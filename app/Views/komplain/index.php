<?php
  $start_date = !empty($_GET['start_date']) ? $_GET['start_date'] : false;
  $end_date = !empty($_GET['end_date']) ? $_GET['end_date'] : false;
  $redirect = '';
  if ($start_date && $end_date) $redirect = '?start_date='.$start_date.'&end_date='.$end_date;
?>
<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
    <div class="col-lg">
      <div class="card">
        <div class="card-body pt-3 pb-3">
            <form id="filterForm" class="row g-6 ">
                <div class="col-md-4">
                <label for="start_date" class="form-label">Dari:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $start_date ?>">
                </div>
                <div class="col-md-4">
                <label for="end_date" class="form-label">Sampai:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $end_date ?>">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Data Komplain</h5>
                    </div>
                    <div class="align-items-left;">
                    <a href="<?= base_url('komplain/generate-pdf').$redirect ?>" target="_blank" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Cetak PDF
                    </a>
                    </div>

                    <!-- Menampilkan pesan sukses jika ada -->
                    <?php if (session()->getFlashdata('message')): ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: "<?= session()->getFlashdata('message') ?>",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        </script>
                    <?php endif; ?>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>No. Resi</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($komplain)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($komplain as $k) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($k['nama']) ?></td>
                                        <td><?= esc($k['email']) ?></td>
                                        <td><?= esc($k['no_telp']) ?></td>
                                        <td><?= esc($k['no_resi']) ?></td>
                                        <td><?= esc($k['pesan']) ?></td>
                                        <td>
                                            <span class="badge 
                                                    <?= ($k['status'] == 'Pending') ? 'bg-warning' : 
                                                        (($k['status'] == 'Selesai') ? 'bg-success' : 
                                                        (($k['status'] == 'Proses') ? 'bg-info' : 'bg-primary')) ?>">
                                                <?= esc($k['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('komplain/edit/' . $k['id']) ?>" class="btn btn-info">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-danger delete-btn" data-id="<?= $k['id'] ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data komplain.</td>
                                </tr>
                            <?php endif; ?>
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
            const komplainId = this.getAttribute("data-id");

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin menghapus data komplain ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('komplain/delete/') ?>" + komplainId;
                }
            });
        });
    });
});
</script>

<?= $this->endSection() ?>
