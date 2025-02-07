<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Resi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .container {
            border: 1px solid #000;
            padding: 10px;
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .barcode {
            text-align: center;
            margin: 10px 0;
        }
        .info-table, .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .info-table th, .info-table td, .product-table th, .product-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .info-table th {
            width: 30%;
        }
        .product-table th {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="shopee_logo.png" alt="Shopee" height="30">
            <h2>STD</h2>
            <img src="spx_logo.png" alt="SPX Express" height="30">
        </div>
        
        <div class="barcode">
            <img src="barcode.png" alt="Barcode" height="50">
        </div>
        
        <table class="info-table">
            <tr>
                <th>Penerima</th>
                <td><?= $pengiriman['penerima'] ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= $pengiriman['pengirim'] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?= $pengiriman['alamat_penerima'] ?></td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td><?= $pengiriman['telepon_penerima'] ?></td>
            </tr>
            <tr>
                <th>No. Resi</th>
                <td><?= $pengiriman['no_resi'] ?></td>
            </tr>
        </table>
        
        <table class="product-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>SKU</th>
                    <th>Variasi</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?= $pengiriman['nama_barang'] ?></td>
                    <td><?= $pengiriman['sku'] ?></td>
                    <td><?= $pengiriman['variasi'] ?></td>
                    <td><?= $pengiriman['qty'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
