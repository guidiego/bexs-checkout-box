<?php
    class BCBPayment {
        function __construct($attr)
        {
            $value = (float) $attr['value'];

            if (isset($attr['tax'])) {
                $this->tax = (float) $attr['tax'];
                $value += $this->tax;
            }

            $this->value = $value;
            $this->maxInstallments = (int) $attr['max_installments'];
            $this->title = $attr['title'];
            $this->description = $attr['description'];
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
            'max_installments' => (int) bcb_get_api_prop('default_max_installments'),
        ];

        $payment = new BCBPayment(array_merge($baseAttrs, $attrs));

        if (isset($payment)) {
            include('form.php');
        }
    }

    add_shortcode("bexs-checkout-box", 'bcb_shortcode');
