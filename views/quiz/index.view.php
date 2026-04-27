<?php

    ob_start();
    require("views/components/navbar.php");
    
    Sessions::validate();

?>

<div class="box">
    <p class="temporaryText">Index lapa, apmeklē <a href="quiz/get">quiz/get</a></p>
</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>
