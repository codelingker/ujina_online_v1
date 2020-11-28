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
    if(isset($_GET['token'])) {
        $get_kode = base64_decode($_GET['token']);
        $data_soal = tampil_soal_ujian($get_kode);  
        $jumlah_soal = mysqli_num_rows($data_soal);
    ?>

    <section class="row my-5">
        <div class="col-sm-8 mx-auto">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5>Soal Ujian</h5>
                </div>
                <div class="card-body p-0">
                    <?php                         
                        if(isset($_POST['submit_soal'])) {
                            $id_user        = $_SESSION['login']['id_user'];
                            $submit_token   = base64_decode($_GET['token']);
                            $kode_ujian     = kode_ujian(); 
                            $nilai = 0;
                            foreach($data_soal as $ds) {
                                $ks         = $ds['kode_soal'];
                                $jawaban    = $_POST['soal' . $ks];

                                $cek_jawaban = cek_jawaban($ks, $jawaban);
                                $rows_jawaban =  mysqli_num_rows($cek_jawaban);
                                $nilai += $rows_jawaban; 
                                
                                submit_jawaban($kode_ujian, $ks, $jawaban);
                            }
                            $total_nilai = (100 / $jumlah_soal) * $nilai;

                            submit_ujian_selesai($kode_ujian, $submit_token, number_format($total_nilai, 1) ,$id_user);
                            
                            echo '
                                <script>
                                    window.location.href="peserta.php?stat=selesai";
                                </script>
                            ';
                        }
                    ?>
                    <form method="post">
                        <ul class="list-group">
                            <?php foreach($data_soal as $no_soal => $data_soal) : ?>
                                
                            <li class="list-group-item border-left-0 border-right-0 border-top-0 border-primary" style="border-radius:0">
                                <p>
                                    <b><?= $no_soal += 1; ?>. </b> &nbsp; <?= $data_soal['soal']; ?>
                                </p>

                                <div class="mb-1">
                                    <input type="radio" id="soal-1<?= $data_soal['kode_soal']; ?>" name="soal<?= $data_soal['kode_soal']; ?>" value="A" />
                                    <label for="soal-1<?= $data_soal['kode_soal']; ?>">A. <?= $data_soal['j_a']; ?></label>
                                </div>
                                <div class="mb-1">
                                    <input type="radio" id="soal-2<?= $data_soal['kode_soal']; ?>" name="soal<?= $data_soal['kode_soal']; ?>" value="B" />
                                    <label for="soal-2<?= $data_soal['kode_soal']; ?>">B. <?= $data_soal['j_b']; ?></label>
                                </div>
                                <div class="mb-1">
                                    <input type="radio" id="soal-3<?= $data_soal['kode_soal']; ?>" name="soal<?= $data_soal['kode_soal']; ?>" value="C" />
                                    <label for="soal-3<?= $data_soal['kode_soal']; ?>">C. <?= $data_soal['j_c']; ?></label>
                                </div>
                                <div class="mb-1">
                                    <input type="radio" id="soal-4<?= $data_soal['kode_soal']; ?>" name="soal<?= $data_soal['kode_soal']; ?>" value="D" />
                                    <label for="soal-4<?= $data_soal['kode_soal']; ?>">D. <?= $data_soal['j_d']; ?></label>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="my-4 mx-3">
                            <button class="btn btn-primary" name="submit_soal">Submit Jawaban</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php } else if(isset($_GET['stat'])) { ?>
        <?php if($_GET['stat'] == "selesai") { ?>
        
            <section class="row">
                <div class="col-sm-4 mx-auto">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <h2>Selesai</h2>
                            <hr class="border-primary" />
                            <p class="text-left mb-0">Anda sudah menyelesaikan ujian ini. Nilai anda sedang di proses.</p>

                            <div class="mt-4 text-right">
                                <a href="peserta.php" class="btn btn-primary btn-sm">Halaman Utama</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } ?>
    <?php } else { ?>

    <section class="row">
        <div class="col-sm-4 mx-auto">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white">
                    <h5>Token Ujian</h5>
                </div>
                <div class="card-body">
                    <?php 
                    // memamnggil file config.php
                    require_once "config.php";

                    if(isset($_POST['submit_token'])) {
                        $kode = $_POST['kode_token'];
                        if(empty($kode)) {
                            echo '
                                <div class="alert alert-danger"> Kode Token belum diisi!</div>
                            ';
                        } else {
                            $cek_token = cek_token($kode);
                            $data_token = mysqli_fetch_assoc($cek_token);
                            $rows_token = mysqli_num_rows($cek_token);

                            if($rows_token == 0) {
                                echo '
                                    <div class="alert alert-danger"> Kode Token tidak ditemukan!</div>
                                ';
                            } else {
                                $cek_peserta_ujian = cek_peserta_ujian($kode);
                                $rows_peserta_ujian = mysqli_num_rows($cek_peserta_ujian);

                                if($rows_peserta_ujian > 0) {
                                    
                                    echo '
                                    <div class="alert alert-danger"> Kode token sudah digunakan!</div>
                                    ';
                                } else {
                                    $enc_token = base64_encode($kode);
                                    echo "
                                        <script>
                                            window.location.href='peserta.php?token=$enc_token';
                                        </script>
                                    ";
                                }
                            }
                        }
                    } else {
                        echo '
                        <div class="alert alert-warning">
                            Silahkan hubungi admin untuk mendapatkan kode token ujian.
                        </div>
                        ';
                    }
                    ?>

                    <form method="post">                        
                        <div class="form-group">
                            <input type="text" class="form-control border border-primary" name="kode_token" placeholder="Masukan Token disini...">
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary" name="submit_token">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php } ?>

</main>

</body>
</html>