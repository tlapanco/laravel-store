<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;


class DashboardController extends Controller
{
    public function index(): View
    {
    	$categories = Category::all();

    	$categoriesWithTotals = $categories->map(function($category){
    		$category->avaiableProductsCount = $category->avaiableProducts();
    		$category->unavaiableProductsCount = $category->unavaiableProducts();
            $category->total = $category->avaiableProductsCount + $category->unavaiableProductsCount;
    		return $category;
    	});

    	
    	return view('dashboard', compact('categoriesWithTotals'));
    }
}
