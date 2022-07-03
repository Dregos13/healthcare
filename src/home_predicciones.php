<?php
session_start();

require_once("../classes/Database.php");

$conect = new Database();
$db = $conect->connect();

if (isset($_SESSION['user'])){




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home Page</title>
    <link href="../style/style_homecss.css" rel="stylesheet" />
    <link href="../style/styles.css" rel="stylesheet" />
    <link rel="icon" href="../assets/heart.png">
    <script src="../js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/functions.js"></script>
    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home.php">Healt Predict</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['name'] ?><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="settings.php">Ajustes</a></li>
                <li><a class="dropdown-item" href="home_predicciones.php">Predicciones</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="logout.php">Cerrar sesi&oacuten</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                echo $_SESSION['name'];
                ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Predicciones</h1>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Precision</th>
                        <th scope="col">Positivo</th>
                        <th scope="col">Negativo</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $filter  = ['userId' => $_SESSION['user']];
                    $options = [];

                    $query = new \MongoDB\Driver\Query($filter, $options);
                    $cursor = $db->executeQuery("usuarios.records", $query);
                    $i = 1;
                    foreach ($cursor as $cur) {
                    echo "<tr>";
                    echo "<td> $i </td>";
                    echo "<td> $cur->media </td>";
                    echo "<td> $cur->positivo </td>";
                    echo "<td> $cur->negativo </td>";
                    echo "</tr>";
                    $i++;

                    }
                    ?>
                    </tbody>
                </table>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#prediccion').on('click', function () {
                            var target = $('#prediccion').val();
                            console.log(target);

                            $.ajax({
                                url: 'http://127.21.0.3:8000/predictUser',
                                method: 'POST',

                                data: {
                                    id: target
                                },
                                success: function (result) {
                                    console.log(result);
                                    location.reload();
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        });
                    });

                </script>

                <button id="prediccion" value="<?php echo $_SESSION['user']; ?>">Predecir</button>

            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../js/scripts.js"></script>
<script src="../js/Chart.min.js" crossorigin="anonymous"></script>
<script src="../assets/chart-area-demo.js"></script>
<script src="../assets/chart-bar-demo.js"></script>
<script src="../js/simple-datatables@latest.js" crossorigin="anonymous"></script>
<script src="../js/datatables-simple-demo.js"></script>
</body>
</html>

<?php

}else{

    header('LOCATION: ../index.php');
}