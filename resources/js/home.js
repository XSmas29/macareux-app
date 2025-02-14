import './bootstrap';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;
window.onload = function() {
    let dropzone = new Dropzone('#csvDropzone', {
        url: '/upload',
        maxFilesize: 3,
        acceptedFiles: '.jpg, .jpeg, .png, .gif'
    });

    dropzone.on('complete', function(file) {
        let response = JSON.parse(file.xhr.response);
        let image = response.image;

        let imageElement = document.createElement('img');
        imageElement.src = image;
        document.querySelector('.images').appendChild(imageElement);
    });
}
