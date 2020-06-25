<?php
    function bcb_style_init() {
        return bcb_create_init(
            'bcbStylePlugin',
            'bcb_style',
            'Bexs Styles Configuration',
            [
                [
                    'name' => 'some_class',
                    'label' => 'Some class etc',
                ],
            ]
        );
    }

    function bcb_style_section_callback(  ) {
        echo __( 'Aqui você pode configurar os estilos do seu Checkout', 'wordpress' );
    }

    function bcb_style_options_page() {
        return bcb_create_options_page('bcbStylePlugin');
    }