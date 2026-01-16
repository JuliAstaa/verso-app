<table>
    <thead>
        <tr>
            <th colspan="4" style="text-align: center; font-weight: bold; font-size: 14px;">
                LAPORAN PRODUK TERLARIS ({{ date('d/m/Y', strtotime($start)) }} - {{ date('d/m/Y', strtotime($end)) }})
            </th>
        </tr>
        <tr></tr>

        <tr style="background-color: #f3f4f6;">
            <th style="border: 1px solid #000; font-weight: bold; width: 5px; text-align: center;">No</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 40px;">Nama Produk</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 25px;">Varian (Warna/Size)</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 15px; text-align: center;">Terjual (Qty)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $item)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000;">
                    {{ $item->productVariant->product->name ?? 'Produk Dihapus' }}
                </td>
                <td style="border: 1px solid #000;">
                    {{ $item->productVariant->color->name ?? '-' }} / {{ $item->productVariant->size->name ?? '-' }}
                </td>
                <td style="border: 1px solid #000; text-align: center; font-weight: bold;">
                    {{ $item->total_sold }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="border: 1px solid #000; text-align: center;">Belum ada penjualan di periode ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>