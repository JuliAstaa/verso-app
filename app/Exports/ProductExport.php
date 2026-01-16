<?php
namespace App\Exports;

use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class ProductExport implements FromView, ShouldAutoSize
{
    protected $start, $end;
    public function __construct($start, $end) { $this->start = $start; $this->end = $end; }

    public function view(): View
    {
        $products = OrderItem::select('product_variant_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', function($q) {
                $q->where('status', 'paid')
                  ->whereBetween('created_at', [$this->start . ' 00:00:00', $this->end . ' 23:59:59']);
            })
            ->groupBy('product_variant_id')
            ->orderByDesc('total_sold')
            ->with(['productVariant.product', 'productVariant.color', 'productVariant.size']) // Eager load
            ->get();

        return view('exports.products', ['products' => $products, 'start' => $this->start, 'end' => $this->end]);
    }
}