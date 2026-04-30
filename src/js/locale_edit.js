document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (e) => {
        
        if (e.target.closest('.btn_edit')) {

            const locale_id = document.querySelector("#locale_id");
            const locale_input = document.querySelector("#locale_input");
            const span_text = document.querySelector("#span_text");
            const btn = e.target.closest('.btn_edit');

            const id = btn.dataset.id;
            const locale_name = btn.dataset.localeName;

            locale_input.value= locale_name;
            locale_id.value = id;
            span_text.innerHTML="("+locale_name+")";

            document.querySelector('#editOverlay').classList.remove('d-none');
        }

    });

    document.querySelector('#btn_locale_edit').addEventListener('click', async () => {
        
            const locale_id = document.querySelector("#locale_id");
            const locale_input = document.querySelector("#locale_input");
            
            const locale_responser = document.querySelector("#locale_responser");

            if(locale_input.value.trim() === ""){
                locale_input.focus();
                locale_responser.innerHTML="This field is required!";
                return;
            }

            const formData = new FormData();
            
            formData.append("id", locale_id.value);
            formData.append("locale_name", locale_input.value);


            try {

                locale_responser.innerHTML = `<p class="text-info">Updating record...</p>`;

                const response = await fetch(`${BASE_URL}/api/locale_edit`, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if(data.status === "error"){
                    locale_responser.innerHTML = `<p class="text-danger">${data.message}</p>`;
                    return;
                }
                    
                    locale_responser.innerHTML = `<p class="text-success"><span class="glyphicon glyphicon-ok"></span> ${data.message}</p>`;

                    setTimeout( async () => {
                        await loadLocale();
                    }, 2000);

                    setTimeout(() => {
                        document.querySelector('#editOverlay').classList.add('d-none');
                    }, 2000);

            } catch(error) {
                locale_responser.innerHTML = `<p class="text-danger">${error}</p>`;

            }
        });

    // Close modal
    document.querySelector('#closeEdit').addEventListener('click', () => {
        document.querySelector('#editOverlay').classList.add('d-none');
    });

});
