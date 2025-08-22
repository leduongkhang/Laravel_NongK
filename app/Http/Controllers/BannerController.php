<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
class BannerController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }
    public function manage_banner(){
        $this->AuthLogin();
        $slide = Banner::orderby('slider_id','DESC')->get();
        return view('admin.slider.list_slider')->with(compact('slide'));
    }
    public function add_banner(){
        $this->AuthLogin();
        return view('admin.slider.add_slider');
    }
    public function insert_slider(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $get_image = $request->file('slider_image');

        $path = 'public/upload/slider';
        

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);

            $slider = new Banner();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image; 
            $slider->slider_status = $data['slider_status']; 
            $slider->slider_desc = $data['slider_desc']; 
            $slider->save();

            
            Session::put('message','Thêm slider thành công');
            return Redirect::to('add-banner');
        }else{
            Session::put('message','Vui lòng thêm siler');
            return Redirect::to('add-banner');
        }     

    }
    public function delete_slide(Request $request, $slide_id){
        $this->AuthLogin();
        $slider = Slider::find($slide_id);
        $slider->delete();
        Session::put('message','Xóa slider thành công');
        return redirect()->back();

    }
    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Đã hiện slider sản phẩm');
        return Redirect::to('manage-banner');
    }
    public function unactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','Đã ẩn slider sản phẩm');
        return Redirect::to('manage-banner');
    }
}
