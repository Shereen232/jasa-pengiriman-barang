<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Data Supir</h5>

          <!-- Form Edit Supir -->
          <form id="editSupirForm" method="post" action="<?= base_url('data-master/supir/update/' . $supir['id']) ?>">
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">No. KTP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no_ktp" value="<?= old('no_ktp', $supir['no_ktp']) ?>" required>
                <?php if (session()->getFlashdata('errors')['no_ktp'] ?? false) : ?>
                    <small class="text-danger"><?= session()->getFlashdata('errors')['no_ktp']; ?></small>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Nama Supir</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama_supir" value="<?= old('nama_supir', $supir['nama_supir']) ?>" required>
                <?php if (session()->getFlashdata('errors')['nama_supir'] ?? false) : ?>
                    <small class="text-danger"><?= session()->getFlashdata('errors')['nama_supir']; ?></small>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat" required><?= old('alamat', $supir['alamat']) ?></textarea>
                <?php if (session()->getFlashdata('errors')['alamat'] ?? false) : ?>
                    <small class="text-danger"><?= session()->getFlashdata('errors')['alamat']; ?></small>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Telepon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telepon" value="<?= old('telepon', $supir['telepon']) ?>" required>
                <?php if (session()->getFlashdata('errors')['telepon'] ?? false) : ?>
                    <small class="text-danger"><?= session()->getFlashdata('errors')['telepon']; ?></small>
                <?php endif; ?>
              </div>
            </div>

            <div class="text-center">
              <button type="button" id="submitBtn" class="btn btn-primary">Update</button>
              <a href="<?= base_url('data-master/supir') ?>" class="btn btn-secondary">Batal</a>
            </div>
          </form><!-- End Form -->

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById("submitBtn").addEventListener("click", function() {
    Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin mengupdate data supir ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, update!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("editSupirForm").submit();
        }
    });
});

// Notifikasi SweetAlert setelah berhasil update
<?php if(session()->getFlashdata('success_message')) : ?>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: "<?= session()->getFlashdata('success_message') ?>",
        showConfirmButton: false,
        timer: 2000
    });
<?php endif; ?>
</script>

<?= $this->endSection() ?>
