<?php
session_start();

require_once("../classes/Database.php");

$conect = new Database();
$db = $conect->connect();

if (isset($_SESSION['admin'])){

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
    <link href="../style/style_aux.css" rel="stylesheet" />
    <script src="../js/all.js" crossorigin="anonymous"></script>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home.php">Healt Predict - Admin</a>
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
                    <a class="nav-link" href="home_admin.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
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
            <div class="container-fluid px-4">
                <h1 class="mt-4">Usuarios existentes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Administra los usuarios.</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Selecciona un usuario
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Alta</th>
                                <th>Opci&oacuten</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $filter  = ['rol' => "user"];
                            $options = [];

                            $query = new \MongoDB\Driver\Query($filter, $options);
                            $cursor = $db->executeQuery("usuarios.user", $query);

                            foreach ($cursor as $cur) {
                                echo "<tr>";
                                echo "<th> $cur->name </th>";
                                echo "<th> $cur->Age </th>";
                                echo "<th> $cur->email </th>";
                                echo "<th> $cur->pass </th>";
                                echo "<th><form method='post' action='admin_tansition.php'>";
                                if($cur->alta){
                                    ?>

                                    <button class="button" value="<?php echo $cur->name; ?>" name="activa">
                                        Activo
                                    </button>

                                    <?php
                                }else{
                                    ?>

                                    <button class="button2" value="<?php echo $cur->name; ?>" name="inactiva">
                                        Inactivo
                                    </button>

                                    <?php
                                }
                                echo "</form></th>";
                                ?>
                                <th>
                                <button class="button2" value="<?php echo $cur->name; ?>" name="borrar">
                                Borrar
                                </button>
                                </th>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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