<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
use App\Models\User;
use App\Models\ClientPurchase;
    
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
                "currency" => "GBP",
                "customer" => $customertoken,
                "description" => "test 3"
        ]);

        if($donepayment['status'] == 'succeeded'){

            $today = date('Y-m-d');
            $exp_date = date('Y-m-d', strtotime('+30 days'));

            $purchase = ClientPurchase::find($purchaseid);
            $purchase->payment_status = "Paid";
            $purchase->package_exp = $exp_date;
            $purchase->update();

            
           
        return back()->withMessage('Payment Done!');

        }else{

            return back()->withMessage('Payment Not Done');
        }
    }
}