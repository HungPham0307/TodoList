<?php
require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/enums/Enums.php';
require_once __DIR__ . '/app/enums/WorkStatus.php';
require_once __DIR__ . '/app/traits/ConvertString.php';
require_once __DIR__ . '/app/connection/Database.php';
require_once __DIR__ . '/app/models/Model.php';
require_once __DIR__ . "/app/core/App.php";

new App\Core\App;
