<?php

namespace App\Http\Controllers\frontend;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use Session;

class GioHangController extends Controller
{


    public function index()
    {
        return view('frontend.cart-index');
        $product =DB::table('vtho_product')->get();
       return view('index',compact('product'));
    }
    public function AddCart(Request $request ,$id)
    {
        $product =DB::table('vtho_product')->where('id',$id)->first();
        if($product !=null)
        {
            $oldcart = Session('Cart') ? Session('Cart'):null;
            $newcart = new Cart($oldcart);
            $newcart->AddCart($product,$id);

            $request->session()->put('Cart',$newcart);
            // dd(Session('Cart'));
            
           
        }
        // return redirect()->route('giohang.addcart');
        return view('frontend.cart-index',compact('newcart'));

    }

}
