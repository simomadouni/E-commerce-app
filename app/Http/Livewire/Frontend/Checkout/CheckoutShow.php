<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\Orderitem;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts,$totalProductAmount=0;

    public $fullname,$email,$phone,$pincode,$address,$payement_mode=NULL,$payement_id=NULL;

    public function rules()
    {
        return[
            'fullname' =>'required|string|max:121',
            'email' =>'required|email|max:121',
            'phone' =>'required|string|max:11|min:10',
            'pincode' =>'required|string|max:6|min:6',
            'address' =>'required|string|max:500'
        ];
    }
    public function placeOrder()
    {
         $this->validate();
        $order = Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=> 'Mdn-'.Str::random(10),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payement_mode'=>$this->payement_mode,
            'payement_id'=>$this->payement_id,
        ]);
        foreach ($this->carts as $cartItem){
            $orderItens = Orderitem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product_id,
                'product_color_id'=> $cartItem->product_color_id,
                'quantity'=>$cartItem->quantity,
                'price'=> $cartItem->product->selling_price

            ]);
            if($cartItem->product_color_id !=NULL){
                $cartItem ->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem ->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
          }
          return $order;
    }

    public function codOrder()
    {
        $this->payement_mode ='Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('message',[
                'text'=>'Order Placed Success',
                'type'=>'success',
                'status'=> 200
            ]);
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something is wrang',
                'type'=>'error',
                'status'=> 500
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($this->carts as $cartItem){
          $this->totalProductAmount +=  $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
