<style>
    .bcb-form {
        background: #fff;
        padding: 40px;
    }

    .bcb-row::after {
        content: " ";
        display: block;
        clear: both;
    }

    .bcb-form > .bcb-form-title {
        margin: 0;
        padding: 0;
        text-align: center;
        color: #00df91;
    }

    .bcb-form .bcb-form-description {
        margin: 0 0 20px;
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #4c5867;
    }

    .bcb-form-input {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        position: relative;
        height: 42px;
        border-bottom: solid 1px #c9c9c9;
        margin-bottom: 45px;
    }

    .bcb-form-input input {
        position: absolute;
        display: block;
        width: 100%;
        height: 22px;
        bottom: 0px;
        left: 0px;
        border: none;
        outline: none;
        background-color: transparent;
        font-size: 17px;
        color: #3c3c3c;
        z-index: 1;
        padding: 0;
    }

    .bcb-form-input span {
        position: absolute;
        display: block;
        height: auto;
        top: 15px;
        font-size: 17px;
        color: #c9c9c9;
        text-align: left;
        white-space: nowrap;
        cursor: text;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        z-index: 5;
    }

    .bcb-form-input input:not(:placeholder-shown) + span,
    .bcb-form-input input:focus + span {
        top: 0px;
        font-size: 13px;
    }

    .bcb-form-input input ~ .highlight {
        position: absolute;
        left: 0;
        bottom: -1px;
        background: #4bde95;
        width: 100%;
        max-width: 0%;
        height: 1px;
        transition: .5s;
    }

    .bcb-form-input input:focus ~ .highlight {
        max-width: 100%;
        transition: .5s;
    }

    .input-national, .input-installments { float: left; width: 49%; }
    .input-installments { margin-left: 2%; }

    .input-installments select {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        bottom: 0px;
        opacity: 0;
        z-index: 3;
        cursor: pointer;
    }

    .bpc-fake-select {
        font-size: 17px;
        color: #3c3c3c;
        bottom: 0;
        position: absolute;
        left: 1px;
        z-index: 1;
    }

    .bcb-btn {
        display: inline-block;
        padding: 16px 80px;
        max-width: 100%;
        min-height: 50px;
        font-family: 'sf-pro-text', Verdana, Geneva, Tahoma, sans-serif;
        font-size: 17px;
        font-weight: 600;
        color: #fff;
        background-color: #4bde95!important;
        border: 2px solid #4bde95;
        border-radius: 10px;
        box-sizing: border-box;
        cursor: pointer;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        text-transform: uppercase;
        color: #FFF;
        margin: 0 auto;
        display: block;
    }

    .bcb-btn:focus {
        outline: none;
    }

    .bcb-btn.bcb-btn-load {
        position: relative;
    }

    .bcb-btn.bcb-btn-load::before {
        content: " ";
        position: absolute;
        top: -3px;
        left: -3px;
        bottom: -3px;
        right: -3px;
        z-index: 1;
        cursor: no-drop;
        background: rgba(255, 255, 255, 0.3);
    }

    .bcb-wrap {
        min-width: 500px;
        min-height: 300px;
        background: #FFF;
    }

    .bcb-wrap > div {
        box-shadow: 0 0.5em 1em -0.125em rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.02);
        max-width: 580px;
        width: 100%;
        margin: 0 auto;
    }

    .bcb-modal {
        position: fixed;
        overflow: scroll;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.6);
        max-width: 100%!important;
        width: 100%!important;
        padding: 100px 50px 0;
        z-index: 10;
        margin: 0;
        z-index: 100000;
        display: none;
    }

    .bcb-modal > form {
        max-width: 700px;
        margin: 0 auto;
        width: 95%;
    }

    .bcb-modal-open {
        display: block;
    }

    .bcb-modal-left > div,
    .bcb-modal-right > div {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        border-radius: 0;
    }

    .bcb-modal-left > div > .bcb-form,
    .bcb-modal-right > div > .bcb-form {
        height: 100%;
    }

    .bcb-modal-right > div {
        right: 0;
    }

    .bcb-modal-left > div {
        left: 0;
    }

    .bcb-modal-open-cta {
        margin: 0 auto 25px;
    }

    .bcb-alert {
        background: #ffefef;
        border-radius: 3px;
        border: 1px solid #9c0d0d;
        color: #9c0d0d;
        margin-bottom: 15px;
        text-align: center;
        padding: 5px 10px;
        font-size: 16px;
        display: none;
    }

    .bcb-alert.show {
        display: block;
    }

    .bcb-header {
        background: #4bde95;
        padding: 40px 90px;
    }

    .bcb-steps {
        display: block;
        text-align: right;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #FFF;
        font-size: 13px;
        margin-bottom: 45px;
    }

    .bcb-title {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: 20px;
        color: #FFF;
        font-weight: bold;
        max-width: 300px;
        margin: 0 auto;
        display: flex;
    }

    .bcb-icon {
        width: 50px;
        height: 50px;
    }

    .bcb-final-alert {
        background: #FFF;
        text-align: center;
        padding: 40px;
        font-size: 22px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .bcb-corner-btn {
        background: transparent!important;
        position: absolute!important;
        top: 100px!important;
        font-family: Verdana, Geneva, Tahoma, sans-serif!important;
        text-transform: lowercase;
    }

    #bcbStep2, #bcbStep3 {
        display: none;
    }
</style>

