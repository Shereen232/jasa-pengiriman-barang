<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>

<section class="section">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah User</h5>
                <form action="<?= base_url('user/store') ?>" method="post">
                <?= csrf_field() ?>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                            <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
                            <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['username']) ? session()->getFlashdata('validation')['username'] : '' ?></small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-danger"><?= !empty(session()->getFlashdata('validation')['password']) ? session()->getFlashdata('validation')['password'] : '' ?></small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
