<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Data Pengiriman</h5>
            <div>
              <a href="<?= base_url('pengiriman/tambah') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
              </a>
              <a href="<?= base_url('pengiriman/cetak_pdf') ?>" class="btn btn-danger">
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
                <th>Supir</th>
                <th>Barang</th>
                <th>Berat</th>
                <th>Biaya Kirim</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                    <?php $no = 1; ?>
                        <?php foreach ($pengiriman as $item): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item['no_pengiriman'] ?></td>
                                <td><?= $item['tanggal'] ?></td>
                                <td><?= $item['nama_pelanggan'] ?></td>
                                <td><?= $item['penerima'] ?></td>
                                <td><?= $item['nama_supir'] ?></td>
                                <td><?= $item['nama_barang'] ?></td>
                                <td><?= $item['berat'] ?> kg</td>
                                <td>Rp <?= number_format($item['biaya_kirim'], 0, ',', '.') ?></td>
                                <td><?= $item['status'] ?></td>
                                <td>
                                    <a href="<?= base_url('pengiriman/edit/' . $item['id']) ?>" class="btn btn-info">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= base_url('pengiriman/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="<?= base_url('pengiriman/cetak/' . $item['id']) ?>" class="btn btn-success" >
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

<?= $this->endSection() ?>
