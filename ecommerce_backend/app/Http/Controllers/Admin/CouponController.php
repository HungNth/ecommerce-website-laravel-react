<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        return view('admin.coupons.index', [
            'coupons' => Coupon::latest()->get(),
        ]);
    }
    
    public function create()
    {
        return view('admin.coupons.create');
    }
    
    public function store(AddCouponRequest $request)
    {
        if ($request->validated()) {
            Coupon::create($request->validated());
            
            return redirect()->route('admin.coupons.index')
                ->with('success', 'Coupon added successfully!');
        }
    }
    
    public function show()
    {
        abort(404);
    }
    
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', [
            'coupon' => $coupon,
        ]);
    }
    
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        if ($request->validated()) {
            $coupon->update($request->validated());
            
            return redirect()->route('admin.coupons.index')
                ->with('success', 'Coupon updated successfully!');
        }
    }
    
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        
        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully!');
    }
}
