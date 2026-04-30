document.addEventListener('DOMContentLoaded', () => {

    const formProfile = document.querySelector('#formProfile');
    const profile_responser = document.querySelector('#profile_responser');
    const picturePreview = document.querySelector('#picturePreview');
    const lname = document.querySelector('#lname');
    const fname = document.querySelector('#fname');
    const mname = document.querySelector('#mname');
    const church_id = document.querySelector('#church_id');
    const locale = document.querySelector('#locale');
    const pictureInput = document.querySelector('#pictureInput');
    const dob = document.querySelector('#dob');

    // preview
    if (pictureInput && picturePreview) {
        pictureInput.addEventListener('change', () => {

            const file = pictureInput.files[0];
            if (!file) return;

            const allowedType = ["image/jpeg", "image/jpg", "image/png"];

            if (!allowedType.includes(file.type)) {
                profile_responser.innerHTML =
                    '<p class="text-danger">Invalid file type</p>';

                picturePreview.src = './src/images/MCGI-logo.png';
                pictureInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                picturePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    function resetPreview() {
        picturePreview.src = './src/images/MCGI-logo.png';
    }
    if (!formProfile) return;

    formProfile.addEventListener('submit', async (e) => {
        e.preventDefault();

        try {
            profile_responser.innerHTML ='<img src="./src/gifs/rot.gif" class="rot"/> Uploading...';

            const formData = new FormData(formProfile);

            const response = await fetch(`${BASE_URL}/api/profiles_add`, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === "error") {
                profile_responser.innerHTML =
                    `<p class="text-danger">${data.message}</p>`;
                return;
            }

             profile_responser.innerHTML =
                `<p class="text-success"><span class="glyphicon glyphicon-ok"></span> ${data.message}</p>`;

            setTimeout(() => {
                profile_responser.innerHTML = `
                        <p class="text-primary"><img src="./src/gifs/rot.gif" class="rot"/> Please wait! Resetting...</p>
                    `;
            }, 2000);

            setTimeout( () => {
                profile_responser.innerHTML = '';
                formProfile.reset();
                resetPreview();
            }, 4000);


        } catch (err) {
            console.error(err);
            profile_responser.innerHTML =
                `<p class="text-danger">Server error: ${err}</p>`;
        }
    });

});