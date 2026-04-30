
<div class="aside_banner">
    <?= htmlspecialchars(strtoupper($_SESSION['userName'])); ?>
</div>
<ul class="ul_menu">
    <li>
        <a href="dashboard">
            <div class="<?= ($text_css == "Dashboard") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-dashboard text-info"></span> Dashboard
            </div>
        </a>
    </li>
    <!-- <li>
        <a href="qrcode">
            <div class="<?= ($text_css == "Qrcode") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-qrcode text-danger"></span> Open QR Scanner
            </div>
        </a>
    </li> -->
    <li>
        <a href="start_attendance">
            <div class="<?= ($text_css == "Attendance start") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-edit text-danger"></span> Start Attendance
            </div>
        </a>
    </li>
    <li>
        <a href="profiles">
            <div class="<?= ($text_css == "Profiles" || $text_css == "profiles_add") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-user text-primary"></span> Profiles
            </div>
        </a>
    </li>
    <li>
        <a href="settings">
            <div class="<?= ($text_css == "Settings") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-cog settings text-warning"></span> Settings
            </div>
        </a>
    </li>
    <li>
        <a href="reports">
            <div class="<?= ($text_css == "Reports") ? 'text-primary bg_purple' : '' ?>">
                <span class="glyphicon glyphicon-folder-open text-success"></span> Reports
            </div>
        </a>
    </li>
</ul>