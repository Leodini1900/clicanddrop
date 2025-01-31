<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploader des photos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
</head>
<body>
    <h1>🙂 Déposez vos photos ici 🙂</h1>
    <div class="dropzone" id="dropzone">🧙‍♂️ Déposez vos fichiers ou dossiers ici 🧙‍♂️</div>
    <ul id="fileList"></ul>

    <div>
        🌟 Il est possible de sélectionner et déposer plusieurs fichiers ou dossier en même temps. 🌟
    </div>
    <div id="totalFileSize">Taille totale des fichiers déposés : <span id="totalSize"></span> Mo</div> -->

    <form id="uploadForm" class="hidden">
        <input type="file" name="files[]" id="fileInput" multiple>
        <input type="password" id="hiddenPassword" name="password">
    </form>

    <div id="passwordPopup">
        <label for="popupPassword">Mot de passe :</label>
        <input type="password" id="popupPassword" name="popupPassword" required>
        <button onclick="submitForm()">Valider</button>
    </div>

    <div id="confirmationPopup">
        <p>Fichiers téléchargés avec succès !</p>
        <button onclick="closeConfirmationPopup()">OK</button>
    </div>

    <div id="progressBarContainer">
        <div id="progressBar"></div>
    </div>

    <div id="loadingSpinner">
        <p>Compression en cours, veuillez patienter...</p>
        <img src="https://i.gifer.com/YCZH.gif" alt="Loading...">
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileList = document.getElementById('fileList');
        const zipSizeElement = document.getElementById('zipSize');
        const fileInput = document.getElementById('fileInput');
        const passwordPopup = document.getElementById('passwordPopup');
        const confirmationPopup = document.getElementById('confirmationPopup');
        const popupPassword = document.getElementById('popupPassword');
        const hiddenPassword = document.getElementById('hiddenPassword');
        const uploadForm = document.getElementById('uploadForm');
        const progressBarContainer = document.getElementById('progressBarContainer');
        const progressBar = document.getElementById('progressBar');
        const loadingSpinner = document.getElementById('loadingSpinner');
        let droppedItems = null;
        const MAX_CHUNK_SIZE = 20 * 1024 * 1024; // 20 MB

        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            droppedItems = e.dataTransfer.items;
            showPasswordPopup();
            displayFileList(droppedItems);
        });

        function displayFileList(items) {
            fileList.innerHTML = '';
            for (let i = 0; i < items.length; i++) {
                let file = items[i].getAsFile();
                if (file) {
                    let listItem = document.createElement('li');
                    listItem.textContent = `${file.name} (${(file.size / (1024 * 1024)).toFixed(2)} Mo)`;
                    fileList.appendChild(listItem);
                }
            }
        }

        function showPasswordPopup() {
            passwordPopup.style.display = 'block';
        }

        function submitForm() {
            const password = popupPassword.value;
            if (password) {
                hiddenPassword.value = password;
                passwordPopup.style.display = 'none';

                if (droppedItems) {
                    processFiles(droppedItems);
                }
            } else {
                alert('Veuillez entrer le mot de passe.');
            }
        }

        async function processFiles(items) {
            loadingSpinner.style.display = 'block';

            let zip = new JSZip();
            let folderName = '';

            for (let i = 0; i < items.length; i++) {
                let entry = items[i].webkitGetAsEntry();
                if (entry.isDirectory) {
                    folderName = entry.name;
                    await addDirectoryToZip(entry, zip);
                } else {
                    let file = items[i].getAsFile();
                    folderName = file.name.split('.')[0]; // Use the file name without extension if it's not a directory
                    zip.file(file.name, file);
                }
            }

            const timestamp = new Date().toISOString().replace(/[-:.]/g, '');
            const zipFileName = `${folderName}_${timestamp}.zip`;

            let startTime = Date.now();
            zip.generateAsync({ type: 'blob' }, (metadata) => {
                // Update progress bar and estimated time
                let progress = Math.round(metadata.percent);
                progressBar.style.width = progress + '%';
                progressPercentage.textContent = progress + '%';

                let elapsedTime = (Date.now() - startTime) / 1000; // in seconds
                let estimatedTotalTime = (elapsedTime / metadata.percent) * 100; // in seconds
                let timeLeft = estimatedTotalTime - elapsedTime;

                timeRemaining.textContent = formatTime(timeLeft);
            }).then((content) => {
                let zipBlob = new Blob([content], { type: 'application/zip' });
                let zipFile = new File([zipBlob], zipFileName, { type: 'application/zip' });

                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(zipFile);
                fileInput.files = dataTransfer.files;

                // Display the size of the ZIP file
                zipSizeElement.textContent = (zipBlob.size / (1024 * 1024)).toFixed(2);

                loadingSpinner.style.display = 'none';
                uploadFiles();
            });
        }

        function formatTime(seconds) {
            let minutes = Math.floor(seconds / 60);
            seconds = Math.floor(seconds % 60);
            return `${minutes}m ${seconds}s`;
        }

        async function uploadFiles() {
            const files = fileInput.files;
            for (let file of files) {
                await uploadFileInChunks(file);
            }
            showConfirmationPopup();
        }

        async function uploadFileInChunks(file) {
            const totalChunks = Math.ceil(file.size / MAX_CHUNK_SIZE);
            for (let chunkIndex = 0; chunkIndex < totalChunks; chunkIndex++) {
                const start = chunkIndex * MAX_CHUNK_SIZE;
                const end = Math.min(start + MAX_CHUNK_SIZE, file.size);
                const chunk = file.slice(start, end);

                const formData = new FormData();
                formData.append('chunk', chunk);
                formData.append('chunkIndex', chunkIndex);
                formData.append('totalChunks', totalChunks);
                formData.append('fileName', file.name);
                formData.append('password', hiddenPassword.value);

                progressBarContainer.style.display = 'block';
                progressBar.style.width = `${((chunkIndex + 1) / totalChunks) * 100}%`;

                await fetch('upload.php', {
                    method: 'POST',
                    body: formData
                });
            }
            progressBarContainer.style.display = 'none';
        }

        function showConfirmationPopup() {
            confirmationPopup.style.display = 'block';
        }

        function closeConfirmationPopup() {
            confirmationPopup.style.display = 'none';
        }

        async function addDirectoryToZip(entry, zipFolder) {
            let reader = entry.createReader();
            let entries = await readAllEntries(reader);

            for (let entry of entries) {
                if (entry.isDirectory) {
                    await addDirectoryToZip(entry, zipFolder.folder(entry.name));
                } else {
                    let file = await getFile(entry);
                    zipFolder.file(entry.name, file);
                }
            }
        }

        function readAllEntries(reader) {
            return new Promise((resolve, reject) => {
                reader.readEntries((entries) => {
                    if (entries.length === 0) {
                        resolve([]);
                    } else {
                        resolve(entries);
                    }
                });
            });
        }

        function getFile(entry) {
            return new Promise((resolve, reject) => {
                entry.file((file) => {
                    resolve(file);
                });
            });
        }
    </script>

</body>
</html>
