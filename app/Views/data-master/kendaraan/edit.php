<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data Kendaraan</h5>

                <?php $errors = session()->getFlashdata('errors'); ?>

                <form id="editKendaraanForm" action="<?= base_url('data-master/kendaraan/update/' . $kendaraan['id']) ?>" method="post">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">No. Polisi</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_polisi" class="form-control" value="<?= old('no_polisi', $kendaraan['no_polisi']); ?>" required>
                            <?php if (!empty($errors['no_polisi'])) : ?>
                                <small class="text-danger"><?= $errors['no_polisi']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Merk</label>
                        <div class="col-sm-10">
                            <input type="text" name="merk" class="form-control" value="<?= old('merk', $kendaraan['merk']); ?>" required>
                            <?php if (!empty($errors['merk'])) : ?>
                                <small class="text-danger"><?= $errors['merk']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">No. Mesin</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_mesin" class="form-control" value="<?= old('no_mesin', $kendaraan['no_mesin']); ?>" required>
                            <?php if (!empty($errors['no_mesin'])) : ?>
                                <small class="text-danger"><?= $errors['no_mesin']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Warna</label>
                        <div class="col-sm-10">
                            <input type="text" name="warna" class="form-control" value="<?= old('warna', $kendaraan['warna']); ?>" required>
                            <?php if (!empty($errors['warna'])) : ?>
                                <small class="text-danger"><?= $errors['warna']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Supir</label>
                        <div class="col-sm-10">
                            <select name="id_supir" class="form-control" required>
                                <option value="">-- Pilih Supir --</option>
                                <?php foreach ($supir as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= old('id_supir', $kendaraan['id_supir']) == $item['id'] ? 'selected' : '' ?>>
                                        <?= $item['nama_supir'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <?php if (!empty($errors['id_supir'])) : ?>
                                <small class="text-danger"><?= $errors['id_supir']; ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('data-master/kendaraan') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('editKendaraanForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman langsung

        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin memperbarui data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Jika dikonfirmasi, kirim form
            }
        });
    });

    <?php if (session()->getFlashdata('success_message')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: "<?= session()->getFlashdata('success_message'); ?>"
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>
