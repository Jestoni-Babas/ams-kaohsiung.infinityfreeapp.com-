document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('click', (e) => {
        
        if (e.target.closest('.btn_edit_gathering')) {

            const gathering_id = document.querySelector("#gathering_id");
            const gathering_input = document.querySelector("#gathering_input");
            const span_text = document.querySelector("#span_text2");
            const btn = e.target.closest('.btn_edit_gathering');

            const id = btn.dataset.id;
            const gathering_name = btn.dataset.gatheringName;

            gathering_input.value= gathering_name;
            gathering_id.value = id;
            span_text.innerHTML="("+gathering_name+")";

            document.querySelector('#editOverlay2').classList.remove('d-none');
        }

    });

    document.querySelector('#btn_gathering_edit').addEventListener('click', async () => {
        
            const gathering_id = document.querySelector("#gathering_id");
            const gathering_input = document.querySelector("#gathering_input");
            
            const gathering_responser = document.querySelector("#gathering_responser");

            if(gathering_input.value.trim() === ""){
                gathering_input.focus();
                gathering_responser.innerHTML="This field is required!";
                return;
            }

            const formData = new FormData();
            
            formData.append("id", gathering_id.value);
            formData.append("gathering_name", gathering_input.value);


            try {

                gathering_responser.innerHTML = `<p class="text-info">Updating record...</p>`;

                const response = await fetch(`${BASE_URL}/api/gathering_edit`, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if(data.status === "error"){
                    gathering_responser.innerHTML = `<p class="text-danger">${data.message}</p>`;
                    return;
                }
                    
                    gathering_responser.innerHTML = `<p class="text-success"><span class="glyphicon glyphicon-ok"></span> ${data.message}</p>`;

                    setTimeout( async () => {
                        await loadGatherings();
                    }, 2000);

                    setTimeout(() => {
                        document.querySelector('#editOverlay2').classList.add('d-none');
                    }, 2000);

            } catch(error) {
                gathering_responser.innerHTML = `<p class="text-danger">${error}</p>`;

            }
        });

    // Close modal
    document.querySelector('#closeEdit2').addEventListener('click', () => {
        document.querySelector('#editOverlay2').classList.add('d-none');
    });

});
