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
          <form id="filterForm" class="row g-6">
            <div class="col-md-4">
              <label for="start_date" class="form-label">Dari:</label>
              <input type="date" class="form-control" id="start_date" name="start_date" 
                    value="<?= old('start_date', $start_date) ?>">
            </div>

            <div class="col-md-4">
              <label for="end_date" class="form-label">Sampai:</label>
              <input type="date" class="form-control" id="end_date" name="end_date" 
                    value="<?= old('end_date', $end_date) ?>">
            </div>

            <div class="col-md-4">
              <label for="status" class="form-label">Status:</label>
              <select class="form-select" id="status" name="status">
                <option value="">-- Semua --</option>
                <?php
                  $statuses = [
                    'Menunggu Pengiriman',
                    'Dalam Perjalanan',
                    'Terkirim',
                    'Gagal Terkirim',
                    'Dibatalkan'
                  ];
                  foreach ($statuses as $item) {
                    $selected = old('status') == $item ? 'selected' : '';
                    echo "<option value=\"$item\" $selected>$item</option>";
                  }
                ?>
              </select>
            </div>

            <div class="col-md-12 d-flex justify-content-end mt-3">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <!-- Filter Form -->
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Data Pengiriman</h5>
            <div>
              <a href="<?= base_url('pengiriman/tambah') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
              </a>
              <a href="<?= base_url('pengiriman/cetak_pdf').$redirect ?>" target="_blank" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf-fill"></i> Cetak PDF
              </a>
            </div>
          </div>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>No Pengiriman</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Supir 1</th>
                <th>Supir 2</th>
                <th>Barang</th>
                <th>Berat</th>
                <th>Biaya Kirim</th>
                <th>Estimasi Pengiriman</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($pengiriman as $item): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($item['no_pengiriman']) ?></td>
                  <td><?= esc($item['tanggal']) ?></td>
                  <td><?= esc($item['nama_pengirim']) ?></td>
                  <td><?= esc($item['penerima']) ?></td>
                  <td><?= esc($item['nama_supir1']) ?></td>
                  <td><?= esc($item['nama_supir2']) ?></td>
                  <td><?= esc($item['nama_barang']) ?></td>
                  <td><?= esc($item['berat']) ?> kg</td>
                  <td>Rp <?= number_format($item['biaya_kirim'], 0, ',', '.') ?></td>
                  <td><?= esc($item['estimasi_pengiriman']) ?></td>
                  <td><?= esc($item['status']) ?></td>
                  <td>
                    <a href="<?= base_url('pengiriman/edit/' . $item['id']) ?>" class="btn btn-info">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-danger delete-btn" data-id="<?= $item['id'] ?>">
                      <i class="bi bi-trash"></i>
                    </button>
                    <a href="<?= base_url('pengiriman/cetak/' . $item['id']) ?>" class="btn btn-success">
                      <i class="bi bi-printer-fill"></i>
                    </a>
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
            const pengirimanId = this.getAttribute("data-id");

            Swal.fire({
                title: "Konfirmasi",
                text: "Apakah Anda yakin ingin menghapus data pengiriman ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('pengiriman/delete/') ?>" + pengirimanId;
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
