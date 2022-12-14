<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/croppie.min.css">
</head>
<body>
<?php include 'header.php'?>

<div>

    <div>
        <div class="card-body">

            <label for="selectedImage" style="cursor: pointer">
                <img id="selectUploadImage" src="Images/icons8-add-image-90.png" />
            </label>
            <input type="file" id="selectedImage" name="selectedImage" style="display: none;" />
        </div>

        <div class="card text-center" id="uploadimage" style="display: none">
            <div class="card-header">
                Upload & Crop Image
            </div>
            <div class="card-body">
                <div id="image_demo" style="width: 350px; margin-top:30px"></div>
                <div id="uploaded_image" style="width: 350px; margin-top:30px"></div>
            </div>
            <div class="card-footer text-muted">
                <button class="crop_image">Crop & Upload Image</button>
            </div>
        </div>
    </div>


<script src="./jquery/jquery-3.6.1.min.js"></script>
<script src="./js/croppie.min.js"></script>


</body>
</html>