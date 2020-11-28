<?php
session_start();
function database() {
    $hostname = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "db_ujian_online"; 

    $db = mysqli_connect($hostname, $username, $password, $database);

    return $db;
}    

function login($username) {
    $db = database();
    $q = mysqli_query($db, "SELECT * FROM tb_login WHERE email = '$username' ");
    return $q;
}

function cek_token($kode) {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_token_master WHERE kode_token = '$kode' ");
}   

function tampil_soal_ujian($token) {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_soal_ujian su JOIN tb_bank_soal bs ON su.kode_soal = bs.kode_soal JOIN tb_token_master tm ON tm.kode_token  = su.kode_token WHERE su.kode_token = '$token' ");
}

function kode_ujian() {
    $db = database();
    $q = mysqli_query($db, "SELECT MAX(kode_ujian) as kode FROM tb_ujian_selesai ");
    $d = mysqli_fetch_assoc($q);
    $r = mysqli_num_rows($q);
    $k = $d['kode'];
    $urutan = (int) substr($k, 3, 4);
    $urutan++;
    $huruf = "US";
    return $huruf . sprintf("%05s", $urutan);
}

function id_peserta() {
    $db = database();
    $q = mysqli_query($db, "SELECT MAX(id_peserta) as kode FROM tb_peserta ");
    $d = mysqli_fetch_assoc($q);
    $r = mysqli_num_rows($q);
    $k = $d['kode'];
    $urutan = (int) substr($k, 3, 4);
    $urutan++;
    $huruf = "P";
    return $huruf . sprintf("%04s", $urutan);
}

function kode_soal() {
    $db = database();
    $q = mysqli_query($db, "SELECT MAX(kode_soal) as kode FROM tb_bank_soal ");
    $d = mysqli_fetch_assoc($q);
    $r = mysqli_num_rows($q);
    $k = $d['kode'];
    $urutan = (int) substr($k, 3, 4);
    $urutan++;
    $huruf = "S";
    return $huruf . sprintf("%04s", $urutan);
}

function kode_soal_ujian() {
    return substr(str_shuffle(str_repeat("01234567890ABCDEabcde", 7)), 0, 7);
}

function submit_jawaban($kode_ujian,  $soal, $jawaban) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_jawaban_peserta (kode_ujian, kode_soal, jawaban_peserta) VALUES('$kode_ujian', '$soal', '$jawaban') ");
}

function submit_ujian_selesai($kode_ujian, $token, $nilai ,$id_user) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_ujian_selesai (kode_ujian, id_peserta, kode_token, total_nilai) VALUES('$kode_ujian', '$id_user', '$token', '$nilai') ");
}

function cek_peserta_ujian($token) {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_ujian_selesai WHERE kode_token = '$token' ");
}

function load_bank_soal() {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_bank_soal ORDER BY kode_soal DESC");
}

function load_ujian_selesai() {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_ujian_selesai us 
                            JOIN tb_peserta pe ON us.id_peserta = pe.id_peserta 
                            ORDER BY us.kode_ujian DESC");
}

function load_token() {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_token_master ORDER BY id_token DESC");
}

function load_hasil_ujian($kode_ujian) {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_jawaban_peserta jp JOIN tb_bank_soal bs ON jp.kode_soal = bs.kode_soal WHERE jp.kode_ujian = '$kode_ujian'");
}

function cek_jawaban($kode, $jawaban) {
    $db = database();
    return  mysqli_query($db, "SELECT * FROM tb_bank_soal  
                                WHERE kode_soal = '$kode' AND jawaban_benar = '$jawaban' ");
}

function tambah_soal($kode, $soal, $a, $b, $c, $d, $j) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_bank_soal (kode_soal, soal, j_a, j_b, j_c, j_d, jawaban_benar)  
                                VALUES('$kode', '$soal', '$a', '$b', '$c', '$d', '$j') ");
}

function tambah_soal_ujian($kode, $soal) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_soal_ujian (kode_soal, kode_token)  
                                VALUES('$soal', '$kode') ");
}
function tambah_token_master($kode) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_token_master (kode_token)  
                                VALUES('$kode') ");
}
function cek_email($email) {
    $db = database();
    return mysqli_query($db, "SELECT * FROM tb_login 
                                WHERE email = '$email' ");
}
function tambah_data_peserta($id, $nama, $email) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_peserta (id_peserta, nama_peserta, email_peserta)  
                                VALUES('$id', '$nama', '$email') ");
}
function tambah_data_login($id, $email, $password) {
    $db = database();
    mysqli_query($db, "INSERT INTO tb_login (id_user, email, password)  
                                VALUES('$id', '$email', '$password') ");
}