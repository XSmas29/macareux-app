import './bootstrap';
import * as FilePond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImageEdit from "filepond-plugin-image-edit";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import { Notyf } from 'notyf';
import 'filepond/dist/filepond.min.css';
import "@fortawesome/fontawesome-free/css/all.min.css";
import 'notyf/notyf.min.css'; // for React, Vue and Svelte

const notyf = new Notyf();

FilePond.registerPlugin(
  FilePondPluginImagePreview,
  FilePondPluginImageExifOrientation,
  FilePondPluginFileValidateSize,
  FilePondPluginImageEdit,
  FilePondPluginFileValidateType,
);

let currentFile = null;
const checkFileType = (file) => {
  console.log(file)
  if (file.fileType !== 'text/csv') {
    notyf.error('File must be a csv file');
    return false;
  }
  return true;
};

window.onload = function() {
  const fileInput = FilePond.create(document.querySelector('input[type="file"]'), {
    allowPaste: false,
    checkValidity: true,
    allowFileTypeValidation: true,
    beforeAddFile: checkFileType,
    beforeDropFile: checkFileType,
  });
  fileInput.on('addfile', (error, file) => {
    currentFile = file;
  });
  fileInput.on('error', (error, file) => {
    notyf.error('File must be a csv file');
  });

  document.getElementById('btnUpload').addEventListener('click', async () => {
    if (!currentFile) {
      notyf.error('You must select a csv file before uploading');
      return;
    }

    if (currentFile.fileType !== 'text/csv') {
      notyf.error('File must be a csv file');
      return;
    }

    const formData = new FormData();
    formData.append('file', currentFile.file);
    setloadingUpload(true);
    try {
      const response = await fetch("upload", {
        method: "POST",
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'accept': 'multipart/form-data',
        }
      });

      const result = await response.json();
      if (!result.error) {
        notyf.success("File uploaded successfully!");
      } else {
        for (const [key, value] of Object.entries(result.message)) {
          notyf.error(`${key} error: ${value}`);
        }
      }
      setloadingUpload(false);
    } catch (error) {
      setloadingUpload(false);
      notyf.error("Error uploading file");
      console.error(error);
    }
  });
}

const setloadingUpload = (loading) => {
  const btnUpload = document.getElementById('btnUpload');
  if (loading) {
    document.getElementById("btnUpload").disabled = true;
    btnUpload.innerHTML = '<span class="loading loading-spinner text-primary-content"></span>';
  } else {
    document.getElementById("btnUpload").disabled = false;
    btnUpload.innerHTML = `<i class="fa-solid fa-arrow-up-from-bracket"></i>
            <div>Upload CSV</div>`;
  }
};

const uploadCSV = async () => {
  if (!currentFile) {
    notyf.error('You must select a csv file to upload');
    return;
  }

  const formData = new FormData();
  formData.append('file', file.file);
  const response = await fetch('/upload', {
      method: 'POST',
      body: formData,
  });
  const data = await response.json();
};
