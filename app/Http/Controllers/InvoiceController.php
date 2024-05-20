<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\Invoice\StoreInvoiceRequest;

class InvoiceController extends Controller
{
    public function create()
    {
        // $customer = Customer::where('id', $request->get('customer_id'))
        //     ->first();

        $carts = Cart::content();

        return view('invoices.create', [
            //'customer' => $customer,
            'carts' => $carts
        ]);
    }
}
