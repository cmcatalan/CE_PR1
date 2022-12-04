<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function all()
    {
        return view('components.categories', ['categories' => Category::all()]);
    }

    public function single($id)
    {
        $category_name = Category::findOrFail($id)->name;
        $products = Product::where('active',true)
            ->where('category_id', $id)
            ->get();

        return view('components.category',
            [
                'category_name' => $category_name,
                'products' => $products
            ]);
    }
}
