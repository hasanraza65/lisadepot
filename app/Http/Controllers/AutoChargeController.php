<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPurchase;
use App\Models\ClientAccount;
use App\Models\Service;
use App\Models\Transaction;
use Session;
use Stripe;
use Auth;
use App\Models\User;
use Carbon\Carbon;

class AutoChargeController extends Controller
{
    public function perHourCharge(){

        $checkloop = 0;

        $get_purchases = $hiredva = ClientPurchase::where('plan', 'Hire a VA')
        ->join('users', 'users.id', 'client_purchases.user_id')
        ->select('users.*', 'client_purchases.*', 'client_purchases.id as id', 'users.id as user_id')
        ->get();

        foreach($get_purchases as $data){

            $checkloop = 1;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if($data->stripe_token != "" || $data->stripe_token != null){

                $customertoken = $data->stripe_token;
                $totalcost = $data->package_price*$data->per_day_hours*$data->quantity;

                $donepayment = Stripe\Charge::create ([
            
                    "amount" => $totalcost * 100,
                    "currency" => "GBP",
                    "customer" => $customertoken,
                    "description" => "Payment From Service Provider"

                ]);

                if($donepayment['status'] == 'succeeded'){

                $clientpurchase = new Transaction();
                $clientpurchase->user_id = $data->user_id;
                $clientpurchase->purchase_id = $data->id;
                $clientpurchase->card_last_four = $donepayment['payment_method_details']['card']->last4;
                $clientpurchase->transaction_id = $donepayment['balance_transaction'];
                $clientpurchase->charges = $totalcost;
                $clientpurchase->save();
                
                }else{

                $clientpurchase = new Transaction();
                $clientpurchase->user_id = $data->user_id;
                $clientpurchase->purchase_id = $data->id;
                $clientpurchase->status = "Failed";
                $clientpurchase->charges = $totalcost;
                $clientpurchase->save();

                }

            }

        }

    }

    public function perMonthCharge(){

        $checkloop = 0;

        $get_purchases = $hiredva = ClientPurchase::where('plan', 'Pro DS Plan')
        ->where('package_2_type', 'monthly')
        ->whereDate('package_exp', Carbon::today())
        ->join('users', 'users.id', 'client_purchases.user_id')
        ->select('users.*', 'client_purchases.*', 'client_purchases.id as id', 'users.id as user_id')
        ->get();

        foreach($get_purchases as $data){

            $checkloop = 1;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if($data->stripe_token != "" || $data->stripe_token != null){

                $customertoken = $data->stripe_token;
                $totalcost = $data->package_price;

                $donepayment = Stripe\Charge::create ([
            
                    "amount" => $totalcost * 100,
                    "currency" => "GBP",
                    "customer" => $customertoken,
                    "description" => "Payment From Service Provider"

                ]);

                if($donepayment['status'] == 'succeeded'){

                $clientpurchase = new Transaction();
                $clientpurchase->user_id = $data->user_id;
                $clientpurchase->purchase_id = $data->id;
                $clientpurchase->card_last_four = $donepayment['payment_method_details']['card']->last4;
                $clientpurchase->transaction_id = $donepayment['balance_transaction'];
                $clientpurchase->charges = $totalcost;
                $clientpurchase->save();
                
                }else{

                $clientpurchase = new Transaction();
                $clientpurchase->user_id = $data->user_id;
                $clientpurchase->purchase_id = $data->id;
                $clientpurchase->status = "Failed";
                $clientpurchase->charges = $totalcost;
                $clientpurchase->save();

                }

            }

        }

    }
}
