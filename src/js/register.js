document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const responser = document.querySelector('#responser');
    const username = document.querySelector('#username');
    const email = document.querySelector('#email');
    const pwd = document.querySelector('#pwd');
    const confirm_pwd = document.querySelector('#confirm_pwd');

    function isValidEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }

    // --- Validation ---
    if(username.value.trim() === "") {
        username.focus();
        responser.innerHTML = '<p class="text-danger">Full name field must be fill out!</p>';
        return false;
    } else if (email.value.trim() === "") {
        email.focus();
        responser.innerHTML = '<p class="text-danger">Email field must be fill out!</p>';
        return false;
    } else if (!isValidEmail(email.value.trim())) {
        email.focus();
        responser.innerHTML = '<p class="text-danger">Please enter a valid email address!</p>';
        return false;
    } else if (pwd.value.trim() === "") {
        pwd.focus();
        responser.innerHTML = '<p class="text-danger">Create your password!</p>';
        return false;
    } else if (confirm_pwd.value.trim() === "") {
        confirm_pwd.focus();
        responser.innerHTML = '<p class="text-danger">Re-type your password!</p>';
        return false;
    } else if (confirm_pwd.value.trim() !== pwd.value.trim()) {
        confirm_pwd.focus();
        responser.innerHTML = '<p class="text-danger">Passwords do not match!</p>';
        return false;
    }

    const formData = new FormData(e.target);

    try {

        responser.innerHTML = '<p class="text-info">Saving data...</p>';

        const response = await fetch(`${BASE_URL}/api/register`, {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        const messages = Array.isArray(data.message) ? data.message : [data.message];

        if (data.status === "error") {
           
           responser.innerHTML = `<p class="text-danger">${messages.join("<br/>")}</p>`;
        } else {

            responser.innerHTML = `<p class="text-success">${messages.join("<br/>")}</p>`;
            setTimeout(() => {
                responser.innerHTML = '<p class="text-success">Redirecting to log in...</p>';
            }, 2000);

            setTimeout(() => {
                
                window.location = "login";
            }, 2000);
        }

    } catch (err) {
        responser.innerHTML = `<p class="text-danger">${err}</p>`;
    }
});