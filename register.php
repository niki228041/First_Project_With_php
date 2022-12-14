<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/croppie.min.css">

</head>
<body>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/header.php')?>


<div>
    <p style="color:black">
        Registration
    </p>

    <div class="container" style="padding-top:20px">

        <div class="row container">
            <div class="col">
                <div class="input-control">
                    <label class="col-form-label mt-4" for="name">Ім'я користувача</label>
                    <input type="text" class="form-control input_reg"  placeholder="Ім'я" id="name">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label class="col-form-label mt-4" for="surname">Фамілія користувача</label>
                    <input type="text" class="form-control input_reg"  placeholder="Фамілія" id="surname">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label class="col-form-label mt-4" for="email">Емайл адресса</label>
                    <input type="email" class="form-control input_reg" placeholder="Емайл" id="email">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label class="col-form-label mt-4" for="phone">Телефон</label>
                    <input type="text" class="form-control input_reg" placeholder="Телефон" id="phone">
                    <div class="error"></div>
                </div>

                <button class="btn btn-primary mt-4" type="submit" onclick={handleReg()}>Register</button>

                <div class="mt-4">
                    <button class="btn-primary btn" onclick="getCurrentUser()">
                        GetCurrentUser
                    </button>
                </div>
            </div>
            <div class="col">
                <div class="input-control">
                    <label class="col-form-label mt-4" for="land">Країна</label>
                    <input type="text" class="form-control input_reg" placeholder="Країна" id="land">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label class="col-form-label mt-4" for="password">Пароль</label>
                    <input type="password" class="form-control input_reg" placeholder="Пароль" id="password">
                    <div class="error"></div>
                </div>

                <div class="input-control">
                    <label class="col-form-label mt-4" for="password">Повторний ввід Пароль</label>
                    <input type="password" class="form-control input_reg" placeholder="Ще раз Пароль" id="repeat_password">
                    <div class="error"></div>
                </div>

                <?php include 'pls_2cropper.php' ?>

            </div>
        </div>
    </div>


</div>

    <script src="jquery/jquery-3.6.1.min.js"></script>
    <script src="./js/croppie.min.js"></script>
    <script src="./js/reg.js"></script>

<script>
    $(document).ready(function (){



        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport:{
                width:200,
                height:200,
                type:'circle'
            },
            boundary:{
                width: 300,
                height: 300
            }
        });


        $('#selectedImage').on('change',function (){
            console.log('hi');
            var reader = new FileReader();
            reader.onload = function (event){
                $image_crop.croppie('bind',{
                    url:event.target.result
                })
            }
            reader.readAsDataURL(this.files[0]);

            $('#uploadimage').show();
        });

        function uploadImg(a)
        {
            console.log(a);
        }


        $('.crop_image').click(function (event){


            $image_crop.croppie('result',{
                type:'canvas',
                size:'viewport'
            }).then(function (response){
                $.ajax({
                    url:"uploadedImage.php",
                    type:"POST",
                    data:{"image":response},
                    success:function (data)
                    {
                        uploadImg(response);
                        $('#uploaded_image').html(data);
                        console.log("uploaded your img~");
                    }
                })
            })
        });


    });
</script>

</body>
</html>