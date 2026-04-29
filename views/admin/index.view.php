<?php

    ob_start();

    require("views/components/navbar.php");
    
?>

<div class="box">
    <p class="temporaryText">Admin panelis</a></p>

    <a href="/admin/quiz/create">izveidot testu</a>
    <a href="/admin/topic/create">izveidot topiku</a>

</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>
