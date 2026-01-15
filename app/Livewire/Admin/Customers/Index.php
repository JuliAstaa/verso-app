<?php

namespace App\Livewire\Admin\Customers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $filterStatus = ''; 
    public $filterEmailVerified = '';
    public $sortBy = '';

    public $isModalOpen = false;

    // ban user / soft delete
    public function banUser($id) {
        $user = User::withTrashed()->find($id);

        if($user->trashed()) {
            $user->restore();
            $this->dispatch('swal:toast', ['type' => 'success', 'text' => 'User berhasil di-unban (Restore).']);
        } else {
            $user->delete();
            $this->dispatch('swal:toast', ['type' => 'error', 'text' => 'User berhasil di-ban!']);
        }
    }

    public function render()
    {
        $query = User::query()->where('role', 'customer');

        // filter ban / active
        if ($this->filterStatus === '') {
            $query->withTrashed();
        } elseif ($this->filterStatus === '1') {
            $query->onlyTrashed();
        }

        // filter email verified or not
        if ($this->filterEmailVerified === '1') {
            $query->whereNotNull('email_verified_at'); 
        } elseif ($this->filterEmailVerified === '0') {
            $query->whereNull('email_verified_at'); 
        }

        //  search by name and email
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        // switch case buat logic sort
        switch ($this->sortBy) {
            case 'oldest':
                $query->oldest(); 
                break;
            case 'asc':
                $query->orderBy('name', 'asc'); 
                break;
            case 'desc':
                $query->orderBy('name', 'desc'); 
                break;
            default:
                $query->latest(); 
                break;
        }


        // 6. Eksekusi Pagination
        return view('livewire.admin.customers.index', ['customers' => $query->paginate(10)]);
    }
}
