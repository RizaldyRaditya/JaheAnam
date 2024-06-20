<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Produk::find($request->id);

        if($product == null){
            return response()->json([
                $status => false,
                $message => 'Record not found'
            ]);
        }

        if (Cart::count() > 0){
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach($cartContent as $item){
                if($item->id == $product->id){
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false){
                Cart::add($product->id, $product->nama, 1, $product->harga, ['gambar' => $product->gambar, 'stok' => $product->stok]);
                $status = true;
                $message = $product->name.' added in cart';
            } else {
                $status = false;
                $message = $product->name.' already added in cart';
            }
        } else {
            Cart::add($product->id, $product->nama, 1, $product->harga, ['gambar' => $product->gambar, 'stok' => $product->stok]);
            $status = true;
            $message = $product->name.' added in cart';
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart(){
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        return view('cart', $data);
    }

    public function updateCart(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Produk::find($itemInfo->id);
        if($qty <= $product->stok){
            Cart::update($rowId, $qty);
            $message = 'Cart Updated Successfully';
            $status = true;
        } else {
            $message = 'Requested quantity ('.$qty.') is not available in stock.';
            $status = false;
        }

        session()->flash('success', $message);

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request){
        $itemInfo = Cart::get($request->rowId);
        if($itemInfo == null){
            $errorMessage = 'Item no found in cart';
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item removed from cart successfully';
        session()->flash('error', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function checkout(){
        if(Cart::count() == 0){
            return redirect()->route('cart');
        }
        return view('checkout');
    }

    public function processCheckout(Request $request){
        $validator = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'notelp' => 'required|max:12',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kodepos' => 'required|max:5',
        ]);

        $user =  Auth::user();

        $subTotal = Cart::subtotal(2, '.', '');

        $order = new Order;
        $order->user_id = $user->id;
        $order->subtotal = $subTotal;

        $order->nama = $request->nama;
        $order->email = $request->email;
        $order->alamat = $request->alamat;
        $order->notelp = $request->notelp;
        $order->kota = $request->kota;
        $order->kecamatan = $request->kecamatan;
        $order->kodepos = $request->kodepos;
        $order->metode = $request->paymentMethod;
        $order->save();

        foreach(Cart::content() as $item){
            $orderItem = new OrderItem;
            $orderItem->produk_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->total = $item->price*$item->qty;
            $orderItem->save();

            $produkData = Produk::find($item->id);
            $currentQty = $produkData->stok;
            $updateQty = $currentQty-$item->qty;
            $produkData->stok = $updateQty;
            $produkData->save();
        }
        
        session()->flash('success', 'you have successfully placed order');
        Cart::destroy();

        return response()->json([
            "message" => "place order success",
            'status' => true
        ]);
    }

    public function processCheckoutTransfer(Request $request){
        $orderId = $request->order_id;
        $order = Order::find($orderId);
        // Pastikan pesanan ditemukan
        if(!$order){
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }
    
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $uniqueOrderId = $order->id . '_' . time();

        // Menyiapkan parameter transaksi Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $uniqueOrderId, // Menggunakan ID pesanan yang diterima
                'gross_amount' => $order->subtotal,
            ),
            'customer_details' => array(
                'first_name' => $order->nama,
                'email' => $order->email,
                'phone' => $order->notelp,
            ),
        );

        // Mendapatkan Snap Token dengan parameter yang sesuai
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken,
        ]);
    }

    public function updatePaymentStatus(Request $request){
        $orderId = $request->order_id;
        $order = Order::find($orderId);
    
        if(!$order){
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }
    
        // Ubah status pembayaran menjadi 'paid'
        $order->payment_status = 'paid';
        $order->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Payment status updated successfully'
        ]);
    }
    
    
    

}
