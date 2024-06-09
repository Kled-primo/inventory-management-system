@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <form action="{{ route('suppliers.update', $supplier->uuid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">
                                        {{ __('Edit Supplier') }}
                                    </h3>
                                </div>

                                <div class="card-actions">
                                    <x-action.close route="{{ route('suppliers.index') }}" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <x-input name="name" :value="old('name', $supplier->name)" :required="true"/>
                                        <x-input name="email" label="Email address" :value="old('email', $supplier->email)" :required="true"/>
                                        <x-input name="shopname" label="Shop name" :value="old('shopname', $supplier->shopname)" :required="true"/>
                                        <x-input name="phone" label="Phone number" :value="old('phone', $supplier->phone)" :required="true"/>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                {{ __('Address ') }}
                                            </label>

                                            <textarea id="address"
                                                      name="address"
                                                      rows="3"
                                                      class="form-control @error('address') is-invalid @enderror"
                                            >{{ old('address', $supplier->address) }}</textarea>

                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <x-button type="submit">
                                    {{ __('Save') }}
                                </x-button>
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
@endpushonce
