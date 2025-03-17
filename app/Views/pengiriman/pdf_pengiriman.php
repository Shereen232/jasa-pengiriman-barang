<?php 
$auth = service('authentication');
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pengiriman</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { border: 1px solid black; padding: 8px; text-align: center; }
        td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }

        .header-container {
            display: flex;
            align-items: center;
            text-align: center;
            margin-bottom: 10px;
        }

        .header-container img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .header-text {
            font-size: 16px;
            font-weight: bold;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header-container">
        <img src="<?=$imageBase64?>" alt="Logo">
        <div>
            <p class="header-text">LAPORAN DATA PENGIRIMAN</p>
            <p style="line-height: 0" class="header-text">PT. TAZZA PAKET EXPRESS</p>
            <?php if (!empty($startDate) && !empty($endDate)) : ?>
                <p>Periode: <?= date('d-m-Y', strtotime($startDate)) ?> s/d <?= date('d-m-Y', strtotime($endDate)) ?></p>
            <?php else : ?>
                <p>Periode: Semua Data</p>
            <?php endif; ?>

        </div>
    </div>

    <!-- Tabel Data Pengiriman -->
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Resi</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Supir</th>
                <th>Barang</th>
                <th>Status</th>
                <th>Berat</th>
                <th>Biaya Kirim</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $totalBiaya = 0; ?>
            <?php foreach ($pengiriman as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['no_pengiriman'] ?></td>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= $item['nama_pengirim'] ?></td>
                    <td><?= $item['penerima'] ?></td>
                    <td><?= $item['nama_supir'] ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td><?= $item['berat'] ?> kg</td>
                    <td style="text-align:right">Rp <?= number_format($item['biaya_kirim'], 0, ',', '.') ?></td>
                </tr>
                <?php $totalBiaya += $item['biaya_kirim']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" style="text-align: center;"><b>Jumlah</b></td>
                <td style="text-align:right"><b>Rp <?= number_format($totalBiaya, 0, ',', '.') ?></b></td>
            </tr>
        </tfoot>
    </table>

    <!-- Bagian Tanda Tangan -->
    <div class="signature">
        <p>Pekalongan, <?= date('d-m-Y') ?></p>
        <br><br><br>
        <div style="margin-right: 40px;">
        <?= $auth->user()->username ?>
        </div>

    </div>

</body>
</html>
