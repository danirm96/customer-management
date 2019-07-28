<?php
/**
 * Created by PhpStorm.
 * User: flash
 * Date: 25/07/2019
 * Time: 23:34
 */
?>
<div class="body">
    <?php
        include_once $_SERVER["DOCUMENT_ROOT"]. '/components/topbar.php';
        echo "<div class='row'>";
        include_once $_SERVER["DOCUMENT_ROOT"] . '/components/aside.php';
        echo "<div id='main'>";
        include_once $_SERVER["DOCUMENT_ROOT"] . '/modules/customers.php';
        echo "</div>";
        echo "</div>";
    ?>

</div>
