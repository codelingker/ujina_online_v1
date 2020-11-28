<section class="row">
    <div class="col-sm-7 mb-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-light">
                <h5>Data Nilai</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0 myTable border">
                        <thead>
                            <th style="width: 50px"></th>
                            <th>Kode Peserta</th>
                            <th>Nama Peserta</th>
                            <th class="text-center">Total Nilai</th>
                        </thead>
                        <tbody>
                            <?php 
                                foreach(load_ujian_selesai() as $n_ujian => $data_ujian) : 
                                    
                            ?>
                                
                            <tr>
                                <th><?= $n_ujian+=1; ?></th>
                                <td><?= $data_ujian['kode_ujian'] ?></td>
                                <td><?= $data_ujian['nama_peserta'] ?></td>
                                <td class="text-center"><?= $data_ujian['total_nilai'] ?></td>
                            </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5 mb-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-light d-flex flex-wrap" style="justify-content: space-between">
                <h5>Data Token</h5>
                <a href="admin.php?page=tambah-soal-ujian" class="btn btn-sm btn-outline-light">Buat Token</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0 myTable border">
                        <thead>
                            <th style="width: 50px"></th>
                            <th>Token</th>
                        </thead>
                        <tbody>
                            <?php foreach(load_token() as $n_token => $data_token) : ?>
                            <tr>
                                <th>
                                    <?= $n_token+=1; ?>
                                </th>
                                <td>
                                    <?= $data_token['kode_token']; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12 mb-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-light d-flex flex-wrap" style="justify-content: space-between">
                <h5>Bank Soal</h5>
                <a href="admin.php?page=tambah-soal" class="btn btn-sm btn-outline-light">Tambah Soal</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0 border myTable">
                        <thead>
                            <th style="width: 50px"></th>
                            <th style="width: 100px">Kode Soal</th>
                            <th>Soal</th>
                        </thead>
                        <tbody>
                                
                            <?php foreach(load_bank_soal() as $u_soal => $bank_soal) : ?>
                            <tr>
                                <th>
                                    <?= $u_soal+=1; ?>
                                </th>
                                <td>
                                    <?= $bank_soal['kode_soal']; ?>
                                </td>
                                <td>
                                    <p>
                                        <?= $bank_soal['soal'] ?>
                                    </p>
                                    <div class="mb-3">
                                        Opsi jawaban: 
                                        <p class="mb-0">A. <?= $bank_soal['j_a'] ?></p>
                                        <p class="mb-0">B. <?= $bank_soal['j_b'] ?></p>
                                        <p class="mb-0">C. <?= $bank_soal['j_c'] ?></p>
                                        <p class="mb-0">D. <?= $bank_soal['j_d'] ?></p>
                                    </div>
                                    <h6>Jawaban Benar: <?= $bank_soal['jawaban_benar'] ?></h6>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

</section>