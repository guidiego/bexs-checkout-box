<?php
    function bcb_api_init()
    {
        return bcb_create_init(
            'bcbApiPlugin',
            'bcb_api',
            'Checkout Configuration',
            [
                [
                    'name' => 'client_id',
                    'label' => 'Bexs ClientID',
                ],
                [
                    'name' => 'client_secret',
                    'label' => 'Bexs Client Secret',
                ],
                [
                    'name' => 'amount_kind',
                    'label' => 'Select amount type (BRL or Foreign)',
                    'render' => 'bcb_amount_kind_render',
                    'default' => 'BRL',
                ],
                [
                    'name' => 'coin_kind',
                    'label' => 'Coin Prefix',
                    'default' => 'R$',
                ],
                [
                    'name' => 'bexs_api_url',
                    'label' => 'Bexs Client API',
                    'default' => 'https://sandbox.bexs.com.br/v1',
                ],
                [
                    'name' => 'redirect_url',
                    'label' => 'Success Redirect URL',
                ],
                [
                    'name' => 'default_max_installments',
                    'label' => 'Default Max Installments',
                    'default' => '5',
                ],
            ]
        );
    }

    function bcb_api_section_callback()
    {
        echo __( 'Você pode resgatar seu token de API aqui:', 'wordpress' );
    }

    function bcb_amount_kind_render()
    {
        $availableOpts = ['BRL', 'foreign'];
        $pluginSlug = 'bcb_api';
        $fieldName = 'amount_kind';
        $options = get_option($pluginSlug);
        $fieldTotalName = $pluginSlug . '_' . $fieldName;
        $fieldPropName = $pluginSlug . "[" . $fieldTotalName . "]";
        $val = $options[$fieldTotalName];

        ?>
            <select name='<?= $fieldPropName ?>'>
                <?php foreach($availableOpts as $opt) { ?>
                    <option value="<?= $opt ?>" <?php selected($opt, $val); ?>><?= $opt ?></option>
                <?php } ?>
            </select>
        <?php
    }

    function bcb_coin_kind_render()
    {
        ?>
            <select>
                <?php foreach($options as $opt) { ?>
                    <option></option>
                <?php } ?>
            </select>
        <?php
    }

    function bcb_get_api_prop($name)
    {
        return bcb_get_option('bcb_api', $name);
    }

    function bcb_api_options_page()
    {
        return bcb_create_options_page('bcbApiPlugin');
    }