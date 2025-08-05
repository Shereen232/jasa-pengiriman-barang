<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Data Kendaraan</h5>
                        <a href="<?= base_url('data-master/kendaraan/tambah') ?>" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Kendaraan
                        </a>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kendaraan</th> <!-- Tambah kolom -->
                                <th>No. Polisi</th>
                                <th>Merk</th>
                                <th>No. Mesin</th>
                                <th>Warna</th>
                                <th>Status</th> <!-- Kolom status aktif/nonaktif -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($kendaraan)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($kendaraan as $k) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($k['nama_kendaraan']) ?></td> <!-- Tampilkan nama kendaraan -->
                                        <td><?= esc($k['no_polisi']) ?></td>
                                        <td><?= esc($k['merk']) ?></td>
                                        <td><?= esc($k['no_mesin']) ?></td>
                                        <td><?= esc($k['warna']) ?></td>
                                        <td>
                                            <?php if (is_null($k['deleted_at'])) : ?>
                                                <span class="badge bg-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="badge bg-danger">Non Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('data-master/kendaraan/edit/' . $k['id']) ?>" class="btn btn-info">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <?php if (is_null($k['deleted_at'])) : ?>
                                                <button class="btn btn-warning btn-status" data-id="<?= $k['id'] ?>" data-status="0">Non Aktifkan</button>
                                            <?php else : ?>
                                                <button class="btn btn-success btn-status" data-id="<?= $k['id'] ?>" data-status="1">Aktifkan</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data kendaraan.</td>
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
            const kendaraanId = this.getAttribute("data-id");

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin menghapus data kendaraan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('data-master/kendaraan/delete/') ?>" + kendaraanId;
                }
            });
        });
    });

    // Aktif/Nonaktif Kendaraan
    const statusButtons = document.querySelectorAll(".btn-status");
    statusButtons.forEach(button => {
        button.addEventListener("click", function() {
            const kendaraanId = this.getAttribute("data-id");
            const status = this.getAttribute("data-status");
            const text = status == "1" ? "mengaktifkan" : "menonaktifkan";
            Swal.fire({
                title: "Konfirmasi",
                text: `Apakah Anda yakin ingin ${text} kendaraan ini?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('data-master/kendaraan/status/') ?>" + kendaraanId + "/" + status;
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
