<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <h1><?php echo APP_NAME; ?></h1>
            <p class="subtitle">Consolidated Learning Objectives - Weeks 2-5</p>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav">
        <div class="container">
            <div class="nav-links">
                <a href="?page=dashboard" class="nav-link <?php echo (!isset($_GET['page']) || $_GET['page'] === 'dashboard') ? 'active' : ''; ?>">
                    🏠 Dashboard
                </a>
                <a href="?page=week2" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'week2') ? 'active' : ''; ?>">
                    📝 Week 2 - Forms
                </a>
                <a href="?page=week3" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'week3') ? 'active' : ''; ?>">
                    🏠 Week 3 - Addresses
                </a>
                <a href="?page=week4" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'week4') ? 'active' : ''; ?>">
                    🛍️ Week 4 - Products
                </a>
                <a href="?page=week5" class="nav-link <?php echo (isset($_GET['page']) && $_GET['page'] === 'week5') ? 'active' : ''; ?>">
                    🔐 Week 5 - Sessions
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 SDC310 Final Project - Amber Lawson | Server-Side Scripting</p>
        </div>
    </footer>

    <script>
        // Simple JavaScript for enhanced UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to main content
            document.querySelector('.main-content').classList.add('fade-in');
            
            // Auto-hide flash messages after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
            
            // Confirm delete actions
            const deleteLinks = document.querySelectorAll('a[href*="delete"]');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to delete this item?')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            field.style.borderColor = 'var(--danger-color)';
                            isValid = false;
                        } else {
                            field.style.borderColor = 'var(--border-color)';
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Please fill in all required fields.');
                    }
                });
            });
        });
    </script>
</body>
</html>

