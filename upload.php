<?php
// Function to convert PHP configuration size to bytes
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

// Mot de passe que l'utilisateur doit entrer
$valid_password = 'Mary-Noelle48';

// Vérifie si un fichier a été téléchargé
if (empty($_FILES['files']['tmp_name'][0])) {
    die("Aucun fichier téléchargé. Vérifiez que la taille des fichiers ne dépasse pas la limite autorisée.");
}

// Vérifie le mot de passe
if (!isset($_POST['password']) || $_POST['password'] !== $valid_password) {
    die("Mot de passe incorrect.");
}

// Crée le dossier de téléchargement s'il n'existe pas
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Limite de taille pour chaque fichier (en octets)
$max_file_size = 32 * 1024 * 1024; // 32 Mo

foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
    $file_name = basename($_FILES['files']['name'][$key]);
    $file_size = $_FILES['files']['size'][$key];
    $file_tmp = $_FILES['files']['tmp_name'][$key];
    $file_type = $_FILES['files']['type'][$key];

    // Vérifie la taille du fichier
    if ($file_size > $max_file_size) {
        die("Le fichier $file_name est trop gros.");
    }

    // Déplace le fichier téléchargé dans le dossier de téléchargement
    $upload_file = $upload_dir . $file_name;
    if (move_uploaded_file($file_tmp, $upload_file)) {
        echo "Le fichier $file_name a été téléchargé avec succès.";
    } else {
        echo "Erreur lors du téléchargement du fichier $file_name.";
    }
}
?>
