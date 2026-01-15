<?php
namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class CustomerExport implements FromView, ShouldAutoSize
{
    protected $start, $end;
    public function __construct($start, $end) { $this->start = $start; $this->end = $end; }

    public function view(): View
    {
        $customers = Order::select('user_id', DB::raw('SUM(total_price) as total_spent'), DB::raw('COUNT(id) as total_trx'))
            ->where('status', 'paid')
            ->whereBetween('created_at', [$this->start . ' 00:00:00', $this->end . ' 23:59:59'])
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->with('user') // Ambil nama user
            ->get();

        return view('exports.customer', ['customers' => $customers, 'start' => $this->start, 'end' => $this->end]);
    }
}