<?php
session_start();

require_once("../classes/Database.php");

$conect = new Database();
$db = $conect->connect();


?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../style/style.css">
    <title>Inicio Sesion</title>
</head>
<body class="img js-fullheight" style="background-color: #00aaaa;">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Log in</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Inicia sesion</h3>
                    <form method="post" action="" class="signin-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" id="user" name="user" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary submit px-3" name="log" value="Log in">
                        </div>
                    </form>
                    <form method="post" action="signin.php" class="signin-form">
                        <input type="submit" class="form-control btn btn-primary submit px-3" name="log" value="Sign in">

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

<?php

if (isset($_POST['log'])){

    $user_name = $_POST['user'];
    $password = $_POST['pass'];

    $filter      = ['name' => $user_name];
    $options = [];

    $query = new \MongoDB\Driver\Query($filter, $options);

    $cursor = $db->executeQuery("usuarios.user", $query);


    foreach ($cursor as $cur) {

        if ($cur->pass == $password && $cur->name == $user_name) {

            $alta = $cur->alta;

            if($alta) {

                $_SESSION['user'] = $cur->_id;
                $_SESSION['name'] = $cur->name;

                if ($cur->test){

                    header("LOCATION: ./home.php");

                }else{

                    header("LOCATION: ./cuestionario.php");

                }



            }else{

                echo '<script type="text/javascript">alert("No estas dado de alta aun, espera a que tu solicitud sea aprobada.");</script>';

            }

        }else{

            echo "Something went wrong";
        }

    }

}

?>