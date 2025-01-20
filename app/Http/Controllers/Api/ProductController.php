<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\ProductController;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    	try
    	{
    		$productos = Product::select('id', 'name', 'description', 'price', 'category_id')
    												->where('status', 1)
    												->with(['productImages' => function($query) {
    													$query->select('id', 'product_id', 'name');
    												}])
    												->get(); 
    		return response()->json($productos);

    	} catch(Exception $e)
    	{
    		return response()->json(['error' => 'Algo salió mal, intentelo más tarde']);
    	}
    }
}
