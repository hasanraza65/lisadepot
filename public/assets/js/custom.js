function checkPlanType(val){

    $('#package_price').val("");

    var selectedvalue = val.value;

    if(selectedvalue == "DS Free Plan"){

        $('#package_price').val(0);

    }else if(selectedvalue == "Pro DS Plan"){
        
        $('#package_3_type').addClass('d-none');
        $('#package_2_type').removeClass('d-none');

    }else if(selectedvalue == "Hire a VA"){

        $('#package_2_type').addClass('d-none');
        $('#package_3_type').removeClass('d-none');

    }

}

function setPrice(val){
    var selectedvalue = val.value;
    $('#package_price').val("");

    if(selectedvalue == "monthly"){
        $('.pricediv').show();
        $('#package_price_label').html("Price $ (Monthly)");
        $('#package_price').val(1999);
    }else if(selectedvalue == "equity"){
        $('.pricediv').hide();
    }else if(selectedvalue == "8_hours"){
        $('.pricediv').show();
        $('#package_price_label').html("Price $ (Per Hour)");
        $('#package_price').val(10);
    }else if(selectedvalue == "5_hours"){
        $('.pricediv').show();
        $('#package_price_label').html("Price $ (Per Hour)");
        $('#package_price').val(14);
    }
}

function setPricePerHour(){

    var selectedhours = $('#hours').val();
    var price = 0;

    if(selectedhours <= 4){
        price = 14;
    }else{
        price = 10;
    }

    $('#package_price_label').html("Price $ (Per Hour)");
    $('#package_price').val(price);
}