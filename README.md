# Projet Clic and Drop

## Description
Le projet **Clic and Drop** est une application web permettant de télécharger facilement des fichiers en les déposant dans une zone dédiée sur la page web. Les fichiers peuvent être compressés en un fichier ZIP avant d'être téléchargés sur le serveur.

## Fonctionnalités
- **Zone de dépôt** : Une zone où les utilisateurs peuvent glisser et déposer des fichiers ou des dossiers.
- **Téléchargement de fichiers multiples** : Les utilisateurs peuvent sélectionner et déposer plusieurs fichiers ou dossiers en même temps.
- **Compression ZIP** : Les fichiers déposés sont compressés en un fichier ZIP avant d'être téléchargés.
- **Popup de mot de passe** : Une popup demande aux utilisateurs d'entrer un mot de passe avant de télécharger les fichiers.
- **Affichage de la progression** : La progression du téléchargement est affichée à l'utilisateur.
- **Gestion des erreurs** : Vérification de la taille des fichiers et affichage des messages d'erreur en cas de problème.

## Configuration
### Fichier `config.php`
- Récupère et renvoie la taille maximale des fichiers pouvant être téléchargés en fonction des configurations PHP.

### Fichier `upload.php`
- Gère le processus de téléchargement des fichiers.
- Vérifie le mot de passe avant d'autoriser le téléchargement.
- Vérifie la taille des fichiers téléchargés.
- Déplace les fichiers téléchargés dans le répertoire `uploads/`.

## Utilisation
1. Ouvrez `index.html` dans un navigateur web.
2. Glissez et déposez vos fichiers ou dossiers dans la zone de dépôt.
3. Entrez le mot de passe lorsque la popup apparaît.
4. Les fichiers seront compressés en un fichier ZIP et téléchargés sur le serveur.

## Dépendances
- [JSZip](https://stuk.github.io/jszip/) : Une bibliothèque JavaScript pour créer, lire et éditer des fichiers ZIP.

## Auteur
- Leodini1900

## Licence
Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
