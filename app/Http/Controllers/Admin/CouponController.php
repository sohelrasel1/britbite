<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $data['coupons'] = Coupon::query()->orderBy('id', 'DESC')->paginate(10);
        $data['packages'] = Package::query()->where('status', '1')->get();
        return view('admin.packages.coupons.index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'value' => 'required',
            'start_date' => 'required',
            'minimum_spend' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = $request->except('_token');
        $input['packages'] = json_encode($request->packages);
      
        Coupon::create($input);

        Session::flash('success', 'Coupon added successfully!');
        return "success";
    }

    public function edit($id)
    {
        $data['coupon'] = Coupon::findOrFail($id);
        $data['packages'] = Package::where('status', '1')->get();
        $data['selectedPackages'] = !empty($data['coupon']->packages) ? json_decode($data['coupon']->packages, true) : [];
        return view('admin.packages.coupons.edit', $data);
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:coupons,code,' . $request->coupon_id,
            'type' => 'required',
            'value' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'end_date' => 'required',
            'minimum_spend' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = $request->except('_token', 'coupon_id');

        $data = Coupon::find($request->coupon_id);
        $packages = !empty($request->packages) ? json_encode($request->packages) : NULL;
        $input['packages'] = $packages;
        $data->fill($input)->save();
        Session::flash('success', 'Coupon updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->delete();
        $request->session()->flash('success', 'Coupon deleted successfully!');
        return back();
    }
}
