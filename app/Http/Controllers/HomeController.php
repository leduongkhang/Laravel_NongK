<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Models\Banner;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function send_mail(){
                $to_name = "Nong K";
                $to_email = "khang_dth215947@student.agu.edu.vn";//send to this email
         
                $data = array("name"=>"Mail từ TK khách hàng","body"=>'mail gửi về vấn đề hàng hóa'); //body of mail.blade.php
            
                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('test mail nhé');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
                return Redirect('/')->with('message','');

    }
    public function index(Request $request){
        //slider
        $slider = Banner::orderby('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        //seo
        $meta_desc = "Chuyên bán thuốc trừ sâu, thuốc trừ cỏ, thuốc trừ nấm bệnh vi khuẩn, thuốc sâu, thuốc cỏ, thuốc bệnh, thuoc sau, thuoc co, thuoc nam benh vi khuan, sương mai, lem lép hạt, phấn trắng, thán thư, suong mai, lem lep hat, phan trang, than thu, ruồi vàng";
        $meta_keywords = "Nông dược, nông dược việt nam, thuốc sâu, thuốc cỏ, thuốc bệnh, phấn trắng, thán thư, lem lép hạt, ruồi vàng";
        $meta_title = "Sản phẩm thuốc bảo vệ thực vật";
        $url_canonical = $request->url();
        //seo
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $new_product = DB::table('tbl_product')->where('tbl_product.product_quantity','>',0)->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();

        

        //cách 1
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('new_product',$new_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
        //cách 2
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product'));
    }
    public function all_product_customer(Request $request){
        $slider = Banner::orderby('slider_id','DESC')->where('slider_status','1')->take(3)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('tbl_product.product_quantity','>',0)->where('product_status','1')->orderby('product_id','asc')->paginate(6);

        return view('pages.all_product')->with('all_product',$all_product)->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }
    public function search(Request $request){
        $slider = Banner::orderby('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

         $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->where('tbl_product.product_quantity','>',0)->where('product_status','1')->get();

        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('slider',$slider);
    }
}
