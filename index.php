<?php
// Get all files in the current directory
$files = scandir(__DIR__);

// Function to get the file size in a readable format
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory Listing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Directory Listing</h1>
    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>File Size</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <?php if ($file !== '.' && $file !== '..' && $file !== basename(__FILE__)): ?>
                    <tr>
                        <td><a href="<?php echo htmlspecialchars($file); ?>"><?php echo htmlspecialchars($file); ?></a></td>
                        <td><?php echo formatSizeUnits(filesize($file)); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>