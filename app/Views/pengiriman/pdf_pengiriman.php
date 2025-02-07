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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengiriman</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        
        body {
            font-size: 12px;
        }

        table, tr, td {
            border-color: #000;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-container img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .title-text {
            font-size: 16px;
            font-weight: bold;
        }

        .bulan {
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }

        table {
            margin-top: 0.5rem;
            text-align: left;
            width: 100%;
            border-collapse: collapse;
        }

        tfoot th, tfoot td {
            text-align: right;
        }
    
    </style>
</head>
<body>
    <header style="display: table; width: 100%">
        <div class="logo-container" style="height:70px; display: table-cell; vertical-align: middle;">
            <div style="width: 70px; float: left;">
                <img src="<?=$imageBase64?>" alt="Logo" style="width:70px; height:auto;">
            </div>
            <div style="margin-left: 100px;">
                <b>LAPORAN DATA PENGIRIMAN</b>
                <br>
                <b>PT. TAZZA PAKET EXPRESS</b>
            </div>
        </div>
    </header>

    <table border=1 width=100% cellpadding=2 cellspacing=0 style=" text-align:center;">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pengiriman</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Supir</th>
                <th>Barang</th>
                <th>Berat</th>
                <th>Biaya Kirim</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($pengiriman as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item['no_pengiriman'] ?></td>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= $item['nama_pelanggan'] ?></td>
                    <td><?= $item['penerima'] ?></td>
                    <td><?= $item['nama_supir'] ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['berat'] ?> kg</td>
                    <td>Rp <?= number_format($item['biaya_kirim'], 0, ',', '.') ?></td>
                    <td><?= $item['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
