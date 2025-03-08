<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="col-lg-6">
        <div class="card"> 
            <div class="card-body">
                <h5 class="card-title" style="text-align: center;">Input Data Pelanggan</h5>
                <form id="pelangganForm" action="<?= base_url('data-master/pelanggan/create') ?>" method="post">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">No KTP</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_ktp" class="form-control" value="<?= old('no_ktp'); ?>">
                            <?php if (session()->getFlashdata('errors')['no_ktp'] ?? false) : ?>
                                <small class="text-danger"><?= session()->getFlashdata('errors')['no_ktp']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_pelanggan" class="form-control" value="<?= old('nama_pelanggan'); ?>">
                            <?php if (session()->getFlashdata('errors')['nama_pelanggan'] ?? false) : ?>
                                <small class="text-danger"><?= session()->getFlashdata('errors')['nama_pelanggan']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                            <?php if (session()->getFlashdata('errors')['jenis_kelamin'] ?? false) : ?>
                                <small class="text-danger"><?= session()->getFlashdata('errors')['jenis_kelamin']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control"><?= old('alamat'); ?></textarea>
                            <?php if (session()->getFlashdata('errors')['alamat'] ?? false) : ?>
                                <small class="text-danger"><?= session()->getFlashdata('errors')['alamat']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" name="telepon" class="form-control" value="<?= old('telepon'); ?>">
                            <?php if (session()->getFlashdata('errors')['telepon'] ?? false) : ?>
                                <small class="text-danger"><?= session()->getFlashdata('errors')['telepon']; ?></small>
                            <?php endif; ?>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('pelangganForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form langsung

        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin menyimpan data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Jika dikonfirmasi, kirim form
            }
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            title: "Sukses!",
            text: "<?= session()->getFlashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "OK"
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>
