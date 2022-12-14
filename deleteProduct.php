

<?php
$id = $_POST['id'];



$user = 'root';
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=pv016_', $user, $pass);

$dbh->query( 'DELETE FROM tbh_product_images WHERE product_id='.$id);
$dbh->query('DELETE FROM tbh_products WHERE id='.$id);
$dbh=null;
?>