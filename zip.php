<?php

$dir = './';  // Ensure this is an existing directory
$zip = new ZipArchive();

// Generate the zip file name based on the folder name
$zipFileName = rtrim($dir, '/') . '.zip';

// Try to create the zip file
$res = $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

if ($res === TRUE) {
    // Loop through all files in the directory
    foreach (glob($dir . '*') as $file) {
        if (is_file($file)) {
            // Add file to the zip archive
            $zip->addFile($file, basename($file));
        }
    }
    // Close the zip archive
    $zip->close();
    echo 'Zip file created successfully: ' . $zipFileName;
} else {
    // Translate error code to meaningful message
    $errorMsg = match($res) {
        ZipArchive::ER_EXISTS => 'File already exists.',
        ZipArchive::ER_INCONS => 'Zip archive inconsistent.',
        ZipArchive::ER_INVAL => 'Invalid argument.',
        ZipArchive::ER_MEMORY => 'Malloc failure.',
        ZipArchive::ER_NOENT => 'No such file.',
        ZipArchive::ER_NOZIP => 'Not a zip archive.',
        ZipArchive::ER_OPEN => 'Can\'t open file.',
        ZipArchive::ER_READ => 'Read error.',
        ZipArchive::ER_SEEK => 'Seek error.',
        default => 'Unknown error.'
    };
    
    echo 'Failed to create zip. Error: ' . $errorMsg;
}
