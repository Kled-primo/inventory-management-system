<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\ProducttypeController;
use App\Http\Controllers\Order\DueOrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Order\OrderPendingController;
use App\Http\Controllers\Order\OrderCompleteController;
use App\Http\Controllers\Quotation\QuotationController;
use App\Http\Controllers\Dashboards\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Product\ProductExportController;
use App\Http\Controllers\Product\ProductImportController;
use App\Http\Controllers\Product\ProductForecastController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(
	'php/',
	function () {
		return phpinfo();
	}
);

Route::get(
	'/',
	function () {
		if ( Auth::check() ) {
			return redirect( '/dashboard' );
		}
		return redirect( '/login' );
	}
);

Route::middleware( array( 'auth', 'verified' ) )->group(
	function () {

		Route::get( 'dashboard/', array( DashboardController::class, 'index' ) )->name( 'dashboard' );

		// User Management
		// Route::resource('/users', UserController::class); //->except(['show']);
		Route::put( '/user/change-password/{username}', array( UserController::class, 'updatePassword' ) )->name( 'users.updatePassword' );

		Route::get( '/profile', array( ProfileController::class, 'edit' ) )->name( 'profile.edit' );
		Route::get( '/profile/settings', array( ProfileController::class, 'settings' ) )->name( 'profile.settings' );
		Route::get( '/profile/store-settings', array( ProfileController::class, 'store_settings' ) )->name( 'profile.store.settings' );
		Route::post( '/profile/store-settings', array( ProfileController::class, 'store_settings_store' ) )->name( 'profile.store.settings.store' );
		Route::patch( '/profile', array( ProfileController::class, 'update' ) )->name( 'profile.update' );
		Route::delete( '/profile', array( ProfileController::class, 'destroy' ) )->name( 'profile.destroy' );

		Route::resource( '/quotations', QuotationController::class );
		Route::resource( '/customers', CustomerController::class );
		Route::resource( '/suppliers', SupplierController::class );
		Route::resource( '/categories', CategoryController::class );
		Route::resource( '/producttype', ProductType::class );
		Route::resource( '/units', UnitController::class );

		// Route Product Forecast
		Route::get( 'productsforecast/{id}/{year}/product', array( ProductForecastController::class, 'product' ) )->name( 'forecast.product' );
		Route::get( 'productsforecast/history', array( ProductForecastController::class, 'history' ) )->name( 'forecast.history' );
		Route::post( 'productsforecast/history', array( ProductForecastController::class, 'showhistory' ) )->name( 'forecast.showhistory' );
		Route::post( 'productsforecast/export/general', array( ProductForecastController::class, 'exportgeneral' ) )->name( 'forecast.exportgeneral' );
		Route::post( 'productsforecast/individual', array( ProductForecastController::class, 'historyindividual' ) )->name( 'forecast.historyindividual' );
		Route::post( 'productsforecast/category', array( ProductForecastController::class, 'historycategory' ) )->name( 'forecast.historycategory' );
		Route::post( 'productsforecast/individualcategory', array( ProductForecastController::class, 'historyindividualcategory' ) )->name( 'forecast.individualcategory' );
		Route::post( 'productsforecast/exportindividualmonthly', array( ProductForecastController::class, 'exportindividualmonthly' ) )->name( 'forecast.exportindividualmonthly' );
		Route::post( 'productsforecast/exportindividualquarterly', array( ProductForecastController::class, 'exportindividualquarterly' ) )->name( 'forecast.exportindividualquarterly' );

		// Route Products
		Route::get( 'products/import/', array( ProductImportController::class, 'create' ) )->name( 'products.import.view' );
		Route::post( 'products/import/', array( ProductImportController::class, 'store' ) )->name( 'products.import.store' );
		Route::get( 'products/export/', array( ProductExportController::class, 'create' ) )->name( 'products.export.store' );
		Route::resource( '/products', ProductController::class );

		// Route POS
		Route::get( '/pos', array( PosController::class, 'index' ) )->name( 'pos.index' );
		Route::post( '/pos/cart/add', array( PosController::class, 'addCartItem' ) )->name( 'pos.addCartItem' );
		Route::post( '/pos/cart/update/{rowId}', array( PosController::class, 'updateCartItem' ) )->name( 'pos.updateCartItem' );
		Route::delete( '/pos/cart/delete/{rowId}', array( PosController::class, 'deleteCartItem' ) )->name( 'pos.deleteCartItem' );

		// Route::post('/pos/invoice', [PosController::class, 'createInvoice'])->name('pos.createInvoice');
		Route::get( 'invoice/create/', array( InvoiceController::class, 'create' ) )->name( 'invoice.create' ); // changed to get

		// Route Orders
		Route::get( '/orders', array( OrderController::class, 'index' ) )->name( 'orders.index' );
		Route::get( '/orders/pending', OrderPendingController::class )->name( 'orders.pending' );
		Route::get( '/orders/complete', OrderCompleteController::class )->name( 'orders.complete' );

		Route::get( '/orders/create', array( OrderController::class, 'create' ) )->name( 'orders.create' );
		Route::post( '/orders/store', array( OrderController::class, 'store' ) )->name( 'orders.store' );

		// SHOW ORDER
		Route::get( '/orders/{order}', array( OrderController::class, 'show' ) )->name( 'orders.show' );
		Route::put( '/orders/update/{order}', array( OrderController::class, 'update' ) )->name( 'orders.update' );
		Route::delete( '/orders/cancel/{order}', array( OrderController::class, 'cancel' ) )->name( 'orders.cancel' );

		// DUES
		Route::get( 'due/orders/', array( DueOrderController::class, 'index' ) )->name( 'due.index' );
		Route::get( 'due/order/view/{order}', array( DueOrderController::class, 'show' ) )->name( 'due.show' );
		Route::get( 'due/order/edit/{order}', array( DueOrderController::class, 'edit' ) )->name( 'due.edit' );
		Route::put( 'due/order/update/{order}', array( DueOrderController::class, 'update' ) )->name( 'due.update' );

		// TODO: Remove from OrderController
		Route::get( '/orders/details/{order_id}/download', array( OrderController::class, 'downloadInvoice' ) )->name( 'order.downloadInvoice' );

		// Route Purchases
		Route::get( '/purchases/approved', array( PurchaseController::class, 'approvedPurchases' ) )->name( 'purchases.approvedPurchases' );
		Route::get( '/purchases/report', array( PurchaseController::class, 'purchaseReport' ) )->name( 'purchases.purchaseReport' );
		Route::get( '/purchases/report/export', array( PurchaseController::class, 'getPurchaseReport' ) )->name( 'purchases.getPurchaseReport' );
		Route::post( '/purchases/report/export', array( PurchaseController::class, 'exportPurchaseReport' ) )->name( 'purchases.exportPurchaseReport' );

		Route::get( '/purchases', array( PurchaseController::class, 'index' ) )->name( 'purchases.index' );
		Route::get( '/purchases/create', array( PurchaseController::class, 'create' ) )->name( 'purchases.create' );
		Route::post( '/purchases', array( PurchaseController::class, 'store' ) )->name( 'purchases.store' );

		// Route::get('/purchases/show/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
		Route::get( '/purchases/{purchase}', array( PurchaseController::class, 'show' ) )->name( 'purchases.show' );

		// Route::get('/purchases/edit/{purchase}', [PurchaseController::class, 'edit'])->name('purchases.edit');
		Route::get( '/purchases/{purchase}/edit', array( PurchaseController::class, 'edit' ) )->name( 'purchases.edit' );
		Route::post( '/purchases/update/{purchase}', array( PurchaseController::class, 'update' ) )->name( 'purchases.update' );
		Route::delete( '/purchases/delete/{purchase}', array( PurchaseController::class, 'destroy' ) )->name( 'purchases.delete' );

		// Route Quotations
		// Route::get('/quotations/{quotation}/edit', [QuotationController::class, 'edit'])->name('quotations.edit');
		// Route::post('/quotations/complete/{quotation}', [QuotationController::class, 'update'])->name('quotations.update');
		// Route::delete('/quotations/delete/{quotation}', [QuotationController::class, 'destroy'])->name('quotations.delete');

		Route::get( '/permissions', array( PermissionController::class, 'index' ) )->name( 'permissions.index' );
		Route::post( '/permissions', array( PermissionController::class, 'create' ) )->name( 'permissions.create' );
		Route::post( '/permissions/user/{userid}/remove-role', array( PermissionController::class, 'userremove' ) )->name( 'permissions.user.remove' );

		Route::get( '/settings', array( SettingController::class, 'index' ) )->name( 'settings.index' );
		Route::post( '/settings', array( SettingController::class, 'save' ) )->name( 'settings.save' );
		Route::get( '/settings/{id}/setactive', array( SettingController::class, 'setactive' ) )->name( 'settings.setactive' );

		// Logging
		Route::get( '/logs', array( LogController::class, 'index' ) )->name( 'logs.index' );
	}
);

require __DIR__ . '/auth.php';

Route::get(
	'test/',
	function () {
		return view( 'test' );
	}
);
