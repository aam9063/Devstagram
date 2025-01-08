import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function() {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Drop files here to upload',
        acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
        addRemoveLinks: true,
        dictRemoveFile: 'Remove file',
        maxFiles: 1,
        uploadMultiple: false,

        init: function() {
            const imageInput = document.querySelector('[name="image"]');
            if (imageInput && imageInput.value.trim()) { // If there is an image already uploaded in the database then show it
                const publishedImage = {};
                publishedImage.size = 1234;
                publishedImage.name = imageInput.value;

                this.options.addedfile.call(this, publishedImage); // Call the default addedfile event
                this.options.thumbnail.call(this, publishedImage, `/uploads/${publishedImage.name}`); // Call the default thumbnail event

                publishedImage.previewElement.classList.add('dz-success', 'dz-complete'); // Add the complete class (green border color)
            }
        },
    });

    dropzone.on('success', function(file, response) {
        if (response.image) {
            document.querySelector('[name="image"]').value = response.image;
        } else {
            console.error('Error: La respuesta del servidor no contiene el nombre de la imagen.');
        }
    });

    dropzone.on('error', function(file, response) {
        console.error('Error: ', response);
    });

    dropzone.on('removedfile', function() {
        document.querySelector('[name="image"]').value = '';
    });
});
