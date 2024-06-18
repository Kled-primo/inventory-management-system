<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component {

	use WithPagination;

	public $perPage = 5;

	public $search = '';

	public $sortField = 'id';

	public $sortAsc = false;

	public $setting;

	public $year;

	public function mount() {
		$this->year = now()->format( 'Y' );
	}

	public function sortBy( $field ): void {
		if ( $this->sortField === $field ) {
			$this->sortAsc = ! $this->sortAsc;

		} else {
			$this->sortAsc = true;
		}

		$this->sortField = $field;
	}

	public function render() {
		return view(
			'livewire.tables.product-table',
			array(
				'products' => Product::with( array( 'category', 'unit', 'product_type' ) )
					->search( $this->search )
					->orderBy( $this->sortField, $this->sortAsc ? 'asc' : 'desc' )
					->paginate( $this->perPage ),
			)
		);
	}
}
