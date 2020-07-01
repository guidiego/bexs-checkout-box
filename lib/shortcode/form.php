<style>
    .bpc-form {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
    }

    .bcp-row::after {
        content: " ";
        display: block;
        clear: both;
    }

    .bpc-form > .bpc-form-title {
        margin: 0 0 20px;
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #4c5867;
        color: #00df91;
    }

    .bpc-form .bpc-form-input {
        position: relative;
    }

    .bpc-form .bpc-form-input > span {
        display: block;
        position: relative;
        width: 1px;
        height: 1px;
        overflow: hidden;
    }

    .bpc-form .bpc-form-input > input,
    .bpc-form .bpc-form-input > .bpc-fake-select {
        border: 1px solid #d2dae1;
        color: #384554;
        background-color: #fff;
        width: 100%;
        margin-bottom: 10px;
        line-height: 40px;
        padding: 0 10px;
        max-width: 100%;
        font-family: "Inter var", -apple-system, BlinkMacSystemFont, "Helvetica Neue", Helvetica, sans-serif;
    }

    .bpc-form .bpc-form-input > input:focus {
        outline: none;
        border-color: #00df91;
    }

    .bpc-form .bpc-form-input select {
        position: absolute;
        top: 0;
        bottom: 0;
        opacity: 0;
        width: 100%;
    }

    .bpc-form .bpc-form-input select:focus + .bpc-fake-select {
        border-color: #00df91;
    }

    .input-datev, .input-cv, .input-installments { float: left; width: 30%; }
    .input-cv { margin: 0 2% }
    .input-installments { width: 36% }

    .bpc-form > .bpc-form-btn {
        background: #00df91;
        width: 100%;
    }

    .bpc-form > .bpc-form-btn:focus {
        outline: none;
    }

    .bpc-form > .bpc-form-btn.bcb-btn-load {
        position: relative;
    }

    .bpc-form > .bpc-form-btn.bcb-btn-load::before {
        content: " ";
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.3);
    }
</style>

<?php $inputClass = 'bpc-form-input ' . bcb_get_style_prop('desc_class') ?>
<form class="bpc-form <?= bcb_get_style_prop('box_class') ?>">
    <h3 class="bpc-form-title <?= bcb_get_style_prop('title_class') ?>">
        <?= $payment->title ?>
    </h3>
    <div class="bpc-form-description <?= bcb_get_style_prop('desc_class') ?>">
        <?= $payment->description ?>
    </div>
    <label class="<?= $inputClass ?>">
        <span><?= bcb_get_style_prop('email_placeholder') ?></span>
        <input placeholder="<?= bcb_get_style_prop('email_placeholder') ?>" name="email" autocomplete="email">
    </label>
    <label class="<?= $inputClass ?>">
        <span><?= bcb_get_style_prop('national_id_placeholder') ?></span>
        <input placeholder="<?= bcb_get_style_prop('national_id_placeholder') ?>" name="national-id">
    </label>
    <label class="<?= $inputClass ?>">
        <span>Número do Cartão de Crédito</span>
        <input placeholder="<?= bcb_get_style_prop('cardnumber_placeholder') ?>" name="cardnumber" autocomplete="cc-number">
    </label>
    <label class="<?= $inputClass ?>">
        <span>Nome</span>
        <input placeholder="<?= bcb_get_style_prop('name_placeholder') ?>" name="ccname" autocomplete="cc-name">
    </label>
    <div class="bcp-row">
        <label class="<?= $inputClass ?> input-datev">
            <span>Data de Vencimento</span>
            <input placeholder="<?= bcb_get_style_prop('exp_placeholder') ?>" name="cc-exp" autocomplete="cc-exp">
        </label>
        <label class="<?= $inputClass ?> input-cv">
            <span>Código de Segurança</span>
            <input placeholder="<?= bcb_get_style_prop('cvv_placeholder') ?>" name="cvc" autocomplete="cc-csc">
        </label>
        <input type="hidden" name="value" value="<?= $payment->value ?>">
        <label class="<?= $inputClass ?> input-installments">
            <select name="installments">
                <?php
                    foreach ($payment->installmentObj as $installment) { ?>
                        <option value="<?=$installment['value']?>"><?=$installment['label']?></option>
                    <?php }
                ?>
            </select>
            <div class="bpc-fake-select">
                <?= $payment->installmentObj[0]['label'] ?>
            </div>
        </label>
    </div>
    <button type="submit" class="bpc-form-btn <?= bcb_get_style_prop('btn_class') ?>">
        <?= bcb_get_style_prop('btn_text') ?>
    </button>
</form>

<script>
    document.body.onload = function () {

        document.querySelector('.bpc-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const loadClass = 'bcb-btn-load';
            const btn = document.querySelector('.bpc-form-btn')
            const form = Array
                .from(e.target.elements)
                .reduce((prev, el) => ({
                    ...prev, [el.name]: el.value,
                }), {
                    "value":  "<?= $payment->value ?>",
                });

            if (btn.classList.contains(loadClass)) {
                return;
            }

            btn.classList.toggle(loadClass);

            if ('fetch' in window ){
                const options = {
                    method: 'POST',
                    body: JSON.stringify(form),
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                };

                const onSuccess = (d) => {
                    window.location.href = "<?= bcb_get_api_prop('redirect_url') ?>"
                }

                fetch('/?rest_route=/bexs-checkout/v1/pay', options)
                    .then((response) => response.json())
                    .then(onSuccess)
                    .catch(() => btn.classList.toggle(loadClass))
            }
        });
    }
</script>