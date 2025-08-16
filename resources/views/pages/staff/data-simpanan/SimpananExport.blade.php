<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Jenis Simpanan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($simpanans as $index => $simpanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $simpanan->user->username }}</td>
                <td>{{ $simpanan->tanggal }}</td>
                <td>{{ $simpanan->jumlah }}</td>
                <td>{{ $simpanan->jenisSimpanan->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
