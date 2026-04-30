async function loadLocale() {

    const render = document.querySelector("#locale_list_loader");

    try {

        const response = await fetch(`${BASE_URL}/api/locale_list`);
        const data = await response.json();

        if(data.count === 0){
            render.innerHTML = `
                    <p>${data.message}</p>
                `;
            return;
        }

            let html = '';

            html += `
                    <div class="alert alert-info">
                        <table class="table table-bordered table-hover rounded-table">
                            <tr>
                                <td class="bg-light">#</td>
                                <td class="bg-light">Locale names</td>
                                <td class="bg-light" align="center" colspan="2">
                                    Actions
                                </td>
                            </tr>
                `;
            let i = 1;
            data.data.forEach(locale => {
                html += `
                        <tr>
                            <td>
                                ${i++}
                            </td>
                            <td>
                                ${locale.locale_name}
                            </td>
                            <td align="center">
                                <button class="btn btn_edit btn-outline-success" data-id="${locale.id}" data-locale-name="${locale.locale_name}">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit
                                </button>
                            </td>
                            <td align="center">
                                <button class="btn btn_delete btn-outline-danger" data-id="${locale.id}" data-locale-name="${locale.locale_name}">
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
loadLocale();