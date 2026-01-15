<table>
    <thead>
        {{-- Judul Laporan --}}
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold;">
                LAPORAN PENDAPATAN ({{ $startDate }} s/d {{ $endDate }})
            </th>
        </tr>
        <tr></tr> {{-- Baris kosong --}}
        
        {{-- Header Tabel --}}
        <tr style="background-color: #eeeeee;">
            <th style="border: 1px solid #000000; font-weight: bold;">No</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Tanggal</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Invoice</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Customer</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Status</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $index => $order)
            <tr>
                <td style="border: 1px solid #000000;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ $order->created_at->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000000;">{{ $order->invoice_number }}</td>
                <td style="border: 1px solid #000000;">{{ $order->recipient_name }}</td>
                <td style="border: 1px solid #000000;">{{ strtoupper($order->status) }}</td>
                <td style="border: 1px solid #000000;">{{ $order->total_price }}</td>
            </tr>
        @endforeach
        
        {{-- Total Row --}}
        <tr>
            <td colspan="5" style="border: 1px solid #000000; text-align: right; font-weight: bold;">TOTAL PENDAPATAN</td>
            <td style="border: 1px solid #000000; font-weight: bold;">{{ $totalRevenue }}</td>
        </tr>
    </tbody>
</table>