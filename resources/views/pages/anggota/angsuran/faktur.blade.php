<!DOCTYPE html>
<html>
<head>
    <title>Faktur Angsuran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .faktur-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
        }
        .faktur-header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .header-text {
            flex-grow: 1;
            text-align: center;
        }
        .faktur-body { margin-bottom: 20px; }
        .faktur-footer {
            border-top: 2px solid #000;
            padding-top: 10px;
            margin-top: 30px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        th { background-color: #f5f5f5; }
        .text-right { text-align: right; }
        .print-button {
            text-align: center;
            margin-top: 20px;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
            .faktur-container { border: none; }
        }
    </style>
</head>
<body>
    <div class="faktur-container">
        <div class="faktur-header">
            <!-- Logo Koperasi -->
            <img src="{{ asset('images/logo-ksp.png') }}" alt="Logo Koperasi" class="logo">

            <div class="header-text">
                <h2 style="margin: 0;">KOPERASI SIMPAN PINJAM</h2>
                <h3 style="margin: 5px 0 0 0;">FAKTUR PEMBAYARAN ANGSURAN</h3>
                <p style="margin: 5px 0 0 0;">No. Faktur: {{ sprintf('ANG-%04d', $angsuran->id) }}</p>
            </div>

            <!-- Kosongkan bagian kanan untuk balance -->
            <div style="width: 80px;"></div>
        </div>

        <div class="faktur-body">
            <table>
                <tr>
                    <th width="30%">Nama Anggota</th>
                    <td>{{ $angsuran->formulirPengajuan->user->username }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ \Carbon\Carbon::parse($angsuran->tanggal)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Angsuran Ke</th>
                    <td>{{ $angsuran->angsuran_ke }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Sisa Pembayaran</th>
                    <td>Rp {{ number_format($angsuran->sisa_pembayaran, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="faktur-footer">
            <table>
                <tr>
                    <td width="70%">
                        <p><strong>Keterangan:</strong></p>
                        <p>Simpan faktur ini sebagai bukti pembayaran yang sah</p>
                    </td>
                    <td>
                        <p style="text-align: center;">Hormat Kami,</p>
                        <br><br><br>
                        <p style="text-align: center;">(___________________)</p>
                        <p style="text-align: center;">Bendahara Koperasi</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="print-button no-print">
        <button onclick="window.print()" style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Cetak Faktur</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">Tutup</button>
    </div>

    <script>
        window.onload = function() {
            // Auto print jika diperlukan
            // window.print();
        };
    </script>
</body>
</html>
