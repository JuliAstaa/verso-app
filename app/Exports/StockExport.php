<?php
namespace App\Exports;

use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockExport implements FromView, ShouldAutoSize
{
    // Gak butuh constructor tanggal karena ini snapshot real-time

    public function view(): View
    {
        $stocks = ProductVariant::with('product', 'color', 'size')
            ->orderBy('stock', 'asc') // Yang stok dikit taruh atas biar admin panik
            ->get();

        return view('exports.stock', ['stocks' => $stocks, 'date' => date('d-m-Y H:i')]);
    }
}