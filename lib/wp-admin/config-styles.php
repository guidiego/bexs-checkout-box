<?php
    function bcb_style_init() {
        return bcb_create_init(
            'bcbStylePlugin',
            'bcb_style',
            'Component Style',
            [
                [
                    'name' => 'ipt_class',
                    'label' => 'CSS class to be added on input',
                ],
                [
                    'name' => 'title_class',
                    'label' => 'CSS class to be added on title',
                ],
                [
                    'name' => 'desc_class',
                    'label' => 'CSS class to be added on description',
                ],
                [
                    'name' => 'box_class',
                    'label' => 'CSS class to be added on Box',
                ],
                [
                    'name' => 'btn_class',
                    'label' => 'CSS class to be added on Button',
                ],
                [
                    'name' => 'btn_text',
                    'label' => 'Button Text',
                    'default' => 'Finish Payment',
                ],
                [
                    'name' => 'email_placeholder',
                    'label' => "email's field placeholder",
                    'default' => 'Email',
                ],
                [
                    'name' => 'national_id_placeholder',
                    'label' => "nationalId's field placeholder",
                    'default' => 'National ID',
                ],
                [
                    'name' => 'cardnumber_placeholder',
                    'label' => "cardnumber's field placeholder",
                    'default' => 'Credit Card Number',
                ],
                [
                    'name' => 'name_placeholder',
                    'label' => "name's field placeholder",
                    'default' => 'Name in Credit Card',
                ],
                [
                    'name' => 'exp_placeholder',
                    'label' => "exp's field placeholder",
                    'default' => 'Expire Date',
                ],
                [
                    'name' => 'cvv_placeholder',
                    'label' => "cvv's field placeholder",
                    'default' => 'Security Code',
                ],
            ]
        );
    }

    function bcb_style_section_callback(  ) {
        echo __( 'Here you are able to change all Box texts, mode and add CSS classes', 'wordpress' );
    }

    function bcb_get_style_prop($name) {
        return bcb_get_option('bcb_style', $name);
    }

    function bcb_style_options_page() {
        return bcb_create_options_page('bcbStylePlugin');
    }