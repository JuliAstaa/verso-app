<?php

namespace App\Livewire\Front\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionList extends Component
{
    use WithPagination;

    public $status = 'all'; 
    public $search = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTransactionsProperty()
    {
        return Order::where('user_id', Auth::id())

            ->with(['orderItems.productVariant.product']) 
            
            ->when($this->status != 'all', function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->search, function ($query) {
                return $query->where('invoice_number', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(5);
    }
    
    public function render()
    {
        return view('livewire.front.customer.transaction-list',[
            'transactions' => $this->transactions
        ]);
    }
}
