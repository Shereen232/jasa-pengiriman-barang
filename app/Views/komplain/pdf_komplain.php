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
    <title>Laporan Komplain</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        .header-container { display: flex; align-items: center; text-align: center; margin-bottom: 10px; }
        .header-container img { width: 50px; height: 50px; margin-right: 10px; }
        .header-text { font-size: 16px; font-weight: bold; }
        .signature { margin-top: 30px; text-align: right; font-size: 14px; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header-container">
        <img src="<?=$imageBase64?>" alt="Logo">
        <div>
            <p class="header-text">LAPORAN KOMPLAIN</p>
            <p style="line-height: 0" class="header-text">PT. TAZZA PAKET EXPRESS</p>
            <?php if (!empty($startDate) && !empty($endDate)) : ?>
                <p>Periode: <?= date('d-m-Y', strtotime($startDate)) ?> s/d <?= date('d-m-Y', strtotime($endDate)) ?></p>
            <?php else : ?>
                <p>Periode: Semua Data</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tabel Data Komplain -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>No. Resi</th>
                <th>Pesan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($komplain as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                    <td><?= $item['nama'] ?></td>
                    <td><?= $item['email'] ?></td>
                    <td><?= $item['no_telp'] ?></td>
                    <td><?= $item['no_resi'] ?></td>
                    <td><?= $item['pesan'] ?></td>
                    <td><?= $item['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bagian Tanda Tangan -->
    <div class="signature">
        <p>Pekalongan, <?= date('d-m-Y') ?></p>
        <br><br><br>
        <?= $auth->user()->username ?>
    </div>

</body>
</html>
