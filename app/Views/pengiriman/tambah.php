<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
             <h5 class="card-title">Input Pengiriman</h5>
                <form id="pengirimanForm" method="post" action="<?= base_url('pengiriman/create') ?>">
                    <?= csrf_field() ?>
                    <div class="row mt-3 mb-3">
                        <!-- <div class="col">
                            <div class="form-group">
                                <label>No Pengiriman</label>
                                <input type="text" name="no_pengiriman" class="form-control" value="<?= $no_pengiriman ?>" readonly>
                            </div>
                        </div> -->
                        <div class="col">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" value="<?= old('nama_pengirim') ?>">
                        <?php if (session()->getFlashdata('errors')['nama_pengirim'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['nama_pengirim']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Telepon Pengirim</label>
                        <input type="number" name="telepon_pengirim" id="telepon_pengirim" class="form-control" value="<?= old('telepon_pengirim') ?>">
                        <?php if (session()->getFlashdata('errors')['telepon_pengirim'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['telepon_pengirim']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Alamat Pengirim</label>
                        <textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control"><?= old('alamat_pengirim') ?></textarea>
                        <?php if (session()->getFlashdata('errors')['alamat_pengirim'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['alamat_pengirim']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Penerima</label>
                        <input type="text" name="penerima" class="form-control" value="<?= old('penerima') ?>">
                        <?php if (session()->getFlashdata('errors')['penerima'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['penerima']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Provinsi</label>
                        <select id="provinsi" class="form-control" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Kota/Kabupaten</label>
                        <select id="kota" class="form-control" required>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Kecamatan</label>
                        <select id="kecamatan" class="form-control" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Kelurahan</label>
                        <select id="kelurahan" class="form-control" required>
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Alamat Penerima</label>
                        <textarea id="alamat" name="alamat_penerima" class="form-control"><?= old('alamat_penerima') ?></textarea>
                        <?php if (session()->getFlashdata('errors')['alamat_penerima'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['alamat_penerima']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Telepon Penerima</label>
                        <input type="text" name="telepon_penerima" class="form-control" pattern="[0-9]+" title="Hanya boleh berisi angka" value="<?= old('telepon_penerima') ?>">
                        <?php if (session()->getFlashdata('errors')['telepon_penerima'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['telepon_penerima']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Jenis Barang</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_barang" id="Benda Mati" value="Benda Mati" <?php if (old('jenis_barang') == 'Benda Mati') {
                                    echo 'checked';
                                } ?>>
                                <label class="form-check-label" for="Benda Mati">Benda Mati</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_barang" id="Makhluk Hidup" value="Makhluk Hidup" <?php if (old('jenis_barang') == 'Makhluk Hidup') {
                                    echo 'checked';
                                } ?>>
                                <label class="form-check-label" for="Makhluk Hidup">Makhluk Hidup</label>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('errors')['jenis_barang'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['jenis_barang']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= old('nama_barang') ?>">
                        <?php if (session()->getFlashdata('errors')['nama_barang'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['nama_barang']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="<?= old('jumlah') ?>">
                        <?php if (session()->getFlashdata('errors')['jumlah'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['jumlah']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Berat (Kg)</label>
                        <input type="number" name="berat" id="berat" class="form-control" step="0.1" value="<?= old('berat') ?>">
                        <?php if (session()->getFlashdata('errors')['berat'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['berat']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Biaya Kirim (Rp)</label>
                        <input type="text" id="biaya_kirim_display" class="form-control" value="<?= old('biaya_kirim_display') ?>">
                        <?php if (session()->getFlashdata('errors')['biaya_kirim'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['biaya_kirim']; ?></small>
                        <?php endif; ?>
                        <input type="hidden" name="biaya_kirim" id="biaya_kirim"> <!-- Hidden input -->
                    </div>
                    <div class="form-group mt-3 mb-3">
                        <label>Kendaraan</label>
                        <select name="id_kendaraan" class="form-control">
                            <option value="">-- Pilih Kendaraan --</option>
                            <?php foreach ($kendaraan as $item): ?>
                                <?php if ($item['id'] == old('id_kendaraan')) : ?>
                                    <option value="<?= $item['id'] ?>" selected><?= $item['merk'] ?> | No. Polisi : <?= $item['no_polisi'] ?> | Supir : <?= $item['supir'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['merk'] ?> | No. Polisi : <?= $item['no_polisi'] ?> | Supir : <?= $item['supir'] ?></option>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </select>
                        <?php if (session()->getFlashdata('errors')['id_kendaraan'] ?? false) : ?>
                            <small class="text-danger"><?= session()->getFlashdata('errors')['id_kendaraan']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- <script>
    document.getElementById('berat').addEventListener('input', function () {
        const berat = parseFloat(this.value) || 0;
        const biayaPerKg = 10000; // Rp 10.000 per kg
        const biayaKirim = berat * biayaPerKg;
        document.getElementById('biaya_kirim').value = biayaKirim.toLocaleString('id-ID');
    });
</script> -->

<script>
    document.getElementById('biaya_kirim_display').addEventListener('input', function () {
        let value = this.value.replace(/\D/g, ''); // Hapus karakter selain angka
        let formatted = new Intl.NumberFormat('id-ID').format(value); // Format ribuan
        
        this.value = formatted; // Tampilkan angka yang diformat di input display
        document.getElementById('biaya_kirim').value = value; // Simpan angka asli di input hidden
    });
</script>


<script>
    document.getElementById('pelanggan').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const alamat = selectedOption.getAttribute('data-alamat');
        document.getElementById('alamat_pengirim').value = alamat || '';
    });
</script>

<script>
    $(document).ready(function () {
        // Load Provinsi
        $.getJSON("<?= base_url('wilayah/provinsi') ?>", function (data) {
            $.each(data, function (key, val) {
                $('#provinsi').append('<option value="' + val.id + '">' + val.provinsi + '</option>');
            });
        });

        // Load Kota berdasarkan Provinsi
        $('#provinsi').change(function () {
            var id_provinsi = $(this).val();
            $('#kota').html('<option value="">Pilih Kota</option>');
            $('#kecamatan, #kelurahan').html('<option value="">Pilih Kecamatan/Kelurahan</option>');

            $.getJSON("<?= base_url('wilayah/kota/') ?>" + id_provinsi, function (data) {
                $.each(data, function (key, val) {
                    $('#kota').append('<option value="' + val.id + '">' + val.kabupaten_kota + '</option>');
                });
            });
            setAlamat();
        });

        // Load Kecamatan berdasarkan Kota
        $('#kota').change(function () {
            var id_kota = $(this).val();
            var nama_kota = $(this).text();
            $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
            $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

            $.getJSON("<?= base_url('wilayah/kecamatan/') ?>" + id_kota, function (data) {
                $.each(data, function (key, val) {
                    $('#kecamatan').append('<option value="' + val.id + '">' + val.kecamatan + '</option>');
                });
            });
            setAlamat();
        });

        // Load Kelurahan berdasarkan Kecamatan
        $('#kecamatan').change(function () {
            var id_kecamatan = $(this).val();
            $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');

            $.getJSON("<?= base_url('wilayah/kelurahan/') ?>" + id_kecamatan, function (data) {
                $.each(data, function (key, val) {
                    $('#kelurahan').append('<option value="' + val.id + '">' + val.kelurahan + '</option>');
                });
            });
            setAlamat();
        });

        $('#kelurahan').change(function () {
            setAlamat();
        });

        function setAlamat()
        {
            provinsi = $('#provinsi option:selected').val();
            kabupaten = $('#kota option:selected').val();
            kecamatan = $('#kecamatan option:selected').val();
            kelurahan = $('#kelurahan option:selected').val();

            nama_provinsi = $('#provinsi option:selected').text();
            nama_kabupaten = $('#kota option:selected').text();
            nama_kecamatan = $('#kecamatan option:selected').text();
            nama_kelurahan = $('#kelurahan option:selected').text();
            
            if (provinsi, kabupaten, kecamatan, kelurahan) {
                $('#alamat').text('Desa '+nama_kelurahan+', Kecamatan '+nama_kecamatan+', '+nama_kabupaten+', '+nama_provinsi)
            }else{
                $('#alamat').text(nama_provinsi);
            }
        }

    });
</script>

<?= $this->endSection() ?>
