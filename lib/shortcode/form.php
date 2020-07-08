<style>
    .bcb-form {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
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

    .bcb-form .bcb-form-input {
        position: relative;
    }

    .bcb-form .bcb-form-input > span {
        display: block;
        position: relative;
        width: 1px;
        height: 1px;
        overflow: hidden;
    }

    .bcb-form .bcb-form-input > input,
    .bcb-form .bcb-form-input > .bpc-fake-select {
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

    .bcb-form .bcb-form-input > input:focus {
        outline: none;
        border-color: #00df91;
    }

    .bcb-form .bcb-form-input select {
        position: absolute;
        top: 0;
        bottom: 0;
        opacity: 0;
        width: 100%;
    }

    .bcb-form .bcb-form-input select:focus + .bpc-fake-select {
        border-color: #00df91;
    }

    .input-datev, .input-cv, .input-installments { float: left; width: 30%; }
    .input-cv { margin: 0 2% }
    .input-installments { width: 36% }

    .bcb-btn {
        background: #00df91!important;
        width: 100%;
        text-align: center;
        color: #FFF;
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
        top: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.3);
    }

    .bcb-modal {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5);
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

    .bcb-modal-left > form,
    .bcb-modal-right > form {
        position: absolute;
        top: 0;
        bottom: 0;
        border-radius: 0px;
        max-width: auto;
        width: auto;
    }

    .bcb-modal-right > form {
        right: 0;
    }

    .bcb-modal-left > form {
        left: 0;
    }

    .bcb-btn-block {
        display: block;
        margin: 0 auto 25px;
    }

    .bcb-modal-close {
        border: 2px solid #888;
        color: #888;
        background: transparent!important;
        margin-top: 10px;
    }

</style>

<?php $inputClass = 'bcb-form-input ' . bcb_get_style_prop('desc_class') ?>
<?php $isModal = bcb_get_style_prop('modal_mode') == 'true' ?>
<?php if ($isModal) { ?>
    <button type="button" class="bcb-btn bcb-btn-block bcb-modal-open-cta">
        <?= bcb_get_style_prop('cta_button') ?>
    </button>
<?php } ?>
<div class="<?= $isModal ? 'bcb-modal' : '' ?> <?= $isModal ? 'bcb-modal-' . bcb_get_style_prop('modal_position') : '' ?>">
    <form class="bcb-form <?= bcb_get_style_prop('box_class') ?>">
        <h3 class="bcb-form-title <?= bcb_get_style_prop('title_class') ?>">
            <?= $payment->title ?>
        </h3>
        <div class="bcb-form-description <?= bcb_get_style_prop('desc_class') ?>">
            <?= $payment->description ?>
        </div>
        <label class="<?= $inputClass ?>">
            <span><?= bcb_get_style_prop('email_placeholder') ?></span>
            <input placeholder="<?= bcb_get_style_prop('email_placeholder') ?>" name="email" autocomplete="email" type="email">
        </label>
        <label class="<?= $inputClass ?>">
            <span><?= bcb_get_style_prop('national_id_placeholder') ?></span>
            <input placeholder="<?= bcb_get_style_prop('national_id_placeholder') ?>" name="national-id" data-mask="^[0-9]\d{0,12}$" data-regex>
        </label>
        <label class="<?= $inputClass ?>">
            <span><?= bcb_get_style_prop('cardnumber_placeholder') ?></span>
            <input placeholder="<?= bcb_get_style_prop('cardnumber_placeholder') ?>" name="cardnumber" autocomplete="cc-number" data-mask="0000 0000 0000 0000">
        </label>
        <label class="<?= $inputClass ?>">
            <span><?= bcb_get_style_prop('name_placeholder') ?></span>
            <input placeholder="<?= bcb_get_style_prop('name_placeholder') ?>" name="ccname" autocomplete="cc-name">
        </label>
        <div class="bcb-row">
            <label class="<?= $inputClass ?> input-datev">
                <span><?= bcb_get_style_prop('exp_placeholder') ?></span>
                <input placeholder="<?= bcb_get_style_prop('exp_placeholder') ?>" name="cc-exp" autocomplete="cc-exp" data-mask="00/00" >
            </label>
            <label class="<?= $inputClass ?> input-cv">
                <span><?= bcb_get_style_prop('cvv_placeholder') ?></span>
                <input placeholder="<?= bcb_get_style_prop('cvv_placeholder') ?>" name="cvc" autocomplete="cc-csc" data-mask="^[0-9]\d{0,3}$" data-regex>
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
        <?php if ($isModal) { ?>
            <button type="button" class="bcb-btn bcb-modal-close">
                <?= bcb_get_style_prop('close_modal_button') ?>
            </button>
        <?php } ?>
    </form>
</div>

<script src="https://unpkg.com/imask"></script>
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
        document.querySelector('.bcb-modal-open-cta').addEventListener('click', function () {
            document.querySelector('.bcb-modal').classList.add('bcb-modal-open');
        });

        document.querySelector('.bcb-modal').addEventListener('click', function (event) {
            this.classList.remove('bcb-modal-open');
        });

        document.querySelector('.bcb-modal .bcb-modal-close').addEventListener('click', function (event) {
            document.querySelector('.bcb-modal').classList.remove('bcb-modal-open');
        });

        document.querySelector('.bcb-modal form').addEventListener('click', function (event) {
            event.stopPropagation();
        });
    <?php } ?>

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