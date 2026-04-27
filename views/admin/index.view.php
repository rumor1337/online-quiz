<?php

    ob_start();

    require("views/components/navbar.php");
    
?>

<div class="box">
    <p class="temporaryText">Admin panelis</a></p>

    <a href="/admin/quiz/create">izveidot testu</a>
    <a href="/admin/topic/create">izveidot topiku</a>
    <a href="/admin/quiz/import">importēt caur JSON</a>

</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>
