<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Edit Data Supir</h5>
                    <form action="<?= base_url('data-master/kendaraan/update/' . $kendaraan['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>No. Polisi</label>
                            <input type="text" name="no_polisi" class="form-control" value="<?= old('no_polisi', $kendaraan['no_polisi']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <input type="text" name="merk" class="form-control" value="<?= old('merk', $kendaraan['merk']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>No. Mesin</label>
                            <input type="text" name="no_mesin" class="form-control" value="<?= old('no_mesin', $kendaraan['no_mesin']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" name="warna" class="form-control" value="<?= old('warna', $kendaraan['warna']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Supir</label>
                            <select name="id_supir" class="form-control" required>
                                <option value="">-- Pilih Supir --</option>
                                <?php foreach ($supir as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= ($item['id'] == $kendaraan['id_supir']) ? 'selected' : '' ?>>
                                        <?= $item['nama'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
