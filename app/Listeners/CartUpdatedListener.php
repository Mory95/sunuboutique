<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if(request()->session()->has('coupon')){

            $couponCode = session()->get('coupon')['code'];

            $coupon = Coupon::whereCode($couponCode)->first();
            session()->put('coupon', [
                'code' => $coupon->code,
                'remise' => $coupon->remise(Cart::subtotal()),
            ]);
        }

    }
}
