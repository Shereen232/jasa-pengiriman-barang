<?php
$auth = service('authentication');
$profilePath = 'images/profile/'.$auth->user()->username.'.jpg';
$defaultImage = 'NiceAdmin/assets/img/profile-img.jpg';

$image = file_exists(FCPATH . $profilePath) ? base_url($profilePath) : base_url($defaultImage);
?>
<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

    <section class="section profile">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img id="triggerImgUpload" style="cursor: pointer;" src="<?= $image ?>" alt="Profile" class="rounded-circle">
              <h2><?= $auth->user()->username ?></h2>
              <h3><?= $auth->user()->email ?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <form id="imageUpload" class="d-none" action="<?= base_url('profil/upload') ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" required>
        </form>

        <div class="col-12">

          <div class="card">
            <div class="card-title ps-3">Change Password</div>
            <div class="card-body pt-3">
              <form>
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>

    <script>
    document.getElementById("triggerImgUpload").addEventListener("click", function() {
        document.getElementById("file").click(); // Memicu input file saat gambar diklik
    });

    document.getElementById("file").addEventListener("change", function() {
        if (this.files.length > 0) {
            document.getElementById("imageUpload").submit(); // Mengirim form secara otomatis
        }
    });
</script>

<?= $this->endSection() ?>