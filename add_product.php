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
                <label for="image" class="form-label">Image(Max=3)</label>
                <input type="file" class="form-control" name="userfile[]" multiple="multiple" onchange="onChangeImages()">

                <div class="mt-4" style="display: flex;flex-direction: row">

                    <div class="mr-3" draggable="true">
                        <label for="file_1">
                            <img style="height: 100px;cursor: pointer" id="img_1" name="img_1" class="img_for_drag_and_drop" src="./uploads/placeholder_600x400_2.svg" draggable="true">
                        </label>
                        <input type="file" class="img_for_drag_and_drop" id="file_1" name="file_1" onchange="changeImgs()" hidden>
                    </div>

                    <div class="mr-3" draggable="true">
                        <label for="file_2">
                            <img style="height: 100px;cursor: pointer" id="img_2" name="img_2" class="img_for_drag_and_drop" src="./uploads/placeholder_600x400_2.svg" draggable="true">
                        </label>
                        <input type="file" class="img_for_drag_and_drop" id="file_2" name="file_2" onchange="changeImgs()" hidden>
                    </div>

                    <div class="mr-3" draggable="true">
                        <label for="file_3">
                            <img style="height: 100px;cursor: pointer" id="img_3" name="img_3" class="img_for_drag_and_drop" src="./uploads/placeholder_600x400_2.svg" draggable="true">
                        </label>
                        <input type="file" class="img_for_drag_and_drop" id="file_3" name="file_3" onchange="changeImgs()" hidden>
                    </div>
                </div>

            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" cols="40" rows="5"></textarea>
            </div>
            <button type="submit" name="submit" value="Submit"  class="btn btn-success">Add Product</button>
        </form>
    </div>

    <script>
        let bild_1 = document.getElementById('img_1');
        let bild_2 = document.getElementById('img_2');
        let bild_3 = document.getElementById('img_3');

        let file_1 = document.getElementById('file_1');
        let file_2 = document.getElementById('file_2');
        let file_3 = document.getElementById('file_3');


        let img_conteiner = document.getElementsByClassName("img_for_drag_and_drop");

        bild_1.addEventListener("dragstart",function (event){
            event.dataTransfer.setData('text/plain',event.target.id);
            console.log(file_1.files);

        });

        bild_2.addEventListener("dragstart",function (event){
            event.dataTransfer.setData('text/plain',event.target.id);
            console.log(file_2.files);

        });

        bild_3.addEventListener("dragstart",function (event){
            event.dataTransfer.setData('text/plain',event.target.id);
            console.log(file_3.files);

        });

        for(var slot of img_conteiner)
        {
            slot.addEventListener("dragover",function (event){
                event.preventDefault();
                event.dataTransfer.dropEffect = "move";
            });

            slot.addEventListener("drop",function (event){
                event.preventDefault();

                const id = event.dataTransfer.getData('text/plain');
                const element = document.getElementById(id);


                var idData = id.replace('img_','');
                var id_to_change = event.target.id.replace('img_','');
                console.log(idData);
                console.log(id_to_change);

                let id_of_file_input = 'file_' + idData;
                let id_of_file_input_to_change = 'file_' + id_to_change;

                let file = document.getElementById(id_of_file_input);
                let file_to_change = document.getElementById(id_of_file_input_to_change);
////

                // Now let's create a DataTransfer to get a FileList
                const dataTransfer = new DataTransfer();
                const dataTransfer_to_change = new DataTransfer();

                console.log('files');
                const myFile = file.files[0];
                const myFile_to_change = file_to_change.files[0];

                if(file.files[0] != undefined && file_to_change.files[0] != undefined) {
                    dataTransfer.items.add(myFile);
                    dataTransfer_to_change.items.add(myFile_to_change);
////
                    file.files = dataTransfer_to_change.files;
                    file_to_change.files = dataTransfer.files;


                    var img_ = event.target.src;
                    event.target.src = element.src;
                    element.src = img_;
                }


            });
        }

        function onChangeImages(){
            var userfile = document.getElementsByName('userfile[]');

            let empty = new DataTransfer();


            document.getElementById('file_1').files = empty.files;
            document.getElementById('file_2').files = empty.files;
            document.getElementById('file_3').files = empty.files;

            document.getElementById('img_1').src = './uploads/placeholder_600x400_2.svg';
            document.getElementById('img_2').src = './uploads/placeholder_600x400_2.svg';
            document.getElementById('img_3').src = './uploads/placeholder_600x400_2.svg';

            for (var it = 0;it<3;it++){
                console.log();
                if(userfile[0].files.length > it){
                    var img_name = 'img_'+(it+1);
                    var path = 'uploads/' + userfile[0].files[it].name;
                    //document.getElementById(img_name).src=path;

                    let srcWebp = URL.createObjectURL(userfile[0].files[it]);
                    document.getElementById(img_name).src=srcWebp;
                    console.log(userfile[0].files[it]);


                    let id_of_file_input = 'file_' + (it+1);

                    // Create a new File object
                    const myFile = userfile[0].files[it];

                    // Now let's create a DataTransfer to get a FileList
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(myFile);

                    console.log(document.getElementById(id_of_file_input).files = dataTransfer.files);

                }
                else
                {
                    var img_name = 'img_'+(it+1);
                    document.getElementById(img_name).src='/uploads/placeholder_600x400_2.svg';
                }
            }

        }

        function changeImgs(){
            for (var it =0;it<3;it++){
                let file_id = 'file_' + (it+1);
                let img_id = 'img_' + (it+1);
                let file = document.getElementById(file_id);
                if(file.files[0] != undefined)
                {
                    let srcWebp = URL.createObjectURL(file.files[0]);
                    document.getElementById(img_id).src = srcWebp;
                }
            }
        }
    </script>

    </body>
</html>
