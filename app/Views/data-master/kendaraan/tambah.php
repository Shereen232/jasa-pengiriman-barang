<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Input Data Kendaraan</h5>

              <!-- Horizontal Form -->
              <form>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">No. Polisi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Merk</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">No. Mesin</label>
                  <div class="col-sm-10">
                    <textarea type="password" class="form-control" id="inputPassword"> </textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Tahun</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Warna</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Supir</label>
                  <div class="col-sm-10">
                    <select id="pelanggan_id" name="pelanggan_id" class="choices form-select m-0">
                      <option value="">Cari Supir</option>
                        <?php foreach ($pelanggan as $key => $value) : ?>
                            <?php if ($value['id'] != old('pelanggan_id')) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                            <?php else: ?>
                                <option value="<?= $value['id'] ?>" selected><?= $value['nama'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
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
<?= $this->endSection( ) ?>