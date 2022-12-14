<?php
    include($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/try_with_photo.php');
?>



<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
    <body>

    <div style="padding-top: 50px">
        <h1 class="text-center">Add Product</h1>
        <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="userfile[]" multiple="multiple">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" cols="40" rows="5"></textarea>
            </div>
            <button type="submit" name="submit" value="Submit"  class="btn btn-success">Add Product</button>
        </form>
    </div>

    </body>
</html>