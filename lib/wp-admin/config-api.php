<?php
    function bcb_api_init() {
        return bcb_create_init(
            'bcbApiPlugin',
            'bcb_api',
            'Bexs API Configuration',
            [
                [
                    'name' => 'auth_token',
                    'label' => 'Bexs Authorization Token',
                ],
            ]
        );
    }

    function bcb_api_auth_token_render() {
        echo bcb_create_text_input('bcb_api', 'auth_token');
    }

    function bcb_api_section_callback(  ) {
        echo __( 'Você pode resgatar seu token de API aqui:', 'wordpress' );
    }

    function bcb_api_options_page() {
        return bcb_create_options_page('bcbApiPlugin');
    }