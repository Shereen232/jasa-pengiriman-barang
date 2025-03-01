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
                            <td><?= $item['no_ktp'] ?></td>
                            <td><?= $item['nama_pelanggan'] ?></td>
                            <td><?= $item['jenis_kelamin'] ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td><?= $item['telepon'] ?></td>
                            <td>
                                <a href="<?= base_url('data-master/pelanggan/edit/' . $item['id_pelanggan']) ?>" class="btn btn-info">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('data-master/pelanggan/delete/' . $item['id_pelanggan']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
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
