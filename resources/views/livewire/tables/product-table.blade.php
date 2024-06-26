<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Products') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-icon.vertical-dots />
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <a href="{{ route('products.create') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Create Product') }}
                    </a>
                    <a href="{{ route('products.import.view') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Import Products') }}
                    </a>
                    <a href="{{ route('products.export.store') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Export Products') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entries
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            {{ __('Name') }}
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('code')" href="#" role="button">
                            {{ __('Code') }}
                            @include('inclues._sort-icon', ['field' => 'code'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('unit_number')" href="#" role="button">
                            {{ __('Unit Number') }}
                            @include('inclues._sort-icon', ['field' => 'code'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('unit_id')" href="#" role="button">
                            {{ __('Unit') }}
                            @include('inclues._sort-icon', ['field' => 'unit_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('producttype')" href="#" role="button">
                            {{ __('Product Type') }}
                            @include('inclues._sort-icon', ['field' => 'producttype'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('category_id')" href="#" role="button">
                            {{ __('Category') }}
                            @include('inclues._sort-icon', ['field' => 'category_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Quantity') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('selling_price')" href="#" role="button">
                            {{ __('Selling Price') }}
                            @include('inclues._sort-icon', ['field' => 'selling_price'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('manufacturing_date')" href="#" role="button">
                            {{ __('Manufacturing Date') }}
                            @include('inclues._sort-icon', ['field' => 'manufacturing_date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('expiry_date')" href="#" role="button">
                            {{ __('Expiry Date') }}
                            @include('inclues._sort-icon', ['field' => 'expiry_date'])
                        </a>
                    </th>

                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td class="align-middle text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->code }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->unit_number }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->unit ? $product->unit->name : '--' }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->product_type->name ?? "==" }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->category ? $product->category->name : '--' }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->quantity }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->selling_price }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->manufacturing_date }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $product->expiry_date }}
                    </td>
                    <td class="align-middle text-center" style="width: 10%">
                        <a href="{{ route('forecast.product', [$product->id,$this->year]) }}" class="btn btn-outline-success btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-dots-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 3v18h18" />
                                <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M13 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M18 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M21 3l-6 1.5" />
                                <path d="M14.113 6.65l2.771 3.695" />
                                <path d="M16 12.5l-5 2" />
                            </svg>
                        </a>
                        <x-button.show class="btn-icon" route="{{ route('products.show', $product->uuid) }}" />
                        <x-button.edit class="btn-icon" route="{{ route('products.edit', $product->uuid) }}" />
                        <x-button.delete class="btn-icon" route="{{ route('products.destroy', $product->uuid) }}" onclick="return confirm('Are you sure to delete product {{ $product->name }} ?')" />
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="align-middle text-center" colspan="7">
                        No results found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $products->firstItem() }}</span>
            to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $products->links() }}
        </ul>
    </div>
</div>