<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use Illuminate\Support\Facades\File;


class PageController extends Controller
{
    #GET: admin/page, admin/page/index
    public function index()
    {
        $list_page = Post::where([['status', '!=', 0], ['type', '=', 'page']])
        ->orderBy('created_at', 'desc')
        ->paginate(9);
        return view('backend.page.index', compact('list_page'));
    }

    #GET:  admin/page/trash
    public function trash()
    {
        $list_page = Post::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.page.trash', compact('list_page'));
    }

    #GET: admin/page/create, admin/page/create
    
    public function create()
    {
        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
       $page=new Post;// tạo mới
       $page->title=$request->title;
       $page->slug= Str::slug($page->title=$request->title,'-');
       $page->type='page';
       $page->detail=$request->detail;
       $page->metakey=$request->metakey;
       $page->metadesc=$request->metadesc;
       $page->status=$request->status;
       $page->created_at=date('Y-m-d H:i:s');
       $page->created_by=1;
       // upload file
       if($request->has('images'))
       {
        $path_dir="public/images/page/";
        $file=$request->file('images');
        $extension = $file->getClientOriginalExtension();
        $filename= $page->slug .'.' . $extension;
        $file->move($path_dir,$filename);
        $page->images=$filename;
       }
        // end upload file  
       if($page->save())//lưu vào csdl
       {
        $link=new Link();
        $link->slug= $page->slug;
        $link->table_id= $page->id;
        $link->type='page';
        $link->save();
        return redirect()->route('page.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       return redirect()->route('page.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page= Post::find($id);
        if ($page == null){
         return redirect()->route('page.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.page.show',compact('page'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page=Post::find($id);
        $list_page = Post::where('status','!=',0)->get();
        return view('backend.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, string $id)
    {
       $page= Post::find($id);//lấy mẫu tin
       $page->title=$request->title;
       $page->detail=$request->detail;
       $page->slug= Str::slug($page->title=$request->title,'-');
       $page->metakey=$request->metakey;
       $page->metadesc=$request->metadesc;
       $page->updated_at=date('Y-m-d H:i:s');
       $page->updated_by=1;
       $page->status=$request->status;
       //upload file
       if($request->has('images'))
       {
        $path_dir="public/images/page/";
        if(File::exists($path_dir . $page->images))
        {
            File::delete($path_dir . $page->images);
        }
       
        $file= $request->file('images');
        $extension = $file->getClientOriginalExtension();
        $filename= $page->slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $page->images= $filename;
       }
       // end upload file

       if($page->save())//lưu vào csdl
       {
        $link= Link::where([['type','=','page'],['table_id','=',$id]])->first();
        $link->slug= $page->slug;
        $link->save();
        return redirect()->route('page.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       return redirect()->route('page.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);
        
    }

     //GET:admin/page/destroy/1
    public function destroy(string $id)
    {
        $page= Post::find($id);
        //lấy ra thông tin tấm hình cần xoá
        $path_dir="public/images/page/";
        $path_image_delete=($path_dir.$page->images);
        //
        if ($page == null){
         return redirect()->route('page.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($page->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','page'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('page.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('page.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/page/status/1
    public function status( string $id)
    {
       $page= Post::find($id);
       if ($page == null){
        return redirect()->route('page.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $page->status=($page->status==1)?2 :1;
        $page->updated_at= date('Y-m-d H:i:s');
        $page->updated_by=1;
        $page->save();
        return redirect()->route('page.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $page= Post::find($id);
       if ($page == null){
        return redirect()->route('page.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $page->status=0;
        $page->updated_at= date('Y-m-d H:i:s');
        $page->updated_by=1;
        $page->save();
        return redirect()->route('page.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/page/restore/1
    public function restore( string $id)
    {
       $page= Post::find($id);
       if ($page == null){
        return redirect()->route('page.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $page->status=2;
        $page->updated_at= date('Y-m-d H:i:s');
        $page->updated_by=1;
        $page->save();
        return redirect()->route('page.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
