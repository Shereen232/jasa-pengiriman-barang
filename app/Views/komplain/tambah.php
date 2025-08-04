<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Komplain</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-2">Tambah Komplain</h1>
        <p class="text-lg mb-8">Silakan isi form di bawah untuk mengajukan komplain.</p>

        <div class="flex flex-col md:flex-row items-center justify-center">
            <div class="mb-8 md:mb-0 md:mr-8">
                <img alt="Illustration" class="w-72 md:w-96" height="400"
                     src="https://storage.googleapis.com/a1aa/image/r_laK1a1OeibdqwOKsdCkhYhiM2ud7UO0QY4s840MRI.jpg"
                     width="300"/>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <form action="<?= base_url('komplain/simpan') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Input Nama -->
                        <div>
                            <input class="border border-gray-300 p-2 rounded-md w-full" 
                                   name="nama" 
                                   placeholder="Nama" 
                                   type="text" 
                                   value="<?= old('nama') ?>" />
                            <span class="text-red-500 text-sm">
                                <?= !empty(session()->getFlashdata('validation')['nama']) ? session()->getFlashdata('validation')['nama'] : '' ?>
                            </span>
                        </div>

                        <!-- Input Email -->
                        <div>
                            <input class="border border-gray-300 p-2 rounded-md w-full" 
                                   name="email" 
                                   placeholder="Email" 
                                   type="email" 
                                   value="<?= old('email') ?>" />
                            <span class="text-red-500 text-sm">
                                <?= !empty(session()->getFlashdata('validation')['email']) ? session()->getFlashdata('validation')['email'] : '' ?>
                            </span>
                        </div>

                        <!-- Input No. Telp -->
                        <div>
                            <input class="border border-gray-300 p-2 rounded-md w-full" 
                                   name="no_telp" 
                                   placeholder="No. Telp" 
                                   type="text" 
                                   value="<?= old('no_telp') ?>" />
                            <span class="text-red-500 text-sm">
                                <?= !empty(session()->getFlashdata('validation')['no_telp']) ? session()->getFlashdata('validation')['no_telp'] : '' ?>
                            </span>
                        </div>

                        <!-- Input No. Resi -->
                        <div>
                            <input class="border border-gray-300 p-2 rounded-md w-full" 
                                   name="no_resi" 
                                   placeholder="No. Resi" 
                                   type="text" 
                                   value="<?= old('no_resi') ?>" />
                            <span class="text-red-500 text-sm">
                                <?= !empty(session()->getFlashdata('validation')['no_resi']) ? session()->getFlashdata('validation')['no_resi'] : '' ?>
                            </span>
                        </div>
                    </div>

                    <!-- Input Pesan -->
                    <div class="mb-4">
                        <textarea class="border border-gray-300 p-2 rounded-md w-full h-32"
                                  name="pesan"
                                  placeholder="Pesan"><?= old('pesan') ?></textarea>
                        <span class="text-red-500 text-sm">
                            <?= !empty(session()->getFlashdata('validation')['pesan']) ? session()->getFlashdata('validation')['pesan'] : '' ?>
                        </span>
                    </div>

                    <button class="bg-yellow-500 text-white py-2 px-4 rounded-md w-full" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert Notifikasi -->
    <script>
        <?php if (session()->getFlashdata('message')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "<?= session()->getFlashdata('message') ?>",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('validation')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "Harap periksa kembali form Anda.",
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
    </script>

    <script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const succesSessionFlashMsg = '<?= session()->getFlashdata('success_message') ?>';
    const errorSessionFlashMsg = '<?= session()->getFlashdata('error_message') ?>';
    const trxResiFlashMsg = '<?= session()->getFlashdata('tracking_resi') ?>';
    window.onload = function () {
      if (trxResiFlashMsg !== '') {
        const target = document.getElementById("trxResi");
        target.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    };

    if (succesSessionFlashMsg !== '') {
        Toast.fire({
            icon: 'success',
            title: succesSessionFlashMsg
        })
    }

    if (errorSessionFlashMsg !== '') {
      console.log('ok');
      
        Toast.fire({
            icon: 'warning',
            title: errorSessionFlashMsg
        })
    }

  </script>
</body>
</html>
