<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{
    //
    function index(){
        $data =  Product::all();

        return view('product',['products'=>$data]);
    } 
    function detail($id)
    {
        $data =  Product :: find($id);
        return view ('detail',['product'=>$data]);
    }
    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
           $cart= new Cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->save();
           return redirect('/');

        }
        else
        {
            return redirect('/login');
        }
    }
   static function cartItem()
   {
       if(Session::has('user')){
     $userId=Session::get('user')['id'];
    return Cart::where('user_id',$userId)->count();
       }
    }
    function cartList()
    {
        if(Session::has('user')){
        $userId=Session::get('user')['id'];
       $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();

        return view('cartlist',['products'=>$products]);
        }
        else
        {
            return redirect('/login');
        }
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }

}
