<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar</title>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh">

<main class="container">
    <div class="row">
        <div class="col-sm-4 mx-auto">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Daftar</h4>
                </div>
                <div class="card-body">
                    <?php 
                    // memamnggil file config.php
                    require_once "config.php";

                    $nama = "";
                    $email = "";
                    $password = "";

                    // saat user menekan tombol login
                    if(isset($_POST['daftar'])) {
                        // menampung inputan user berupa username dan password dalam varibel ($)
                        $nama    = $_POST['nama'];
                        $email    = $_POST['email'];
                        $password = $_POST['password'];

                        // kondisi ketika inputan nama lengkap kosong
                        if(empty($nama)) {
                            echo '
                                <div class="alert alert-danger"> Nama belum diisi!</div>
                            ';

                            // kondisi ketika inputan email kosong
                        } else if(empty($email)) {
                            echo '
                                <div class="alert alert-danger"> Email belum diisi!</div>
                            ';

                            // kondisi ketika inputan password kosong
                        } else if(empty($password)) {
                            echo '
                                <div class="alert alert-danger"> Password belum diisi!</div>
                            ';
                        } else {
                             
                            $cek  = cek_email($email);
                            $data = mysqli_fetch_assoc($cek);
                            $rows = mysqli_num_rows($cek);

                            if($rows > 0) {
                                echo '
                                    <div class="alert alert-danger"> Email sudah terdaftar!</div>
                                ';
                            } else {
                                $id = id_peserta();
                                tambah_data_peserta($id, $nama, $email);
                                tambah_data_login($id, $email, $password);
                                echo '
                                    <script>
                                        window.location.href="login.php?pesan=berhasil-daftar";
                                    </script>
                                ';
                            }
                        }
                    }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="Username">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm border border-primary" name="nama" value="<?= $nama; ?>" /> 
                        </div>                                        
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control form-control-sm border border-primary" name="email" value="<?= $email; ?>" /> 
                        </div>                    
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control form-control-sm border border-primary" name="password" value="<?= $password; ?>" /> 
                        </div>                    
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" name="daftar">Daftar</button>
                        </div>
                        <div class="mt-3">
                            <small>
                                Sudah punya akun? <a href="login.php">Login</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="assets/jquery/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>