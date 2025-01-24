<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Pelanggan</h4>
            <a href="<?= base_url('data-master/pelanggan/tambah') ?>" class="btn btn-success">Tambah Pelanggan</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No KTP</th>  <!-- Kolom No KTP -->
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Jenis Kelamin</th>  <!-- Kolom Jenis Kelamin -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pelanggan as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['no_ktp'] ?></td>  
                            <td><?= $item['nama'] ?></td>
                            <td><?= $item['alamat'] ?></td>
                            <td><?= $item['telepon'] ?></td>
                            <td><?= $item['jenis_kelamin'] ?></td>  <!-- Menampilkan Jenis Kelamin -->
                            <td>
                                <a href="<?= base_url('data-master/pelanggan/edit/' . $item['id']) ?>" class="btn btn-info">Edit</a>
                                <a href="<?= base_url('data-master/pelanggan/delete/' . $item['id']) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
