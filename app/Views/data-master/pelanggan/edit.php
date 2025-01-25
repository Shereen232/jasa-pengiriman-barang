<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Edit Pelanggan</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('data-master/pelanggan/update/' . $pelanggan['id_pelanggan']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>No KTP</label>
                    <input type="text" name="no_ktp" class="form-control" value="<?= $pelanggan['no_ktp'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="<?= $pelanggan['nama_pelanggan'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" <?= $pelanggan['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $pelanggan['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= $pelanggan['alamat'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="<?= $pelanggan['telepon'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
