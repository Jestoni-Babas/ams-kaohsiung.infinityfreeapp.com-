<?php

if(!isset($_SESSION['userId'])){
    header("Location: /ams");
    exit;
} 