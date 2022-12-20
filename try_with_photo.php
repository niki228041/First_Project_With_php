<?php

if(isset($_POST['submit'])){


    $array_of_image = [];

    $array_of_files = [];

    for($i =0;$i<3;$i++)
    {
        $tmp_name = 'file_' . ($i+1);

        $tmp = !empty($_FILES[$tmp_name]['name']);

        echo '<script> console.log('.$tmp.')</script>';

        if(!empty($_FILES[$tmp_name]['name']))
        {
            array_push($array_of_files,$_FILES[$tmp_name]);
        }
    }




    $_countOfPics = count($array_of_files);


    for ($i=0; $i < $_countOfPics; $i++) {
        //$array_of_image_string .= saveImg($i) . "|";
        array_push($array_of_image,saveImg($i,$array_of_files));
        //saveImg($i);
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $images = $array_of_image;

        include($_SERVER['DOCUMENT_ROOT'].'/options/connection_db.php');


        $sql = "INSERT INTO `tbh_products` (`name`, `price`, `datecreate`, `description`) VALUES (:name,:price, NOW(), :description);";
        $smtp = $dbh->prepare($sql);
        $smtp->bindParam(':name',$name);
        $smtp->bindParam(':price',$price);
        $smtp->bindParam(':description',$description);
        //$smtp->bindParam(':image',$images);
        $smtp->execute();

        $id = $dbh->lastInsertId();

        echo '<script> console.log("myid")</script>';
        echo '<script> console.log('.$id.')</script>';


        //Select id from products

        //-----------

        //Insert images in images_table
        print_r($array_of_image);


        $counter = 0;
        foreach ($array_of_image as $img)
        {
            $priority_ = $counter+1;
            if($counter<3) {
                $sql_img = "INSERT INTO `tbh_product_images` (`name`, `datecreate`, `priority`, `product_id`) VALUES (:img,NOW(), :counter, :product_id);";
                $db_prepare_img_to_push = $dbh->prepare($sql_img);
                $db_prepare_img_to_push->bindParam(':img', $img);
                $db_prepare_img_to_push->bindParam(':counter',$priority_);
                $db_prepare_img_to_push->bindParam(':product_id', $id);
                $db_prepare_img_to_push->execute();
            }
            $counter++;
        }
        //-----------




        header('Location: products.php');
        //ot tak toche mochna
        //header('Location:/');

        echo '<script> console.log("form was GOOD sended to database")</script>';
        exit();

    }
    else{
        echo '<script> console.log("error with some form field")</script>';
    }

}

// print_r($_FILES['userfile']['name'][2]);

function saveImg($i,$array_of_files)
{
    echo '<script>console.log("im in")</script>';

    $allowed_ext = array('png', 'jpg', 'jpeg', 'gif','webp','jfif');
    if(!empty($array_of_files[$i]['name']))
    {
        // print_r($_FILES);
        $file_name = $array_of_files[$i]['name'];
        $file_size = $array_of_files[$i]['size'];
        $file_tmp = $array_of_files[$i]['tmp_name'];
        $target_dir = 'uploads/'.$file_name.'';

        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext,$allowed_ext))
        {
            //if u want to not send big images to database
            //if($file_size <= 1000000)
            //{
                move_uploaded_file($file_tmp, $target_dir);
                //echo "<br/>";
                //echo $file_ext;
                //echo '<p style="color:green">file was uploaded</p>';
                //echo "<hr/>";
                echo '<script> console.log("form was sended to database")</script>';
                return $file_name;
            //}
            //else
            //{
                echo '<script> console.log("too big file")</script>';
            //}
        }else{
            echo '<script> console.log("invalide file type")</script>';
        }
    }else{
        echo '<script> console.log("NO FILE CHOOSED")</script>';
    }
}

?>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    include ($_SERVER['DOCUMENT_ROOT'].'/lib/guidv4.php');

    $image_name = guidv4().'.jpeg';

    print_r($_FILES);

    $dir_save='pizzaImages/';
    $uploadfile = $dir_save.$image_name;

}

?>
