<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" >
</head>
<body>

<?php
    include 'header.php';
    include($_SERVER['DOCUMENT_ROOT'].'/options/connection_db.php');
?>

<?php
    try {
    $user="root";
    $pass="";
    $dbh = new PDO('mysql:host=localhost;dbname=pv016_', $user, $pass);
?>


<?php
    }catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>


<div class="container" style="padding-top:140px">
    <p style="color:black">
        Products
    </p>

    <section style="background-color: #eee;">
        <div class="container py-3">
            <div style="display: flex;flex-direction: column">
                <?php

                $sql_request = 'SELECT p.id,p.name,p.price,pi.name as image
	                                FROM tbh_products p,tbh_product_images pi
                                    WHERE p.id=pi.product_id and pi.priority=1;';

                foreach($dbh->query($sql_request) as $row) {
                    $id = $row["id"];
                    $image = $row["image"];

                    $pieces = explode("|", $image);
                    //print_r($pieces);

                    $name = $row["name"];
                    $price = $row["price"];
                    $id = $row["id"];
                echo '
                    <div class="card mb-3" style="display: flex;flex-direction: row;height: 100px">
                        <img src="./uploads/'.$pieces[0].'" class="card-img-top" style="width: 30%; object-fit: cover" height="100%" alt="Gaming Laptop"/>
                        
                        <div class="card-body">

                            <div class="d-flex justify-content-between " >
                                <h5 class="mb-0" style="overflow: hidden; max-width: 50%;max-height: 23px"  >'.$name.'</h5>
                                <h5 class="text-dark mb-0">$ '.$price.'</h5>
                            </div>
                                <div style="display:0 flex; flex-direction: row;height:80%;">
                                    <a type="button" class="btn btn-success" href="profile.php?id='.$id.'">Купити</a>
                                    <button type="button" class="btn btn-danger delete ml-2" data-id='.$id.'>Видалити</button>
                                </div>
                            
                        </div>
                    </div>
                ';
                }
                ?>


            </div>


            <div class="row">
                <a class="nav-link active" aria-current="page" href="add_product.php">Add New Product</a>
            </div>
        </div>
    </section>



</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="js/login.js"></script>
<script src="js/requestToDb.js"></script>

</body>
</html>