<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh">

<main class="container">
    <div class="row">
        <div class="col-sm-4 mx-auto">
            <div class="card border border-primary">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <?php 
                    // memamnggil file config.php
                    require_once "config.php";

                    $username = "";
                    $password = "";

                    if(isset($_GET['pesan'])) {
                        echo '
                            <div class="alert alert-success"> <b> Akun sudah terdaftar :)  </b> <br /> Silahkan login menggunakan akun yang sudah didaftarkan. <a href="login.php" class="close">&times;</a></div>
                        ';
                    }

                    // saat user menekan tombol login
                    if(isset($_POST['login'])) {
                        // menampung inputan user berupa username dan password dalam varibel ($)
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // kondisi ketika inputan username kosong
                        if(empty($username)) {
                            echo '
                                <div class="alert alert-danger"> Username belum diisi!</div>
                            ';

                            // kondisi ketika inputan password kosong
                        } else if(empty($password)) {
                            echo '
                                <div class="alert alert-danger"> Password belum diisi!</div>
                            ';
                        } else {
                             
                            $cek = login($username);
                            $data = mysqli_fetch_assoc($cek);
                            $rows = mysqli_num_rows($cek);

                            if($rows == 0) {
                                echo '
                                    <div class="alert alert-danger"> Akun tidak terdaftar!</div>
                                ';
                            } else {
                                if($password <> $data['password']) {
                                    echo '
                                        <div class="alert alert-danger"> Username dan password tidak sesuai!</div>
                                    ';
                                } else {
                                    $_SESSION['login']['id_user'] = $data['id_user'];
                                    $_SESSION['login']['level'] = $data['level'];
                                    echo '
                                        <script>
                                            window.location.href="index.php";
                                        </script>
                                    ';
                                }
                            }
                        }
                    }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="Username">Email</label>
                            <input type="text" class="form-control form-control-sm border border-primary" name="username" value="<?= $username; ?>" /> 
                        </div>                    
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control form-control-sm border border-primary" name="password" value="<?= $password; ?>" /> 
                        </div>                    
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" name="login">Login</button>
                        </div>
                        <div class="mt-3">
                            <small>
                                Belum punya akun? <a href="daftar.php">Daftar</a>
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