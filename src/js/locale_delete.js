document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (e) => {
        
        if (e.target.closest('.btn_delete')) {

            const locale_id = document.querySelector("#locale_id2");
            const span_text = document.querySelector("#span_text_2");
            const btn = e.target.closest('.btn_delete');

            const id = btn.dataset.id;
            const locale_name = btn.dataset.localeName;

            locale_id.value = id;
            span_text.innerHTML="("+locale_name+")";

            document.querySelector('#deleteOverlay').classList.remove('d-none');
        }
    });

   const deleteBtn = document.querySelector('#btn_locale_delete');

if (deleteBtn) {
    deleteBtn.addEventListener('click', async (e) => {
        
        const locale_id = document.querySelector("#locale_id2");
        const span_text_2 = document.querySelector("#span_text_2");

        const formData = new FormData();
        formData.append("id", locale_id.value);

        try {

            span_text_2.innerHTML = `<p class="text-info">Deleting record...</p>`;

            const response = await fetch(`${BASE_URL}/api/locale_delete`, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if(data.status === "error"){
                span_text_2.innerHTML = `<p class="text-danger">${data.message}</p>`;
                return;
            }
                
            span_text_2.innerHTML = `
                            <p class="text-success">
                                <span class="glyphicon glyphicon-trash text-danger"></span>
                                <img src="./src/gifs/rot.gif" class="rot"/>
                                ${data.message}
                            </p>
                        `;

            setTimeout(async () => {
                await loadLocale();
            }, 2000);

            setTimeout(() => {
                document.querySelector('#deleteOverlay').classList.add('d-none');
            }, 2000);

        } catch(error) {
            span_text_2.innerHTML = `<p class="text-danger">${error}</p>`;
        }
    });
}

    // Close modal
    const closeBtn = document.querySelector('#closeDelete');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            document.querySelector('#deleteOverlay').classList.add('d-none');
        });
    }

});
