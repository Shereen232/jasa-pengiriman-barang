<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Data Pelanggan</h5>
            <div>
              <a href="<?= base_url('data-master/pelanggan/tambah') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
              </a>
            </div>
          </div>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pelanggan as $index => $item): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= esc($item['no_ktp']) ?></td>
                  <td><?= esc($item['nama_pelanggan']) ?></td>
                  <td><?= esc($item['jenis_kelamin']) ?></td>
                  <td><?= esc($item['alamat']) ?></td>
                  <td><?= esc($item['telepon']) ?></td>
                  <td>
                    <a href="<?= base_url('data-master/pelanggan/edit/' . $item['id_pelanggan']) ?>" class="btn btn-info">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-danger delete-btn" data-id="<?= $item['id_pelanggan'] ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const pelangganId = this.getAttribute("data-id");

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin menghapus data pelanggan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('data-master/pelanggan/delete/') ?>" + pelangganId;
                }
            });
        });
    });
});

// Notifikasi sukses setelah menghapus data
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
