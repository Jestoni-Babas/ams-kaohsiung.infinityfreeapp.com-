document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#addLocaleForm');
    if (!form) return;

    const responser = document.querySelector('#responser');
    const add_locale = document.querySelector('#add_locale');

    function attachClose() {
        const btn = responser.querySelector("button");
        if (btn) {
            btn.addEventListener("click", () => {
                responser.innerHTML = "";
            });
        }
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (add_locale.value.trim() === "") {
            add_locale.focus();
            responser.innerHTML = `
                <div class="alert alert-danger d-flex justify-content-between">
                    <p class="text-danger m-0">This field is required!</p>
                    <button type="button" class="border-0 bg-transparent">&times;</button>
                </div>`;
            attachClose();
            return;
        }

        const formData = new FormData(form);

        try {
            responser.innerHTML = `
                <div class="alert alert-info d-flex justify-content-between">
                    <p class="text-info m-0">Saving...</p>
                    <button type="button" class="border-0 bg-transparent">&times;</button>
                </div>`;
            attachClose();

            const response = await fetch(`${BASE_URL}/api/locale_insert`, {
                method: "POST",
                body: formData
            });

            const data = await response.json();
            const messages = Array.isArray(data.message) ? data.message : [data.message];

            if (data.status === "error") {
                responser.innerHTML = `
                    <div class="alert alert-danger d-flex justify-content-between">
                        <p class="text-danger m-0">${messages.join("<br/>")}</p>
                        <button type="button" class="border-0 bg-transparent">&times;</button>
                    </div>`;
                attachClose();
            } else {
                responser.innerHTML = `
                    <div class="alert alert-success">
                        <p class="m-0"><span class="glyphicon glyphicon-ok"></span> ${messages.join("<br/>")}</p>
                    </div>`;

                setTimeout(() => {
                    responser.innerHTML = `
                        <div class="alert alert-info">
                            <p class="m-0"><img src="./src/gifs/rot.gif" class="rot"/> Please wait! Setting up...</p>
                        </div>`;
                }, 2000);

                setTimeout(async () => {
                    responser.innerHTML = '';
                    add_locale.value = "";
                    await loadLocale();
                }, 4000);
            }

        } catch (err) {
            responser.innerHTML = `<p class="text-danger">${err}</p>`;
        }
    });
});