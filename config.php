<?php
// Convert PHP configuration size to bytes
function convertPHPSizeToBytes($sSize) {
    if (is_numeric($sSize)) {
        return (int)$sSize;
    }
    $sSuffix = strtoupper(substr($sSize, -1));
    $iValue = (int)substr($sSize, 0, -1);
    switch ($sSuffix) {
        case 'P':
            $iValue *= 1024;
        case 'T':
            $iValue *= 1024;
        case 'G':
            $iValue *= 1024;
        case 'M':
            $iValue *= 1024;
        case 'K':
            $iValue *= 1024;
            break;
    }
    return $iValue;
}

// Get the maximum upload size
$maxUpload = convertPHPSizeToBytes(ini_get('upload_max_filesize'));
$maxPost = convertPHPSizeToBytes(ini_get('post_max_size'));
$memoryLimit = convertPHPSizeToBytes(ini_get('memory_limit'));

// Choose the smallest value among the three
$maxFileSize = min($maxUpload, $maxPost, $memoryLimit);

// Convert to MB for display
$maxFileSizeMB = $maxFileSize / 1024 / 1024;

header('Content-Type: application/json');
echo json_encode([
    'maxFileSizeMB' => $maxFileSizeMB,
    'maxFileSize' => $maxFileSize
]);
?>
