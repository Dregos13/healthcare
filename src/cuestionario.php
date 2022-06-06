<?php
session_start();

require_once("../classes/Database.php");
require_once("../classes/user.php");

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
                <h2 class="heading-section">Comlpeta tus datos</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Datos Fisiológicos</h3>
                    <form method="post" action="" class="signin-form" id="data">
                        <h4 class="heading-section">G&eacutenero</h4>
                        <div class="form-group">
                            <select class="form-control-2"  id="`sex`" name="sex" form="data">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <h4 class="heading-section">Tiene alguna dolencia en el pecho?</h4>
                        <div class="form-group">
                            <select class="form-control-2"  id="chest" name="chest" form="data">
                                <option value="TA">Angina típica</option>
                                <option value="ATA">Angina atípica</option>
                                <option value="NAP">Dolor, pero no de angina</option>
                                <option value="ASY">Asintomático</option>
                            </select>
                        </div>
                        <h4 class="heading-section">Presión Sanguínea en reposo</h4>
                        <div class="form-group">
                            <input type="range" class="form-control" oninput="this.nextElementSibling.value = this.value" max="200" min="80" id="rbp" name="rbp" required>
                            <output>140</output>mmHg
                        </div>
                        <h4 class="heading-section">Colesterol</h4>
                        <div class="form-group">
                            <input type="range" class="form-control" oninput="this.nextElementSibling.value = this.value" max="300" min="100" id="ch" name="ch" required>
                            <output>140</output>mg/dl
                        </div>
                        <h4 class="heading-section">¿Tiene Diabetes?</h4>
                        <div class="form-group">
                            <select class="form-control-2"  id="diabetes" name="diabetes" form="data">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <h4 class="heading-section">¿Realiza deporte?</h4>
                        <div class="form-group">
                            <select class="form-control-2"  id="sport" name="sport" form="data">
                                <option value="Y">Sí</option>
                                <option value="N">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary submit px-3" name="log" value="Terminar cuestionario">
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

    $bulk = new MongoDB\Driver\BulkWrite;

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['sex' => $_POST['sex']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['ChestPainType' => $_POST['chest']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['RestingBP' => $_POST['rbp']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['Cholesterol' => $_POST['ch']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['FastingBS' => $_POST['diabetes']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['ExerciseAngina' => $_POST['sport']]],
        ['multi' => false, 'upsert' => false]
    );

    $bulk->update(
        ['_id' => $_SESSION['user']],
        ['$set' => ['test' => true]],
        ['multi' => false, 'upsert' => false]
    );

    $result = $db->executeBulkWrite('usuarios.user', $bulk);

    header("LOCATION: home.php");

}