<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Komplain</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-2">Tambah Komplain</h1>
        <p class="text-lg mb-8">Silakan isi form di bawah untuk mengajukan komplain.</p>

        <!-- Menampilkan pesan error jika ada -->
        <?php if(session()->getFlashdata('errors')): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                <ul>
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Menampilkan pesan sukses -->
        <?php if(session()->getFlashdata('message')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <div class="flex flex-col md:flex-row items-center justify-center">
            <div class="mb-8 md:mb-0 md:mr-8">
                <img alt="Illustration" class="w-72 md:w-96" height="400"
                     src="https://storage.googleapis.com/a1aa/image/r_laK1a1OeibdqwOKsdCkhYhiM2ud7UO0QY4s840MRI.jpg"
                     width="300"/>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <form action="/komplain/simpan" method="post">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input class="border border-gray-300 p-2 rounded-md" name="nama" placeholder="Nama" type="text" required/>
                        <input class="border border-gray-300 p-2 rounded-md" name="email" placeholder="Email" type="email" required/>
                        <input class="border border-gray-300 p-2 rounded-md" name="no_telp" placeholder="No. Telp" type="text" required/>
                        <input class="border border-gray-300 p-2 rounded-md" name="no_resi" placeholder="No. Resi" type="text" required/>
                    </div>
                    <textarea class="border border-gray-300 p-2 rounded-md w-full mb-4 h-32"
                              name="pesan" placeholder="Pesan" required></textarea>
                    <button class="bg-yellow-500 text-white py-2 px-4 rounded-md w-full" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
