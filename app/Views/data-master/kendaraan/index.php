<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Datatables</h5>
            <div>
              <a href="<?=base_url() ?>data-master/kendaraan/tambah" type="button" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            </div>
            </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>No</b>
                    </th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Unity Pugh</td>
                    <td>9958</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>
                        <button type="button" class="btn btn-info"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
<?= $this->endSection( ) ?>
