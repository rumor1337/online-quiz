<?php

    ob_start();

?>
<link rel="stylesheet" href="css/style.css">
<div class="mainContent">
    <h1 class="mainText">Login</h1>

    <form method="POST" class="loginForm">
        <label for="username">username</label>
        <input type="text" name="username" class="username">
        <label for="password">password</label>
        <input type="password" name="password" class="password">

        <button>submit</button>

            <p class="authSwitch">
                Don't have an account?
                <a href="/register">Register</a>
            </p>

    </form>

  <?php if(!empty($errors)) {

    foreach($errors as $error) {
        echo "<p class='error'>$error</p>";
    }

} ?>

</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>