<table>
    <thead>
        <tr>
            {{-- Judul Laporan --}}
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 14px;">
                LAPORAN STOK GUDANG (Snapshot: {{ $date }})
            </th>
        </tr>
        <tr></tr> {{-- Spasi --}}

        {{-- Header Tabel --}}
        <tr style="background-color: #f3f4f6;">
            <th style="border: 1px solid #000; font-weight: bold; width: 5px; text-align: center;">No</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 35px;">Nama Produk</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 15px;">Warna</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 15px;">Ukuran</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 15px; text-align: center;">Sisa Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse($stocks as $index => $variant)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000;">
                    {{ $variant->product->name ?? 'Produk Dihapus' }}
                </td>
                <td style="border: 1px solid #000;">{{ $variant->color->name ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $variant->size->name ?? '-' }}</td>
                
                {{-- Logic Warna: Merah kalau stok < 5 --}}
                <td style="border: 1px solid #000; text-align: center; {{ $variant->stock < 5 ? 'color: red; font-weight: bold;' : '' }}">
                    {{ $variant->stock }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="border: 1px solid #000; text-align: center;">Data stok kosong.</td>
            </tr>
        @endforelse
    </tbody>
</table>