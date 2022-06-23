<?php
    include "../../config/base_url";
    session_start();
    session_destroy();
    header("Location: $BASE_URL/login-page");
?>