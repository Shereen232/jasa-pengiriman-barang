<?php 
    function imageToBase64($path) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    $imageBase64 = imageToBase64('images/logo.png');
?>
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
        <div style="width: 60px; float: left;">
                <img src="<?=$imageBase64?>" alt="Logo" style="width:60px; height:auto;">
            </div>
        <div class="header">
            <span style="margin-left: -60px;">PT. Tazza Paket Express</span>
        </div>
        <br>
        <br>
        <br>
        <table class="info-table">
            <tr>
                <th>No. Pengiriman</th>
                <td><?= esc($data['no_pengiriman']) ?></td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td><?= esc($data['nama_penerima']) ?></td>
            </tr>
            <tr>
                <th>Alamat Penerima</th>
                <td><?= esc($data['alamat_penerima']) ?></td>
            </tr>
            <tr>
                <th>Telepon Penerima</th>
                <td><?= esc($data['telepon_penerima']) ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= esc($data['nama_pengirim']) ?></td>
            </tr>
            <tr>
                <th>Alamat Pengirim</th>
                <td><?= esc($data['alamat_pengirim']) ?></td>
            </tr>
            <tr>
                <th>Telepon Pengirim</th>
                <td><?= esc($data['telepon_pengirim']) ?></td>
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
                <td><?= esc($data['nama_barang']) ?></td>
                <td><?= esc($data['jumlah']) ?> pcs</td>
                <td><?= esc($data['berat']) ?></td>
                <td><?= esc($data['biaya_kirim']) ?></td>
                <td><?= esc($data['tanggal_kirim']) ?></td>
            </tr>
        </table>

        <div class="cut-line">
            -------------------------------- Potong Lembar Pengirim --------------------------------
        </div>

        <table class="info-table">
            <tr>
                <th>No. Pengiriman</th>
                <td><?= esc($data['no_pengiriman']) ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= esc($data['nama_pengirim']) ?></td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td><?= esc($data['nama_penerima']) ?></td>
            </tr>
            <tr>
                <th>Alamat Penerima</th>
                <td><?= esc($data['alamat_penerima']) ?></td>
            </tr>
        </table>

        <table class="content-table">
            <tr>
                <th>Berat</th>
                <th>Biaya</th>
                <th>Lain-lain</th>
            </tr>
            <tr>
                <td><?= esc($data['berat']) ?></td>
                <td><?= esc($data['biaya_kirim']) ?></td>
                <td>-</td>
            </tr>
        </table>

        <div class="footer">
            Untuk Pengecekan Status Kiriman, Silahkan Kunjungi Website PT. Tazza Paket Express
        </div>
    </div>

</body>
</html>
