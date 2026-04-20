<header>
    <nav class="navbar">
        <a class="link" href="/">home</a>
        <?php if(empty($_SESSION)) { ?>
            <a class="link" href="/login">login</a>
        <?php } else {?>
            <a class="link" href="/logout">logout</a>
        <?php }?>
    </nav>
</header>