<?php if ($this->session->flashdata('sukses') != ""): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('sukses') ?>
            </div>
        </div>
    </div>
<?php endif ?>
<?php if ($this->session->flashdata('gagal') != ""): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('gagal') ?>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-md-5 col-sm-12 mb-2">
        <div class="card">
            <div class="card-header">Tambah Antrian Pasien</div>
            <div class="card-body">
                <form class="form-inline justify-content-center needs-validation" novalidate method="POST" action="<?= base_url('antrian?cari=pasien') ?>">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="nik" class="sr-only">NIK</label>
                    <input type="number" class="form-control" name="nik" id="nik" placeholder="NIK Pasien" required>

                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
            </div>
            <?php if ($this->session->flashdata('cari_pasien') !=""): ?>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    <?= $this->session->flashdata('cari_pasien') ?>
                </div>
            </div>
            <?php endif ?>


            <?php if ($cari !=""): ?>
            <div class="card-body">
                <h4>Data Pasien</h4>
                <table>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td><?= $cari->nik_pasien; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $cari->nama_pasien; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?= $cari->jenis_kelamin; ?></td>
                    </tr>
                    <tr>
                        <td>Usia</td>
                        <td>:</td>
                        <td><?= $cari->umur_pasien; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $cari->alamat_pasien; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <a href="<?= base_url('antrian/tambah/'.$cari->id_pasien) ?>" class="btn btn-warning btn-sm mt-3">Tambah ke antrian <i class="fas fa-arrow-right"></i></a>
                        </td>
                    </tr>
                </table>
            </div>                
            <?php endif ?>
        </div>
    </div>
    <div class="col-md-7 col-sm-12 mb-2">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Antrian</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <?php if ($this->session->flashdata('antrian_pasien') !=""): ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success" role="alert">
                            <?= $this->session->flashdata('antrian_pasien') ?>
                        </div>
                    </div>
                    <?php endif ?>

                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No Antrian</th>
                                        <th>NIK</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Antrian</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php foreach ($antrian as $value): ?>
                                        
                                        <tr>
                                            <td><?= $value->no_antrian ?></td>
                                            <td>
                                                <a href="<?= base_url('antrian/periksa/'.$value->id_antrian) ?>">
                                                <?= $value->nik_pasien ?>
                                                </a>                                                
                                            </td>
                                            <td><?= $value->nama_pasien ?></td>
                                            <td>
                                                <?php if ($value->status_antrian=="antrian"){ ?>
                                                    <a href="<?= base_url('antrian/periksa/'.$value->id_antrian) ?>" class="btn btn-sm btn-dark">Dalam Antrian</a>
                                                <?php }elseif ($value->status_antrian=="pemeriksaan") { ?>
                                                    <button class="btn btn-warning btn-sm">Pemeriksaan</button>
                                                <?php }elseif ($value->status_antrian=="selesai") { ?>
                                                    <button class="btn btn-success btn-sm">Selesai</button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
