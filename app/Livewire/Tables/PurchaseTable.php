<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;
use Auth;

class PurchaseTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'purchase_no';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;

        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {

        if (isset(Auth::user()->supplier->id)) {
            // Supplier
            $purchases = Purchase::where("supplier_id", Auth::user()->supplier->id)
                ->with('supplier')
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        } else {
            // Admin or Employee
            $purchases = Purchase::search($this->search)
                ->with('supplier')
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);

        }



        return view('livewire.tables.purchase-table', [
            'purchases' => $purchases
        ]);
    }
}
