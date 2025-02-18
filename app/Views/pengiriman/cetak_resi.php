<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Resi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; border: 1px solid #000; padding: 10px; }
        .header { text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px; }
        .barcode { text-align: center; margin-bottom: 10px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .info-table th, .info-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .info-table th { background-color: #f2f2f2; width: 30%; }
        .content-table { width: 100%; border-collapse: collapse; }
        .content-table th, .content-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        .footer { text-align: center; font-size: 10px; margin-top: 10px; }
        .cut-line { border-top: 1px dashed #000; text-align: center; margin-top: 15px; padding-top: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            PT. Tazza Paket Express
        </div>

        <table class="info-table">
            <tr>
                <th>No. Pengiriman</th>
                <td><?= $no_pengiriman ?></td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td><?= $nama_penerima ?></td>
            </tr>
            <tr>
                <th>Alamat Penerima</th>
                <td><?= $alamat_penerima ?></td>
            </tr>
            <tr>
                <th>Telepon Penerima</th>
                <td><?= $telepon_penerima ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= $nama_pengirim ?></td>
            </tr>
            <tr>
                <th>Alamat Pengirim</th>
                <td><?= $alamat_pengirim ?></td>
            </tr>
            <tr>
                <th>Telepon Pengirim</th>
                <td><?= $telepon_pengirim ?></td>
            </tr>
        </table>

        <table class="content-table">
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Berat</th>
                <th>Biaya Kirim</th>
                <th>Tanggal Kirim</th>
            </tr>
            <tr>
                <td><?= $nama_barang ?></td>
                <td><?= $jumlah ?> pcs</td>
                <td><?= $berat ?></td>
                <td><?= $biaya_kirim ?></td>
                <td><?= $tanggal_kirim ?></td>
            </tr>
        </table>

        <div class="cut-line">
            -------------------------------- Potong Lembar Pengirim --------------------------------
        </div>

        <table class="info-table">
            <tr>
                <th>No. Pengiriman</th>
                <td><?= $no_pengiriman ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= $nama_pengirim ?></td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td><?= $nama_penerima ?></td>
            </tr>
            <tr>
                <th>Alamat Penerima</th>
                <td><?= $alamat_penerima ?></td>
            </tr>
        </table>

        <table class="content-table">
            <tr>
                <th>Berat</th>
                <th>Biaya</th>
                <th>Lain-lain</th>
            </tr>
            <tr>
                <td><?= $berat ?></td>
                <td><?= $biaya_kirim ?></td>
                <td>-</td>
            </tr>
        </table>

        <div class="footer">
            Untuk Pengecekan Status Kiriman, Silahkan Kunjungi Website PT. Tazza Paket Express
        </div>
    </div>

</body>
</html>
