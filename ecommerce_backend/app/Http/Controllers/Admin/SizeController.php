<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        return view('admin.sizes.index', [
            'sizes' => Size::latest()->get(),
        ]);
    }
    
    public function create()
    {
        return view('admin.sizes.create');
    }
    
    public function store(AddSizeRequest $request)
    {
        if ($request->validated()) {
            Size::create($request->validated());
            
            return redirect()->route('admin.sizes.index')
                ->with('success', 'Size added successfully!');
        }
    }
    
    public function show()
    {
        abort(404);
    }
    
    public function edit(Size $size)
    {
        return view('admin.sizes.edit', [
            'size' => $size,
        ]);
    }
    
    public function update(UpdateSizeRequest $request, Size $size)
    {
        if ($request->validated()) {
            $size->update($request->validated());
            
            return redirect()->route('admin.sizes.index')
                ->with('success', 'Size updated successfully!');
        }
    }
    
    public function destroy(Size $size)
    {
        $size->delete();
        
        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully!');
    }
}
