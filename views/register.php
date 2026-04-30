
<div class="bg-wrapper position-relative">
    <img src="src/images/MCGI-logo.png" class="mcgi-logo" alt="MCGI LOGO"/>
    <div class="bg-dark bg-opacity-50 w-100 h-100">
        <div class="d-flex justify-content-end gap-3 p-4">
            <a href="/ams/" class="btn btn-light">HOME</a>
        </div>
        <div class="bg-dark bg-opacity-50 p-4 w-75 m-auto rounded">
      
            <h2 class="text-light text-center">Create an Account</h2>
            
            <div class="p-3 rounded m-auto text-light register">

            <div id="responser"></div>

                <form id="registerForm" method="POST" action="<?= $base ?>/api/register" class="register-form">
                    <div class="p-2 mb-2">
                        <label for="username"><b class="text-secondary">Enter full name</b></label>
                            <input type="text" name="username" class="form-control bg-dark bg-opacity-50 text-light" id="username" placeholder="Your name"/>
                    </div>
                    <div class="p-2 mb-2">
                        <label for="email"><b class="text-secondary">Specify Email</b></label>
                            <input type="email" name="email" class="form-control bg-dark bg-opacity-50 text-light" id="email" placeholder="example@gmail.com"/>
                    </div>
                    <div class="p-2 mb-2">
                        <label for="pwd"><b class="text-secondary">Create Password</b></label></label>
                            <input type="password" name="pwd" class="form-control bg-dark bg-opacity-50 text-light" id="pwd" placeholder="*******"/>
                    </div>
                    <div class="p-2 mb-2">
                        <label for="confirm_pwd"><b class="text-secondary">Confirm Password</b></label></label>
                            <input type="password" name="confirm_pwd" class="form-control bg-dark bg-opacity-50 text-light" id="confirm_pwd" placeholder="Re-type your password"/>
                    </div>
                    <div class="p-2 mb-2 d-flex justify-content-between">
                        <button class="btn btn-primary">REGISTER</button>
                        <a href="login" class="btn btn-link">LOG IN</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>