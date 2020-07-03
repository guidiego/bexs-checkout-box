<?php
// @TODO: BexsAPI class

include_once('bexs.php');

function post_payment()
{
    $api = new BexsAPI();
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);
    $value = $_POST['value'];
    $installments = $_POST['installments'];
    $expDateParts = explode('/', $_POST['cc-exp']);
    $bexsPayment = $api->createPayment($value, $installments, [
        'full_name' => $_POST['ccname'],
        'national_id' => $_POST['national-id'],
        'email' => $_POST['email'],
    ], [
        'number' => str_replace(' ', '', $_POST['cardnumber']),
        'card_holder_name' => $_POST['ccname'],
        'cvv' => $_POST['cvc'],
        'expiration_month' => $expDateParts[0],
        'expiration_year' => $expDateParts[1],
    ]);

    if ($bexsPayment['status'] == 'AUTHORIZED') {
        $dbId = bcbInsertPaymentRegister($_POST, $bexsPayment);
        return ['code' => $dbId];
    }

    return $bexsPayment;
}

add_action('rest_api_init', function () {
    register_rest_route( 'bexs-checkout/v1', '/pay', [
        'methods' => 'POST',
        'callback' => 'post_payment',
    ]);
});