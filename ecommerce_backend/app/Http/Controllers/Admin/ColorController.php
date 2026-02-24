<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin.colors.index', [
            'colors' => Color::latest()->get(),
        ]);
    }
    
    public function create()
    {
        return view('admin.colors.create');
    }
    
    public function store(AddColorRequest $request)
    {
        if ($request->validated()) {
            Color::create($request->validated());
            
            return redirect()->route('admin.colors.index')
                ->with('success', 'Color added successfully!');
        }
    }
    
    public function show()
    {
        abort(404);
    }
    
    public function edit(Color $color)
    {
        return view('admin.colors.edit', [
            'color' => $color,
        ]);
    }
    
    public function update(UpdateColorRequest $request, Color $color)
    {
        if ($request->validated()) {
            $color->update($request->validated());
            
            return redirect()->route('admin.colors.index')
                ->with('success', 'Color updated successfully!');
        }
    }
    
    public function destroy(Color $color)
    {
        $color->delete();
        
        return redirect()->route('admin.colors.index')
            ->with('success', 'Color deleted successfully!');
    }
}
