<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $key = $request->input('tukhoa');
        $result = Product::where('product_name', 'like', '%' . $key . '%')->get();
        return view('product.search', compact('result', 'key'));
    }
}
