<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Input Data Supir</h5>

                    <!-- Form Tambah Supir -->
                    <form id="supirForm" method="post" action="<?= base_url('data-master/supir/create') ?>">
                        <div class="row mb-3">
                            <label for="noKtp" class="col-sm-3 col-form-label">No. KTP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="noKtp" name="no_ktp" value="<?= old('no_ktp') ?>">
                                <small id="error_ktp" class="text-danger d-none"></small>
                                <?php if (session()->getFlashdata('errors')['no_ktp'] ?? false) : ?>
                                    <small class="text-danger"><?= session()->getFlashdata('errors')['no_ktp']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="sim" class="col-sm-3 col-form-label">Jenis SIM</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="sim" name="sim">
                                    <option value="">-- Pilih Jenis SIM --</option>
                                    <option value="SIM B1" <?= old('sim') == 'SIM B1' ? 'selected' : '' ?>>SIM B1</option>
                                    <option value="SIM B1 Umum" <?= old('sim') == 'SIM B1 Umum' ? 'selected' : '' ?>>SIM B1 Umum</option>
                                    <option value="SIM B2" <?= old('sim') == 'SIM B2' ? 'selected' : '' ?>>SIM B2</option>
                                    <option value="SIM B2 Umum" <?= old('sim') == 'SIM B2 Umum' ? 'selected' : '' ?>>SIM B2 Umum</option>
                                </select>
                                <?php if (session()->getFlashdata('errors')['sim'] ?? false) : ?>
                                    <small class="text-danger"><?= session()->getFlashdata('errors')['sim']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="namaSupir" class="col-sm-3 col-form-label">Nama Supir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namaSupir" name="nama_supir" value="<?= old('nama_supir') ?>">
                                <?php if (session()->getFlashdata('errors')['nama_supir'] ?? false) : ?>
                                    <small class="text-danger"><?= session()->getFlashdata('errors')['nama_supir']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat" name="alamat"><?= old('alamat') ?></textarea>
                                <?php if (session()->getFlashdata('errors')['alamat'] ?? false) : ?>
                                    <small class="text-danger"><?= session()->getFlashdata('errors')['alamat']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= old('telepon') ?>">
                                <?php if (session()->getFlashdata('errors')['telepon'] ?? false) : ?>
                                    <small class="text-danger"><?= session()->getFlashdata('errors')['telepon']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusAktif" value="Aktif" checked>
                                    <label class="form-check-label" for="statusAktif">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="Tidak Aktif">
                                    <label class="form-check-label" for="statusTidakAktif">Tidak Aktif</label>
                                </div>
                            </div>
                        </div>
                    
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#noKtp').change(function(e) {
        const ktp = $(this).val();
        $('#namaSupir').attr('disabled', true);
        $('#alamat').attr('disabled', true);
        $('#telepon').attr('disabled', true);
        $.ajax({
            url: '<?= base_url() ?>data-master/supir/check-ktp',
            method: 'GET',
            dataType: 'json',
            data: {ktp},
            success: function (response) {
                if (response.status == 'success') {
                    $('#namaSupir').removeAttr('disabled');
                    $('#alamat').removeAttr('disabled');
                    $('#telepon').removeAttr('disabled');
                    $('#error_ktp').addClass('d-none');
                }else{
                    $('#namaSupir').attr('disabled', true);
                    $('#alamat').attr('disabled', true);
                    $('#telepon').attr('disabled', true);
                    $('#error_ktp').html(response.message);
                    $('#error_ktp').removeClass('d-none');
                }
            },
            error: function (xhr, status, error) {
                console.error('Terjadi kesalahan saat mengambil data:', error);
            }
        });
    });
</script>
<script>
    document.getElementById('supirForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form terkirim langsung

        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin menyimpan data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Kirim form jika dikonfirmasi
            }
        });
    });
</script>

<?= $this->endSection() ?>