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
                    'name' => 'modal_mode',
                    'label' => 'Active Modal',
                    'default' => 'false',
                    'render' => 'bcb_modal_mode_render'
                ],
                [
                    'name' => 'modal_position',
                    'label' => 'Modal Position',
                    'default' => 'center',
                    'render' => 'bcb_modal_position_render'
                ],
                [
                    'name' => 'cta_button',
                    'label' => 'CTA Button Text',
                    'default' => 'Buy',
                ],
                [
                    'name' => 'close_modal_button',
                    'label' => 'Modal Close Button Text',
                    'default' => 'Close',
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

    function bcb_modal_mode_render()
    {
        $availableOpts = ['true', 'false'];
        $pluginSlug = 'bcb_style';
        $fieldName = 'modal_mode';
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

    function bcb_modal_position_render()
    {
        $availableOpts = ['center', 'left', 'right'];
        $pluginSlug = 'bcb_style';
        $fieldName = 'modal_position';
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

    function bcb_style_section_callback(  ) {
        echo __( 'Here you are able to change all Box texts, mode and add CSS classes', 'wordpress' );
    }

    function bcb_get_style_prop($name) {
        return bcb_get_option('bcb_style', $name);
    }

    function bcb_style_options_page() {
        return bcb_create_options_page('bcbStylePlugin');
    }