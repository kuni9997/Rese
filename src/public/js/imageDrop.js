//---------拡張子確認用---------------------------
var allow_exts = new Array('jpeg', 'png');

function getExt(filename) {
    var pos = filename.lastIndexOf('.');
    if (pos == -1) return '';
    return filename.slice(pos + 1);
}

function checkExt(filename) {
    var ext = getExt(filename).toLowerCase();
    if (allow_exts.indexOf(ext) === -1) 
        return true;
    return false;
}

//---------クリックされたときの処理------------------
const uploadBox = document.querySelector(".review__pic__upload-box");
const previewBox = document.querySelector(".review__pic__content__preview-box img");
const filePreview = document.getElementById("image");
const fileInput = document.getElementById("review__pic__content__image")

function roadImg(e) {
    const file = e.target.files[0];

    if (!file) return;
    if (file.length > 1){
        return alert("アップロードできるファイルは１つだけです。");
    }
    if (checkExt(file.name)){
        return alert("アップロードできる拡張子はjpeg, pngのみです。");
    }
    previewBox.removeAttribute("hidden");
    previewBox.src = URL.createObjectURL(file);
    fileInput.files = file;
}

filePreview.addEventListener("change", roadImg, false);
uploadBox.addEventListener("click", () => filePreview.click());
//-----------------------------------------------------------
//---------ドラッグ＆ドロップの処理---------------------------
function dragover(e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.background = "#e1e7f0"
}

function dragleave(e) {
    e.stopPropagation();
    e.preventDefault();
    this.style.background = "#fff"
}

function dropLoad(e) {
    e.stopPropagation();
    e.preventDefault();

    uploadBox.style.background = "#fff";
    let files = e.dataTransfer.files;
    if (files.length > 1){
        return alert("アップロードできるファイルは１つだけです。");
    }
    if (checkExt(files)){
        return alert("アップロードできる拡張子は('jpeg', 'png')のみです。");
    }
    filePreview.files = files;
    fileInput.files = files;
    previewBox.removeAttribute("hidden");
    previewBox.src = URL.createObjectURL(filePreview.files[0]);
}

uploadBox.addEventListener("drop", dropLoad, false);
uploadBox.addEventListener("dragover", dragover, false);
uploadBox.addEventListener("dragleave", dragleave, false);

