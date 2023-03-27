<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Post;

class SiteController extends Controller
{
    public function index($slug=null){
        if($slug==null)
        {
            return $this->home();
        }
        else{
            $link = Link::where('slug','=',$slug)->first();
            // if($product==null)
            // {
            //     $product=Product:: where([['status','=','1'],['slug','=','$slug']])->first();
            // }
            if($link!=NULL)
            {
                $type = $link->type; 
                switch($type){
                    case 'brand':{
                        $this->product_brand($slug);
                        break;
                    }
                    case 'category':{
                        $this->product_category($slug);
                        break;
                    }
                    case 'topic':{
                        $this->post_topic($slug);
                        break;
                    }
                    case 'page':{
                        $this->post_page($slug);
                        break;
                    }
                }
            }
            else
            {
                $product = Product::where([['status','=',1],['slug','=',$slug]])->first();
                if($product!=NULL)
                {
                    $this->product_detail($product);
                }
                else
                {
                    $post = Post::where([['status','=',1],['slug','=',$slug],['type','=','post']])->first();
                    if($post!=NULL)
                    {
                        $this->post_detail($post);
                    }
                    else
                    {
                       return $this->error_404($slug);
                    }
                }
            }
        }
    }
    
     //trang chủ
     
     private function home(){
        return view('frontend.home');
    }
    private function product_brand()
    {
        return view('frontend.product-brand');
    }
    private function product_category()
    {
        return view('frontend.product-category');
    }
    private function product_detail($product)
    {
        return view('frontend.product-detail');
    }
    private function post_topic()
    {
        return view('frontend.post-topic');
    }
    private function post_page()
    {
        return view('frontend.post-page');
    }
    private function post_detail($post)
    {
        return view('frontend.post-detail');
    }
    private function error_404($slug)
    {
        return view('frontend.404');
    }

   
}
