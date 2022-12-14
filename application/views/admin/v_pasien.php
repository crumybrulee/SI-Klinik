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
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Pasien</h2>
                <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#exampleModalLong">
                 <i class="fas fa-plus"></i>  Tambah Pasien Baru
                </button>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NIK</th>
                                        <th>Nama Pasien</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php $no=1; foreach ($pasien as $value): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value->nik_pasien ?></td>
                                            <td><?= $value->nama_pasien ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit<?= $value->id_pasien ?>">
                                                 <i class="fas fa-edit"></i> Detail
                                                </button>
                                                <a href="<?= base_url('pasien/hapus/'.$value->id_pasien) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus? Y/N')"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>



<!-- Modal Edit-->
<div class="modal fade" id="edit<?= $value->id_pasien ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="<?= base_url('pasien/edit/'.$value->id_pasien) ?>" method="POST" class="needs-validation" novalidate>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pasien <?= $value->nama_pasien ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" name="nik_pasien" class="form-control" value="<?= $value->nik_pasien ?>" id="nik" placeholder="Enter NIK" required>
            <div class="invalid-feedback">
                NIK harus diisi.
            </div>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama_pasien" class="form-control" value="<?= $value->nama_pasien ?>" id="nama" placeholder="Enter Nama" required>
            <div class="invalid-feedback">
                Nama harus diisi.
            </div>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="radio">
                <label>
                    <input type="radio"  <?php if ($value->jenis_kelamin == 'laki-laki') { echo "checked"; } ?>  value="laki-laki" id="optionsRadios1" name="jenis_kelamin"> Laki-Laki
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" <?php if ($value->jenis_kelamin == 'perempuan') { echo "checked"; } ?> value="perempuan" id="optionsRadios2" name="jenis_kelamin"> Perempuan
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="umur">Umur</label>
            <input type="number" name="umur_pasien" class="form-control" value="<?= $value->umur_pasien ?>" id="umur" placeholder="Enter Umur" required>
            <div class="invalid-feedback">
                Umur harus diisi.
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea required name="alamat_pasien" class="form-control"id="alamat" rows="3"><?= $value->alamat_pasien ?></textarea>
            <div class="invalid-feedback">
                Alamat harus diisi.
            </div>
        </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

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


<!-- Modal Add-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="<?= base_url('pasien/tambah') ?>" method="POST" class="needs-validation" novalidate>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pasien Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="number" name="nik_pasien" class="form-control" id="nik" placeholder="Enter NIK" required>
            <div class="invalid-feedback">
                NIK harus diisi.
            </div>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama_pasien" class="form-control" id="nama" placeholder="Enter Nama" required>
            <div class="invalid-feedback">
                Nama harus diisi.
            </div>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="radio">
                <label>
                    <input type="radio" value="laki-laki" id="optionsRadios1" name="jenis_kelamin"> Laki-Laki
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" value="perempuan" id="optionsRadios2" name="jenis_kelamin"> Perempuan
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="umur">Umur</label>
            <input type="number" name="umur_pasien" class="form-control" id="umur" placeholder="Enter Umur" required>
            <div class="invalid-feedback">
                Umur harus diisi.
            </div>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea required name="alamat_pasien" class="form-control" id="alamat" rows="3"></textarea>
            <div class="invalid-feedback">
                Alamat harus diisi.
            </div>
        </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>