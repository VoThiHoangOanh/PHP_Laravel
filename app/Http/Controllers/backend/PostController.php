<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    #GET: admin/post, admin/post/index
    public function index()
    {
        $list_post = Post::where([['status', '!=', 0], ['type', '=', 'post']])
        ->orderBy('created_at', 'desc')
        ->paginate(9);
        return view('backend.post.index', compact('list_post'));
    }

    #GET:  admin/post/trash
    public function trash()
    {
        $list_post = Post::where([['status', '=', 0], ['type', '=', 'post']])
        ->orderBy('created_at','desc')
        ->get();
        return view('backend.post.trash', compact('list_post'));
    }

    #GET: admin/post/create, admin/post/create
    
    public function create()
    {
        $list_topic= Topic::where('status','!=',0)->get();
        $html_topic_id='';

        foreach($list_topic as $item)
        {
            $html_topic_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return view('backend.post.create',compact('html_topic_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $post=new Post;// tạo mới
        $post->title=$request->title;
        $post->slug= Str::slug($post->title=$request->title,'-');
        $post->type='post';
        $post->detail=$request->detail;
        $post->topic_id=$request->topic_id;
        $post->metakey=$request->metakey;
        $post->metadesc=$request->metadesc;
        $post->status=$request->status;
        $post->created_at=date('Y-m-d H:i:s');
        $post->created_by=1;
        // upload file
        if($request->has('images'))
        {
         $path_dir="public/images/post/";
         $file=$request->file('images');
         $extension = $file->getClientOriginalExtension();
         $filename= $post->slug .'.' . $extension;
         $file->move($path_dir,$filename);
         $post->images=$filename;
         $post->save();
         return redirect()->route('post.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);
        }
        else
        {
            return redirect()->route('post.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Post::find($id);
        if ($post == null){
         return redirect()->route('post.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.post.show',compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post=Post::find($id);
        $list_topic= Topic::where('status','!=',0)->get();
        $html_topic_id='';

        foreach($list_topic as $item)
        {
            $html_topic_id.='<option value="'.$item->id.'">'.$item->title.'</option>';
        }
        return view('backend.post.edit',compact('post','html_topic_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post=Post::find($id);// lấy mẫy tin
        $post->title=$request->title;
        $post->slug= Str::slug($post->title=$request->title,'-');
        $post->detail=$request->detail;
        $post->topic_id=$request->topic_id;
        $post->metakey=$request->metakey;
        $post->metadesc=$request->metadesc;
        $post->updated_at=date('Y-m-d H:i:s');
        $post->updated_by=1;
        $post->status=$request->status;
       //upload file
       if($request->has('images'))
       {
        $path_dir="public/images/post/";
        if(File::exists($path_dir . $post->images))
        {
            File::delete($path_dir . $post->images);
        }
       
        $file= $request->file('images');
        $extension = $file->getClientOriginalExtension();
        $filename= $post->slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $post->images= $filename;
        $post->save();
        return redirect()->route('post.index')->with('message',['type'=>'success','msg'=>'Cập nhật Thành công']);
       }
       else
       {
        return redirect()->route('post.index')->with('message',['type'=>'danger','msg'=>'Cập nhật thất bại']);
       }
    }

     //GET:admin/post/destroy/1
    public function destroy(string $id)
    {
        $post= Post::find($id);
        //lấy ra thông tin tấm hình cần xoá
        $path_dir="public/images/post/";
        $path_image_delete=($path_dir.$post->images);
        //
        if ($post == null){
         return redirect()->route('post.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($post->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','post'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('post.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('post.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/post/status/1
    public function status( string $id)
    {
       $post= Post::find($id);
       if ($post == null){
        return redirect()->route('post.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $post->status=($post->status==1)?2 :1;
        $post->updated_at= date('Y-m-d H:i:s');
        $post->updated_by=1;
        $post->save();
        return redirect()->route('post.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $post= Post::find($id);
       if ($post == null){
        return redirect()->route('post.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $post->status=0;
        $post->updated_at= date('Y-m-d H:i:s');
        $post->updated_by=1;
        $post->save();
        return redirect()->route('post.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/post/restore/1
    public function restore( string $id)
    {
       $post= Post::find($id);
       if ($post == null){
        return redirect()->route('post.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $post->status=2;
        $post->updated_at= date('Y-m-d H:i:s');
        $post->updated_by=1;
        $post->save();
        return redirect()->route('post.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
