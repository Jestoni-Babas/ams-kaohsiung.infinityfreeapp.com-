
<div class="bg-wrapper position-relative">
    <img src="src/images/MCGI-logo.png" class="mcgi-logo" alt="MCGI LOGO"/>
    <div class="bg-dark bg-opacity-50 w-100 h-100">
        <div class="d-flex justify-content-end gap-3 p-4">
            <a href="/ams/" class="btn btn-light">HOME</a>
        </div>
        <div class="bg-dark bg-opacity-50 p-4 w-75 m-auto rounded">
            
            <h2 class="text-light text-center">Log into your Account</h2>

            <div class="p-3 rounded m-auto text-light login">
                 <div id="responser"></div>
                <form id="loginForm" method="POST" action="<?= $base ?>/api/login" class="login-form">
                    <div class="p-2 mb-2">
                        <label for="email">Email</label>
                            <input type="email" name="email" class="form-control bg-dark bg-opacity-50 text-light" id="email" placeholder="example@gmail.com"/>
                    </div>
                    <div class="p-2 mb-2">
                        <label for="password">Password</label>
                            <input type="password" name="pwd" class="form-control bg-dark bg-opacity-50 text-light" id="pwd" placeholder="*******"/>
                    </div>
                    <div class="p-2 mb-2 d-flex justify-content-between">
                        <button class="btn btn-success">LOG IN</button>
                        <a href="register" class="btn btn-link">REGISTER</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>