<section class="row">
    <div class="col-sm-8 mx-auto">
        <?php 
        if(isset($_GET['stat'])) {
            echo '
            <div class="alert alert-success"> Soal Baru sudah ditambahkan <a href="admin.php?page=tambah-soal-ujian" class="close">&times;</a></div>
            
            ';
        }
        if(isset($_POST['submit'])) {
            $kode = kode_soal_ujian();
            $soal = @$_POST['soal'];
            if(empty($soal)) {
                echo '
                <div class="alert alert-danger">
                    soal belum dipilih.
                </div>
                ';
            } else {
                foreach($soal as $soal) {
                    tambah_soal_ujian($kode, $soal);
                }
                tambah_token_master($kode);
                echo '
                <script>
                    window.location.href="admin.php?page=tambah-soal-ujian&stat=berhasil";
                </script>
                ';

            }
        } else {
            echo '
            <div class="alert alert-warning">
                Pilih soal ujian yang akan dijadikan soal ujian.
            </div>
            ';
        }
        ?>
        
        <form method="POST" class="card border-primary">
            <div class="card-header border-primary bg-primary text-white d-flex" style="justify-content: space-between">
                <h5>Tambah soal Ujian</h5>
                <div class="text-right">
                    <small>Kode Token: </small>
                    <h6><?= kode_soal_ujian(); ?></h6>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-borderless myTable">
                    <thead>
                        <th style="width: 50px"></th>
                        <th>Soal</th>
                    </thead>
                    <tbody>
                        <?php foreach(load_bank_soal() as $bs) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="soal[]" value="<?= $bs['kode_soal']; ?>" />
                            </td>
                            <td><?= $bs['soal']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer border-primary">
                <button type="submit" class="btn btn-primary" name="submit">submit soal</button>
                <a href="admin.php" class="btn border-secondary">Kembali</a>
            </div>
        </form>
    </div>
</section>