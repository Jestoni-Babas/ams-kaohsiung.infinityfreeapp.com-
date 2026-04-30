<?php
include 'controllers/isLoggedIn.php';
?>


<div id="response_loader"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-primary">
                    <h4>
                        <span class="glyphicon glyphicon-list-alt"></span> Required input
                    </h4>
                    <div id="localTime"></div>
                        <div class="bg-white p-4 rounded">
                            
                                <label for="locale">Gathering type</label>
                                    <div id="gathering_list_loader"></div><br/>
                                <button type="button" class="btn btn-warning" id="btn_qrcode_loader2">
                                    <span class="glyphicon glyphicon-qrcode"></span> Launch QR scanner
                                </button>
                                <button type="button" class="btn btn-primary" id="btn_reset">
                                    <span class="glyphicon glyphicon-repeat"></span> Reset
                                </button>
                            
                        </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-secondary">
                    <div class="alert alert-primary p-2 d-flex justify-content-between align-items-center">
                        <h4 class="m-0 p-0">
                            <span class="glyphicon glyphicon-qrcode"></span> QR Code Scanner
                        </h4>
                        <!-- <button class="btn btn-primary" id="btn_switch_camera" type="button">
                            Switch Camera
                        </button> -->
                    </div>
                        <div class="bg-white p-4 rounded">
                            <div class="container" id="qr_scanner_container2">

                                <div id="reader" class="mx-auto"></div>

                                <div id="result"></div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>