<header>
    <nav class="navbar">
        <a href="/">home</a>
        <?php if(empty($_SESSION)) { ?>
            <a href="/login">login</a>
        <?php } else {?>
            <a href="/logout">logout</a>
        <?php }?>
    </nav>
</header>