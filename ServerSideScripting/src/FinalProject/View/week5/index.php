<?php if ($flashMessage): ?>
    <div class="alert alert-<?php echo $flashMessage['type']; ?>">
        <?php echo $flashMessage['message']; ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Week 5 - Sessions & Cookies</h2>
        <p class="card-subtitle">State management using PHP sessions and cookies for data persistence</p>
    </div>
</div>

<div class="grid grid-2 mt-4">
    <!-- Cookie & Session Storage -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Store Data</h3>
            <p class="card-subtitle">Save name in cookie and birthdate in session</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week5">
                <input type="hidden" name="action" value="store_data">
                
                <div class="form-group">
                    <label for="name" class="form-label">Name (stored in cookie) *</label>
                    <input type="text" id="name" name="name" class="form-input" 
                           value="<?php echo htmlspecialchars($storedName); ?>" required>
                    <small class="text-gray-600">This will be stored in a browser cookie for 1 hour</small>
                </div>
                
                <div class="form-group">
                    <label for="date_of_birth" class="form-label">Date of Birth (stored in session) *</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-input" 
                           value="<?php echo htmlspecialchars($storedBirthdate); ?>" required>
                    <small class="text-gray-600">This will be stored in the server session</small>
                </div>
                
                <button type="submit" class="btn btn-primary">💾 Store Data</button>
            </form>
        </div>
    </div>

    <!-- Session User Management -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Session User</h3>
            <p class="card-subtitle">Manage user name in session</p>
        </div>
        <div class="card-body">
            <form method="POST" action="?page=week5">
                <input type="hidden" name="action" value="store_session">
                
                <div class="form-group">
                    <label for="user" class="form-label">User Name *</label>
                    <input type="text" id="user" name="user" class="form-input" 
                           value="<?php echo htmlspecialchars($sessionUser); ?>" required>
                    <small class="text-gray-600">This will be stored in the PHP session</small>
                </div>
                
                <button type="submit" class="btn btn-success">👤 Update Session User</button>
            </form>
        </div>
    </div>
</div>

<!-- Data Display -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Current Stored Data</h3>
        <p class="card-subtitle">View what's currently stored in cookies and sessions</p>
    </div>
    <div class="card-body">
        <div class="grid grid-3">
            <div class="p-4 bg-blue-50 border border-blue-200 rounded">
                <h4 class="text-lg font-semibold mb-2 text-blue-800">🍪 Cookie Data</h4>
                <div class="space-y-2">
                    <div>
                        <strong>Name:</strong>
                        <span class="block text-sm text-gray-700">
                            <?php echo $storedName ? htmlspecialchars($storedName) : 'No name stored in cookie'; ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="p-4 bg-green-50 border border-green-200 rounded">
                <h4 class="text-lg font-semibold mb-2 text-green-800">🔐 Session Data</h4>
                <div class="space-y-2">
                    <div>
                        <strong>Birthdate:</strong>
                        <span class="block text-sm text-gray-700">
                            <?php echo $storedBirthdate ? htmlspecialchars($storedBirthdate) : 'No birthdate stored in session'; ?>
                        </span>
                    </div>
                    <div>
                        <strong>Session User:</strong>
                        <span class="block text-sm text-gray-700">
                            <?php echo htmlspecialchars($sessionUser); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="p-4 bg-purple-50 border border-purple-200 rounded">
                <h4 class="text-lg font-semibold mb-2 text-purple-800">📊 Session Info</h4>
                <div class="space-y-2">
                    <div>
                        <strong>Session ID:</strong>
                        <span class="block text-sm text-gray-700 break-all">
                            <?php echo session_id(); ?>
                        </span>
                    </div>
                    <div>
                        <strong>Session Status:</strong>
                        <span class="block text-sm text-gray-700">
                            <?php echo session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive'; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Demonstration Links -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Individual Demonstrations</h3>
        <p class="card-subtitle">View separate cookie and session examples</p>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div class="text-center p-6 bg-orange-50 border border-orange-200 rounded">
                <div class="text-4xl mb-3">🍪</div>
                <h4 class="text-lg font-semibold mb-2">Cookie Example</h4>
                <p class="text-sm text-gray-600 mb-4">
                    View a dedicated page showing cookie storage and retrieval
                </p>
                <a href="?page=week5/cookies" class="btn btn-warning">View Cookie Demo</a>
            </div>
            
            <div class="text-center p-6 bg-indigo-50 border border-indigo-200 rounded">
                <div class="text-4xl mb-3">🔐</div>
                <h4 class="text-lg font-semibold mb-2">Session Example</h4>
                <p class="text-sm text-gray-600 mb-4">
                    View a dedicated page showing session management
                </p>
                <a href="?page=week5/sessions" class="btn btn-primary">View Session Demo</a>
            </div>
        </div>
    </div>
</div>

<!-- Technical Details -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Learning Objectives Demonstrated</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h4 class="text-lg font-semibold mb-2">🍪 Cookie Management</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Setting cookies with expiration times</li>
                    <li>• Reading cookie values with $_COOKIE</li>
                    <li>• Cookie persistence across page requests</li>
                    <li>• Client-side storage limitations</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-2">🔐 Session Management</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Starting sessions with session_start()</li>
                    <li>• Storing data in $_SESSION superglobal</li>
                    <li>• Session persistence across requests</li>
                    <li>• Server-side storage security</li>
                </ul>
            </div>
        </div>
        
        <div class="grid grid-2 mt-4">
            <div>
                <h4 class="text-lg font-semibold mb-2">🔄 State Persistence</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Maintaining user data between requests</li>
                    <li>• Form data preservation</li>
                    <li>• User preference storage</li>
                    <li>• Shopping cart-like functionality</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-2">🛡️ Security Considerations</h4>
                <ul class="space-y-1 text-sm">
                    <li>• Cookie security and HttpOnly flags</li>
                    <li>• Session hijacking prevention</li>
                    <li>• Data sanitization and validation</li>
                    <li>• Secure vs insecure storage choices</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded">
            <h4 class="text-lg font-semibold mb-2 text-yellow-800">⚡ Key Differences</h4>
            <div class="grid grid-2 gap-4 text-sm">
                <div>
                    <strong class="text-yellow-800">Cookies:</strong>
                    <ul class="text-yellow-700 mt-1">
                        <li>• Stored on client browser</li>
                        <li>• Limited size (4KB)</li>
                        <li>• Can have expiration dates</li>
                        <li>• Sent with every request</li>
                    </ul>
                </div>
                <div>
                    <strong class="text-yellow-800">Sessions:</strong>
                    <ul class="text-yellow-700 mt-1">
                        <li>• Stored on server</li>
                        <li>• No size limitations</li>
                        <li>• Expire when browser closes</li>
                        <li>• More secure for sensitive data</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

