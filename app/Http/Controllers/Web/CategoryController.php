<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\View\View;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): View 
    {
    	$categories = Category::paginate(15);
    	return view('category.index', compact('categories'));
    }

    public function create(): View
    {
    	return view('category.create');
    }

    public function edit(string $id): View
    {
    	$category = Category::find($id);
    	return view('category.edit', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
    	Category::create($request->safe()->only(['name']));
    	return redirect()->route('categorias.index');
    }

    public function update(CategoryRequest $request, string $id)
    {
    	$category = Category::find($id);
    	$category->update($request->safe()->only(['name']));
    	return redirect()->route('categorias.index');
    }

    public function destroy (string $id)
    {
    	Category::find($id)->delete();
    	return redirect()->route('categorias.index');
    }
}
