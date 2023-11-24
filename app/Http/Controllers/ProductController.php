<?php

namespace App\Http\Controllers;

use App\Models\ProductReviews;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductReviews::orderBy('created_at', 'desc')->paginate(9);

        $data = [
            'pageTitle' => 'Eco-Friendly Product Reviews',
            'products' => $products,
        ];

        return view('frontend.pages.products', $data);
    }

    public function show($slug)
    {
        $product = ProductReviews::where('slug', $slug)->firstOrFail();

        $data = [
            'pageTitle' => $product->name,
            'product' => $product,
        ];

        return view('frontend.pages.single_product', $data);
    }
}
