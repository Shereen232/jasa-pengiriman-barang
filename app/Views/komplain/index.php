<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Data Komplain</h5>
                        
                    </div>

                    <!-- Menampilkan pesan sukses jika ada -->
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
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
                                                <?= ($k['status'] == 'Pending') ? 'bg-warning' : (($k['status'] == 'Selesai') ? 'bg-success' : 'bg-primary') ?>">
                                                <?= esc($k['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('komplain/edit/' . $k['id']) ?>" class="btn btn-info">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('komplain/delete/' . $k['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
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

<?= $this->endSection() ?>
