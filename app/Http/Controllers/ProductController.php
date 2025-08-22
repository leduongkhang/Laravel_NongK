<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Session;
use App\Http\Requests;
use App\Models\Gallery;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return redirect::to('dashboard');
        }else{
            return redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['meta_keywords'] = $request->product_keywords;
        
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');

        $path = 'public/upload/product/';
        $path_gallery = 'public/upload/gallery/';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);

            $data['product_image'] = $new_image;
            
        }
            $pro_id = DB::table('tbl_product')->insertGetId($data);

            $gallery = new Gallery();
            $gallery->gallery_image = $new_image;
            $gallery->gallery_name = $new_image;
            $gallery->product_id = $pro_id;
            $gallery->save();

            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Đã hiện dạnh mục sản phẩm');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Đã ẩn sản phẩm');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['meta_keywords'] = $request->product_keywords;

        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image) {
                //  Lấy ảnh cũ
                $product = DB::table('tbl_product')->where('product_id', $product_id)->first();
                $gallery = DB::table('tbl_gallery')->where('product_id', $product_id)->first();

                $old_image_path = 'public/upload/product/' . $product->product_image;
                $old_image_path_gallery = $gallery ? 'public/upload/gallery/' . $gallery->gallery_image : '';

                // Xóa ảnh cũ nếu tồn tại
                if ($product->product_image != '' && file_exists($old_image_path)) {
                    unlink($old_image_path);
                }

                if ($gallery && $gallery->gallery_image != '' && file_exists($old_image_path_gallery)) {
                    unlink($old_image_path_gallery);
                }

                $path = 'public/upload/product/';
                $path_gallery = 'public/upload/gallery/';

                // Upload ảnh mới
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();

                $get_image->move($path, $new_image);
                File::copy($path . $new_image, $path_gallery . $new_image);

                $data['product_image'] = $new_image;

                // Cập nhật gallery tương ứng
                if ($gallery) {
                    DB::table('tbl_gallery')->where('product_id', $product_id)->update([
                        'gallery_image' => $new_image,
                        'gallery_name' => $new_image
                    ]);
                } else {
                    // Nếu chưa có gallery, thêm mới
                    $new_gallery = new Gallery();
                    $new_gallery->gallery_image = $new_image;
                    $new_gallery->gallery_name = $new_image;
                    $new_gallery->product_id = $product_id;
                    $new_gallery->save();
                }
            }

            // Cập nhật thông tin sản phẩm
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);

            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');


    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //end admin page

    public function details_product(request $request, $product_id){
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();


        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $detail_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($detail_product as $key => $value){
            $category_id = $value->category_id;

            $product_id = $value->product_id;
        }

        foreach($detail_product as $key => $val){
            //seo
            $meta_desc = $val->product_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->product_name;
            $url_canonical = $request->url();
            //seo
        }

        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get();

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.sanpham.show_detail')->with('category',$cate_product)->with('brand',$brand_product)->with('product_detail',$detail_product)->with('related',$related_product)->with('gallery',$gallery)
        ->with(compact('meta_desc','meta_keywords','meta_title','url_canonical'))->with('slider',$slider);
    }
}
