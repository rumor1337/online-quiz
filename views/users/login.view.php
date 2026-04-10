<?php

    ob_start();

    require("views/components/navbar.php");

?>

<div class="mainContent">
    <h1 class="mainText">login</h1>

    <form method="POST" class="loginForm">
        <label for="username">username</label>
        <input type="text" name="username" class="username">
        <label for="password">password</label>
        <input type="text" name="password" class="password">

        <button>submit</button>
    </form>

</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>