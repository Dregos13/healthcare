<?php

require_once ("../database/Database.php");

$conect = new Database();
$db = $conect->connect();

?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../style/style.css">
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <title>Sign Up</title>
</head>
<body class="img js-fullheight" style="overflow: visible; background-color: #00aaaa;">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Sign Up</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Create a user</h3>
                    <form method="post" action="" class="signin-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" id="user" name="user" required>
                            <span id="availablity" style="color: #aaaa00"></span>
                        </div>
                        <script type="text/javascript">

                            $('document').ready(function(){
                                $('#user').blur(function(){
                                    var username = $(this).val();
                                    $.ajax ({
                                        url : "functions.php",
                                        method : "POST",
                                        data :  {username : username },
                                        dataType : "text",
                                        success:function(html)
                                        {
                                            $('#availablity').html(html);
                                        }
                                    });
                                });
                            });
                        </script>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Repeat password" id="pass2" name="pass2" required>
                            <span id="equal" style="color: #aaaa00"></span>
                            <script type="text/javascript">

                                $('document').ready(function(){
                                    $('#pass2').blur(function(){
                                        var pass2 = $(this).val();
                                        var pass = $('#pass').val();
                                        $.ajax ({
                                            url : "functions.php",
                                            method : "POST",
                                            data :  {pass2 : pass2,
                                                     pass : pass},
                                            dataType : "text",
                                            success:function(html)
                                            {
                                                $('#equal').html(html);
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Age" id="age" name="age" required>
                            <span id="adult" style="color: #aaaa00"></span>
                            <script type="text/javascript">

                                $('document').ready(function(){
                                    $('#age').blur(function(){
                                        var age = $(this).val();
                                        $.ajax ({
                                            url : "functions.php",
                                            method : "POST",
                                            data :  {age: age},
                                            dataType : "text",
                                            success:function(html)
                                            {
                                                $('#adult').html(html);
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" id="Email" name="mail" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary submit px-3" name="log" value="Create user">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

<?php

if(isset($_POST['log'])){

    $user = ['name' => $_POST['user'], 'pass' => $_POST['pass'], 'Age' => $_POST['age'], 'email' => $_POST['mail']];

    var_dump($user);

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($user);

    $db = $conect->connect();

    $db->executeBulkWrite('usuarios.user', $bulk);


}