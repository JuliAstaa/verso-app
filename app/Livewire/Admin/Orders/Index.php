<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Filter properties (yg lama biarin aja)
    public $search = '', $filterStatus = '', $sortBy = 'latest';

    // --- PROPERTI BARU BUAT MODAL ---
    public $isModalOpen = false;
    public $selectedOrder = null;

    // Form Input
    public $statusInput = '';
    public $trackingInput = '';

    // 1. BUKA MODAL & AMBIL DATA
    public function showDetail($id)
    {
        $this->selectedOrder = Order::with(['user', 'orderItems.productVariant.product'])->find($id);
        
        // Isi form dengan data saat ini
        $this->statusInput = $this->selectedOrder->status;
        $this->trackingInput = $this->selectedOrder->tracking_number;

        $this->isModalOpen = true;
    }

    // 2. TUTUP MODAL
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedOrder = null;
        $this->reset(['statusInput', 'trackingInput']);
    }

    // 3. LOGIC UPDATE STATUS (THE BRAIN 🧠)
    public function updateOrder()
    {
        // Validasi: Kalau status 'shipped', RESI WAJIB DIISI!
        $this->validate([
            'statusInput' => 'required',
            'trackingInput' => 'required_if:statusInput,shipped,completed', 
        ], [
            'trackingInput.required_if' => 'Nomor Resi wajib diisi kalau barang dikirim!',
        ]);

        if ($this->selectedOrder) {
            $this->selectedOrder->update([
                'status' => $this->statusInput,
                'tracking_number' => $this->trackingInput,
            ]);

            $this->dispatch('swal:toast', [
                'type' => 'success', 
                'text' => 'Order berhasil diperbarui!'
            ]);

            $this->closeModal();
        }
    }

    public function render()
    {
        // ... (Query render yang lama biarin aja) ...
        // Copy dari codingan sebelumnya
        $query = Order::query()->with('user'); 
        if ($this->filterStatus) $query->where('status', $this->filterStatus);
        if ($this->search) {
            $query->where(function($q) {
                $q->where('invoice_number', 'like', '%'.$this->search.'%')
                  ->orWhere('recipient_name', 'like', '%'.$this->search.'%');
            });
        }
        if ($this->sortBy == 'oldest') $query->oldest(); else $query->latest();

        return view('livewire.admin.orders.index', [
            'orders' => $query->paginate(10)
        ]);
    }
}