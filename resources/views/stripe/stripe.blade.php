@extends('layout.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Enter Payment Detail</h1>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        <br>
    @endif

<div class="">
    

        <div class="card p-4">


        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" 
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form">



        @csrf

        <div class="">
        Card Holder Name
        <input value="test" type="text" class="form-control" placeholder="Card Holder Name">
        </div>

        <div class="row mt-4">
            <div class="col-md-8">

            Card Number
            <input value="4242424242424242" type="text" autocomplete='off' class='form-control card-number' size='20' placeholder="Card Number">

            </div>
            <div class="col-md-4">

            CSV
            <input value="123" autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>

            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                Card Expiry Month
                <input value="12" class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
            </div>
            <div class="col-md-6">
                Card Expiry Year
                <input value="2024"  class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
            </div>
        </div>

        <div class='mt-4'>
        <div class='col-md-12 error form-group d-none'>
        <div class='alert-danger alert'>Please correct the errors and try
        again.</div>
        </div>

        @foreach($data as $datas)
        @if($datas->package_2_type == 'equity' || $datas->plan == 'Hire a VA')
        
        @php 
            $msg = "You will be charged 1 usd for your debit/credit card verification.";
            $pckgprice = 1;

        @endphp    
        
        @else

        @php 

            $msg = "";
            $pckgprice = $datas->package_price;

        @endphp
        
        @endif

        <input type="hidden" name="totalcost" value="{{$pckgprice}}">
        <input type="hidden" name="purchaseid" value="{{$datas->id}}">
       

        @endforeach

        <div class="mt-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{$pckgprice}})</button>
        <br>
        {{$msg}}
        </div>


            
        </form>

        </div>
        </div>
        <!-- end card -->


</div>




</div>
<!-- /.container-fluid -->


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
var $form         = $(".require-validation");
$('form.require-validation').bind('submit', function(e) {
var $form         = $(".require-validation"),
inputSelector = ['input[type=email]', 'input[type=password]',
'input[type=text]', 'input[type=file]',
'textarea'].join(', '),
$inputs       = $form.find('.required').find(inputSelector),
$errorMessage = $form.find('div.error'),
valid         = true;
$errorMessage.addClass('hide');
$('.has-error').removeClass('has-error');
$inputs.each(function(i, el) {
var $input = $(el);
if ($input.val() === '') {
$input.parent().addClass('has-error');
$errorMessage.removeClass('hide');
e.preventDefault();
}
});
if (!$form.data('cc-on-file')) {
e.preventDefault();
Stripe.setPublishableKey($form.data('stripe-publishable-key'));
Stripe.createToken({
number: $('.card-number').val(),
cvc: $('.card-cvc').val(),
exp_month: $('.card-expiry-month').val(),
exp_year: $('.card-expiry-year').val()
}, stripeResponseHandler);
}
});
function stripeResponseHandler(status, response) {
if (response.error) {
$('.error')
.removeClass('hide')
.find('.alert')
.text(response.error.message);
} else {
/* token contains id, last4, and card type */
var token = response['id'];
$form.find('input[type=text]').empty();
$form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
$form.get(0).submit();
}
}
});
</script>

@endsection 