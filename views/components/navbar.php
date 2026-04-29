<header>
    <nav class="navbar">
        <a class="link" href="/">sākums</a>
        <?php if(empty($_SESSION['username'])) { ?>
            <a class="link" href="/login">pieteikties</a>
        <?php } else {?>
            <a class="link" href="/logout">atteikties</a>
        <?php }?>
        <?php if(!empty($_SESSION['username']) && $_SESSION['rights'] == 'admin') {?>
            <a class="link" href="/admin">admin</a>
        <?php } ?>

    </nav>
</header>