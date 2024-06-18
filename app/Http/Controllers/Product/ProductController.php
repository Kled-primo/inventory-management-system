<?php

namespace App\Http\Controllers\Product;

use Str;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller {

	public function index() {
		// $products = Product::where("user_id", auth()->id())->count();
		$products = Product::all()->count();

		return view(
			'products.index',
			array(
				'products' => $products,
			)
		);
	}

	public function create( Request $request ) {
		$categories = Category::where( 'user_id', auth()->id() )->get( array( 'id', 'name' ) );
		$units      = Unit::where( 'user_id', auth()->id() )->get( array( 'id', 'name' ) );

		$producttypes = ProductType::where( 'user_id', auth()->id() )->select( array( 'id', 'name', 'slug' ) )->get();

		if ( $request->has( 'category' ) ) {
			$categories = Category::where( 'user_id', auth()->id() )->whereSlug( $request->get( 'category' ) )->get();
		}

		if ( $request->has( 'unit' ) ) {
			$units = Unit::where( 'user_id', auth()->id() )->whereSlug( $request->get( 'unit' ) )->get();
		}

		return view(
			'products.create',
			array(
				'categories'   => $categories,
				'units'        => $units,
				'producttypes' => $producttypes,
			)
		);
	}

	public function store( StoreProductRequest $request ) {
		/**
		 * Handle upload image
		 */
		$image = '';
		if ( $request->hasFile( 'product_image' ) ) {
			$image = $request->file( 'product_image' )->store( 'products', 'public' );
		}

		Product::create(
			array(
				// "code" => IdGenerator::generate([
				// 'table' => 'products',
				// 'field' => 'code',
				// 'length' => 7,
				// 'prefix' => 'PC'
				// ]),

				'name'               => $request->name,
				'category_id'        => $request->category_id,
				'unit_id'            => $request->unit_id,
				'producttype'        => $request->producttype,
				'quantity'           => $request->quantity,
				'unit_number'        => $request->unit_number,
				'selling_price'      => $request->selling_price,
				'purchase_price'     => $request->purchase_price,
				'quantity_alert'     => $request->quantity_alert,
				'notes'              => $request->notes,
				'manufacturing_date' => $request->manufacturing_date,
				'expiry_date'        => $request->expiry_date,
				'user_id'            => $request->user_id,
				'slug'               => Str::slug( $request->name, '-' ),
				'uuid'               => Str::uuid(),
			)
		);

		return to_route( 'products.index' )->with( 'success', 'Product has been created!' );
	}

	public function show( $uuid ) {
		$product = Product::where( 'uuid', $uuid )->firstOrFail();
		// Generate a barcode
		$generator = new BarcodeGeneratorHTML();

		$barcode = $generator->getBarcode( $product->code, $generator::TYPE_CODE_128 );

		return view(
			'products.show',
			array(
				'product' => $product,
				'barcode' => $barcode,
			)
		);
	}

	public function edit( $uuid ) {
		$product = Product::where( 'uuid', $uuid )->firstOrFail();
		return view(
			'products.edit',
			array(
				'categories' => Category::where( 'user_id', auth()->id() )->get(),
				'units'      => Unit::where( 'user_id', auth()->id() )->get(),
				'product'    => $product,
			)
		);
	}

	public function update( UpdateProductRequest $request, $uuid ) {
		$product = Product::where( 'uuid', $uuid )->firstOrFail();
		$product->update( $request->except( 'product_image' ) );

		$image = $product->product_image;
		if ( $request->hasFile( 'product_image' ) ) {

			// Delete Old Photo
			if ( $product->product_image ) {
				unlink( public_path( 'storage/' ) . $product->product_image );
			}
			$image = $request->file( 'product_image' )->store( 'products', 'public' );
		}

		$product->name               = $request->name;
		$product->slug               = Str::slug( $request->name, '-' );
		$product->category_id        = $request->category_id;
		$product->unit_id            = $request->unit_id;
		$product->quantity           = $request->quantity;
		$product->unit_number        = $request->unit_number;
		$product->selling_price      = $request->selling_price;
		$product->purchase_price     = $request->purchase_price;
		$product->quantity_alert     = $request->quantity_alert;
		$product->notes              = $request->notes;
		$product->manufacturing_date = $request->manufacturing_date;
		$product->expiry_date        = $request->expiry_date;
		$product->save();

		return redirect()
			->route( 'products.index' )
			->with( 'success', 'Product has been updated!' );
	}

	public function destroy( $uuid ) {
		$product = Product::where( 'uuid', $uuid )->firstOrFail();
		/**
		 * Delete photo if exists.
		 */
		if ( $product->product_image ) {
			// check if image exists in our file system
			if ( file_exists( public_path( 'storage/' ) . $product->product_image ) ) {
				unlink( public_path( 'storage/' ) . $product->product_image );
			}
		}

		$product->delete();

		return redirect()
			->route( 'products.index' )
			->with( 'success', 'Product has been deleted!' );
	}
}
