<?php
    class BCBProduct {
        function __construct($attr)
        {
            $this->value = (float) $attr['value'];
            $this->maxInstallments = (int) $attr['max_installments'];
            $this->name = $attr['product_name'];
            $this->description = $attr['product_description'];
            $this->installmentObj = $this->generateInstallments();
        }

        function generateInstallments()
        {
            $installments = range(1, $this->maxInstallments);
            $installmentsObj = [];

            foreach($installments as $installment) {
                $instVal = round($this->value / $installment, 2);
                $installmentsObj[] = [
                    'label' => "$installment x R$ $instVal",
                    'value' => $installment,
                ];
            }

            return $installmentsObj;
        }
    }

    function bcb_shortcode($attrs)
    {
        $baseAttrs = [
            'value' => 0,
            'max_installments' => (int) bcb_get_default_max_installments(),
        ];

        $product = new BCBProduct(array_merge($baseAttrs, $attrs));

        if (isset($product)) {
            include('form.php');
        }
    }

    add_shortcode("bexs-checkout-box", 'bcb_shortcode');
