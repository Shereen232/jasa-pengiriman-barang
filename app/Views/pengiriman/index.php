<?= $this->extend('template/admin.php') ?>

<?= $this->section('app') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Pengiriman</h4>
            <a href="<?= base_url('pengiriman/tambah') ?>" class="btn btn-success">Tambah Pengiriman</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pengiriman</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Barang</th>
                        <th>Berat</th>
                        <th>Biaya Kirim</th>
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
                            <td><?= $item['nama_pengirim'] ?></td>
                            <td><?= $item['penerima'] ?></td>
                            <td><?= $item['nama_barang'] ?></td>
                            <td><?= $item['berat'] ?> kg</td>
                            <td>Rp <?= number_format($item['biaya_kirim'], 0, ',', '.') ?></td>
                            <td>
                                <a href="<?= base_url('pengiriman/edit/' . $item['id']) ?>" class="btn btn-info">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('pengiriman/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

