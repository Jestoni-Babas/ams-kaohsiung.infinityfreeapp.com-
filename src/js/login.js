document.querySelector('#loginForm').addEventListener('submit', async(e) => {
    e.preventDefault();

    const responser = document.querySelector('#responser');
    const email = document.querySelector('#email');
    const pwd = document.querySelector('#pwd');

    function isValidEmail(email) {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }

    if(email.value.trim() === ""){
        email.focus();
        responser.innerHTML = '<p class="text-danger">Email field must be fill out!</p>';
        return false;
    } else if(!isValidEmail(email.value.trim())){
        email.focus();
        responser.innerHTML = '<p class="text-danger">Enter a valid email!</p>';
        return false;
    }
    if(pwd.value.trim() === ""){
        pwd.focus();
        responser.innerHTML = '<p class="text-danger">Enter you password</p>';
        return false;
    }

    const formData = new FormData(e.target);

    try {

        responser.innerHTML = '<p class="text-info">Verifying user data...</p>';

        const response = await fetch(`${BASE_URL}/api/login`, {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        const messages = Array.isArray(data.message) ? data.message : [data.message];

        if (data.status === "error") {
           
           responser.innerHTML = `<p class="text-danger">${messages.join("<br/>")}</p>`;
        } else {

            responser.innerHTML = `<p class="text-info">${messages.join("<br/>")}</p>`;
            setTimeout(() => {
                responser.innerHTML = '<p class="text-success">Redirecting to your Dashboard...</p>';
            }, 2000);

            setTimeout(() => {
                
                window.location = "dashboard";
            }, 2000);
          
           
        }

    } catch (err) {
        responser.innerHTML = `<p class="text-danger">${err}</p>`;
    }

});