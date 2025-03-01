<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Input Data Kendaraan</h5>
                <form action="<?= base_url('data-master/kendaraan/create') ?>" method="post">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">No. Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_polisi" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Merk</label>
                        <div class="col-sm-10">
                            <input type="text" name="merk" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">No. Mesin</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_mesin" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Warna</label>
                        <div class="col-sm-10">
                            <input type="text" name="warna" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Supir</label>
                        <div class="col-sm-10">
                            <select name="id_supir" class="form-control" required>
                                <option value="">-- Pilih Supir --</option>
                                <?php foreach ($supir as $item): ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
