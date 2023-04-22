<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    #GET: admin/user, admin/user/index
    public function index()
    {
        $list_user = User::where([['roles', '=', 'admin'],['status', '!=', 0] ])
        ->paginate(9);
        return view('backend.user.index', compact('list_user'));
    }

    #GET:  admin/user/trash
    public function trash()
    {
        $list_user = User::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.user.trash', compact('list_user'));
    }

    #GET: admin/user/create, admin/user/create
    
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
       $user=new User;// tạo mới
       $user->name=$request->name;
       $user->username=$request->username;
       $user->phone=$request->phone;
       $user->roles='admin';
       $user->password=$request->password;
       $user->email=$request->email;
       $user->gender=$request->gender;
       $slug= Str::slug($user->name=$request->name,'-');
       $user->created_at=date('Y-m-d H:i:s');
       $user->created_by=1;
       $user->status=$request->status;
       // upload file
       if($request->has('image'))
       {
        $path_dir="public/images/user/";
        $file=$request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename=$slug .'.' . $extension;
        $file->move($path_dir,$filename);
        $user->image=$filename;
        $user->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);
       }       
       else{
        return redirect()->route('user.index')->with('message',['type'=>'danger','msg'=>'Thêm thất bại']);
       }
      

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user= User::find($id);
        if ($user == null){
         return redirect()->route('user.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.user.show',compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
       $user= User::find($id);//lấy mẫu tin
       $user->name=$request->name;
       $user->username=$request->username;
       $user->phone=$request->phone;
       $user->password=$request->password;
       $user->email=$request->email;
       $user->gender=$request->gender;
       $slug= Str::slug($user->name=$request->name,'-');
       $user->updated_at=date('Y-m-d H:i:s');
       $user->updated_by=1;
       $user->status=$request->status;
       //upload file
       if($request->has('image'))
       {
        $path_dir="public/images/user/";
        if(File::exists($path_dir . $user->image))
        {
            File::delete($path_dir . $user->image);
        }
       
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename=$slug .'.' . $extension;
        $file->move($path_dir, $filename);
        $user->image= $filename;
        $user->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','msg'=>'Cập nhật Thành công']);
       }
       // end upload file
        
    }

     //GET:admin/user/destroy/1
    public function destroy(string $id)
    {
        $user= User::find($id);
        //lấy ra thông tin tấm hình cần xoá
        $path_dir="public/images/user/";
        $path_image_delete=($path_dir.$user->image);
        //
        if ($user == null){
         return redirect()->route('user.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($user->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }
            if( $link= Link::where([['type','=','user'],['table_id','=',$id]])->first())
            {
                $link->delete();
            }
         return redirect()->route('user.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
         return redirect()->route('user.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/user/status/1
    public function status( string $id)
    {
       $user= User::find($id);
       if ($user == null){
        return redirect()->route('user.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $user->status=($user->status==1)?2 :1;
        $user->updated_at= date('Y-m-d H:i:s');
        $user->updated_by=1;
        $user->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $user= User::find($id);
       if ($user == null){
        return redirect()->route('user.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $user->status=0;
        $user->updated_at= date('Y-m-d H:i:s');
        $user->updated_by=1;
        $user->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/user/restore/1
    public function restore( string $id)
    {
       $user= User::find($id);
       if ($user == null){
        return redirect()->route('user.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $user->status=2;
        $user->updated_at= date('Y-m-d H:i:s');
        $user->updated_by=1;
        $user->save();
        return redirect()->route('user.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
