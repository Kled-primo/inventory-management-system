<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests\ProductType\StoreProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;
use Str;

class ProductTypeController extends Controller
{
    public function index()
    {
        $producttypes = ProductType::where("user_id", auth()->id())->select(['id', 'name', 'slug'])->get();

        return view('producttype.index', [
            'producttypes' => $producttypes,
        ]);
    }

    public function create()
    {
        return view('producttypes.create');
    }

    public function show(ProductType $producttype)
    {
        $producttype->loadMissing('products')->get();

        return view('producttype.show', [
            'producttype' => $producttype
        ]);
    }

    public function store(StoreProductTypeRequest $request)
    {
        ProductType::create([
            "user_id" => auth()->id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()
            ->route('producttype.index')
            ->with('success', 'Product Type has been created!');
    }

    public function edit(ProductType $producttype)
    {
        return view('producttypes.edit', [
            'producttype' => $producttype
        ]);
    }

    public function update(UpdateProductTypeRequest $request, $slug)
    {
        $producttype = ProductType::where(["user_id" => auth()->id(), "slug" => $slug])->firstOrFail();
        $producttype->name = $request->name;
        $producttype->slug = Str::slug($request->name);
        $producttype->save();

        return redirect()
            ->route('producttype.index')
            ->with('success', 'Product Type has been updated!');
    }

    public function destroy(ProductType $producttype)
    {
        $producttype->delete();

        return redirect()
            ->route('producttype.index')
            ->with('success', 'Product Type has been deleted!');
    }
}
