<?php if ($flashMessage): ?>
    <div class="alert alert-<?php echo $flashMessage['type']; ?>">
        <?php echo $flashMessage['message']; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Week 4 - Products & Database Operations</h2>
        <p class="card-subtitle">Advanced database operations with multiple tables and relationships</p>
    </div>
</div>

<div class="grid grid-3 mt-4">
    <!-- Product Management -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo $editProduct ? 'Edit Product' : 'Add Product'; ?></h3>
            <p class="card-subtitle">Manage digital products</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week4">
                <input type="hidden" name="action" value="<?php echo $editProduct ? 'update_product' : 'create_product'; ?>">
                <?php if ($editProduct): ?>
                    <input type="hidden" name="id" value="<?php echo $editProduct['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="name" class="form-label">Product Name *</label>
                    <input type="text" id="name" name="name" class="form-input" 
                           value="<?php echo $editProduct ? htmlspecialchars($editProduct['name']) : ''; ?>" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="price" class="form-label">Price ($) *</label>
                    <input type="number" id="price" name="price" class="form-input" 
                           value="<?php echo $editProduct ? $editProduct['price'] : ''; ?>" 
                           step="0.01" min="0" required>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $editProduct ? '✏️ Update' : '➕ Add Product'; ?>
                    </button>
                    <?php if ($editProduct): ?>
                        <a href="?page=week4" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- User Management -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add User</h3>
            <p class="card-subtitle">Register new users</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week4">
                <input type="hidden" name="action" value="create_user">
                
                <div class="form-group">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" id="name" name="name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input">
                </div>
                
                <button type="submit" class="btn btn-success">👤 Add User</button>
            </form>
        </div>
    </div>

    <!-- Purchase Recording -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Record Purchase</h3>
            <p class="card-subtitle">Track product sales</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week4">
                <input type="hidden" name="action" value="create_purchase">
                
                <div class="form-group">
                    <label for="user_id" class="form-label">User *</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Select User</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>">
                                <?php echo htmlspecialchars($user['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="product_id" class="form-label">Product *</label>
                    <select id="product_id" name="product_id" class="form-select" required>
                        <option value="">Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['id']; ?>">
                                <?php echo htmlspecialchars($product['name']); ?> - $<?php echo number_format($product['price'], 2); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="quantity" class="form-label">Quantity *</label>
                    <input type="number" id="quantity" name="quantity" class="form-input" 
                           value="1" min="1" required>
                </div>
                
                <button type="submit" class="btn btn-primary">🛒 Record Purchase</button>
            </form>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Products</h3>
        <p class="card-subtitle"><?php echo count($products); ?> product(s) available</p>
    </div>
    <div class="card-body">
        <?php if (!empty($products)): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td>$<?php echo number_format($product['price'], 2); ?></td>
                                <td><?php echo date('M j, Y', strtotime($product['created_at'])); ?></td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="?page=week4&action=edit_product&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="?page=week4&action=delete_product&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-danger btn-sm">🗑️ Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center p-8">
                <div class="text-6xl mb-4">🛍️</div>
                <p class="text-gray-500">No products available yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Users with Purchase Summary -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Users & Purchase Summary</h3>
        <p class="card-subtitle"><?php echo count($usersWithPurchases); ?> user(s) registered</p>
    </div>
    <div class="card-body">
        <?php if (!empty($usersWithPurchases)): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Purchases</th>
                            <th>Total Spent</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersWithPurchases as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo $user['total_purchases'] ?? 0; ?></td>
                                <td>$<?php echo number_format($user['total_spent'] ?? 0, 2); ?></td>
                                <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center p-8">
                <div class="text-6xl mb-4">👥</div>
                <p class="text-gray-500">No users registered yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Recent Purchases -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Recent Purchases</h3>
        <p class="card-subtitle"><?php echo count($purchases); ?> purchase(s) recorded</p>
    </div>
    <div class="card-body">
        <?php if (!empty($purchases)): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchases as $purchase): ?>
                            <tr>
                                <td><?php echo $purchase['id']; ?></td>
                                <td><?php echo htmlspecialchars($purchase['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($purchase['product_name']); ?></td>
                                <td><?php echo $purchase['quantity']; ?></td>
                                <td>$<?php echo number_format($purchase['price'], 2); ?></td>
                                <td>$<?php echo number_format($purchase['quantity'] * $purchase['price'], 2); ?></td>
                                <td><?php echo date('M j, Y g:i A', strtotime($purchase['purchased_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center p-8">
                <div class="text-6xl mb-4">🛒</div>
                <p class="text-gray-500">No purchases recorded yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Learning Objectives Demonstrated</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h4 class="text-lg font-semibold mb-2">🗄️ Advanced Database Operations</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Multiple table management (products, users, purchases)</li>
                    <li>• Foreign key relationships and constraints</li>
                    <li>• Complex JOIN queries for data aggregation</li>
                    <li>• Transaction-like operations for data integrity</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-2">🏗️ MVC Best Practices</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Separation of business logic in models</li>
                    <li>• Controller action handling and routing</li>
                    <li>• View templating with data binding</li>
                    <li>• Error handling and user feedback</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-purple-50 border border-purple-200 rounded">
            <h4 class="text-lg font-semibold mb-2 text-purple-800">💼 Business Logic</h4>
            <p class="text-sm text-purple-700">
                This section demonstrates a complete e-commerce-style system with products, users, and purchases. 
                The database design includes proper relationships, and the application handles complex queries 
                like calculating total spending per user and aggregating purchase data.
            </p>
        </div>
    </div>
</div>

