<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Link;
use Illuminate\Support\Str;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    #GET: admin/order, admin/order/index
    public function index()
    {
        $list_order = Order ::
        join('vtho_orderdetail','vtho_orderdetail.order_id','=','vtho_order.id')
        ->join('vtho_user','vtho_user.id','=','vtho_order.user_id')
        ->orderBy('vtho_order.created_at','desc')
        ->paginate(9);
        return view('backend.order.index', compact('list_order'));

    }

    #GET:  admin/order/trash
    public function trash()
    {
        $list_order = Order::where('status','=',0)->orderBy('created_at','desc')->get();
        return view('backend.order.trash', compact('list_order'));
    }

    #GET: admin/order/create, admin/order/create
    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order= Order::find($id);
        if ($order == null){
         return redirect()->route('order.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }
        else 
        {
            return view('backend.order.show',compact('order'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_order = Order ::where('vtho_order.id','=',$id)
        ->join('vtho_orderdetail','vtho_orderdetail.order_id','=','vtho_order.id')
        ->join('vtho_user','vtho_user.id','=','vtho_order.user_id')
        ->orderBy('vtho_order.created_at','desc')
        ->first();
        return view('backend.order.edit',compact('list_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, string $id)
    {
       $order= Order::find($id);//lấy mẫu tin
       $order->name=$request->name;
       $slug= Str::slug($order->name=$request->name,'-');
       $order->phone=$request->phone;
       $email->phone=$request->email;
       $order->updated_at=date('Y-m-d H:i:s');
       $order->updated_by=1;
       $order->status=$request->status;
       $order->save();
       return redirect()->route('order.index')->with('message',['type'=>'success','msg'=>'Thêm Thành công']);
    }

     //GET:admin/order/destroy/1
    public function destroy(string $id)
    {
        $order= Order::find($id);
        //lấy ra thông tin tấm hình cần xoá
        $path_dir="public/images/order/";
        $path_image_delete=($path_dir.$order->image);
        //
        if ($order == null){
         return redirect()->route('order.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
 
        }

        if($order->delete())//lưu vào csdl
        {
            if(File::exists($path_image_delete))
            {
                File::delete($path_image_delete);
            }

         $link= Link::where([['type','=','order'],['table_id','=',$id]])->first();
         $link->delete();
         return redirect()->route('order.trash')->with('message',['type'=>'success','msg'=>'Xoá Thành công']);
 
        }
       
         return redirect()->route('order.trash')->with('message',['type'=>'danger','msg'=>'Xoá không thành công']);

    }

    //GET:admin/order/status/1
    public function status( string $id)
    {
       $order= Order::find($id);
       if ($order == null){
        return redirect()->route('order.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $order->status=($order->status==1)?2 :1;
        $order->updated_at= date('Y-m-d H:i:s');
        $order->updated_by=1;
        $order->save();
        return redirect()->route('order.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công']);
    }


    //GET:admin/delete/delete/1
    public function delete( string $id)
    {
       $order= Order::find($id);
       if ($order == null){
        return redirect()->route('order.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $order->status=0;
        $order->updated_at= date('Y-m-d H:i:s');
        $order->updated_by=1;
        $order->save();
        return redirect()->route('order.index')->with('message',['type'=>'success','msg'=>'Xoá vào thùng rác thành công']);
    }
    //GET:admin/order/restore/1
    public function restore( string $id)
    {
       $order= Order::find($id);
       if ($order == null){
        return redirect()->route('order.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);

       }
       $order->status=2;
        $order->updated_at= date('Y-m-d H:i:s');
        $order->updated_by=1;
        $order->save();
        return redirect()->route('order.trash')->with('message',['type'=>'success','msg'=>'Khôi phục thành công']);
    }
   
    
}
