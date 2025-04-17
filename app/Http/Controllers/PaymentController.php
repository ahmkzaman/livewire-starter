<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $tran_id = "test" . rand(111111, 999999);
        $currrency = "BDT";
        $amount = 100;
        $store_id = "aamarpaytest";
        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";
        $url = "https://​sandbox​.aamarpay.com/jsonpost.php";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://​sandbox​.aamarpay.com/jsonpost.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "store_id": "aamarpaytest",
    "tran_id": "' . uniqid('test_') . '",
    "success_url": "' . route('success') . '",
    "fail_url": "http://www.merchantdomain.com/failedpage.html",
    "cancel_url": "http://www.merchantdomain.com/cancellpage.html",
    "amount": "10.0",
    "currency": "BDT",
    "signature_key": "dbb74894e82415a2f7ff0ec3a97e4183",
    "desc": "Merchant Registration Payment",
    "cus_name": "Name",
    "cus_email": "payer@merchantcusomter.com",
    "cus_add1": "House B-158 Road 22",
    "cus_add2": "Mohakhali DOHS",
    "cus_city": "Dhaka",
    "cus_state": "Dhaka",
    "cus_postcode": "1206",
    "cus_country": "Bangladesh",
    "cus_phone": "+8801704",
    "type": "json"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $responseObj = json_decode($response);

        if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {
            $paymentUrl = $responseObj->payment_url;
            return redirect()->away($paymentUrl);
        } else {
            echo $response;
        }
    }

    public function success(Request $request)
    {
        $request_id = $request->mer_txnid;

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public function fail(Request $request)
    {
        return $request;
    }
    public function cancel(Request $request)
    {
        return 'cancelled';
    }
}
