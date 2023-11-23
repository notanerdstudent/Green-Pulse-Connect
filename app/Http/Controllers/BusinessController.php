<?php

namespace App\Http\Controllers;

use App\Models\BusinessListing;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = BusinessListing::orderBy('created_at', 'desc')->paginate(9);

        $data = [
            'pageTitle' => 'Green Business Directory',
            'businesses' => $businesses,
        ];

        return view('frontend.pages.business_listings', $data);
    }

    public function show($slug)
    {
        $business = BusinessListing::where('slug', $slug)->firstOrFail();

        $data = [
            'pageTitle' => $business->name,
            'business' => $business,
        ];

        return view('frontend.pages.single_business', $data);
    }
}
