<header>
    <nav class="navbar">
        <a class="link" href="/">home</a>
        <?php if(empty($_SESSION['username'])) { ?>
            <a class="link" href="/login">login</a>
        <?php } else {?>
            <a class="link" href="/logout">logout</a>
        <?php }?>
        <?php if(!empty($_SESSION['username']) && $_SESSION['rights'] == 'admin') {?>
            <a class="link" href="/admin">admin panel</a>
        <?php } ?>

    </nav>
</header>