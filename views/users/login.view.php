<?php

    ob_start();

    require("views/components/navbar.php");

?>
<link rel="stylesheet" href="css/style.css">
<div class="mainContent">
    <h1 class="mainText">pieteikties</h1>

    <form method="POST" class="accountForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
        <label for="username">lietotājvārds</label>
        <input type="text" name="username" class="username">
        <label for="password">parole</label>
        <input type="password" name="password" class="password">

        <button>pieteikties</button>

            <p class="authSwitch">
                neesi lietotājs?
                <a href="/register">reģistrēties</a>
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