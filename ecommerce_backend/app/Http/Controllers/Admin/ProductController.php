<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['colors', 'sizes'])->latest()->get();
        return view('admin.products.index', [
            'products' => $products,
        ]);
    }
    
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.create', [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
    
    public function store(AddProductRequest $request)
    {
        if ($request->validated()) {
            $data = $request->all();
            $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            // check if the request has images and save them
            if ($request->has('first_image')) {
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            
            if ($request->has('second_image')) {
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            
            if ($request->has('third_image')) {
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }
            // generate slug from name
            $data['slug'] = Str::slug($request->name);
            
            $product = Product::create($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Product added successfully!');
        }
    }
    
    public function show()
    {
        abort(404);
    }
    
    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.edit', [
            'colors' => $colors,
            'sizes' => $sizes,
            'product' => $product,
        ]);
    }
    
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->validated()) {
            $data = $request->all();
            
            if ($request->has('thumbnail')) {
                // remove old thumbnail
                $this->removeProductImageFromStorage($product->thumbnail);
                // store new thumbnail
                $data['thumbnail'] = $this->saveImage($request->file('thumbnail'));
            }
            // check if the request has images and save them
            if ($request->has('first_image')) {
                // remove old image
                $this->removeProductImageFromStorage($product->first_image);
                // store new image
                $data['first_image'] = $this->saveImage($request->file('first_image'));
            }
            
            if ($request->has('second_image')) {
                // remove old image
                $this->removeProductImageFromStorage($product->second_image);
                // store new image
                $data['second_image'] = $this->saveImage($request->file('second_image'));
            }
            
            if ($request->has('third_image')) {
                // remove old image
                $this->removeProductImageFromStorage($product->third_image);
                // store new image
                $data['third_image'] = $this->saveImage($request->file('third_image'));
            }
            // generate slug from name
            $data['slug'] = Str::slug($request->name);
            $data['status'] = $request->status;
            
            $product->update($data);
            $product->colors()->sync($request->color_id);
            $product->sizes()->sync($request->size_id);
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully!');
        }
    }
    
    public function destroy(Product $product)
    {
        // remove images
        $this->removeProductImageFromStorage($product->thumbnail);
        $this->removeProductImageFromStorage($product->first_image);
        $this->removeProductImageFromStorage($product->second_image);
        $this->removeProductImageFromStorage($product->third_image);
        // delete product
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
    
    /**
     * Save the uploaded image to the storage
     */
    public function saveImage($file)
    {
        $imageName = time().'_'.$file->getClientOriginalName();
        $file->storeAs('images/products/', $imageName, 'public');
        
        return 'storage/images/products/'.$imageName;
    }
    
    /**
     * Remove the product image from the storage
     */
    public function removeProductImageFromStorage($file)
    {
        $path = public_path($file);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
