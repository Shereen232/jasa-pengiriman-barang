<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-3 col-md-6">
              <a href="<?= base_url('data-master/supir') ?>">
                <div class="card info-card sales-card">
                  <div class="card-body">
                    <h5 class="card-title">Supir </h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bxs-archive"></i>
                      </div>
                      <div class="ps-3">
                        <h6><?= $total_supir ?></h6>
                        <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-xxl-3 col-md-6">
            <a href="<?= base_url('data-master/kendaraan') ?>">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Kendaraan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_kendaraan ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
              </a>
            </div>

            <div class="col-xxl-3 col-md-6">
            <a href="<?= base_url('data-master/pelanggan') ?>">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Pelanggan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-emotion-normal-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_pelanggan ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </a>
            </div>

            <div class="col-xxl-3 col-md-6">
            <a href="<?= base_url('pengiriman') ?>">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Pengiriman</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_pengiriman ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </a>
            </div>

            <div class="col-xxl-3 col-md-6">
            <a href="<?= base_url('komplain') ?>">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Komplain</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-customer-service-2-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_komplain ?></h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </a>
            </div>
            
            

      </div>
    </section>


<?= $this->endSection() ?>