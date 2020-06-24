<?php
// @TODO: BexsAPI class

function post_payment()
{
    // BexsAPI->createPayment(....);
    return "DO_PAYMENT";
}

add_action('rest_api_init', function () {
    register_rest_route( 'bexs-checkout/v1', '/pay', [
        'methods' => 'POST',
        'callback' => 'post_payment',
    ]);
});