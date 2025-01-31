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
                <div class="row mt-3 mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label>No Pengiriman</label>
                            <input type="text" name="no_pengiriman" class="form-control" value="<?= $no_pengiriman ?>" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3 mb-3">
                <div class="form-group mt-3 mb-3">
                    <label>Nama Pengirim</label>
                    <select name="id_pelanggan" id="pelanggan" class="form-control">
                        <option value="">-- Pilih Pengirim --</option>
                        <?php foreach ($pengirim as $key => $item): ?>
                            <option value="<?= $item->id_pelanggan ?>" 
                                    data-alamat="<?= $item->alamat ?>">
                                <?= $item->nama_pelanggan ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Alamat Pengirim</label>
                    <textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control" readonly></textarea>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Penerima</label>
                    <input type="text" name="penerima" class="form-control" required>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Alamat Penerima</label>
                    <textarea name="alamat_penerima" class="form-control" required></textarea>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Berat (Kg)</label>
                    <input type="number" name="berat" id="berat" class="form-control" step="0.1" required>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Biaya Kirim (Rp)</label>
                    <input type="text" id="biaya_kirim" class="form-control" readonly>
                </div>
                <div class="form-group mt-3 mb-3">
                    <label>Kendaraan</label>
                    <select name="id_kendaraan" class="form-control" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <?php foreach ($kendaraan as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['merk'] ?> | No. Polisi : <?= $item['no_polisi'] ?> | Supir : <?= $item['supir'] ?></option>
                        <?php endforeach ?>
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

<script>
    document.getElementById('pelanggan').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const alamat = selectedOption.getAttribute('data-alamat');
        document.getElementById('alamat_pengirim').value = alamat || '';
    });
</script>

<?= $this->endSection() ?>
