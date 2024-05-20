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

// Filter out the current and parent directory and the script file itself
$filteredFiles = array_filter($files, function($file) {
    return $file !== '.' && $file !== '..' && $file !== basename(__FILE__);
});

// Create an array of files with their sizes
$fileData = array_map(function($file) {
    return [
        'name' => $file,
        'size' => formatSizeUnits(filesize($file))
    ];
}, $filteredFiles);

// Encode the file data into JSON
header('Content-Type: application/json');
echo json_encode($fileData);
