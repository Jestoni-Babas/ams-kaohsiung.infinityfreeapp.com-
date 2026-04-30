async function loadGatherings() {

    const render = document.querySelector("#gathering_list_loader");

    try {

        const response = await fetch(`${BASE_URL}/api/gathering_list`);
        const data = await response.json();

        if(data.count === 0){
            render.innerHTML = `
                    <p>${data.message}</p>
                `;
            return;
        }

            let html = '';

            html += `
                    <div class="alert alert-warning">
                        <table class="table table-bordered table-hover rounded-table">
                            <tr>
                                <td class="bg-light">Gathering types</td>
                                <td class="bg-light" align="center" colspan="2">
                                    Actions
                                </td>
                            </tr>
                `;
            data.data.forEach(gathering => {
                html += `
                        <tr>
                            <td>
                                ${gathering.gathering_name}
                            </td>
                            <td align="center">
                                <button class="btn btn_edit_gathering btn-outline-success" data-id="${gathering.id}" data-gathering-name="${gathering.gathering_name}">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit
                                </button>
                            </td>
                            <td align="center">
                                <button class="btn btn_delete_gathering btn-outline-danger" data-id="${gathering.id}" data-gathering-name="${gathering.gathering_name}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>
                        </tr>
                    `;
            });
                

            html += `
                    </table>
                </div>
                `;

            render.innerHTML = html;


    } catch(err) {
        console.error(err);
        render.innerHTML = `
            <p class="text-danger">Failed to load data!</p>
        `;
    }

}
loadGatherings();