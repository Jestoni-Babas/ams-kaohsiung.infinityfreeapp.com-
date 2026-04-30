document.addEventListener('DOMContentLoaded', () => {

    const profile_loader = document.querySelector('#profile_loader');
    if (!profile_loader) return;

    // ✅ CLICK HANDLER (ONLY ONCE)
    document.addEventListener('click', (e) => {

        if (!e.target.classList.contains('download-btn')) return;

        const id = e.target.dataset.id;
        const container = document.getElementById(`qr-${id}`);

        if (container && container.qrInstance) {
            container.qrInstance.download({
                name: `QR_${id}`,
                extension: "png"
            });
        }

    });

    loadProfiles(profile_loader);
});


async function loadProfiles(profile_loader){

    profile_loader.innerHTML = `
        <p class="text-info">
            <img src="./src/gifs/rot.gif" class="rot"/> Fetching recent profiles...
        </p>
    `;

    try {

        const response = await fetch(`${BASE_URL}/api/profiles_getMinimum`);
        const data = await response.json();

        if (data.status === "error") {
            profile_loader.innerHTML = `<p class="text-danger">${data.message}</p>`;
            return;
        }

        const profiles = Array.isArray(data.profile)
            ? data.profile
            : [data.profile];

        // =========================
        // BUILD TABLE
        // =========================
        let html = `
            <div class="alert alert-warning">
                <table class="table table-hover rounded-table table-bordered">
                    <tr>
                        <td colspan="9" class="bg-light">
                            <h3>Recently added profiles</h3>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><b>Picture</b></td>
                        <td align="center"><b>QR CODE</b></td>
                        <td align="center"><b>Name</b></td>
                        <td align="center"><b>Church ID</b></td>
                        <td align="center"><b>Locale</b></td>
                        <td align="center"><b>Date of Baptism</b></td>
                        <td align="center" colspan="3"><b>Actions</b></td>
                    </tr>
            `;

        profiles.forEach(profile => {

            const qrId = `qr-${profile.church_id}`;

            html += `
                <tr>
                    <td class="text-center align-middle">
                        <div class="profile_photo_container2">
                            <img src="./src/pictures/${profile.picture || 'MCGI-logo.png'}" 
                                class="getMinProfilePic" 
                                loading="lazy">
                        </div>
                    </td>

                    <td class="text-center align-middle">
                        <div id="qr-${profile.church_id}"></div>
                    </td>

                    <td class="text-center align-middle">
                        ${profile.lname} ${profile.fname} ${profile.mname ?? ''}
                    </td>

                    <td class="text-center align-middle">${profile.church_id}</td>
                    <td class="text-center align-middle">${profile.locale}</td>
                    <td class="text-center align-middle">${profile.dob}</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-outline-success download-btn"
                                data-id="${profile.church_id}">
                            <span class="glyphicon glyphicon-save"></span> Download QR
                        </button>
                    </td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-outline-primary"
                                data-id="${profile.id}">
                            <span class="glyphicon glyphicon-pencil"></span> Update
                        </button>
                    </td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-outline-danger"
                                data-id="${profile.id}">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </td>
                </tr>
            `;
        });

        html += `</table>
            </div>`;
        profile_loader.innerHTML = html;

        // =========================
        // GENERATE QR CODES
        // =========================
        profiles.forEach(profile => {

            const container = document.getElementById(`qr-${profile.church_id}`);

            if (!container) return;

            const qr = new QRCodeStyling({
                width: 120,
                height: 120,
                data: `MEMBER:${profile.church_id}`,

                image: "./src/images/MCGI-logo.png",

                qrOptions: {
                    errorCorrectionLevel: "H"
                },

                dotsOptions: {
                    color: "#000",
                    type: "rounded"
                },

                backgroundOptions: {
                    color: "#fff"
                },

                imageOptions: {
                    margin: 2,
                    imageSize: 0.25
                }
            });

            qr.append(container);
            container.qrInstance = qr; // for download
        });

    } catch (err) {
        console.error(err);
        profile_loader.innerHTML = `<p class="text-danger">Sometding went wrong</p>`;
    }
}