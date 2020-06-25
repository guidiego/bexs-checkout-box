<?php
    function bcb_style_init() {
        return bcb_create_init(
            'bcbStylePlugin',
            'bcb_style',
            'Bexs Styles Configuration',
            [
                [
                    'name' => 'ipt_class',
                    'label' => 'Classes adicionada ao input',
                ],
                [
                    'name' => 'title_class',
                    'label' => 'Classe adicionada ao titulo',
                ],
                [
                    'name' => 'desc_class',
                    'label' => 'Classe adicionada a descrição',
                ],
                [
                    'name' => 'box_class',
                    'label' => 'Classe adicionada ao Box',
                ],
                [
                    'name' => 'btn_class',
                    'label' => 'Classe adiconada ao botão',
                ],
                [
                    'name' => 'btn_text',
                    'label' => 'Texto do Botão',
                    'default' => 'Finalizar Compra',
                ],
                [
                    'name' => 'cardnumber_placeholder',
                    'label' => 'Placeholder do cardnumber',
                    'default' => 'Número do Cartão de Crédito',
                ],
                [
                    'name' => 'name_placeholder',
                    'label' => 'Placeholder do name',
                    'default' => 'Nome',
                ],
                [
                    'name' => 'exp_placeholder',
                    'label' => 'Placeholder do exp',
                    'default' => 'Data de Vencimento',
                ],
                [
                    'name' => 'cvv_placeholder',
                    'label' => 'Placeholder do cvv',
                    'default' => 'Código de Segurança',
                ],
            ]
        );
    }

    function bcb_style_section_callback(  ) {
        echo __( 'Aqui você pode configurar os estilos do seu Checkout', 'wordpress' );
    }

    function bcb_get_style_prop($name) {
        return bcb_get_option('bcb_style', $name);
    }

    function bcb_style_options_page() {
        return bcb_create_options_page('bcbStylePlugin');
    }