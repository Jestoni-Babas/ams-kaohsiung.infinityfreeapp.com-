<?php
include 'controllers/isLoggedIn.php';
?>
<div class="alert alert-info">
    <div class="d-flex gap-3">
    <div class="flex-grow-1">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search profile (name or church ID)">
                <button class="btn btn-warning px-4"><span class="glyphicon glyphicon-search"></span> Search</button>
            </div>
        </div>
    <div class="btn-group">
                <a href="profiles" class="btn btn-outline-danger">
                        <span class="glyphicon glyphicon-arrow-left"></span> Return
                </a>
                <a href="profiles_all" class="btn btn-outline-success">
                    <span class="glyphicon glyphicon-eye-open"></span> View all
                </a> 

        </div>
    </div>
</div>
<form action="<?= $base ?>/api/profiles_add" id="formProfile" enctype="multipart/form-data">
    <div class="profile_container">
        <div class="container-fluid">
            <div class="profile_photo_container">
                <img src="./src/images/MCGI-logo.png" class="picturePreview" id="picturePreview">
            </div>
            <div id="profile_responser"></div>
            <div class="bg-white p-4 rounded">
                <div class="row">
                    <div class="col-md-4">
                        <b>Last name</b>
                            <input type="text" name="lname" id="lname" class="form-control" required /><br/>
                    </div>
                    <div class="col-md-4">
                        <b>First name</b>
                            <input type="text" name="fname" id="fname" class="form-control" required /><br/>
                    </div>
                    <div class="col-md-4">
                        <b>Middle name (Optional)</b>
                            <input type="text" name="mname" id="mname" class="form-control" /><br/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <b>Church ID #</b>
                            <input type="text" name="church_id" id="church_id" class="form-control" required /><br/>
                    </div>
                    <div class="col-md-4">
                        <b>Locale</b><br/>
                        <span id="get_locales_loader"></span><br/>
                    </div>
                    <div class="col-md-4">
                        <b>Upload Picture</b>
                            <input type="file" name="picture" id="pictureInput" class="form-control" /><br/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <b>Date of Baptism</b>
                            <input type="date" name="dob" id="dob" id="dob" class="form-control" required /><br/>
                    </div>
                    <div class="col-md-8 text-end">
                        <br/>
                        <button type="submit" class="btn btn-outline-primary">SAVE PROFILE</button><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>