

var image_workspace = document.querySelector('.image-workspace img');
var upload = document.querySelector('.upload');
var cho = document.querySelector('.cho');
var otsosiBliadota = document.querySelector('.otsosi-bliadota');
var img_priview = document.querySelector('.preview-cover');

upload.onchange=(e)=>{
    console.log("im in click on upload");
    var file = e.target.files[0];
    console.log(file);
    var url = window.URL.createObjectURL(new Blob([file],{type:file.type}))
    console.log(url);
    image_workspace.src = url;

    console.log(img_priview);

    var options={
        dragMode:'move',
        preview:'.img-preview',
        viewMode:2,
        modal:false,
        background:false,
        ready: function (){
            console.log("cropper ready");
        }
    }

    var cropper = new Cropper(image_workspace,options);

};
