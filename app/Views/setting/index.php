<?= $this->extend('template/admin.php') ?>
<?= $this->section('app') ?>
<section class="section">
    <div class="row">
        <form action="<?= base_url('admin/setting') ?>" method="post">
        <div class="col">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">About Us</h5>

                    <!-- TinyMCE Editor -->
                    <textarea class="tinymce-editor" name="about_content">
                        <?= $setting->about_content ?>
                    </textarea><!-- End TinyMCE Editor -->

                </div>
                </div>

            </div>

            <div class="col">

                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Footer Editor</h5>

                    <!-- Quill Editor Default -->
                    <textarea class="tinymce-editor" name="footer_content">
                        <?= $setting->footer_content ?>
                    </textarea>
                    <!-- End Quill Editor Default -->

                </div>
                </div>

            </div>

            <div class="col-12">
                <button class="btn btn-primary" id="save-setting">Save Setting</button>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>