<?php

    ob_start();
    session_start();
    require "Sessions.php";

    require("views/components/navbar.php");
    
?>

main page

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>