<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
{
    public function insert_coupon(){

        return view('admin.coupon.insert_coupon');
    }
    public function insert_coupon_code(Request $request){
        $data = $request->all();
        $Coupon = new Coupon;

        $Coupon->coupon_name = $data['coupon_name'];
        $Coupon->coupon_code = $data['coupon_code'];
        $Coupon->coupon_times = $data['coupon_times'];
        $Coupon->coupon_number = $data['coupon_number'];
        $Coupon->coupon_condition = $data['coupon_condition'];
        $Coupon->save();

        Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
    public function list_coupon(){
        $Coupon = Coupon::orderby('coupon_id','DESC')->get();

         return view('admin.coupon.list_coupon')->with(compact('Coupon'));
    }
    public function delete_coupon($coupon_id){
        $Coupon = Coupon::find($coupon_id);
        $Coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }
}
