<?php
    function bcb_admin_menu_setup()
    {
        add_menu_page( 'Bexs Checkout Box', 'Bexs Checkout ', 'manage_options', 'bex-checkout', 'bcb_api_options_page', 'dashicons-cart');
        add_submenu_page('bex-checkout', 'Component Styles', 'Component Styles', 'manage_options', 'component-styles', 'bcb_style_options_page');
        add_submenu_page('bex-checkout', 'Payment History', 'Payment History', 'manage_options', 'payment-history', 'bexsPaymentPage' );
    }

    function bcb_create_options_page($pluginName)
    {
        ?>
        <style>
            .bcb-config-form {
                background: #FFF;
                padding: 20px 40px;
                margin-top: 20px;
                border-radius: 5px;
                box-shadow: 0 0.5em 1em -0.125em rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.02);
                max-width: 620px;
                width: 100%;
            }

            .bcb-config-form h2 {
                color: #00df91;
                font-size: 30px;
                margin-bottom: 10px;
            };
        </style>
        <form class="bcb-config-form" action='options.php' method='post'>
            <?php
            settings_fields($pluginName);
            do_settings_sections($pluginName);
            submit_button();
            ?>
        </form>
        <?php
    }

    function bcb_create_init($pluginName, $pluginSlug, $pageName, $pluginFields)
    {
        register_setting($pluginName, $pluginSlug);
        add_settings_section(
            $pluginSlug . '_' . $pluginName . '_section',
            __($pageName, 'wordpress'),
            $pluginSlug . '_section_callback',
            $pluginName
        );

        foreach ($pluginFields as $field)
        {
            $optName = $pluginSlug . '_' . $field['name'];
            add_settings_field(
                $optName,
                __($field['label'], 'wordpress' ),
                array_key_exists("render", $field) ? $field['render'] : bcb_create_text_input($pluginSlug, $field['name']),
                $pluginName,
                $pluginSlug . '_' . $pluginName . '_section'
            );

            if (array_key_exists("default", $field) && empty($_POST)) {
                $options = get_option($pluginSlug);

                if (!$options[$optName]) {
                    $options[$optName] = $field['default'];
                }

                update_option($pluginSlug, $options);
            }
        }
    }

    function bcb_get_option($pluginSlug, $key) {
        $options = get_option($pluginSlug);
        $optionName = $pluginSlug . '_' . $key;
        return $options[$optionName];
    }

    function bcb_create_text_input($pluginSlug, $fieldName)
    {
        return function () use ($pluginSlug, $fieldName) {
            $options = get_option($pluginSlug);
            $fieldTotalName = $pluginSlug . '_' . $fieldName;
            $fieldPropName = $pluginSlug . "[" . $fieldTotalName . "]";
            $val = $options[$fieldTotalName];
            $inputString = "<input type='text' name='$fieldPropName' value='$val' />";
            echo $inputString;
        };
    }

    include_once('config-api.php');
    include_once('config-styles.php');
    include_once('bexs-payments.php');

    add_action( 'admin_menu', 'bcb_admin_menu_setup' );
    add_action( 'admin_init', 'bcb_api_init' );
    add_action( 'admin_init', 'bcb_style_init' );
