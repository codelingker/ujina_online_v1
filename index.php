<?php 
session_start();
if(isset($_SESSION['login'])) {
    $lv = $_SESSION['login']['level'];

    if($lv == "Admin") {
        echo '
            <script>
                window.location.href="admin.php";
            </script>
        ';
    } else if($lv == "Peserta") {
        echo '
            <script>
                window.location.href="peserta.php";
            </script>
        ';
    } 
} else {
    echo '
        <script>
            window.location.href="login.php";
        </script>
    ';
}