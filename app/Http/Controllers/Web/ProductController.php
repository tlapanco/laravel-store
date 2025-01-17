<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::withTrashed()->with(['productImages' => function ($query) {
            $query->take(1);
        }])->paginate(15);
        // dd($products[0]) ;
        
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //Save Product info
        $newProduct = Product::create($request->safe()->only([
            'name',
            'price',
            'description',
            'status',
            'category_id',
        ]));        

        //Save Product Images
        if ($request->hasFile('productImages')) 
        {
            $photos = $request->file('productImages');
            foreach ($photos as $photo) {
                $name = $newProduct->name . '-' . uniqid() . '.' . $photo->extension();
                $photo->storeAs($newProduct->id, $name);                
                $newProduct->productImages()->save(new ProductImage(['name' => $newProduct->id . '/' . $name]));
            }
        }
        return redirect()->route('productos.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $producto = Product::withTrashed()->with('productImages')->find($id);        
        $categories = Category::all();
        return view('product.edit', compact(['producto', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {        
        $product = Product::withTrashed()->find($id);          
        
        $product->update($request->safe()->only([
            'name',
            'price',
            'status',
            'description',
            'category_id',
        ]));
        if ($request->hasFile('productImages')) 
        {
            $photos = $request->file('productImages');
            foreach ($photos as $photo) {
                $name = $product->name . '-' . uniqid() . '.' . $photo->extension();
                $photo->storeAs($product->id, $name);                
                $product->productImages()->save(new ProductImage(['name' => $product->id . '/' . $name]));
            }
        }
                
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('producto.index');
    }
}
