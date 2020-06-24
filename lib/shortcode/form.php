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

<form class="bpc-form">
    <h3 class="bpc-form-title"> <?= $product->name ?> </h3>
    <label class="bpc-form-input">
        <span>Número do Cartão de Crédito</span>
        <input placeholder="Número do Cartão de Crédito" name="cardnumber" autocomplete="cc-number">
    </label>
    <label class="bpc-form-input">
        <span>Nome</span>
        <input placeholder="Nome" name="ccname" autocomplete="cc-name">
    </label>
    <div class="bcp-row">
        <label class="bpc-form-input input-datev">
            <span>Data de Vencimento</span>
            <input placeholder="Data de Vencimento" name="cc-exp" autocomplete="cc-exp">
        </label>
        <label class="bpc-form-input input-cv">
            <span>Código de Segurança</span>
            <input placeholder="Código de Segurança" name="cvc" autocomplete="cc-csc">
        </label>
        <label class="bpc-form-input input-installments">
            <select name="installments">
                <?php
                    foreach ($product->installmentObj as $installment) { ?>
                        <option value="<?=$installment['value']?>"><?=$installment['label']?></option>
                    <?php }
                ?>
            </select>
            <div class="bpc-fake-select">
                <?= $product->installmentObj[0]['label'] ?>
            </div>
        </label>
    </div>
    <button type="submit" class="bpc-form-btn">
        Finalizar Compra
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
                    "value":  "<?= $product->value ?>",
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
                        'Content-Type': 'application/json'
                    },
                };

                fetch('/?rest_route/bexs-checkout/v1/pay', options)
                    .then(() => console.log('ALO'))
                    .catch(() => btn.classList.toggle(loadClass))
            }
        });
    }
</script>