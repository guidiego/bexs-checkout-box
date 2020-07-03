<?php

class BexsAPI {
    function __construct()
    {
        $auth = json_decode(
            wp_remote_retrieve_body(
                wp_remote_post('https://bexs.auth0.com/oauth/token', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode([
                        "client_id" => bcb_get_option('bcb_api', 'client_id'),
                        "client_secret" => bcb_get_option('bcb_api', 'client_secret'),
                        "grant_type" => "client_credentials",
                        "audience" => "https://payments-sandbox/v1/payments"
                    ])
                ])
            ),
            true
        );

        $this->baseUrl = bcb_get_option('bcb_api', 'bexs_api_url');
        $this->authorization = $auth['token_type'] . ' ' . $auth['access_token'];
    }

    function __prepareHeader($data)
    {
        $opts = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->authorization,
            ]
        ];

        if (!empty($data)) {
            $opts['body'] = json_encode($data);
        }

        return $opts;
    }

    function __get($path)
    {
        $opts = $this->__prepareHeader([]);
        $response = wp_remote_get($this->baseUrl . $path, $opts);
        return json_decode(wp_remote_retrieve_body($response), true);
    }

    function __post($path, $data)
    {
        $opts = $this->__prepareHeader($data);
        $response = wp_remote_post($this->baseUrl . $path, $opts);
        return json_decode(wp_remote_retrieve_body($response), true);
    }

    function createPayment($value, $installments, $consumer, $creditCard)
    {
        $amountKind = bcb_get_api_prop('amount_kind');
        $amountKey = $amountKind == 'foreign' ? 'foreign_amount' : 'amount';
        $data = [
            'type' => 'CREDIT_CARD',
            'card_info' => $creditCard,
            'consumer' => $consumer,
            'installments' => (int) $installments,
            $amountKey => (float) $value,
        ];

        return $this->__post('/payments', $data);
    }
}