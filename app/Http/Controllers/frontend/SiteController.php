<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Category;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Topic;


class SiteController extends Controller
{
    public function index($slug=null){
        if($slug==null)
        {
            return $this->home();
        }
        else{
            $link = Link::where('slug','=',$slug)->first();
            if($link!=NULL)
            {
                $type = $link->type; 
                switch($type){
                    case 'brand':{
                        return $this->product_brand($slug);
                        break;
                    }
                    case 'category':{
                        return $this->product_category($slug);
                        break;
                    }
                    case 'topic':{
                        return $this->post_topic($slug);
                        break;
                    }
                    case 'page':{
                        return $this->post_page($slug);
                        break;
                    }
                }
            }
            else
            {
                $product = Product::where([['status','=',1],['slug','=',$slug]])->first();
                if($product!=NULL)
                {
                    // dd($product);
                    return $this->product_detail($product);
                }
                else
                {
                    $post = Post::where([['status','=',1],['slug','=',$slug],['type','=','post']])->first();
                    if($post!=NULL)
                    {
                        // dd($post);
                        return $this->post_detail($post);
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
     
     private function home()
     {
        $list_category= Category::where([['parent_id','=',0],['status','=','1']])->get();

        return view('frontend.home',compact('list_category'));
    }

    private function product_brand($slug)
    {
        $row_brand= Brand::where([['slug','=',$slug],['status','=','1']])->first();
        $product_list= Product::where([['status','=','1'],['brand_id','=',$row_brand->id]])
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view('frontend.product-brand',compact('row_brand','product_list'));
    }
    private function product_category($slug)
    {
        $row_cat= Category::where([['slug','=',$slug],['status','=','1']])->first();
        $list_category_id=array();
        array_push($list_category_id, $row_cat->id);
        //xét cấp con
        $list_category1= Category::where([['parent_id','=',$row_cat->id],['status','=','1']])->get();
        if(count($list_category1) > 0)
        {
            foreach($list_category1 as $row_cat1)
            {
                array_push($list_category_id, $row_cat1->id);

                $list_category2= Category::where([['parent_id','=',$row_cat1->id],['status','=','1']])->get();
                if(count($list_category2) > 0)
                {
                    foreach($list_category2 as $row_cat2)
                    {
                        array_push($list_category_id, $row_cat2->id);

                        $list_category3= Category::where([['parent_id','=',$row_cat2->id],['status','=','1']])->get();
                        if(count($list_category3) > 0)
                        {
                            foreach($list_category3 as $row_cat3)
                            {
                                array_push($list_category_id, $row_cat3->id);
                            }
                        }
                    }
                }

            }
        }
        $product_list= Product::where('status',1)
        ->whereIn('category_id',$list_category_id)
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view('frontend.product-category',compact ('product_list','row_cat') );
    }
    
    private function product_detail($product)
    {
        $list_category_id=array();
        array_push($list_category_id, $product->category_id);
        //xét cấp con
        $list_category1= Category::where([['parent_id','=',$product->category_id],['status','=','1']])->get();
        if(count($list_category1) > 0)
        {
            foreach($list_category1 as $row_cat1)
            {
                array_push($list_category_id, $row_cat1->id);

                $list_category2= Category::where([['parent_id','=',$row_cat1->id],['status','=','1']])->get();
                if(count($list_category2) > 0)
                {
                    foreach($list_category2 as $row_cat2)
                    {
                        array_push($list_category_id, $row_cat2->id);

                        $list_category3= Category::where([['parent_id','=',$row_cat2->id],['status','=','1']])->get();
                        if(count($list_category3) > 0)
                        {
                            foreach($list_category3 as $row_cat3)
                            {
                                array_push($list_category_id, $row_cat3->id);
                            }
                        }
                    }
                }

            }
        }
        $product_list= Product::where([['status','=','1'],['id','!=',$product->id]])
        ->whereIn('category_id',$list_category_id)
        ->orderBy('created_at','desc')
        ->take(9)
        ->get();
        return view('frontend.product-detail',compact('product','product_list'));
    }
    private function post_topic($slug)
    {
        $row_topic= Topic::where([['slug','=',$slug],['status','=','1']])->first();
        $list_topic_id=array();
        array_push($list_topic_id, $row_topic->id);
        //xét cấp con
        $list_topic1= Topic::where([['parent_id','=',$row_topic->id],['status','=','1']])->get();
        if(count($list_topic1) > 0)
        {
            foreach($list_topic1 as $row_topic1)
            {
                array_push($list_topic_id, $row_topic1->id);

                $list_topic2= Topic::where([['parent_id','=',$row_topic1->id],['status','=','1']])->get();
                if(count($list_topic2) > 0)
                {
                    foreach($list_topic2 as $row_topic2)
                    {
                        array_push($list_topic_id, $row_topic2->id);

                        $llist_topic3= Topic::where([['parent_id','=',$row_topic2->id],['status','=','1']])->get();
                        if(count($llist_topic3) > 0)
                        {
                            foreach($llist_topic3 as $row_topic3)
                            {
                                array_push($list_topic_id, $row_topic3->id);
                            }
                        }
                    }
                }

            }
        }
        $post_list= Post::where([['status','=',1],['type','=','post']])
        ->whereIn('topic_id',$list_topic_id)
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view('frontend.post-topic',compact ('post_list','row_topic') );
    }
    private function post_page($slug)
    {
        $agrs= [
            ['status','=','1'],
            ['type','=','page'],
            ['slug','=',$slug]
        ];
        $post=Post::where($agrs)->first();
        return view('frontend.post-page',compact('post'));
    }
    private function post_detail($post)
    {
        $list_topic_id=array();
        array_push($list_topic_id, $post->id);
        
        //xét cấp con
        $list_topic1= Topic::where([['parent_id','=',$post->id],['status','=','1']])->get();
        if(count($list_topic1) > 0)
        {
            foreach($list_topic1 as $row_topic1)
            {
                array_push($list_topic_id, $row_topic1->id);
                $list_topic2= Topic::where([['parent_id','=',$row_topic1->id],['status','=','1']])->get();
                if(count($list_topic2) > 0)
                {
                    foreach($list_topic2 as $row_topic2)
                    {
                        array_push($list_topic_id, $row_topic2->id);

                        $llist_topic3= Topic::where([['parent_id','=',$row_topic2->id],['status','=','1']])->get();
                        if(count($llist_topic3) > 0)
                        {
                            foreach($llist_topic3 as $row_topic3)
                            {
                                array_push($list_topic_id, $row_topic3->id);
                            }
                        }
                    }
                }

            }
        }
        $post_list= Post::where([['status','=',1],['type','=','post'],['id','!=',$post->id]])
        ->whereIn('topic_id',$list_topic_id)
        ->orderBy('created_at','desc')
        ->take(4)
        ->get();
        return view('frontend.post-detail',compact ('post','post_list'));
    }
    private function error_404($slug)
    {
        return view('frontend.404');
    }

    ////tất cả sản phẩm
   public function product()
   {
    
    $product_list= Product::where('status',1)
        ->orderBy('created_at','desc')
        ->paginate(4);
    return view('frontend.product',compact('product_list'));
   }

   ////tất cả thương hiệu
   public function brand()
   {
    $product_list= Product::where('status',1)
        ->orderBy('created_at','desc')
        ->paginate(4);
    return view('frontend.brand',compact('product_list'));
   }

   ////tất cả bài viết
   public function post()
   {
    $post_list= Post::where([['status','=','1'],['type','=','post']])
        ->orderBy('created_at','desc')
        ->paginate(4);
    return view('frontend.post',compact('post_list'));
   }
   public function timkiem(Request $req)
    {
        $product = Product::where('vtho_product.name', 'like', '%' . $req->keywords . '%')
            ->orWhere('price_buy', $req->keywords)
            ->get();
        return view('frontend.timkiem', compact('product'));
    }
}
