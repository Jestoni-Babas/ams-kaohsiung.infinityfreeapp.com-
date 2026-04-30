document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (e) => {
        
        if (e.target.closest('.btn_delete_gathering')) {

            const gathering_id = document.querySelector("#gathering_id2");
            const span_text = document.querySelector("#span_text_22");
            const btn = e.target.closest('.btn_delete_gathering');

            const id = btn.dataset.id;
            const gathering_name = btn.dataset.gatheringName;

            gathering_id.value = id;
            span_text.innerHTML="("+gathering_name+")";

            document.querySelector('#deleteOverlay2').classList.remove('d-none');
        }
    });

   const deleteBtn = document.querySelector('#btn_gathering_delete');

if (deleteBtn) {
    deleteBtn.addEventListener('click', async (e) => {
        
        const gathering_id = document.querySelector("#gathering_id2");
        const span_text_2 = document.querySelector("#span_text_22");

        const formData = new FormData();
        formData.append("id", gathering_id.value);

        try {

            span_text_2.innerHTML = `<p class="text-info">Deleting record... </p>`;

            const response = await fetch(`${BASE_URL}/api/gathering_delete`, {
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
                await loadGatherings();
            }, 2000);

            setTimeout(() => {
                document.querySelector('#deleteOverlay2').classList.add('d-none');
            }, 2000);

        } catch(error) {
            span_text_2.innerHTML = `<p class="text-danger">${error}</p>`;
        }
    });
}

    // Close modal
    const closeBtn = document.querySelector('#closeDelete2');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            document.querySelector('#deleteOverlay2').classList.add('d-none');
        });
    }

});
