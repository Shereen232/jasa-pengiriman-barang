<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Data Supir</h5>
            <div>
              <a href="<?= base_url('data-master/supir/tambah') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data
              </a>
            </div>
          </div>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>No. KTP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($supir)): ?>
                <?php $no = 1; foreach ($supir as $row): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['no_ktp']); ?></td>
                    <td><?= esc($row['nama']); ?></td>
                    <td><?= esc($row['alamat']); ?></td>
                    <td><?= esc($row['telepon']); ?></td>
                    <td>
                      <a href="<?= base_url('data-master/supir/edit/' . $row['id']) ?>" class="btn btn-info">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      <a href="<?= base_url('data-master/supir/delete/' . $row['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data supir</td>
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

<?= $this->endSection() ?>
