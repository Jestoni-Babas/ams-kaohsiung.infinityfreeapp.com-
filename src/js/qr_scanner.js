document.addEventListener("DOMContentLoaded", () => {

    const result = document.getElementById('result');
    const response_loader = document.getElementById('response_loader');

    let html5QrCode = null;
    let cameraId = null;

    // 🔐 HARD LOCK SYSTEM
    let scanLocked = false;
    let lastQr = null;
    let lastScanTime = 0;

    async function onScanSuccess(qrCodeMessage) {

        const now = Date.now();

        // 🔐 BLOCK IF LOCKED
        if (scanLocked) return;

        // 🔐 BLOCK EMPTY
        if (!qrCodeMessage) return;

        // 🔐 BLOCK SAME QR WITHIN 5 SECONDS
        if (qrCodeMessage === lastQr && (now - lastScanTime) < 5000) {
            return;
        }

        // 🔐 ACTIVATE LOCK IMMEDIATELY
        scanLocked = true;
        lastQr = qrCodeMessage;
        lastScanTime = now;

        // ⏸️ PAUSE SCANNER (IMPORTANT: no restart flicker)
        try {
            await html5QrCode.pause(true);
        } catch (e) {
            console.warn("Pause error:", e);
        }

        result.innerHTML = "Scanned: " + qrCodeMessage;
        response_loader.innerHTML = "Processing...";

        try {
            const response = await fetch(`${BASE_URL}/api/qr_code_scanner`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ qr: qrCodeMessage })
            });

            const data = await response.json();
            if(data.status === "error"){
                 response_loader.innerHTML = `<p class="text-danger">${data.message}</p>`;
                 return;
            }
            response_loader.innerHTML = `
            <div class="alert alert-success">
                <h1>${data.message}</h1>
            </div>
        `;

        } catch (err) {
            console.error(err);
            response_loader.innerHTML = "Error submitting QR data.";
        }

        // ⏳ COOLDOWN BEFORE RESUME
        setTimeout(async () => {

            scanLocked = false;

            try {
                await html5QrCode.resume();
            } catch (e) {
                console.error("Resume error:", e);
            }

        }, 4000);
    }

    async function startScanner() {

        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader");
        }

        try {
            const devices = await Html5Qrcode.getCameras();

            if (!devices.length) {
                result.innerHTML = "No camera found.";
                return;
            }

            cameraId = devices[0].id;

            await html5QrCode.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: 250
                },
                onScanSuccess
            );

        } catch (err) {
            console.error("Camera error:", err);
            result.innerHTML = "Camera access error.";
        }
    }

    // 🚀 START SCANNER ON LOAD
    startScanner();
});