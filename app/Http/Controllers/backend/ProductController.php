<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productimage;
use App\Models\ProductSale;
use App\Models\ProductStore;


use App\Models\Brand;
use Illuminate\Support\Str;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    #GET: admin/product, admin/product/index
    public function index()
    {
        $list_product = Product :: where('vtho_product.status','!=',0)->orderBy('vtho_product.created_at','desc')
        ->paginate(9);
        return view('backend.product.index', compact('list_product'));
    }

    #GET:  admin/product/trash
    public function trash()
    {
        $list_product = Product :: where('vtho_product.status','=',0)->orderBy('vtho_product.created_at','desc')
        ->get();
        return view('backend.product.trash', compact('list_product'));
    }
    ///////

    #GET: admin/product/create, admin/product/create
    
    public function create()
    {
        $list_category = Category::where('status','!=',0)->get();
        $list_brand = Brand::where('status','!=',0)->get();
        $html_category_id='';
        foreach($list_category as $item)
        {
            $html_category_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        $html_brand_id='';
        foreach($list_brand as $item)
        {
            $html_brand_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }


        return view('backend.product.create',compact('html_category_id','html_brand_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
       $product=new Product;// tạo mới
       $product->category_id=$request->category_id;
       $product->brand_id=$request->brand_id;
       $product->name=$request->name;
       $product->slug= Str::slug($product->name=$request->name,'-');
       $product->price_buy=$request->price_buy;
       $product->detail=$request->detail;
       $product->metakey=$request->metakey;
       $product->metadesc=$request->metadesc;
       $product->created_at=date('Y-m-d H:i:s');
       $product->created_by=1;
       $product->status=$request->status;
       if($product->save()==1)
       {//lưu hình
        if($request->has('image'))
           {
            $path_dir="public/images/product/";
            $array_file=$request->file('image');
            $i=1;
            foreach ($array_file as $file)
            {
                $extension = $file->getClientOriginalExtension();
                $filename= $product->slug . "-". $i . '.' . $extension;
                $file->move($path_dir,$filename);
                $product_image=new Productimage();
                $product_image->product_id = $product->id;
                $product_image->image = $filename;
                $product_image->save();
                $i++;
            }

           }///khuyến mãi
           if(strlen($request->price_sale) && strlen($request->date_begin) && strlen($request->date_end))
           {
            $product_sale= new ProductSale();
            $product_sale->product_id = $product->id;
            $product_sale->price_sale = $request->price_sale;
            $product_sale->date_begin = $request->date_begin;
            $product_sale->date_end = $request->date_end;
            $product_sale->save();
           }
           ////nhập kho
           if(strlen($request->price) && strlen($request->qty))
           {
            $product_store= new ProductStore();
            $product_store->product_id = $product->id;
            $product_store->price = $request->price;
            $product_store->qty = $request->qty;
            $product_store->created_at=date('Y-m-d H:i:s');
            $product_store->created_by=1;
            $product_store->save();
           }

       }  
        
        return redirect()->route('product.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

    }
//////////////////////////////////////////////////////////////
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product= Product::find($id);
        if ($product == null){
         return redirect()->route('product.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.product.show',compact('product'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::find($id);
        $list_category = Category::where('status','!=',0)->get();
        $list_brand = Brand::where('status','!=',0)->get();
        $html_category_id='';
        foreach ($list_category as $item)
         {
            if ($product->category_id == $item->id)
            {
                $html_category_id .= '<option selected value="' . $item->id . '">' . $item->name . '</option>';
            }
            else
            {
                $html_category_id .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        }
        $html_brand_id='';
        foreach($list_brand as $item)
        {
            $html_brand_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return view('backend.product.edit',compact('product','html_category_id','html_brand_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
       $product= Product::find($id);//lấy mẫu tin
       $product->category_id=$request->category_id;
       $product->brand_id=$request->brand_id;
       $product->name=$request->name;
       $product->slug= Str::slug($product->name=$request->name,'-');
       $product->price_buy=$request->price_buy;
       $product->detail=$request->detail;
       $product->metakey=$request->metakey;
       $product->metadesc=$request->metadesc;
       $product->updated_at=date('Y-m-d H:i:s');
       $product->updated_by=1;
       $product->status=$request->status;
       //upload file

       if($product->save()==1)
       {//lưu hình
        if($request->has('image'))
           {
            $path_dir="public/images/product/";
            if(File::exists($path_dir . $product->image))
            {
                File::delete($path_dir . $product->image);
            }
            $array_file=$request->file('image');
            $i=1;
            foreach ($array_file as $file)
            {
                $extension = $file->getClientOriginalExtension();
                $filename= $product->slug . "-". $i . '.' . $extension;
                $file->move($path_dir,$filename);
                $product_image=new Productimage();
                $product_image->product_id = $product->id;
                $product_image->image = $filename;
                $product_image->save();
                $i++;
            }

           }///khuyến mãi
           if(strlen($request->price_sale) && strlen($request->date_begin) && strlen($request->date_end))
           {
            $product_sale= new ProductSale();
            $product_sale->product_id = $product->id;
            $product_sale->price_sale = $request->price_sale;
            $product_sale->date_begin = $request->date_begin;
            $product_sale->date_end = $request->date_end;
            $product_sale->save();
           }
           ////nhập kho
           if(strlen($request->price) && strlen($request->qty))
           {
            $product_store= new ProductStore();
            $product_store->product_id = $product->id;
            $product_store->price = $request->price;
            $product_store->qty = $request->qty;
            $product_store->created_at=date('Y-m-d H:i:s');
            $product_store->created_by=1;
            $product_store->save();
           }

       } 

    //    if($request->has('image'))
    //    {
    //     $path_dir="public/images/product/";
    //     if(File::exists($path_dir . $product->image))
    //     {
    //         File::delete($path_dir . $product->image);
    //     }
       
    //     $file= $request->file('image');
    //     $extension = $file->getClientOriginalExtension();
    //     $filename= $product->slug .'.' . $extension;
    //     $file->move($path_dir, $filename);
    //     $product->image= $filename;
    //    }
       // end upload file

    //    $product->save();
       return redirect()->route('product.index')->with('message',['type'=>'danger','msg'=>'Cập nhật thất bại']);
        
    }
//////
     //GET:admin/product/destroy/1
    public function destroy(string $id)
    {
        $product= Product::find($id);
        //lay ra thông tin tấm hình cần xoá
        $path_dir="public/images/product/";
        $path_image_delete=($path_dir.$product->image);
        //
        if ($product == null){
         return redirect()->route('product.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($product->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }
         return redirect()->route('product.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('product.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/product/status/1
    public function status( string $id)
    {
       $product= Product::find($id);
       if ($product == null){
        return redirect()->route('product.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $product->status=($product->status==1)?2 :1;
        $product->updated_at= date('Y-m-d H:i:s');
        $product->updated_by=1;
        $product->save();
        return redirect()->route('product.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $product= Product::find($id);
       if ($product == null){
        return redirect()->route('product.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $product->status=0;
        $product->updated_at= date('Y-m-d H:i:s');
        $product->updated_by=1;
        $product->save();
        return redirect()->route('product.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/product/restore/1
    public function restore( string $id)
    {
       $product= Product::find($id);
       if ($product == null){
        return redirect()->route('product.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $product->status=2;
        $product->updated_at= date('Y-m-d H:i:s');
        $product->updated_by=1;
        $product->save();
        return redirect()->route('product.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
