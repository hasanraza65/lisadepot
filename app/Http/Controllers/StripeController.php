<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
use App\Models\User;
use App\Models\ClientPurchase;
use App\Models\Transaction;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth');
        
    }


    public function stripe($id)
    {

        $data = ClientPurchase::where('id',$id)->get();

        return view('stripe.stripe',compact(['data']));
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $purchaseid = $request->purchaseid;
        $totalcost = $request->totalcost;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        //$customer = \Stripe\Customer::create();

        if(Auth::user()->stripe_token == "" || Auth::user()->stripe_token == null){
        
            $customer = \Stripe\Customer::create(array(
                'source'   => $request->stripeToken,
                'email'    => Auth::user()->email,
                'name'     => Auth::user()->name
            ));

            $customertoken = $customer->id;

            $user = User::find(Auth::user()->id);
            $user->stripe_token = $customertoken;
            $user->update();

        }else{

            $customertoken = Auth::user()->stripe_token;
        }

      //  dd($customer); 

      $donepayment = Stripe\Charge::create ([
            
                "amount" => $totalcost * 100,
                "currency" => "USD",
                "customer" => $customertoken,
                "description" => "Payment By Lisadepot"
        ]);

        if($donepayment['status'] == 'succeeded'){

            $today = date('Y-m-d');
            $exp_date = date('Y-m-d', strtotime('+30 days'));

            $purchase = ClientPurchase::find($purchaseid);
            $purchase->payment_status = "Paid";

            if($purchase->package_2_type != "" && $purchase->package_2_type != "monthly"){

            $purchase->package_exp = $exp_date;

            }

            $purchase->update();

            
           
        return back()->withMessage('Payment Done!');

        }else{

            return back()->withMessage('Payment Not Done');
        }
    }

    public function customChargeView(){

        $users = User::where('user_role', 2)
        ->whereNot('stripe_token','')
        ->get();

        return view('admin.chargecustomer.charge',compact(['users']));
    }

    public function chargeCustomer(Request $request){

        $user = User::find($request->user_id);
        $user_stripe_token = $user->stripe_token;
        $totalcost = $request->total_cost;
        $purchaseid = $request->purchase_id;

        //return $request->user_id;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $donepayment = Stripe\Charge::create ([
            
            "amount" => $totalcost * 100,
            "currency" => "USD",
            "customer" => $user_stripe_token,
            "description" => "Charge By Admin"
    ]);

    if($donepayment['status'] == 'succeeded'){

        $today = date('Y-m-d');
        $exp_date = date('Y-m-d', strtotime('+30 days'));


        $clientpurchase = new Transaction();
        $clientpurchase->user_id = $request->user_id;
        $clientpurchase->purchase_id = $purchaseid;
        $clientpurchase->card_last_four = $donepayment['payment_method_details']['card']->last4;
        $clientpurchase->transaction_id = $donepayment['balance_transaction'];
        $clientpurchase->charges = $totalcost;
        $clientpurchase->save();

        
       
    return back()->withMessage('Payment Done!');

    }else{

        return back()->withMessage('Payment Not Done');
    }

    }

    function clientPurchase(Request $request){

        $id =  $request->id;

        $clientpurchase = ClientPurchase::where('user_id', $id)->get();

        return $clientpurchase;

    }
}