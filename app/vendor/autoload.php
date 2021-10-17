<?php

require_once './app/config/config.php';
require_once './app/enums/Enums.php';
require_once './app/enums/WorkStatus.php';
require_once './app/traits/ConvertString.php';
require_once './app/connection/Database.php';
require_once './app/models/Model.php';
require_once "./app/core/App.php";

return new App\Core\App;
