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
                <a href="profiles_add" class="btn btn-outline-primary">
                        <span class="glyphicon glyphicon-plus"></span> Add profile
                </a>
                <a href="profiles_all" class="btn btn-outline-success">
                    <span class="glyphicon glyphicon-eye-open"></span> View all
                </a> 

        </div>
    </div>
</div>

<div id="profile_loader"></div>