<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\InvoiceItemProduct;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }
    public function create()
    {
        return view('invoice.create');
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
