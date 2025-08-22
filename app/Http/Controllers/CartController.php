<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use App\Models\Coupon;
use App\Models\Banner;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    public function gio_hang(){
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        
        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }
    public function check_coupon(Request $request){
        $data = $request-> all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }
    }
   public function add_cart_ajax(Request $request){
            $data = $request->all();
            $session_id = substr(md5(microtime()),rand(0,26),5);
            $cart = Session::get('cart');

            if ($cart == true) {
                $is_avaiable = false;

                foreach ($cart as $key => $val) {
                    if ($val['product_id'] == $data['cart_product_id']) {
                        // Nếu đã tồn tại thì cộng thêm số lượng
                        $cart[$key]['product_qty'] += $data['cart_product_qty'];
                        $is_avaiable = true;
                        break;
                    }
                }

                // Nếu chưa có trong giỏ thì thêm mới
                if (!$is_avaiable) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_quantity' => $data['cart_product_quantity'],
                        'product_qty' => $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                }
            } else {
                // Nếu chưa có giỏ hàng nào thì tạo mới
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
            }

            Session::put('cart', $cart);
            Session::save();
}

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i=0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id']==$key && $qty<=$cart[$session]['product_quantity'] ){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:green">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity'] ){
                        $message.='<p style="color:red">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('massage',$message);
        }
    }
    public function del_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('massage','Xóa sản phẩm thất bại');
        }
    }

    public function save_cart(Request $request){
        

        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(1);
        return Redirect::to('/show-cart');
        // Cart::destroy();
    }
    public function show_cart(){
        //seo
        // $meta_desc = "Chuyên bán thuốc trừ sâu, thuốc trừ cỏ, thuốc trừ nấm bệnh vi khuẩn, thuốc sâu, thuốc cỏ, thuốc bệnh, thuoc sau, thuoc co, thuoc nam benh vi khuan, sương mai, lem lép hạt, phấn trắng, thán thư, suong mai, lem lep hat, phan trang, than thu, ruồi vàng";
        // $meta_keywords = "Nông dược, nông dược việt nam, thuốc sâu, thuốc cỏ, thuốc bệnh, phấn trắng, thán thư, lem lép hạt, ruồi vàng";
        // $meta_title = "Sản phẩm thuốc bảo vệ thực vật";
        // $url_canonical = $request->url();
        //seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $cart = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id ?? 0)->get();
        
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
        // ->with(compact('meta_desc','meta_keywords','meta_title','url_canonical'))
    }
    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa giỏ hàng thành công');
        }
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart'); 
    }
    public function update_cart_quantity(Request $request ){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart'); 
    }
}
