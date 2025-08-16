<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Bayar</th>
            <th>Jumlah Angsuran</th>
            <th>Ke</th>
            <th>Sisa Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($angsuranList as $index => $angsuran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $angsuran->formulirPengajuan->user->username }}</td>
                <td>{{ $angsuran->tanggal }}</td>
                <td>{{ $angsuran->jumlah_bayar }}</td>
                <td>{{ $angsuran->angsuran_ke }}</td>
                <td>{{ $angsuran->sisa_pembayaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
