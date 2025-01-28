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
                                <th>No. Polisi</th>
                                <th>Merk</th>
                                <th>No. Mesin</th>
                                <th>Warna</th>
                                <th>Supir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($kendaraan)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($kendaraan as $k) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $k['no_polisi'] ?></td>
                                        <td><?= $k['merk'] ?></td>
                                        <td><?= $k['no_mesin'] ?></td>
                                        <td><?= $k['warna'] ?></td>
                                        <td><?= $k['supir'] ?></td>
                                        <td>
                                            <a href="<?= base_url('data-master/kendaraan/edit/' . $k['id']) ?>" class="btn btn-info">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="<?= base_url('data-master/kendaraan/delete/' . $k['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data kendaraan.</td>
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
