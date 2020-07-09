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

    $dbId = bcbInsertPaymentRegister($_POST);
    $bexsPayment = $api->createPayment($value, $installments, [
        'full_name' => $_POST['name'],
        'national_id' => $_POST['national-id'],
        'email' => $_POST['email'],
    ]);

    if ($bexsPayment['status'] == 'DECLINED_BY_BUSINESS_RULES') {
        $error = 'bexs_user_data';
        return new WP_Error( $error, 'Bexs Api Error', ['status' => 500 ] );
    }

    bcbUpdatePaymentRegister($dbId, $bexsPayment);
    return [
        'redirectURL' => $bexsPayment['redirect_url'],
        'id' => $dbId
    ];
}

function bcb_complete_payment()
{
    $api = new BexsAPI();
    $rest_json = file_get_contents("php://input");
    $_POST = json_decode($rest_json, true);
    $id = $_POST['id'];
    $status = $_POST['status'];

    bcbCompletePayment($id, $status);
    return ['success' => true];
}

add_action('rest_api_init', function () {
    register_rest_route( 'bexs-checkout/v1', '/pay', [
        'methods' => 'POST',
        'callback' => 'bcb_post_payment',
    ]);

    register_rest_route( 'bexs-checkout/v1', '/pay/complete', [
        'methods' => 'PUT',
        'callback' => 'bcb_complete_payment',
    ]);
});