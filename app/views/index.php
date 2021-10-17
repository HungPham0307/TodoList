<?php
require './app/views/layouts/header.php';
?>

<body>

    <div class="info">
        <?php for ($i = 1; $i <= App\Enums\WorkStatus::TOTAL_STATUS; $i++) { ?>
            <div class="color-info <?php echo App\Enums\WorkStatus::getName($i) ?>"></div>
            <span><?php echo ucwords(App\Enums\WorkStatus::getName($i)) ?></span> <br><br>
        <?php }  ?>
        <h1>Manage your work schedule</h1>
    </div>
    <div class="show-message"></div>
    <div id='calendar'></div>
</body>
<?php
require './app/views/templates/modal/create_work.php';
require './app/views/templates/modal/update_work.php';

require './app/views/layouts/footer.php';
