<section class="row">
    <div class="col-sm-6 mx-auto">
        <?php 
        if(isset($_GET['stat'])) {
            echo '
                <div class="alert alert-success"> Soal Baru sudah ditambahkan <a href="admin.php?page=tambah-soal" class="close">&times;</a></div>
                
            ';
        }
        if(isset($_POST['submit'])) {
            $kode = kode_soal();
            $soal = $_POST['soal'];
            $a = $_POST['a'];
            $b = $_POST['b'];
            $c = $_POST['c'];
            $d = $_POST['d'];
            $j = $_POST['jawaban'];

            if(empty($soal) OR  empty($a) OR empty($b) OR empty($c) OR empty($d) OR empty($j)) {
                echo '
                    <div class="alert alert-danger"> Inputan tidak boleh kosong!</div>
                ';
            } else {

                tambah_soal($kode, $soal, $a, $b, $c, $d, $j);

                echo '
                    <script>
                        window.location.href="admin.php?page=tambah-soal&stat=berhasil";
                    </script>
                ';
            }

        }
        ?>
        <form method="POST" class="card border-primary">
            <div class="card-header border-primary bg-primary text-white">
                <h5>Tambah soal</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Soal</label>
                    <textarea name="soal" class="form-control border-primary"></textarea>
                </div>
                <div class="form-group">
                    <label>Opsi Jawaban:</label>
                    <div class="d-flex mb-3">
                        <h6 class="mr-3">A. </h6>
                        <textarea name="a" class="form-control border-primary"></textarea>
                    </div>
                    <div class="d-flex mb-3">
                        <h6 class="mr-3">B. </h6>
                        <textarea name="b" class="form-control border-primary"></textarea>
                    </div>
                    <div class="d-flex mb-3">
                        <h6 class="mr-3">C. </h6>
                        <textarea name="c" class="form-control border-primary"></textarea>
                    </div>
                    <div class="d-flex mb-3">
                        <h6 class="mr-3">D. </h6>
                        <textarea name="d" class="form-control border-primary"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jawaban Benar</label>
                    <select name="jawaban" class="form-control border-primary">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
            <div class="card-footer border-primary">
                <button type="submit" class="btn btn-primary" name="submit">submit soal</button>
                <a href="admin.php" class="btn border-secondary">Kembali</a>
            </div>
        </form>
    </div>
</section>