<?php 
// memamnggil file config.php
require_once "config.php";
if(!isset($_SESSION['login'])) {
    echo '
        <script>
            window.location.href="login.php";
        </script>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peserta Ujian</title>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/datatable/datatables.min.css">
</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Ujian Online</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="logout.php"">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<main class="container my-5">
    <?php  
        if(isset($_GET['page'])) {
            $p = $_GET['page'];

            switch ($p) {
                case 'tambah-soal':
                    include "views/tambah_soal.php";
                break;
                
                case 'tambah-soal-ujian':
                    include "views/tambah_soal_ujian.php";
                break;
                
                default:
                    # code...
                    break;
            }
        } else {
            include "views/beranda.php";
        }
    ?>
</main>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/datatable/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('.myTable').DataTable({
            ordering: false
        });
    } );
</script>
</body>
</html>