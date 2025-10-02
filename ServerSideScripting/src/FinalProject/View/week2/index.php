<div class="card">
    <div class="card-header">
        <h2 class="card-title">Week 2 - Form Handling & Validation</h2>
        <p class="card-subtitle">Learn PHP form processing, validation, and user input handling</p>
    </div>
</div>

<div class="grid grid-2 mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Personal Information Form</h3>
            <p class="card-subtitle">Fill out the form to see PHP form processing in action</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week2">
                <div class="form-group">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" id="name" name="name" class="form-input" 
                           value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>" 
                           placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="dob" class="form-label">Date of Birth *</label>
                    <input type="date" id="dob" name="dob" class="form-input" 
                           value="<?php echo isset($formData['dob']) ? htmlspecialchars($formData['dob']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="color" class="form-label">Favorite Color *</label>
                    <input type="text" id="color" name="color" class="form-input" 
                           value="<?php echo isset($formData['color']) ? htmlspecialchars($formData['color']) : ''; ?>" 
                           placeholder="e.g., Blue, Red, Green">
                </div>

                <div class="form-group">
                    <label for="place" class="form-label">Favorite Place to Visit *</label>
                    <input type="text" id="place" name="place" class="form-input" 
                           value="<?php echo isset($formData['place']) ? htmlspecialchars($formData['place']) : ''; ?>" 
                           placeholder="e.g., Paris, Tokyo, New York">
                </div>

                <div class="form-group">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" id="nickname" name="nickname" class="form-input" 
                           value="<?php echo isset($formData['nickname']) ? htmlspecialchars($formData['nickname']) : ''; ?>" 
                           placeholder="Optional nickname">
                </div>

                <button type="submit" class="btn btn-primary">
                    📝 Submit Information
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Processing Results</h3>
            <p class="card-subtitle">See how PHP processes and validates your input</p>
        </div>
        <div class="card-body">
            <?php if (!empty($results)): ?>
                <div class="space-y-3">
                    <?php foreach ($results as $result): ?>
                        <div class="p-3 rounded border-l-4 <?php echo $result['status'] === 'success' ? 'bg-green-50 border-green-400' : 'bg-yellow-50 border-yellow-400'; ?>">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <?php if ($result['status'] === 'success'): ?>
                                        <span class="text-green-600">✅</span>
                                    <?php else: ?>
                                        <span class="text-yellow-600">⚠️</span>
                                    <?php endif; ?>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium <?php echo $result['status'] === 'success' ? 'text-green-800' : 'text-yellow-800'; ?>">
                                        <strong><?php echo $result['field']; ?>:</strong>
                                    </p>
                                    <p class="text-sm <?php echo $result['status'] === 'success' ? 'text-green-700' : 'text-yellow-700'; ?>">
                                        <?php echo $result['value']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center p-8">
                    <div class="text-6xl mb-4">📝</div>
                    <p class="text-gray-500">Submit the form to see the processing results here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Learning Objectives Demonstrated</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h4 class="text-lg font-semibold mb-2">📋 Form Processing</h4>
                <ul class="space-y-1 text-sm">
                    <li>• POST method handling with $_POST superglobal</li>
                    <li>• Form data validation and sanitization</li>
                    <li>• Input type validation (text, date)</li>
                    <li>• Required vs optional field handling</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-2">🔒 Security Features</h4>
                <ul class="space-y-1 text-sm">
                    <li>• XSS prevention with htmlspecialchars()</li>
                    <li>• Input validation and error handling</li>
                    <li>• Form state preservation on submission</li>
                    <li>• Proper error messaging</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded">
            <h4 class="text-lg font-semibold mb-2 text-blue-800">💡 Key Concepts</h4>
            <p class="text-sm text-blue-700">
                This form demonstrates the fundamental concepts of server-side form processing in PHP. 
                Notice how the form maintains its state after submission, validates required fields, 
                and provides clear feedback to the user. The code uses proper sanitization to prevent 
                XSS attacks and follows PHP best practices for form handling.
            </p>
        </div>
    </div>
</div>

