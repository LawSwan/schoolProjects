<!-- View: presentation only, receives data from controller -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week3 GP2 - Amber Lawson</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Week3 GP2 - Amber Lawson</h1>
        <h2 class="text-xl text-gray-600 mb-6">Database Connection Status</h2>

        <?php if (strlen($dbError)) : ?>
            <!-- Error State -->
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo $dbError; ?>
            </div>
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Property</th>
                        <th class="px-6 py-3 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database Name</td>
                        <td class="px-6 py-4"><?php echo $dbName; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database Host</td>
                        <td class="px-6 py-4"><?php echo $dbHost; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database User</td>
                        <td class="px-6 py-4"><?php echo $dbUser; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database Password</td>
                        <td class="px-6 py-4"><?php echo $dbUserPw ?: '(empty)'; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <!-- Success State -->
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                Successfully connected to <strong><?php echo $dbName; ?></strong>
            </div>
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Property</th>
                        <th class="px-6 py-3 text-left">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database Name</td>
                        <td class="px-6 py-4"><?php echo $dbName; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database Host</td>
                        <td class="px-6 py-4"><?php echo $dbHost; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Database User</td>
                        <td class="px-6 py-4"><?php echo $dbUser; ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">Status</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">Connected</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="../index.php" class="inline-block mt-6 text-blue-600 hover:text-blue-800 font-medium">
            &larr; Back to Home
        </a>
    </div>
</body>
</html>
