<?php

    ob_start();

    require("views/components/navbar.php");
    
?>
<link rel="stylesheet" href="css/style.css">
<div class="mainContent">
    <h1 class="mainText">Register</h1>

    <form method="POST" class="accountForm">
        <label for="username">username</label>
        <input type="text" name="username" class="username">
        <label for="password">password</label>
        <input type="password" name="password" class="password">

        <button>submit</button>

            <p class="authSwitch">
                Already have an account?
                <a href="/login">Login</a>
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