<?php
  $status_filter = !empty($_GET['status']) ? $_GET['status'] : '';
  $redirect = '';
  if ($status_filter) $redirect = '?status=' . $status_filter;
?>
<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body pt-3 pb-3">
                    <form id="filterForm" class="row g-3">
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status Komplain</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="Pending" <?= $status_filter == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Proses" <?= $status_filter == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="Selesai" <?= $status_filter == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cetak & Tabel -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Data Komplain</h5>
                    </div>

                    <div class="text-end">
                        <a href="<?= base_url('komplain/generate-pdf') . $redirect ?>" target="_blank" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Cetak PDF
                        </a>
                    </div>

                    <!-- Flash Message -->
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

                    <!-- Table -->
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
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert -->
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
