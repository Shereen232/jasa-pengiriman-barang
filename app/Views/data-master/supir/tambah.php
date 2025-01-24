<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>
<section class="section">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Input Data Supir</h5>

          <!-- Horizontal Form -->
          <form method="post" action="<?= base_url('supir/create') ?>">
            <div class="row mb-3">
              <label for="noKtp" class="col-sm-2 col-form-label">No. KTP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="noKtp" name="no_ktp" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="namaSupir" class="col-sm-2 col-form-label">Nama Supir</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="namaSupir" name="nama_supir" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="telepon" name="telepon" required>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End Horizontal Form -->

        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
