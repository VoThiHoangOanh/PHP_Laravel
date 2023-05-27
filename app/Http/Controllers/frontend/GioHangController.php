<?php

namespace App\Http\Controllers\frontend;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;


use DB;
use Session;

class GioHangController extends Controller
{


    public function index()
    {
        $product =DB::table('vtho_product')->get();
       return view('index',compact('product'));
    }
    public function AddCart(Request $request ,$id)
    {
        $product =Product::where('id',$id)->first();
        if($product !=null)
        {
            $oldcart = Session('Cart') ? Session('Cart'):null;
            $newcart = new Cart($oldcart);
            $newcart->AddCart($product,$id);

            $request->Session()->put('Cart',$newcart);
            // dd(Session('Cart'));
            return view('frontend.cart');

        }

    }
    public function DeleteCart(Request $request ,$id)
    {
        $oldcart = Session('Cart') ? Session('Cart'):null;
        $newcart = new Cart($oldcart);
        $newcart->DeleteCart($id);

        if(Count( $newcart->products) > 0)
        {
            $request->Session()->put('Cart', $newcart);
        }
        else
        {
            $request->Session()->forget('Cart');
        }

        return view('frontend.cart');

    }

    

    public function ListCart()
    {
        return view('frontend.cart-index');

    }

    public function DeleteListCart(Request $request ,$id)
    {
        $oldcart = Session('Cart') ? Session('Cart'):null;
        $newcart = new Cart($oldcart);
        $newcart->DeleteCart($id);

        if(Count( $newcart->products) > 0)
        {
            $request->Session()->put('Cart', $newcart);
        }
        else
        {
            $request->Session()->forget('Cart');
        }

        return view('frontend.list-cart');

    }

    public function SaveListCart(Request $request ,$id,$qty)
    {
        
        $oldcart = Session('Cart') ? Session('Cart'):null;
        $newcart = new Cart($oldcart);
        $newcart->UpdateCart($id,$qty);
        $request->Session()->put('Cart', $newcart);

        return view('frontend.list-cart');

    }


    public function SaveAllCart(Request $request )
    {
        foreach ($request->data as $item)
        {
            $oldcart = Session('Cart') ? Session('Cart'):null;
            $newcart = new Cart($oldcart);
            $newcart->UpdateCart( $item["key"],  $item["value"]);
            $request->Session()->put('Cart', $newcart);
        }
    }

    public function DeleteAllCart(Request $request )
    {
        foreach ($request->data as $item)
        {
            $oldcart = Session('Cart') ? Session('Cart'):null;
            $newcart = new Cart($oldcart);
            $newcart->DeleteCart($item["key"],  $item["value"]);

            if(Count( $newcart->products) > 0)
                {
                    $request->Session()->put('Cart', $newcart);
                }
            else
                {
                    $request->Session()->forget('Cart');
                }

        }
    }

    public function Checkout()
    {
       return view('frontend.checkout');
    }

    public function PostCheckout(Request $request)
    {
        $newcart =Session::get('Cart');
        $order= new Order;
        // $order->user_id= $user->id;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->email=$request->email;
        $order->address=$request->address;
        $order->note=$request->note;
        $order->created_at= date('Y-m-d H:i:s');
        $order->updated_at= date('Y-m-d H:i:s');

        $order->status=1;
        $order->save();

        foreach($newcart->products as $key=>$value){
            $orderdetail=new OrderDetail;
            $orderdetail->order_id=$order->id;
            $orderdetail->product_id=$key;  //$value['productinfo']['id']
            $orderdetail->price=$value['productinfo']->price_buy;
            $orderdetail->qty=$value['qty'];
            $orderdetail->amount=(int)$value['qty']*(int)$value['productinfo']->price_buy;
            $orderdetail->save();

        }

        Session::forget('Cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');

    }


}