<?php $inputClass = 'bcb-form-input' ?>
<?php $isModal = bcb_get_style_prop('modal_mode') == 'true' ?>
<?php if ($isModal) { ?>
    <button type="button" class="bcb-btn bcb-modal-open-cta">
        <?= bcb_get_style_prop('cta_button') ?>
    </button>
<?php } ?>
<div class="bcb-wrap <?= $isModal ? 'bcb-modal' : '' ?> <?= $isModal ? 'bcb-modal-' . bcb_get_style_prop('modal_position') : '' ?>">
    <div id="bcbStep1">
        <div class="bcb-header">
            <p class="bcb-steps">
                <b>Etapa 1</b> de 3
            </p>
            <div class="bcb-title">
                <div class="bcb-icon">
                </div>
                <div>
                    Informe os dados do comprador
                </div>
            </div>
        </div>
        <form class="bcb-form <?= bcb_get_style_prop('box_class') ?>">
            <label class="<?= $inputClass ?>">
                <input required placeholder=" " name="email" autocomplete="email" type="email">
                <span><?= bcb_get_style_prop('email_placeholder') ?></span>
                <div class="highlight"></div>
            </label>
            <label class="<?= $inputClass ?>">
                <input required placeholder=" " name="name" autocomplete="name">
                <span><?= bcb_get_style_prop('name_placeholder') ?></span>
                <div class="highlight"></div>
            </label>
            <div class="bcb-row">
                <label class="<?= $inputClass ?> input-national">
                    <input required placeholder=" " name="national-id" data-mask="^[0-9]\d{0,12}$" data-regex>
                    <span><?= bcb_get_style_prop('national_id_placeholder') ?></span>
                    <div class="highlight"></div>
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
            <button type="submit" class="bcb-form-btn bcb-btn <?= bcb_get_style_prop('btn_class') ?>">
                <?= bcb_get_style_prop('btn_text') ?>
            </button>
        </form>
    </div>
    <div id="bcbStep2"></div>
    <div id="bcbStep3">
        <div class="bcb-final-alert">
            Seu pagamento foi confirmado e está sendo processado! Obrigado pela preferencia!
            <div class="bcb-btn bcb-modal-close">
               Fechar
            </div>
        </div>
    </div>

    <?php if ($isModal) { ?>
        <button type="button" class="bcb-corner-btn bcb-modal-close">X</button>
    <?php } ?>
</div>

<script src="https://unpkg.com/imask" async></script>
<script src="https://apis.bexs.com.br/v1/lib/checkout-bexs.js" async></script>
<script>
    document.body.onload = function () {
        document.querySelectorAll('[data-mask]').forEach((el) => {
            const mask = el.dataset.regex !== "" ? el.dataset.mask : new RegExp(el.dataset.mask);
            IMask(el, { mask });
        });

        document.querySelector('.input-installments > select').onchange = function () {
            const opt = this.querySelector(`option[value="${this.value}"]`);
            document.querySelector('.bpc-fake-select').textContent = opt.textContent;
        }

    <?php if ($isModal) { ?>
        const resetModal = () => {
            const step2 = document.getElementById('bcbStep2');

            document.querySelector('.bcb-modal').classList.remove('bcb-modal-open');
            document.getElementById('bcbStep1').style.display = 'block';
            document.getElementById('bcbStep3').style.display = 'none';

            step2.innerHTML = '';
            step2.style.display = 'none';
        }

        document.querySelector('.bcb-modal-open-cta').addEventListener('click', function () {
            document.querySelector('.bcb-modal').classList.add('bcb-modal-open');
        });

        document.querySelector('.bcb-modal').addEventListener('click', () => resetModal());
        document.querySelector('.bcb-modal .bcb-modal-close').addEventListener('click', () => resetModal());

        document.querySelector('.bcb-modal form').addEventListener('click', function (event) {
            event.stopPropagation();
        });
    <?php } ?>
        ALERT_TEXTS = {
            'bexs_user_data': "<?= bcb_get_style_prop('consumer_data_error') ?>",
            'bexs_credit_card': "<?= bcb_get_style_prop('issuer_error') ?>",
        };

        document.querySelector('.bcb-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const loadClass = 'bcb-btn-load';
            const btn = document.querySelector('.bcb-form-btn')
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
                const createOptions = {
                    method: 'POST',
                    body: JSON.stringify(form),
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                };

                const updateOptions = (id, status) => ({
                    method: 'PUT',
                    body: JSON.stringify({ id, status }),
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                });

                const completeStatus = (id, status, callback = () => {}) => () => fetch(
                    '/?rest_route=/bexs-checkout/v1/pay/complete',
                    updateOptions(id, status)
                ).then(callback);

                const onSuccess = (d) => {
                    window.CheckoutBexs(d.redirectURL, 'bcbStep2', {
                        paymentSuccess: completeStatus(d.id, 1, () => {
                            document.getElementById('bcbStep2').style.display = 'none';
                            document.getElementById('bcbStep3').style.display = 'block';
                        }),
                        paymentFail: completeStatus(d.id, 2),
                        iframeFallback: completeStatus(d.id, 2),
                        changeOrder: () => {
                            window.location = "/";
                        }
                    });

                    btn.classList.toggle(loadClass);
                    document.getElementById('bcbStep1').style.display = 'none';
                    document.getElementById('bcbStep2').style.display = 'block';
                }

                const onFail = (d) => {
                    const alert = document.querySelector('.bcb-alert');
                    alert.classList.add('show');
                    alert.textContent = ALERT_TEXTS[d.code];
                    btn.classList.toggle(loadClass);
                }

                const handleResponse = (response) => {
                    return response.json().then((data) => {
                        if (response.ok) {
                            onSuccess(data);
                        }

                        onFail(data);
                    });
                }

                fetch('/?rest_route=/bexs-checkout/v1/pay', createOptions)
                    .then(handleResponse)
            }
        });
    }
</script>