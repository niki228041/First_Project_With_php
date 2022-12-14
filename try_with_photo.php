<?php

if(isset($_POST['submit'])){
    $_countOfPics = count($_FILES['userfile']['name']);

    $array_of_image = [];

    for ($i=0; $i < $_countOfPics; $i++) {
        //$array_of_image_string .= saveImg($i) . "|";
        array_push($array_of_image,saveImg($i));
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


        //Select id from products
        $ids_request = "SELECT id,name FROM `tbh_products` WHERE name = :name;";
        $sth=$dbh->prepare($ids_request);
        $sth->bindParam(':name',$name);

        $sth->execute();

        $id = $sth->fetchAll();
        echo '<script> console.log('.$id[0]['id'].')</script>';

        //-----------

        //Insert images in images_table
        print_r($array_of_image);

        $counter = 0;
        foreach ($array_of_image as $img)
        {
            $sql_img = "INSERT INTO `tbh_product_images` (`name`, `datecreate`, `priority`, `product_id`) VALUES (:img,NOW(), :counter, :product_id);";
            $db_prepare_img_to_push = $dbh->prepare($sql_img);
            $db_prepare_img_to_push->bindParam(':img',$img);
            $db_prepare_img_to_push->bindParam(':counter',$counter);
            $db_prepare_img_to_push->bindParam(':product_id',$id[0]['id']);
            $db_prepare_img_to_push->execute();
            $counter++;
        }
        //-----------




        //header('Location: products.php');
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

function saveImg($i)
{
    echo '<script>console.log("im in")</script>';

    $allowed_ext = array('png', 'jpg', 'jpeg', 'gif','webp','jfif');
    if(!empty($_FILES['userfile']['name'][$i]))
    {
        // print_r($_FILES);
        $file_name = $_FILES['userfile']['name'][$i];
        $file_size = $_FILES['userfile']['size'][$i];
        $file_tmp = $_FILES['userfile']['tmp_name'][$i];
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
