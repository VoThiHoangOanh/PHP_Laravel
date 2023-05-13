<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    #GET: admin/category, admin/category/index
    public function index()
    {
        $list_category = Category::where('status','!=',0)
        ->orderBy('created_at','desc')
        ->search()
        ->paginate(5);
        return view('backend.category.index', compact('list_category'));
    }

    #GET:  admin/category/trash
    public function trash()
    {
        $list_category = Category::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.category.trash', compact('list_category'));
    }

    #GET: admin/category/create, admin/category/create
    
    public function create()
    {
        $list_category = Category::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';

        foreach($list_category as $item)
        {
            $html_parent_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.category.create',compact('html_parent_id','html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
       $category=new Category;// tạo mới
       $category->name=$request->name;
       $category->slug= Str::slug($category->name=$request->name,'-');
       $category->metakey=$request->metakey;
       $category->metadesc=$request->metadesc;
       $category->parent_id=$request->parent_id;
       $category->sort_order=$request->sort_order;
       $category->created_at=date('Y-m-d H:i:s');
       $category->created_by=1;
       $category->status=$request->status;
       // upload file
       if($request->has('image'))
       {
        $path_dir="public/images/category/";
        $file=$request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $category->slug .'.' . $extension;
        $file->move($path_dir,$filename);
        $category->image=$filename;
       }
        // end upload file  
       if($category->save())//lưu vào csdl
       {
        $link=new Link();
        $link->slug= $category->slug;
        $link->table_id= $category->id;
        $link->type='category';
        $link->save();
        return redirect()->route('category.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       return redirect()->route('category.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category= Category::find($id);
        if ($category == null){
         return redirect()->route('category.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.category.show',compact('category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);
        $list_category = Category::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';

        foreach($list_category as $item)
        {
            $html_parent_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.category.edit',compact('category','html_parent_id','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
       $category= Category::find($id);//lấy mẫu tin
       $category->name=$request->name;
       $category->slug= Str::slug($category->name=$request->name,'-');
       $category->metakey=$request->metakey;
       $category->metadesc=$request->metadesc;
       $category->parent_id=$request->parent_id;
       $category->sort_order=$request->sort_order;
       $category->updated_at=date('Y-m-d H:i:s');
       $category->updated_by=1;
       $category->status=$request->status;
       //upload file
       if($request->has('image'))
       {
        $path_dir="public/images/category/";
        if(File::exists($path_dir . $category->image))
        {
            File::delete($path_dir . $category->image);
        }
       
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $category->slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $category->image= $filename;
       }
       // end upload file

       if($category->save())//lưu vào csdl
       {
        $link= Link::where([['type','=','category'],['table_id','=',$id]])->first();
        $link->slug= $category->slug;
        $link->save();
        return redirect()->route('category.index')->with('message',['type'=>'success','msg'=>'Cập nhật Thành công']);

       }
       return redirect()->route('category.index')->with('message',['type'=>'danger','msg'=>'Cập nhật thất bại']);
        
    }

     //GET:admin/category/destroy/1
    public function destroy(string $id)
    {
        $category= Category::find($id);
        //lấy ra thông tin tấm hình cần xoá
        $path_dir="public/images/category/";
        $path_image_delete=($path_dir.$category->image);
        //
        if ($category == null){
         return redirect()->route('category.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($category->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','category'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('category.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('category.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/category/status/1
    public function status( string $id)
    {
       $category= Category::find($id);
       if ($category == null){
        return redirect()->route('category.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $category->status=($category->status==1)?2 :1;
        $category->updated_at= date('Y-m-d H:i:s');
        $category->updated_by=1;
        $category->save();
        return redirect()->route('category.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $category= Category::find($id);
       if ($category == null){
        return redirect()->route('category.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $category->status=0;
        $category->updated_at= date('Y-m-d H:i:s');
        $category->updated_by=1;
        $category->save();
        return redirect()->route('category.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/category/restore/1
    public function restore( string $id)
    {
       $category= Category::find($id);
       if ($category == null){
        return redirect()->route('category.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $category->status=2;
        $category->updated_at= date('Y-m-d H:i:s');
        $category->updated_by=1;
        $category->save();
        return redirect()->route('category.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
