<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Biar lebar kolom otomatis
use Maatwebsite\Excel\Concerns\WithStyles;    // Biar bisa styling
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RevenueExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $startDate;
    protected $endDate;

    // Terima parameter tanggal dari Controller/Livewire
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // Ambil data order yang sudah PAID dalam rentang tanggal
        $orders = Order::with('user')
            ->where('status', 'paid')
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->latest()
            ->get();

        return view('exports.revenue', [
            'orders' => $orders,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'totalRevenue' => $orders->sum('total_price')
        ]);
    }

    // Styling Header biar Bold (Opsional)
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]], // Judul
            3 => ['font' => ['bold' => true]], // Header Tabel
        ];
    }
}