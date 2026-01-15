<?php

namespace App\Livewire\Admin\Reports;

use App\Exports\CustomerExport;
use App\Exports\ProductExport;
use App\Exports\RevenueExport;
use App\Exports\StockExport;
use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    // Filter Tanggal Default: Bulan Ini
    public $startDate;
    public $endDate;


    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function downloadReport($reportType = 'revenue', $format = 'xlsx')
    {
       // Validasi Tanggal (Kecuali Stock, dia ga butuh tanggal)
    if ($reportType !== 'stock') {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);
    }

    $writerType = ($format === 'pdf') ? \Maatwebsite\Excel\Excel::DOMPDF : \Maatwebsite\Excel\Excel::XLSX;
    $dateStr = date('d-m-Y');

        switch ($reportType) {
            case 'revenue':
                return Excel::download(new RevenueExport($this->startDate, $this->endDate), "Laporan-Pendapatan-$dateStr.$format", $writerType);
            
            case 'products':
                return Excel::download(new ProductExport($this->startDate, $this->endDate), "Laporan-Produk-Terlaris-$dateStr.$format", $writerType);

            case 'stock':
                // Stock gak pake parameter tanggal
                return Excel::download(new StockExport(), "Laporan-Stok-Gudang-$dateStr.$format", $writerType);

            case 'customers':
                return Excel::download(new CustomerExport($this->startDate, $this->endDate), "Laporan-Pelanggan-Loyal-$dateStr.$format", $writerType);
        }
    }
    

    public function render()
    {
        return view('livewire.admin.reports.index');
    }
}