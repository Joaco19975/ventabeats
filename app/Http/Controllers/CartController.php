<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function shop()
    {
        $products = Product::all();

     //  dd($products);
        return view('shop')->withTitle('POLITO ECOMMERCE | SHOP')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();

      /*  foreach ($cartCollection as $producto){
            $attributes = $producto['attributes']; // Acceder a la propiedad "attributes" del elemento actual
            // Hacer algo con la variable $attributes, como imprimir sus valores
            echo "NAME:" . $producto['name'];
            echo "Imagen: " . $attributes['image'] . "<br>";
            echo "Audio: " . $attributes['audio'] . "<br>";
            echo "Slug: " . $attributes['slug'] . "<br>";
            echo "Price:" . $producto['price'] . "<br>";
        }*/

      //  dd($cartCollection);
      //return response()->json($cartCollection["attributes"]);
      return view('cart')->withTitle('POLITO ECOMMERCE | CART')->with(['cartCollection' => $cartCollection]);;
    }

    public function checkout(){
        $cartCollection = \Cart::getContent();
        //dd($cartCollection);
        return view('checkout')->withTitle('POLITO ECOMMERCE | CART')->with(['cartCollection' => $cartCollection]);;

    }
    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'Item is removed!');
    }

    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'audio' => $request->audio,
                'slug' => $request->slug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Item Agregado a sú Carrito!');
    }
    
    public function clear(){
        \Cart::clear();
        return redirect()->route('cart.index')->with('success_msg', 'Car is cleared!');
    }

 

}


