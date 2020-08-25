<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InvoiceItemProduct;

use App\InvoiceItem;

use App\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::All();


        return view('invoice.index', ['invoices' => $invoices]);
    }
    public function create()
    {
        return view('invoice.create');
    }
    public function save(Request $request)
    {
        $input = $request->All();

        $invoice = new Invoice();

        $invoice->sub_amount = $input['subTotal'];
        $invoice->percentage = $input['taxPrice'];
        $invoice->amount = $input['totalPrice'];

        $invoice->save();

        foreach ($input['invoiceItems'] as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->invoice_item_product_id = $item['invoice_item_product_id'];
            $invoiceItem->quantity = $item['quantity'];
            $invoiceItem->price = ($item['price'] * $item['quantity']);

            $invoiceItem->save();
        };
        return [
            'success' => true
        ];
    }
    public function getAllProduct()
    {
        $products = InvoiceItemProduct::orderBy('id')->get();
        if (!isset($products[0])) {
            return [
                'success' => false,
                'message' => "Oof! Something went wrong!"
            ];
        };
        return [
            'success' => true,
            'data' => $products
        ];
    }
}
