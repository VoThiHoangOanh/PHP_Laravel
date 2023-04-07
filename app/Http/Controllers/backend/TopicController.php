<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;
use Illuminate\Support\Facades\File;


class TopicController extends Controller
{
    #GET: admin/topic, admin/topic/index
    public function index()
    {
        $list_topic = Topic::where('status','!=',0)->orderBy('created_at','desc')
        ->paginate(9);
        return view('backend.topic.index', compact('list_topic'));
    }

    #GET:  admin/topic/trash
    public function trash()
    {
        $list_topic = Topic::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.topic.trash', compact('list_topic'));
    }

    #GET: admin/topic/create, admin/topic/create
    
    public function create()
    {
        $list_topic = Topic::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';

        foreach($list_topic as $item)
        {
            $html_parent_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.topic.create',compact('html_parent_id','html_sort_order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(topicStoreRequest $request)
    {
       $topic=new Topic;// tạo mới
       $topic->name=$request->name;
       $topic->slug= Str::slug($topic->name=$request->name,'-');
       $topic->metakey=$request->metakey;
       $topic->metadesc=$request->metadesc;
       $topic->parent_id=$request->parent_id;
       $topic->sort_order=$request->sort_order;
       $topic->created_at=date('Y-m-d H:i:s');
       $topic->created_by=1;
       $topic->status=$request->status;
       // upload file
       if($request->has('image'))
       {
        $path_dir="public/images/topic/";
        $file=$request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $topic->slug .'.' . $extension;
        $file->move($path_dir,$filename);
        $topic->image=$filename;
       }
        // end upload file  
       if($topic->save())//lưu vào csdl
       {
        $link=new Link();
        $link->slug= $topic->slug;
        $link->table_id= $topic->id;
        $link->type='topic';
        $link->save();
        return redirect()->route('topic.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       else
       {
        return redirect()->route('topic.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);

       }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic= Topic::find($id);
        if ($topic == null){
         return redirect()->route('topic.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.topic.show',compact('topic'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $topic=Topic::find($id);
        $list_topic = Topic::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';

        foreach($list_topic as $item)
        {
            $html_parent_id.='<option value="'.$item->id.'">'.$item->name.'</option>';
            $html_sort_order.='<option value="'.$item->sort_order.'">Sau: '.$item->name.'</option>';

        }
        return view('backend.topic.edit',compact('topic','html_parent_id','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicUpdateRequest $request, string $id)
    {
       $topic= Topic::find($id);//lấy mẫu tin
       $topic->name=$request->name;
       $topic->slug= Str::slug($topic->name=$request->name,'-');
       $topic->metakey=$request->metakey;
       $topic->metadesc=$request->metadesc;
       $topic->parent_id=$request->parent_id;
       $topic->sort_order=$request->sort_order;
       $topic->updated_at=date('Y-m-d H:i:s');
       $topic->updated_by=1;
       $topic->status=$request->status;
       //upload file
       if($request->has('image'))
       {
        $path_dir="public/images/topic/";
        if(File::exists($path_dir . $topic->image))
        {
            File::delete($path_dir . $topic->image);
        }
       
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename= $topic->slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $topic->image= $filename;
       }
       // end upload file

       if($topic->save())//lưu vào csdl
       {
        $link= Link::where([['type','=','topic'],['table_id','=',$id]])->first();
        $link->slug= $topic->slug;
        $link->save();
        return redirect()->route('topic.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);

       }
       return redirect()->route('topic.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);
        
    }

     //GET:admin/topic/destroy/1
    public function destroy(string $id)
    {
        $topic= Topic::find($id);
        //lay ra thông tin tấm hình cần xoá
        $path_dir="public/images/topic/";
        $path_image_delete=($path_dir.$topic->image);
        //
        if ($topic == null){
         return redirect()->route('topic.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($topic->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','topic'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('topic.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('topic.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/topic/status/1
    public function status( string $id)
    {
       $topic= Topic::find($id);
       if ($topic == null){
        return redirect()->route('topic.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $topic->status=($topic->status==1)?2 :1;
        $topic->updated_at= date('Y-m-d H:i:s');
        $topic->updated_by=1;
        $topic->save();
        return redirect()->route('topic.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $topic= Topic::find($id);
       if ($topic == null){
        return redirect()->route('topic.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $topic->status=0;
        $topic->updated_at= date('Y-m-d H:i:s');
        $topic->updated_by=1;
        $topic->save();
        return redirect()->route('topic.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/topic/restore/1
    public function restore( string $id)
    {
       $topic= Topic::find($id);
       if ($topic == null){
        return redirect()->route('topic.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $topic->status=2;
        $topic->updated_at= date('Y-m-d H:i:s');
        $topic->updated_by=1;
        $topic->save();
        return redirect()->route('topic.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
