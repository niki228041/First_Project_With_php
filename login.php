<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css" >
</head>
<body>

<?php include 'header.php'?>




<div class="container" style="padding-top:20px">
    <p style="color:black">
        Registration
    </p>


    <div class="col">
        <label class="col-form-label mt-4" for="email">Емайл адресса</label>
        <input type="email" class="form-control" placeholder="Емайл" id="email">

        <label class="col-form-label mt-4" for="password">Пароль</label>
        <input type="password" class="form-control" placeholder="Пароль"  id="password">

        <button class="btn btn-primary mt-4" type="submit" onclick={handleLogin()}>Login</button>

    </div>



</div>

<script src="js/login.js"></script>

</body>
</html>