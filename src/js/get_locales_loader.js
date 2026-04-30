document.addEventListener('DOMContentLoaded', async () => {

    const get_locales_loader = document.querySelector('#get_locales_loader');

    if(!get_locales_loader) return;

    try {
        
         get_locales_loader.innerHTML = '<img src="./src/gifs/rot.gif" class="rot"/>';

        const response = await fetch(`${BASE_URL}/api/get_locales`);
        const data = await response.json();

        if(data.status === "empty"){
            get_locales_loader.innerHTML = '<b class="text-danger">Please add locale in setting menu</b>';
            return;
        }
        let html = '';

         html += `
                <select name="locale" id="locale" class="form-control" required>
                    <option value="">Select Locale</option>
            `;

        data.data.forEach(locale => {

            html += `
                <option value="${locale.locale_name}">${locale.locale_name}</option>
            `;

        });

        html += '</select>';

        get_locales_loader.innerHTML = html;

    } catch(err) {
        console.error(err);
        get_locales_loader.innerHTML = err;
    }
});