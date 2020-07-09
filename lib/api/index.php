<?php
// @TODO: BexsAPI class

include_once('bexs.php');

function bcb_post_payment()
{
    $api = new BexsAPI();
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);
    $value = $_POST['value'];
    $installments = $_POST['installments'];

    // $dbId = bcbInsertPaymentRegister($_POST);
    $bexsPayment = $api->createPayment($value, $installments, [
        'full_name' => $_POST['name'],
        'national_id' => $_POST['national-id'],
        'email' => $_POST['email'],
    ]);

    if ($bexsPayment['status'] == 'DECLINED_BY_BUSINESS_RULES') {
        $error = 'bexs_user_data';
        return new WP_Error( $error, 'Bexs Api Error', ['status' => 500 ] );
    }

    return ['redirectURL' => $bexsPayment['redirect_url']];
}

add_action('rest_api_init', function () {
    register_rest_route( 'bexs-checkout/v1', '/pay', [
        'methods' => 'POST',
        'callback' => 'bcb_post_payment',
    ]);
});