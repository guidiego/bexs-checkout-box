(function() {
    tinymce.PluginManager.add('bcb_mce_button', function( editor, url ) {
      editor.addButton('bcb_mce_button', {
        text: 'Bexs',
        icon: false,
        onclick: function() {
          editor.windowManager.open({
            title: 'Bex Checkout Box Params',
            body: [
              {
                type: 'textbox',
                name: 'contract_id',
                label: 'ContractID',
                value: ''
              },
              {
                type: 'textbox',
                name: 'value',
                label: 'Price',
                value: ''
              },
              {
                type: 'textbox',
                name: 'tax',
                label: 'Tax',
                value: ''
              },
              {
                type: 'textbox',
                name: 'max_installments',
                label: 'Installments',
                value: ''
              },
            ],
            onsubmit: function (e) {
              const params = Object.keys(e.data)
                  .filter((k) => e.data[k] !== '')
                  .map((k) => `${k}="${e.data[k]}"`)
                  .join(' ');

              editor.insertContent(`[bexs-checkout-box ${params}]`)
            }
          })
        }
      });
    });
  })();