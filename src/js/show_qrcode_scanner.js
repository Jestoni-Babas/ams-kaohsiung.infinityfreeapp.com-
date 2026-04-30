document.addEventListener('DOMContentLoaded', () => {

    const btn_qrcode_loader2 = document.querySelector('#btn_qrcode_loader2');
    const btn_reset = document.querySelector('#btn_reset');

    btn_reset.style.display = 'none';

    // 🔊 AUDIO (LOAD ONCE)
    const beepSound = new Audio(`${BASE_URL}/src/audio/beep.mp3`);
    beepSound.preload = "auto";

    function updateTime() {
        const now = new Date();
        const time = now.toLocaleTimeString();

        document.getElementById("localTime").innerHTML = `
            <div class="alert bg-white">
                <h1 class="text-danger">${time}</h1>
            </div>
        `;
    }

    updateTime();
    setInterval(updateTime, 1000);

    function getTime() {
        return new Date().toLocaleTimeString();
    }

    btn_qrcode_loader2.addEventListener('click', () => {

        const qr_scanner_container2 = document.querySelector('#qr_scanner_container2');
        const gathering_type = document.querySelector('#gathering_type');
        const result = document.getElementById('result');
        const response_loader = document.getElementById('response_loader');

        if (!gathering_type.value || gathering_type.value.trim() === "") {
            alert('Please select first Gathering type!');
            gathering_type.focus();
            return;
        }

        btn_reset.style.display = 'block';
        btn_qrcode_loader2.style.display = 'none';
        qr_scanner_container2.classList.toggle('qr_toggle');

        let html5QrCode = null;
        let scanLocked = false;
        let lastQr = null;
        let lastScanTime = 0;

        async function onScanSuccess(qrCodeMessage) {

            const now = Date.now();

            if (scanLocked) return;
            if (!qrCodeMessage) return;

            if (qrCodeMessage === lastQr && (now - lastScanTime) < 5000) {
                return;
            }

            scanLocked = true;
            lastQr = qrCodeMessage;
            lastScanTime = now;

            try {
                await html5QrCode.pause(true);
            } catch (e) {
                console.warn("Pause error:", e);
            }

            result.innerHTML = `
                <b class="text-success">
                    <span class="glyphicon glyphicon-ok"></span> 
                    Scanned: ${qrCodeMessage}
                </b>`;

            beepSound.currentTime = 0;
            beepSound.play();

            response_loader.innerHTML = `
                <p class="text-info">
                    <img src="./src/gifs/rot.gif" class="rot"/> Logging attendance...
                </p>
            `;

            try {
                const response = await fetch(`${BASE_URL}/api/qr_code_scanner`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        qr: qrCodeMessage,
                        gathering_type: gathering_type.value
                    })
                });

                const data = await response.json();

                if (data.status === "error") {

                    response_loader.innerHTML = `
                        <div class="alert alert-danger">
                            <b>
                                <span class="glyphicon glyphicon-warning-sign"></span>
                                ${data.message}
                            </b>
                        </div>
                    `;

                    setTimeout(async () => {
                        scanLocked = false;
                        await html5QrCode.resume();
                    }, 1000);

                    return;
                }

                response_loader.innerHTML = `
                    <div class="alert alert-success">
                        <table class="table bg-white">
                            <tr>
                                <td align="center"><b>Picture</b></td>
                                <td><b>Full name</b></td>
                                <td><b>Locale</b></td>
                                <td><b>Church ID</b></td>
                                <td><b>Gathering type</b></td>
                                <td><b>Time Logged</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="profile_photo_container3">
                                        <img src="./src/pictures/${data.info.picture || 'MCGI-logo.png'}" 
                                            class="getMinProfilePic">
                                    </div>
                                </td>
                                <td class="align-middle">${data.info.lname}, ${data.info.fname} ${data.info.mname}</td>
                                <td class="align-middle">${data.info.locale}</td>
                                <td class="align-middle">${data.info.church_id}</td>
                                <td class="align-middle">${gathering_type.value}</td>
                                <td class="align-middle">${getTime()}</td>
                            </tr>   
                        </table>
                    </div>
                `;

            } catch (err) {
                console.error(err);
                response_loader.innerHTML = "Error submitting QR data.";
            }

            setTimeout(async () => {
                scanLocked = false;
                await html5QrCode.resume();
            }, 1000);
        }

        async function startScanner() {

            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("reader");
            }

            try {
                // 🔥 SIMPLIFIED: just use default camera (no back/front logic)
                await html5QrCode.start(
                    { facingMode: "environment" }, // still prefers back cam if available
                    { fps: 10, qrbox: 250 },
                    onScanSuccess
                );

            } catch (err) {
                console.error("Camera error:", err);
                result.innerHTML = "Camera access error.";
            }
        }

        startScanner();
    });

    btn_reset.addEventListener('click', () => {

        const gathering_type = document.querySelector('#gathering_type');

        btn_qrcode_loader2.style.display = 'block';
        btn_reset.style.display = 'none';
        gathering_type.value = '';

        window.location = `${BASE_URL}/start_attendance`;
    });

});