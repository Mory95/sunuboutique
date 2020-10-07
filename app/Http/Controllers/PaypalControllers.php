<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;
use App\Models\Produit;
use App\Models\Commande;
use DateTime;

class PaypalControllers extends Controller
{
    public function handlePayment()
    {     
        $invoiceId = uniqid();
        $product = $this->cartData($invoiceId);


        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $token = $request->token;
        $PayerID = $request->PayerID;

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($token);

        $invoiceId = $response['INVNUM'] ?? uniqid();
        $product = $this->cartData($invoiceId);

        $response = $paypalModule->doExpressCheckoutPayment($product, $token, $PayerID);
        // dd($response);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // dd('Payment was successfull. The payment success page goes here!');
            if(Cart::count() <=0 )
            {
                messageflash("Désolé votre panier est vide.", "warning");
                return back();
            }

            if($this->checkIfNotAvailable()){
                messageflash("Un produit de votre panier n'est plus disponible en la quantité indoqué.", "error");
                return back();
            }
            $commande = new Commande();
            if(request()->session()->has('coupon')){
                $montantTotal = (Cart::subtotal() - request()->session()->get('coupon')['remise']) +
                ( (Cart::subtotal() - request()->session()->get('coupon')['remise']) *
                    (config('cart.tax') / 100) );
            }else{
                $montantTotal = Cart::Total();
            }
            $produits = [];
            $i = 0;

            foreach (Cart::content() as $prod){
                $produits['produit_'.$i][] = $prod->model->libelle;
                $produits['produit_'.$i][] = $prod->model->prix;
                $produits['produit_'.$i][] = $prod->qty;
                $i++;
            }
            $commande->produits = serialize($produits);
            $commande->moyen_paiement = "PayPal";
            $commande->montant_commande = $montantTotal;
            $commande->date_commande = (new DateTime())
            ->format('Y-m-d H-i-s');
            
            // dd('cool');
            $commande->id_user = Auth::user()->id;
            $commande->save();
            $this->updateStock();
            Cart::destroy();
            if (request()->session()->has('coupon')) {
                session()->forget('coupon');
                // dd('cool');
            }
            messageflash("Paiement effectué avec succé.", "success");
            return redirect()->route('prod');

        }

        dd('Error occured!');
    }


    protected function cartData($invoiceId)
    {
        $product = [];
        $product['items'] = [];
        foreach (Cart::content() as $prod){
            $itemsDetails = [
                'name' => $prod->name,
                'price' => round(($prod->price/655),2),
                'desc'  => $prod->model->description,
                'qty' => $prod->qty,
            ];
            $product['items'][] = $itemsDetails;
        }

        $product['invoice_id'] = $invoiceId;
        $product['invoice_description'] = "Commande de ".Auth::user()->name;
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');

        $total = 0;
        foreach ($product['items'] as $t) {
            $total += $t['price']*$t['qty'];
        }
        $product['total'] = $total;

        return $product;
    }


    private function updateStock(){

        foreach (Cart::content() as $item){
            $produit = Produit::find($item->model->id);
            $produit->update(['qte_stock' => $produit->qte_stock - $item->qty]);
        }
    }
    private function checkIfNotAvailable(){

        foreach (Cart::content() as $item){
            $produit = Produit::find($item->model->id);

            if($produit->qte_stock < $item->qty){
                return true;
            }
        }
        return false;
    }

}
