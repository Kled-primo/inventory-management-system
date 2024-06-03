@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <x-alert />

        <div class="row row-cards">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">
                                    {{ __('Product Create') }}
                                </h3>
                            </div>

                            <div class="card-actions">
                                <a href="{{ route('products.index') }}" class="btn-action">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row row-cards">
                                <div class="col-md-12">

                                    <x-input name="name" id="name" placeholder="Product name" value="{{ old('name') }}" />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">
                                            Product category
                                            <span class="text-danger">*</span>
                                        </label>

                                        @if ($categories->count() === 1)
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" readonly>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" selected>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                            <option selected="" disabled="">
                                                Select a category:
                                            </option>

                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('category_id')==$category->id) selected="selected" @endif>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @endif

                                        @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="producttype_id" class="form-label">
                                            Product Type
                                            <span class="text-danger">*</span>
                                        </label>

                                        @if ($producttypes->count() === 1)
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" readonly>
                                            @foreach ($producttypes as $producttype)
                                            <option value="{{ $producttype->id }}" selected>
                                                {{ $producttype->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select name="producttype" id="producttype" class="form-select @error('producttype') is-invalid @enderror">
                                            <option selected="" disabled="">
                                                Select a Product Type:
                                            </option>

                                            @foreach ($producttypes as $producttype)
                                            <option value="{{ $producttype->id }}" @if(old('producttype')==$producttype->id) selected="selected" @endif>
                                                {{ $producttype->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @endif

                                        @error('producttype_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3">
                                    <x-input type="number" label="Unit Number" name="unit_number" id="unit_number" placeholder="0" value="{{ old('unit_number') }}" />
                                </div>

                                <div class="col-sm-3 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="unit_id">
                                            {{ __('Unit') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        @if ($units->count() === 1)
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" readonly>
                                            @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" selected>
                                                {{ $unit->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <select name="unit_id" id="unit_id" class="form-select @error('unit_id') is-invalid @enderror">
                                            <option selected="" disabled="">
                                                Select a unit:
                                            </option>

                                            @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" @if(old('unit_id')==$unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif

                                        @error('unit_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="col-sm-3 col-md-3">
                                    <x-input type="number" label="Quantity" name="quantity" id="quantity" placeholder="0" value="{{ old('quantity') }}" />
                                </div>

                                <div class="col-sm-3 col-md-3">
                                    <x-input type="number" label="Quantity Alert" name="quantity_alert" id="quantity_alert" placeholder="0" value="{{ old('quantity_alert') }}" />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <x-input type="text" label="Selling Price" name="selling_price" id="selling_price" placeholder="0" value="{{ old('selling_price') }}" />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <x-input type="text" label="Purchase Price" name="purchase_price" id="purchase_price" placeholder="0" value="{{ old('purchase_price') }}" />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <x-input type="date" label="Manufacuring Date" name="manufacturing_date" id="manufacturing_date" placeholder="0" value="{{ old('manufacturing_date') }}" />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <x-input type="date" label="Expiry Date" name="expiry_date" id="expiry_date" placeholder="0" value="{{ old('expiry_date') }}" />
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">
                                            {{ __('Notes') }}
                                        </label>

                                        <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror" placeholder="Product notes"></textarea>

                                        @error('notes')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button.save type="submit">
                                {{ __('Save') }}
                            </x-button.save>

                            <a class="btn btn-warning" href="{{ url()->previous() }}">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce