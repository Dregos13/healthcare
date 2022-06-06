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
        <link href="../style/style_forms.css" rel="stylesheet" />
        <link href="../style/file_upload.css" rel="stylesheet" />
        <link rel="icon" href="../assets/heart.png">
        <script src="../js/all.js" crossorigin="anonymous"></script>
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
                    <li><a class="dropdown-item" href="">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
                        <div class="sb-sidenav-menu-heading">Data</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Upload
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
                    User
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4" style="align-content: center">
                    <h1 class="mt-4">Settings</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit your data.</li>
                    </ol>
                    <?php
                    $filter      = ['name' => $_SESSION['name']];
                    $options = [];
                    $query = new \MongoDB\Driver\Query($filter, $options);
                    $cursor = $db->executeQuery("usuarios.user", $query);
                    foreach ($cursor as $cur){
                    ?>

                    <div>
                        <div class="registration-form">
                            <form method="post" action="" enctype="multipart/form-data">
                                <h2 class="mt-4">Name</h2>
                                <div class="form-group">
                                    <input type="file" class="upload" name="dato">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block create-account" name="upload">Upload</button>
                                </div>
                            </form>
                    </div>
                        <?php
                    }

                    if (isset($_POST['upload'])){

                        $file = $_FILES['dato']['tmp_name'];

                        if ($file != null){

                            $bulk = new MongoDB\Driver\BulkWrite;
                            $first = false;

                            if (($gestor = fopen($file, "r")) !== FALSE) {

                                 while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {

                                     if($first) {

                                         $numero = count($datos);

                                         $date = ['user' => $_SESSION['user'], 'date' => date('Y-m-d', strtotime($datos[0])), 'heartbeat' => $datos[2]];

                                         $bulk->insert($date);



                                     }else{

                                         $first =true;
                                     }

                                 }

                            }

                            $db->executeBulkWrite('usuarios.archive', $bulk);

                        }

                    }
                        ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
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