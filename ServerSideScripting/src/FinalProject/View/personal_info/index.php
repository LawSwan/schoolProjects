<?php
$pageTitle = 'Personal Information Management';
$pageDescription = 'View and manage personal information from the database';
?>

<!-- Success/Error Messages -->
<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        <?php
        switch ($_GET['success']) {
            case 'created': echo 'Person added successfully!'; break;
            case 'updated': echo 'Person updated successfully!'; break;
            case 'deleted': echo 'Person deleted successfully!'; break;
        }
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-error">
        <?php
        switch ($_GET['error']) {
            case 'missing_fields': echo 'Please fill in all required fields.'; break;
            case 'delete_failed': echo 'Failed to delete person.'; break;
            default: echo 'An error occurred.'; break;
        }
        ?>
    </div>
<?php endif; ?>

<!-- Search Form -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">🔍 Search Personal Information</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="flex gap-2">
            <input type="hidden" name="page" value="personal_info">
            <input type="text" 
                   name="search" 
                   placeholder="Search by name, color, place, nickname, or email..." 
                   value="<?php echo htmlspecialchars($search); ?>"
                   class="form-input flex-1">
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if ($search): ?>
                <a href="?page=personal_info" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Add/Edit Form -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <?php echo $editPerson ? '✏️ Edit Person' : '➕ Add New Person'; ?>
        </h3>
    </div>
    <div class="card-body">
        <form method="POST" class="grid grid-2 gap-4">
            <input type="hidden" name="action" value="<?php echo $editPerson ? 'update' : 'create'; ?>">
            <?php if ($editPerson): ?>
                <input type="hidden" name="id" value="<?php echo $editPerson['id']; ?>">
            <?php endif; ?>
            
            <div>
                <label class="form-label">Name *</label>
                <input type="text" 
                       name="name" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['name']) : ''; ?>"
                       class="form-input" 
                       required>
            </div>
            
            <div>
                <label class="form-label">Email *</label>
                <input type="email" 
                       name="email" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['email']) : ''; ?>"
                       class="form-input" 
                       required>
            </div>
            
            <div>
                <label class="form-label">Date of Birth</label>
                <input type="date" 
                       name="date_of_birth" 
                       value="<?php echo $editPerson ? $editPerson['date_of_birth'] : ''; ?>"
                       class="form-input">
            </div>
            
            <div>
                <label class="form-label">Phone</label>
                <input type="tel" 
                       name="phone" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['phone']) : ''; ?>"
                       class="form-input">
            </div>
            
            <div>
                <label class="form-label">Favorite Color</label>
                <input type="text" 
                       name="favorite_color" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['favorite_color']) : ''; ?>"
                       class="form-input">
            </div>
            
            <div>
                <label class="form-label">Favorite Place</label>
                <input type="text" 
                       name="favorite_place" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['favorite_place']) : ''; ?>"
                       class="form-input">
            </div>
            
            <div>
                <label class="form-label">Nickname</label>
                <input type="text" 
                       name="nickname" 
                       value="<?php echo $editPerson ? htmlspecialchars($editPerson['nickname']) : ''; ?>"
                       class="form-input">
            </div>
            
            <div class="flex gap-2 items-end">
                <button type="submit" class="btn btn-primary">
                    <?php echo $editPerson ? 'Update Person' : 'Add Person'; ?>
                </button>
                <?php if ($editPerson): ?>
                    <a href="?page=personal_info" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<!-- Personal Information Table -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">👥 Personal Information Database</h3>
        <p class="card-subtitle">
            <?php echo count($people); ?> person(s) in the database
            <?php echo $search ? ' (filtered)' : ''; ?>
        </p>
    </div>
    <div class="card-body">
        <?php if (!empty($people)): ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Favorite Color</th>
                            <th>Favorite Place</th>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($people as $person): ?>
                            <tr>
                                <td><?php echo $person['id']; ?></td>
                                <td><?php echo htmlspecialchars($person['name']); ?></td>
                                <td><?php echo $person['date_of_birth'] ? date('M j, Y', strtotime($person['date_of_birth'])) : '-'; ?></td>
                                <td>
                                    <span class="badge" style="background-color: <?php echo strtolower($person['favorite_color']); ?>; color: white;">
                                        <?php echo htmlspecialchars($person['favorite_color']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($person['favorite_place']); ?></td>
                                <td><?php echo htmlspecialchars($person['nickname']); ?></td>
                                <td><?php echo htmlspecialchars($person['email']); ?></td>
                                <td><?php echo htmlspecialchars($person['phone']); ?></td>
                                <td><?php echo $person['created_at'] ? date('M j, Y', strtotime($person['created_at'])) : '-'; ?></td>
                                <td>
                                    <div class="flex gap-1">
                                        <a href="?page=personal_info&action=edit&id=<?php echo $person['id']; ?>" 
                                           class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <a href="?page=personal_info&action=delete&id=<?php echo $person['id']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($person['name']); ?>?')">🗑️ Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center p-8">
                <div class="text-6xl mb-4">👥</div>
                <p class="text-gray-500">
                    <?php echo $search ? 'No people found matching your search.' : 'No people in the database yet.'; ?>
                </p>
                <?php if ($search): ?>
                    <a href="?page=personal_info" class="btn btn-primary mt-3">View All People</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

