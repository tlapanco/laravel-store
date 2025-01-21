<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index (Request $request)
    {
    	$categories = Category::select('id', 'name')->get();
    	return response()->json($categories);
    }
}
