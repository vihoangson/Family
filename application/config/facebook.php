<?php
if ($_SERVER["HTTP_HOST"] == "family.vihoangson.com") {
    // family.vihoangson.com
    define("APP_ID", "990882487654318");
    define("APP_SECRET", "3bcd21ad4d38fd842fc205a875fd85c5");
} elseif ($_SERVER["HTTP_HOST"] == "family.vn") {
    // family.vn
    define("APP_ID", "240810182918739");
    define("APP_SECRET", "3d90079e528af4b66dd9cf4c0741674a");
}
$config['app_id']     = APP_ID;
$config['app_secret'] = APP_SECRET;
?>