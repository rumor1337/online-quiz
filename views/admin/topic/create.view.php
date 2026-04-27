<?php
    ob_start();
    require("views/components/navbar.php");
?>

<div class="box">
    <header class="form-header">
        <h2>Admin Panelis</h2>
        <p>Pievienot jaunu topiku</p>
    </header>

    <form action="/admin/topic/create" method="POST" class="admin-form">
        <div class="form-group">
            <label for="name">Topika nosaukums</label>
            <input type="text" id="name" name="name" required placeholder="Ievadiet topika nosaukumu">
        </div>

        <button type="submit" class="btn-submit">Ievietot datubāzē</button>
    </form>
</div>

<?php
    $content = ob_get_clean();
    require("views/components/layout.php");
?>