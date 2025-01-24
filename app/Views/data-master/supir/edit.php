<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Data Supir</h5>

                    <!-- Form Edit Supir -->
                    <form action="<?= base_url('data-master/supir/update/' . $supir['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row mb-3">
                            <label for="no_ktp" class="col-sm-4 col-form-label">No. KTP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?= old('no_ktp', $supir['no_ktp']) ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_supir" class="col-sm-4 col-form-label">Nama Supir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_supir" name="nama_supir" value="<?= old('nama_supir', $supir['nama']) ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat', $supir['alamat']) ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telepon" class="col-sm-4 col-form-label">Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= old('telepon', $supir['telepon']) ?>" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('data-master/supir') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form><!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
