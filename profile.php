<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" >
</head>
<body>

<?php
include 'header.php';
include($_SERVER['DOCUMENT_ROOT'].'/options/connection_db.php');
$id = $_GET['id'];
$name = '';
$price = '';
$description = '';
$sql = 'SELECT p.id,p.name,p.price,p.description
        from tbh_products p 
        where p.id=:id;';

$sth = $dbh->prepare($sql);
$sth->execute([':id'=>$id]);
if($row=$sth->fetch()){
    $name=$row['name'];
    $price=$row['price'];
    $description=$row['description'];
}

$sql = "SELECT pi.name,pi.priority
        FROM tbh_product_images pi
        WHERE pi.product_id=:id
        ORDER BY pi.priority;";

$sth=$dbh->prepare($sql);
$sth->execute([':id'=>$id]);

$images = $sth->fetchAll();
//print_r($images);



?>




<div class="container" style="padding-top:140px">
    <p style="color:black">
        Product
    </p>


    <div class="card card-raised card-carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner" style="height: 400px;width: 400px;margin: auto">
                <div class="carousel-item active" style="margin-top: 100px;height: 400px;">
                    <img id="main_pic" name="main_pic" class="d-block w-100" style="object-fit: cover;" src="uploads/<?php echo $images[0]['name'] ?>"
                         alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://rawgit.com/creativetimofficial/material-kit/master/assets/img/bg2.jpg"  alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h4>
                            <i class="material-icons">location_on</i>
                            Somewhere Beyond, United States
                        </h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://rawgit.com/creativetimofficial/material-kit/master/assets/img/bg3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h4>
                            <i class="material-icons">location_on</i>
                            Yellowstone National Park, United States
                        </h4>
                    </div>
                </div>
            </div>


        </div>
        <div style="display: flex;flex-direction: row;padding: 20px;justify-content: center;">
            <?php
                foreach ($images as $img)
                {
                    echo '<img onclick="clickedOnProduct(this)" style="width: 20%;margin-right: 10px" src="uploads/'.$img['name'].'">';
                }
            ?>
        </div>
    </div>


</div>

<script>
    function clickedOnProduct(name){
        var new_img = name.src.replace('http://localhost/','');
        document.getElementById('main_pic').src = new_img;
    }
</script>

<script src="./jquery/jquery-3.6.1.min.js"></script>

</body>
</html>