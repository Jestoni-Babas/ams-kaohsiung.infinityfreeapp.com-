<?php
include 'controllers/isLoggedIn.php';
?>

<!-- edit locale -->
<div id="editOverlay" class="edit-overlay d-none">
    <!-- Centered Edit Box -->
    <div class="edit-modal">
        <h5>Edit Locale <span class="text-primary" id="span_text"></span></h5>
            <input type="hidden" name="locale_id"  class="form-control mb-3" id="locale_id">
            <span id="locale_responser"></span>
            <input type="text" name="locale_input"  class="form-control mb-3" id="locale_input">

            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" id="closeEdit">Cancel</button>
                <button class="btn btn-success" id="btn_locale_edit" type="submit">Save</button>
            </div>
    </div>
</div>

<!-- delete locale -->
<div id="deleteOverlay" class="delete-overlay d-none">
    <div class="delete-modal">
        <h5>Delete Locale <span class="text-primary" id="span_text_2"></span></h5>
            <input type="hidden" name="locale_id"  class="form-control mb-3" id="locale_id2">
            <h2 class="text-danger text-center">Are you sure?</h2>

            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary" id="closeDelete">NO</button>
                <button class="btn btn-danger" id="btn_locale_delete" type="submit">YES</button>
            </div>
    </div>
</div>

<!-- edit gathering -->
<div id="editOverlay2" class="edit-overlay d-none">
    <!-- Centered Edit Box -->
    <div class="edit-modal">
        <h5>Edit Gathering <span class="text-primary" id="span_text2"></span></h5>
            <input type="hidden" name="gathering_id"  class="form-control mb-3" id="gathering_id">
            <span id="gathering_responser"></span>
            <input type="text" name="gathering_input"  class="form-control mb-3" id="gathering_input">

            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" id="closeEdit2">Cancel</button>
                <button class="btn btn-success" id="btn_gathering_edit" type="submit">Save</button>
            </div>
    </div>
</div>

<!-- delete gathering -->
<div id="deleteOverlay2" class="delete-overlay d-none">
    <div class="delete-modal">
        <h5>Delete Gathering <span class="text-primary" id="span_text_22"></span></h5>
            <input type="hidden" name="gathering_id"  class="form-control mb-3" id="gathering_id2">
            <h2 class="text-danger text-center">Are you sure?</h2>

            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary" id="closeDelete2">NO</button>
                <button class="btn btn-danger" id="btn_gathering_delete" type="submit">YES</button>
            </div>
    </div>
</div>

<p class="text-secondary"><b>NOTE:</b> Here you can add the settings for default fields.</p>
<div class="row container-fluid pt-3">
    <div class="col-md-6 mt-3">
        <div class="setting_header bg-info">
            <b><label for="add_locale">Locale name</label></b>
        </div>
       
        <div class="setting_body">
                <div id="responser"></div>
                <form id="addLocaleForm" method="POST" action="<?= $base ?>/api/locale_insert">
                    <input type="text" name="add_locale" class="form-control" id="add_locale" /><br/>
                        <input type="submit" class="btn btn-outline-primary" value="SUBMIT"/>
                </form>
                <br/>
                    <div id="locale_list_loader"></div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="setting_header bg-warning">
            <b><label for="add_gathering">Gathering type</label></b>
        </div>
       
        <div class="setting_body">
                <div id="responser2"></div>
                <form id="addGatheringForm" method="POST" action="<?= $base ?>/api/gathering_insert">
                    <input type="text" name="add_gathering" class="form-control" id="add_gathering" /><br/>
                        <input type="submit" class="btn btn-outline-warning" value="SUBMIT"/>
                </form>
                <br/>
                    <div id="gathering_list_loader"></div>
        </div>
    </div>
</div>