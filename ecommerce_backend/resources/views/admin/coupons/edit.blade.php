@extends('admin.layouts.app')

@section('title')
    Edit coupon
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white">
                        <h3 class="mt-2">Edit coupon</h3>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               placeholder="S"
                                               value="{{ $coupon->name, old('name') }}"
                                        >
                                        <label for="name">Name*</label>
                                        @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number"
                                               class="form-control @error('discount') is-invalid @enderror"
                                               id="discount"
                                               name="discount"
                                               placeholder="Discount"
                                               value="{{ $coupon->discount, old('discount') }}"
                                        >
                                        <label for="name">Discount*</label>
                                        @error('discount')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="datetime-local"
                                               class="form-control @error('valid_until') is-invalid @enderror"
                                               id="valid_until"
                                               name="valid_until"
                                               placeholder="Validity"
                                               {{--min="{{ \Carbon\Carbon::now()->addDays(1) }}"--}}
                                               value="{{ $coupon->valid_until }}"
                                        >
                                        <label for="name">Validity*</label>
                                        @error('valid_until')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-2">
                                        <button class="btn btn-sm btn-dark" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection