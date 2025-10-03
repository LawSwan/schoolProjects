<div class="card">
    <div class="card-header">
        <h2 class="card-title">Cookie Example</h2>
        <p class="card-subtitle">Dedicated demonstration of cookie storage and retrieval</p>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h3 class="text-lg font-semibold mb-3">Current Cookie Values</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded">
                        <strong>Name in Cookie:</strong>
                        <div class="text-lg mt-1">
                            <?php echo htmlspecialchars($storedName); ?>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-green-50 border border-green-200 rounded">
                        <strong>Birthdate in Session:</strong>
                        <div class="text-lg mt-1">
                            <?php echo htmlspecialchars($storedBirthdate); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-3">Cookie Information</h3>
                <div class="space-y-2 text-sm">
                    <div><strong>Storage Location:</strong> Client browser</div>
                    <div><strong>Expiration:</strong> 1 hour from last update</div>
                    <div><strong>Size Limit:</strong> 4KB maximum</div>
                    <div><strong>Security:</strong> Sent with every HTTP request</div>
                    <div><strong>Persistence:</strong> Survives browser restart (until expiry)</div>
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
        <h3 class="card-title">Cookie Technical Details</h3>
    </div>
    <div class="card-body">
        <div class="grid grid-2">
            <div>
                <h4 class="font-semibold mb-2">How Cookies Work</h4>
                <ol class="text-sm space-y-1">
                    <li>1. Server sends Set-Cookie header</li>
                    <li>2. Browser stores the cookie</li>
                    <li>3. Browser sends cookie with future requests</li>
                    <li>4. Server reads cookie via $_COOKIE</li>
                </ol>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Cookie Attributes</h4>
                <ul class="text-sm space-y-1">
                    <li>• <strong>Name:</strong> user_name</li>
                    <li>• <strong>Value:</strong> <?php echo htmlspecialchars($storedName); ?></li>
                    <li>• <strong>Expires:</strong> 1 hour</li>
                    <li>• <strong>Path:</strong> / (entire site)</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded">
            <h4 class="font-semibold mb-2">PHP Code Example</h4>
            <pre class="text-sm"><code>// Setting a cookie
setcookie('user_name', $name, time() + 3600, '/');

// Reading a cookie
$storedName = isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : '';

// Cookie expires in 1 hour (3600 seconds)</code></pre>
        </div>
    </div>
</div>

