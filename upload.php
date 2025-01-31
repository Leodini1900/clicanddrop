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
if (empty($_FILES['chunk']['tmp_name'])) {
    error_log("Aucun fichier téléchargé. Vérifiez que la taille des fichiers ne dépasse pas la limite autorisée.");
    die("Aucun fichier téléchargé. Vérifiez que la taille des fichiers ne dépasse pas la limite autorisée.");
}

// Vérifie le mot de passe
if (!isset($_POST['password']) || $_POST['password'] !== $valid_password) {
    error_log("Mot de passe incorrect.");
    die("Mot de passe incorrect.");
}

// Crée le dossier de téléchargement s'il n'existe pas
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0777, true)) {
        error_log("Erreur lors de la création du dossier de téléchargement.");
        die("Erreur lors de la création du dossier de téléchargement.");
    }
}

$fileName = $_POST['fileName'];
$chunkIndex = (int)$_POST['chunkIndex'];
$totalChunks = (int)$_POST['totalChunks'];
$chunkTemp = $_FILES['chunk']['tmp_name'];

// Crée un nom de fichier unique pour chaque morceau
$chunkFileName = $upload_dir . $fileName . '.part' . $chunkIndex;

// Déplace le fichier téléchargé dans le dossier de téléchargement
if (move_uploaded_file($chunkTemp, $chunkFileName)) {
    error_log("Le morceau $chunkIndex du fichier $fileName a été téléchargé avec succès.");

    // Vérifie si tous les morceaux ont été téléchargés
    $allChunksUploaded = true;
    for ($i = 0; $i < $totalChunks; $i++) {
        if (!file_exists($upload_dir . $fileName . '.part' . $i)) {
            $allChunksUploaded = false;
            break;
        }
    }

    // Si tous les morceaux ont été téléchargés, les assembler
    if ($allChunksUploaded) {
        error_log("Tous les morceaux du fichier $fileName ont été téléchargés. Assemblage en cours...");
        $finalFile = $upload_dir . $fileName;
        $fp = fopen($finalFile, 'wb');

        if ($fp === false) {
            error_log("Erreur lors de l'ouverture du fichier final pour écriture.");
            die("Erreur lors de l'ouverture du fichier final pour écriture.");
        }

        for ($i = 0; $i < $totalChunks; $i++) {
            $partFile = $upload_dir . $fileName . '.part' . $i;
            $chunk = file_get_contents($partFile);

            if ($chunk === false) {
                error_log("Erreur lors de la lecture du fichier $partFile.");
                die("Erreur lors de la lecture du fichier $partFile.");
            }

            if (fwrite($fp, $chunk) === false) {
                error_log("Erreur lors de l'écriture du chunk $i dans le fichier final.");
                die("Erreur lors de l'écriture du chunk $i dans le fichier final.");
            }

            unlink($partFile); // Supprime le morceau une fois assemblé
        }

        fclose($fp);
        error_log("Le fichier $fileName a été assemblé avec succès.");
        echo "Le fichier $fileName a été assemblé avec succès.";
    } else {
        error_log("Tous les morceaux n'ont pas encore été téléchargés.");
        echo "Tous les morceaux n'ont pas encore été téléchargés.";
    }
} else {
    error_log("Erreur lors du téléchargement du morceau $chunkIndex du fichier $fileName.");
    die("Erreur lors du téléchargement du morceau $chunkIndex du fichier $fileName.");
}
?>
