<table>
    <thead>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 14px;">
                LAPORAN PELANGGAN LOYAL ({{ date('d/m/Y', strtotime($start)) }} - {{ date('d/m/Y', strtotime($end)) }})
            </th>
        </tr>
        <tr></tr>

        <tr style="background-color: #f3f4f6;">
            <th style="border: 1px solid #000; font-weight: bold; width: 5px; text-align: center;">No</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 30px;">Nama Pelanggan</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 30px;">Email</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 15px; text-align: center;">Jml Transaksi</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 20px;">Total Belanja (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($customers as $index => $customer)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000;">{{ $customer->user->name ?? 'User Deleted' }}</td>
                <td style="border: 1px solid #000;">{{ $customer->user->email ?? '-' }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $customer->total_trx }}x</td>
                <td style="border: 1px solid #000;">{{ number_format($customer->total_spent, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="border: 1px solid #000; text-align: center;">Belum ada data pelanggan di periode ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>