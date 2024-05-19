<?php
// Define the directory to be scanned
$directory = '.';

// Open the directory
$dir = opendir($directory);

// Initialize an array to hold the directory contents
$files = [];

// Loop through the directory contents
while (($file = readdir($dir)) !== false) {
    if ($file != '.' && $file != '..') {
        $files[] = $file;
    }
}

// Close the directory
closedir($dir);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f0f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            text-decoration: underline;
        }
        .icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Directory Listing</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td>
                        <a href="<?php echo $file; ?>">
                            <?php if (is_dir($file)): ?>
                                <i class="fas fa-folder icon"></i>
                            <?php else: ?>
                                <i class="fas fa-file icon"></i>
                            <?php endif; ?>
                            <?php echo $file; ?>
                        </a>
                    </td>
                    <td><?php echo is_dir($file) ? 'Directory' : 'File'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
