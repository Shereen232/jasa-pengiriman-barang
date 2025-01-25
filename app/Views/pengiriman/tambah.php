<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Pengiriman</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pengiriman/create') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label>No Pengiriman</label>
                    <input type="text" name="no_pengiriman" class="form-control" value="<?= $no_pengiriman ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat Pengirim</label>
                    <textarea name="alamat_pengirim" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Penerima</label>
                    <input type="text" name="penerima" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat Penerima</label>
                    <textarea name="alamat_penerima" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Berat (Kg)</label>
                    <input type="number" name="berat" id="berat" class="form-control" step="0.1" required>
                </div>
                <div class="form-group">
                    <label>Biaya Kirim (Rp)</label>
                    <input type="text" id="biaya_kirim" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Kendaraan</label>
                    <select name="id_kendaraan" class="form-control" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <?php foreach ($kendaraan as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['merk'] ?> (<?= $item['no_polisi'] ?>)</option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Supir</label>
                    <select name="id_supir" class="form-control" required>
                        <option value="">-- Pilih Supir --</option>
                        <?php foreach ($supir as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Menunggu Pengiriman">Menunggu Pengiriman</option>
                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                        <option value="Terkirim">Terkirim</option>
                        <option value="Gagal Terkirim">Gagal Terkirim</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</section>

<script>
    document.getElementById('berat').addEventListener('input', function () {
        const berat = parseFloat(this.value) || 0;
        const biayaPerKg = 10000; // Rp 10.000 per kg
        const biayaKirim = berat * biayaPerKg;
        document.getElementById('biaya_kirim').value = biayaKirim.toLocaleString('id-ID');
    });
</script>
<?= $this->endSection() ?>
