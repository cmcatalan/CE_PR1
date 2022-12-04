<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    public function single($id)
    {
        $product = Product::where('active', true)
            ->where('product_id', $id)
            ->firstOrFail();

        return view('components.product', ['product' => $product]);
    }
}
