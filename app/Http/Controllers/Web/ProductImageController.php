<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;

use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(string $id) 
    {
    	try {
    		$img = ProductImage::find($id);    	
    		$producto = $img->product_id;    	
    		Storage::delete( $img->name);
    		$img->delete();
    		return back()->with('success', 'Imagen eliminada satisfactoriamente.');
    	}catch(\Throwable $th){
    		return back()->with('error', 'Algo salió mal, intentelo más tarde');
    	}
    }
}
