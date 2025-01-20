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

    		$category->total = $category->count();
    		$category->avaiableProductsCount = $category->avaiableProducts();
    		$category->unavaiableProductsCount = $category->unavaiableProducts();
    		return $category;
    	});

    	
    	return view('dashboard', compact('categoriesWithTotals'));
    }
}
