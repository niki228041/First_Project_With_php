<?php
include($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/options/connection_db.php');
    include($_SERVER['DOCUMENT_ROOT'].'/update_product.php');

    $name = '';
    $price = 0;
    $description = '';
    $id = $_GET['id'];

    $sql = "SELECT * FROM `tbh_products` WHERE id=:id;";
    $smtp = $dbh->prepare($sql);
    $smtp->bindParam(':id',$id);
    $smtp->execute();

    if($row=$smtp->fetch()){
        $name=$row['name'];
        $price=$row['price'];
        $description=$row['description'];
    }


    $sql_ = "SELECT pi.name,pi.priority
            FROM tbh_product_images pi
            WHERE pi.product_id=:id
            ORDER BY pi.priority;";

    $sth=$dbh->prepare($sql_);
    $sth->execute([':id'=>$id]);

    $images = $sth->fetchAll();


    $name_of_imgs = json_encode($images);
    $name = json_encode($name);


    echo '<script> console.log('.$id.')</script>';

?>



<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body onload="prufImg()">

<div style="padding-top: 50px">
    <h1 class="text-center">Edit Product</h1>
    <form method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $name;?>">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="<?php echo $price;?>">
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

        <input type="file" id="product_id" name="product_id" hidden>
        <input type="file" id="products[]" name="products[]"  multiple="multiple" hidden>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control" id="description" name="description" cols="40" rows="5" placeholder="<?php echo $description;?>" ></textarea>
        </div>
        <button type="submit" name="submit" value="Submit"  class="btn btn-success">Edit Product</button>
    </form>
</div>

<script>


    function prufImg()
    {


        const hidded_file = new File([<?php echo json_encode($_GET['id']) ?>], <?php echo json_encode($_GET['id']) ?>, {
            type: "text/plain",
        });

        let data_hidded_file = new DataTransfer();
        data_hidded_file.items.add(hidded_file);

        document.getElementById('product_id').files = data_hidded_file.files;

        <?php
            if(!empty($images[0]['name']))
            $some_tmp_1 = json_encode($images[0]['name']);

            if(!empty($images[1]['name']))
            $some_tmp_2 = json_encode($images[1]['name']);

            if(!empty($images[2]['name']))
            $some_tmp_3 = json_encode($images[2]['name']);
        ?>


        const my_file = new File([<?php echo $some_tmp_1;?>], <?php echo $some_tmp_1;?>, {
            type: "text/plain",
        });

        let first = new DataTransfer();
        first.items.add(my_file);

        document.getElementById('file_1').files = first.files;
        document.getElementById('file_1').files[0].tag='not_real';
        document.getElementById('img_1').src = 'uploads/' + first.files[0].name;


        let products = document.getElementsByName('products[]');
        const dataTransfer = new DataTransfer();

        dataTransfer.items.add(my_file);



        // Now let's create a DataTransfer to get a FileList


        <?php if (empty($some_tmp_2) != 1) {?>
            const my_file_2 = new File([<?php echo $some_tmp_2;?>], <?php echo $some_tmp_2;?>, {
                type: "text/plain",
            });
            let second = new DataTransfer();
            second.items.add(my_file_2);

            document.getElementById('file_2').files = second.files;
            document.getElementById('file_2').files[0].tag='not_real';
            document.getElementById('img_2').src = 'uploads/' + second.files[0].name;

            dataTransfer.items.add(my_file_2);

        <?php }?>


        <?php if (empty($some_tmp_3) != 1) {?>
            const my_file_3 = new File([<?php echo $some_tmp_3;?>], <?php echo $some_tmp_3;?>, {
                type: "text/plain",
            });

            let threed = new DataTransfer();
            threed.items.add(my_file_3);

            document.getElementById('file_3').files = threed.files;
            document.getElementById('file_3').files[0].tag='not_real';
            document.getElementById('img_3').src = 'uploads/' + threed.files[0].name;

            dataTransfer.items.add(my_file_3);
        <?php }?>


        products[0].files = dataTransfer.files;
        console.log(products[0].files);

    }


    let bild_1 = document.getElementById('img_1');
    let bild_2 = document.getElementById('img_2');
    let bild_3 = document.getElementById('img_3');

    let file_1 = document.getElementById('file_1');
    let file_2 = document.getElementById('file_2');
    let file_3 = document.getElementById('file_3');

    let products = document.getElementsByName('products');

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

            let products = document.getElementsByName('products[]');


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
            console.log(products[0].files);

            changeImgs();
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

        let products = document.getElementsByName('products[]');

        // Now let's create a DataTransfer to get a FileList
        const dataTransfer = new DataTransfer();

        for (var it =0;it<3;it++){
            let file_id = 'file_' + (it+1);
            let img_id = 'img_' + (it+1);
            let file = document.getElementById(file_id);
            console.log("HIER");

            if(file.files[0] != undefined)
            {
                const myFile = file.files[0];
                dataTransfer.items.add(myFile);
            }

            if(file.files[0].tag == 'not_real')
            {
                document.getElementById(img_id).src = 'uploads/' + file.files[0].name;
            }
            else if(file.files[0] != undefined)
            {


                let srcWebp = URL.createObjectURL(file.files[0]);
                document.getElementById(img_id).src = srcWebp;
            }
        }

        products[0].files = dataTransfer.files;
        console.log(products[0].files);
    }
</script>

</body>
</html>
