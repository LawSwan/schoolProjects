<?php if ($flashMessage): ?>
    <div class="alert alert-<?php echo $flashMessage['type']; ?>">
        <?php echo $flashMessage['message']; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Week 3 - Address Management System</h2>
        <p class="card-subtitle">Full CRUD operations with MySQL database (Originally Midterm Project)</p>
    </div>
</div>

<div class="grid grid-2 mt-4">
    <!-- Add/Edit Form -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo $editRecord ? 'Edit Address' : 'Add New Address'; ?></h3>
            <p class="card-subtitle">
                <?php echo $editRecord ? 'Update the address information' : 'Enter address details to add to the database'; ?>
            </p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=<?php echo $editRecord ? 'week3/edit' : 'week3/create'; ?>">
                <?php if ($editRecord): ?>
                    <input type="hidden" name="id" value="<?php echo $editRecord['AddressNo']; ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first" class="form-label">First Name *</label>
                        <input type="text" id="first" name="first" class="form-input" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['First']) : ''; ?>" 
                               maxlength="25" required>
                    </div>
                    <div class="form-group">
                        <label for="last" class="form-label">Last Name *</label>
                        <input type="text" id="last" name="last" class="form-input" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['Last']) : ''; ?>" 
                               maxlength="30" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="street" class="form-label">Street Address *</label>
                    <input type="text" id="street" name="street" class="form-input" 
                           value="<?php echo $editRecord ? htmlspecialchars($editRecord['Street']) : ''; ?>" 
                           maxlength="100" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="city" class="form-label">City *</label>
                        <input type="text" id="city" name="city" class="form-input" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['City']) : ''; ?>" 
                               maxlength="25" required>
                    </div>
                    <div class="form-group">
                        <label for="state" class="form-label">State *</label>
                        <input type="text" id="state" name="state" class="form-input" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['State']) : ''; ?>" 
                               maxlength="2" style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group">
                        <label for="zip" class="form-label">ZIP Code *</label>
                        <input type="text" id="zip" name="zip" class="form-input" 
                               value="<?php echo $editRecord ? htmlspecialchars($editRecord['Zip']) : ''; ?>" 
                               maxlength="10" required>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?php echo $editRecord ? '✏️ Update Address' : '➕ Add Address'; ?>
                    </button>
                    <?php if ($editRecord): ?>
                        <a href="?page=week3" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Search -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Search Addresses</h3>
            <p class="card-subtitle">Find addresses by any field</p>
        </div>
        <div class="card-body">
            <form method="GET" action="?page=week3">
                <input type="hidden" name="page" value="week3">
                <div class="form-group">
                    <label for="search" class="form-label">Search Term</label>
                    <input type="text" id="search" name="search" class="form-input" 
                           value="<?php echo htmlspecialchars($search ?? ''); ?>" 
                           placeholder="Search by name, address, city, state, or ZIP">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">🔍 Search</button>
                    <?php if ($search): ?>
                        <a href="?page=week3" class="btn btn-secondary">Clear</a>
                    <?php endif; ?>
                </div>
            </form>
            
            <?php if ($search): ?>
                <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded">
                    <p class="text-sm text-blue-700">
                        <strong>Search Results for:</strong> "<?php echo htmlspecialchars($search); ?>"
                        <br><strong>Found:</strong> <?php echo count($addresses); ?> address(es)
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Address Table -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">All Addresses</h3>
        <p class="card-subtitle">
            <?php echo count($addresses); ?> address(es) in the database
            <?php echo $search ? ' (filtered)' : ''; ?>
        </p>
    </div>
    <div class="card-body">
        <?php if (!empty($addresses)): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Street</th>
                            <th>City</th>
                            <th>State</th>
                            <th>ZIP</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($addresses as $address): ?>
                            <tr>
                                <td><?php echo $address['AddressNo']; ?></td>
                                <td><?php echo htmlspecialchars($address['First']); ?></td>
                                <td><?php echo htmlspecialchars($address['Last']); ?></td>
                                <td><?php echo htmlspecialchars($address['Street']); ?></td>
                                <td><?php echo htmlspecialchars($address['City']); ?></td>
                                <td><?php echo htmlspecialchars($address['State']); ?></td>
                                <td><?php echo htmlspecialchars($address['Zip']); ?></td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="?page=week3&action=edit&id=<?php echo $address['AddressNo']; ?>" 
                                           class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="?page=week3/delete&id=<?php echo $address['AddressNo']; ?>" 
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
                <div class="text-6xl mb-4">🏠</div>
                <p class="text-gray-500">
                    <?php echo $search ? 'No addresses found matching your search.' : 'No addresses in the database yet.'; ?>
                </p>
                <?php if ($search): ?>
                    <a href="?page=week3" class="btn btn-primary mt-3">View All Addresses</a>
                <?php endif; ?>
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
                <h4 class="text-lg font-semibold mb-2">🗄️ Database Operations</h4>
                <ul class="space-y-1 text-sm">
                    <li>• <strong>CREATE:</strong> Add new addresses to database</li>
                    <li>• <strong>READ:</strong> Display all addresses with search</li>
                    <li>• <strong>UPDATE:</strong> Edit existing address information</li>
                    <li>• <strong>DELETE:</strong> Remove addresses from database</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-2">🏗️ MVC Architecture</h4>
                <ul class="space-y-1 text-sm">
                    <li>• <strong>Model:</strong> AddressModel handles all database logic</li>
                    <li>• <strong>View:</strong> This template handles presentation</li>
                    <li>• <strong>Controller:</strong> AddressController manages flow</li>
                    <li>• <strong>Routing:</strong> Clean URLs and action handling</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded">
            <h4 class="text-lg font-semibold mb-2 text-green-800">🎯 Midterm Project Conversion</h4>
            <p class="text-sm text-green-700">
                This is the original Week 3 Midterm project, completely rebuilt using MVC architecture. 
                The functionality remains identical, but the code is now properly organized with 
                separation of concerns, making it more maintainable and scalable.
            </p>
        </div>
    </div>
</div>

<script>
// Auto-uppercase state field
document.getElementById('state').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});
</script>
