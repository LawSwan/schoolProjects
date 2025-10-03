<div class="card">
    <div class="card-header">
        <h2 class="card-title">Session Example</h2>
        <p class="card-subtitle">Dedicated demonstration of PHP session management</p>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h3 class="text-lg font-semibold mb-3">Current Session Values</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-purple-50 border border-purple-200 rounded">
                        <strong>Session User:</strong>
                        <div class="text-lg mt-1">
                            <?php echo htmlspecialchars($sessionUser); ?>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-indigo-50 border border-indigo-200 rounded">
                        <strong>Session ID:</strong>
                        <div class="text-sm mt-1 break-all">
                            <?php echo session_id(); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-3">Session Information</h3>
                <div class="space-y-2 text-sm">
                    <div><strong>Storage Location:</strong> Server filesystem</div>
                    <div><strong>Expiration:</strong> When browser closes</div>
                    <div><strong>Size Limit:</strong> Server memory/disk space</div>
                    <div><strong>Security:</strong> Data never sent to client</div>
                    <div><strong>Persistence:</strong> Until session expires or is destroyed</div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 text-center">
            <a href="?page=week5" class="btn btn-primary">← Back to Week 5 Main</a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Session Technical Details</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h4 class="font-semibold mb-2">How Sessions Work</h4>
                <ol class="text-sm space-y-1">
                    <li>1. session_start() creates/resumes session</li>
                    <li>2. PHP generates unique session ID</li>
                    <li>3. Session ID stored in cookie (PHPSESSID)</li>
                    <li>4. Session data stored on server</li>
                    <li>5. $_SESSION array provides access to data</li>
                </ol>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Session Status</h4>
                <ul class="text-sm space-y-1">
                    <li>• <strong>Status:</strong> <?php echo session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive'; ?></li>
                    <li>• <strong>ID:</strong> <?php echo substr(session_id(), 0, 8); ?>...</li>
                    <li>• <strong>Name:</strong> <?php echo session_name(); ?></li>
                    <li>• <strong>Save Path:</strong> Server temporary directory</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded">
            <h4 class="font-semibold mb-2">PHP Code Example</h4>
            <pre class="text-sm"><code>// Start session
session_start();

// Store data in session
$_SESSION['user'] = $username;

// Read data from session
$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'No Entry';

// Destroy session
session_destroy();</code></pre>
        </div>
        
        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded">
            <h4 class="font-semibold mb-2 text-blue-800">🔒 Security Benefits</h4>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Sensitive data never sent to client browser</li>
                <li>• Session ID is cryptographically secure</li>
                <li>• Data stored on server under application control</li>
                <li>• Automatic cleanup when session expires</li>
            </ul>
        </div>
    </div>
</div>

