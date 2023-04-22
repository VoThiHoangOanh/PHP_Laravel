<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    #GET: admin/brand, admin/brand/index
    public function index()
    {
        $list_brand = Brand::where('status','!=',0)->orderBy('created_at','desc')
        ->paginate(9);
        return view('backend.brand.index', compact('list_brand'));
    }

    #GET:  admin/brand/trash
    public function trash()
    {
        $list_brand = Brand::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.brand.trash', compact('list_brand'));
    }

    #GET: admin/brand/create, admin/brand/create
    
    public function create()
    {
        $list_brand = Brand::where('status','!=',0)->get();
        $html_sort_order='';

        foreach($list_brand as $item)
        {
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.brand.create',compact('html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
       $brand=new Brand;// tạo mới
       $brand->name=$request->name;
       $brand->slug= Str::slug($brand->name=$request->name,'-');
       $brand->metakey=$request->metakey;
       $brand->metadesc=$request->metadesc;
       $brand->sort_order=$request->sort_order;
       $brand->created_at=date('Y-m-d H:i:s');
       $brand->created_by=1;
       $brand->status=$request->status;
       // upload file
       if($request->has('image'))
       {
        $path_dir="public/images/brand/";
        $file=$request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $brand->slug .'.' . $extension;
        $file->move($path_dir,$filename);
        $brand->image=$filename;
       }
        // end upload file  
       if($brand->save())//lưu vào csdl
       {
        $link=new Link();
        $link->slug= $brand->slug;
        $link->table_id= $brand->id;
        $link->type='brand';
        $link->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       else
       {
        return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);

       }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand= Brand::find($id);
        if ($brand == null){
         return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.brand.show',compact('brand'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand=Brand::find($id);
        $list_brand = Brand::where('status','!=',0)->get();
        $html_sort_order='';

        foreach($list_brand as $item)
        {
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.brand.edit',compact('brand','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, string $id)
    {
       $brand= Brand::find($id);//lấy mẫu tin
       $brand->name=$request->name;
       $brand->slug= Str::slug($brand->name=$request->name,'-');
       $brand->metakey=$request->metakey;
       $brand->metadesc=$request->metadesc;
       $brand->sort_order=$request->sort_order;
       $brand->updated_at=date('Y-m-d H:i:s');
       $brand->updated_by=1;
       $brand->status=$request->status;
       //upload file
       if($request->has('image'))
       {
        $path_dir="public/images/brand/";
        if(File::exists($path_dir . $brand->image))
        {
            File::delete($path_dir . $brand->image);
        }
       
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $brand->slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $brand->image= $filename;
       }
       // end upload file

       if($brand->save())//lưu vào csdl
       {
        $link= Link::where([['type','=','brand'],['table_id','=',$id]])->first();
        $link->slug= $brand->slug;
        $link->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Cập nhật Thành công']);

       }
       return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Cập nhập thất bại']);
        
    }

     //GET:admin/brand/destroy/1
    public function destroy(string $id)
    {
        $brand= Brand::find($id);
        //lay ra thông tin tấm hình cần xoá
        $path_dir="public/images/brand/";
        $path_image_delete=($path_dir.$brand->image);
        //
        if ($brand == null){
         return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($brand->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','brand'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('brand.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/brand/status/1
    public function status( string $id)
    {
       $brand= Brand::find($id);
       if ($brand == null){
        return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $brand->status=($brand->status==1)?2 :1;
        $brand->updated_at= date('Y-m-d H:i:s');
        $brand->updated_by=1;
        $brand->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $brand= Brand::find($id);
       if ($brand == null){
        return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $brand->status=0;
        $brand->updated_at= date('Y-m-d H:i:s');
        $brand->updated_by=1;
        $brand->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/brand/restore/1
    public function restore( string $id)
    {
       $brand= Brand::find($id);
       if ($brand == null){
        return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $brand->status=2;
        $brand->updated_at= date('Y-m-d H:i:s');
        $brand->updated_by=1;
        $brand->save();
        return redirect()->route('brand.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
