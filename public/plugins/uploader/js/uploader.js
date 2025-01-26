class ImageUploader {
    constructor(inputSelector, previewContainerSelector, tableListSelector, buttonsContainerSelector) {
        this.tblList = tableListSelector;
        this.fileInput = document.querySelector(inputSelector);
        this.previewContainer = document.querySelector(previewContainerSelector);
        this.tableContainer = document.querySelector(tableListSelector);
        this.buttonsContainerSelector = buttonsContainerSelector; // Save selector for dynamic lookup
        this.croppedImages = [];
        this.cropper = null;

        this.init();
    }

    init() {
        this.fileInput.addEventListener("change", (event) => this.handleFileChange(event));
    }

    handleFileChange(event) {
        const files = event.target.files;
        if (!files.length) return;

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = () => {
                this.showPreview(reader.result, file);
            };
            reader.readAsDataURL(file);
        });

        // Remove "Add to Queue" button from the closest container
        const buttons = buttonsContainer.querySelectorAll('button');
        buttons.forEach((button) => {
            if (button.textContent.trim() === "Add to List") {
                button.remove(); // Remove the button
            }
        });
    }

    showPreview(imageSrc, file) {
        const image = document.createElement("img");
        image.src = imageSrc;
        image.style.maxWidth = "100%";

        this.previewContainer.innerHTML = ""; // Clear previous preview
        this.previewContainer.appendChild(image);

        // Initialize Cropper.js
        if (this.cropper) this.cropper.destroy();
        this.cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 2,
        });

        // Dynamically find the closest buttons container
        const uploaderContainer = this.fileInput.closest('.uploader');
        const buttonsContainer = uploaderContainer?.querySelector(this.buttonsContainerSelector);

        // Check if buttonsContainer exists
        if (!buttonsContainer) {
            console.error(`Buttons container not found within .uploader for selector: ${this.buttonsContainerSelector}`);
            return;
        }

        // Add "Add to Queue" button
        const addToQueueButton = document.createElement("button");
        addToQueueButton.textContent = "Add to List";
        addToQueueButton.classList.add('btn', 'btn-primary');
        addToQueueButton.style.marginBottom = "2px";
        buttonsContainer.appendChild(addToQueueButton);

        addToQueueButton.addEventListener("click", () => this.addToQueue(file, buttonsContainer));
    }

    addToQueue(file, buttonsContainer) {
        if (!this.cropper) return;

        // Get cropped image data
        this.cropper.getCroppedCanvas().toBlob((blob) => {
            const url = URL.createObjectURL(blob);

            const table = document.querySelector(this.tblList + ' tbody');
            const row = document.createElement('tr');

            // Column 1: No (Row Index)
            const indexCell = document.createElement('td');
            indexCell.classList.add('text-center');
            indexCell.textContent = table.rows.length + 1; // Current number of rows + 1
            row.appendChild(indexCell);

            // Column 2: Attachment Type
            const attachmentTypeCell = document.createElement('td');
            attachmentTypeCell.classList.add('text-center');
            attachmentTypeCell.textContent = attachmentTypeText;
            row.appendChild(attachmentTypeCell);

            // Column 3: Attached Photo
            const photoCell = document.createElement('td');
            photoCell.classList.add('text-center');
            const img = document.createElement('img');
            img.src = url;
            img.style.maxWidth = "100px"; // Restrict the size of the preview
            img.style.height = "auto";
            photoCell.appendChild(img);
            row.appendChild(photoCell);

            this.croppedImages.push(blob); // Save blob for uploading

            // Clear cropping preview
            this.cropper.destroy();
            this.cropper = null;
            this.previewContainer.innerHTML = ""; // Clear the preview container

            // Remove "Add to Queue" button from the closest container
            const buttons = buttonsContainer.querySelectorAll('button');
            buttons.forEach((button) => {
                if (button.textContent.trim() === "Add to List") {
                    button.remove(); // Remove the button
                }
            });
        });
    }

    removeFromQueue(queueItem, blob) {
        // Remove the queue item from the UI
        queueItem.remove();

        // Remove the corresponding blob from croppedImages
        const index = this.croppedImages.indexOf(blob);
        if (index !== -1) {
            this.croppedImages.splice(index, 1);
        }
    }

    async saveAllImages() {
        if (!this.croppedImages.length) {
            alert("No images in the queue.");
            return;
        }

        const formData = new FormData();

        this.croppedImages.forEach((blob, index) => {
            formData.append(`images[${index}]`, blob, `image_${index}.jpg`);
        });

        try {
            const response = await fetch("/upload-images", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            });

            if (response.ok) {
                alert("Images uploaded successfully!");
                this.croppedImages.length = 0; // Clear queue
                this.queueContainer.innerHTML = ""; // Clear UI queue
            } else {
                console.error("Upload failed:", await response.text());
                alert("Failed to upload images.");
            }
        } catch (error) {
            console.error("Error uploading images:", error);
            alert("An error occurred while uploading.");
        }
    }
}
