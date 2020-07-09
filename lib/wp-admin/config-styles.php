<?php
    function bcb_style_init() {
        return bcb_create_init(
            'bcbStylePlugin',
            'bcb_style',
            'Component Style',
            [
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
                    'name' => 'first_step_modal_title',
                    'label' => 'The consumer information modal title',
                    'default' => 'Consumer information',
                ],
                [
                    'name' => 'close_modal_button',
                    'label' => 'Success close button text',
                    'default' => 'Close',
                ],
                [
                    'name' => 'btn_text',
                    'label' => 'First modal button text',
                    'default' => 'Next',
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
                    'name' => 'name_placeholder',
                    'label' => "name's field placeholder",
                    'default' => 'Full Name',
                ],
                [
                    'name' => 'consumer_data_error',
                    'label' => "Message when user inform a invalid personal data",
                    'default' => 'Ops! We found some problems with your personal data (E-mail, National ID or Name), check it out!',
                ],
            ]
        );
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