<?php

    ob_start();
    require("views/components/navbar.php");

?>

<div class="box">
    <div class="dropdown-box">
        
        <form action="/quiz" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <h1 class="choiceText">Select your choice</h1>

            <select name="topic" id="topic">
                <?php foreach($topics as $topic): ?>
                    <option value="<?=$topic['id'] ?? 'null'?>"><?=htmlspecialchars($topic['name']) ?? 'nav pieejami'?></option>
                <?php endforeach; ?>
            </select>

            <button class="submitButton">submit</button>
        </form>

    </div>
</div>

<?php

    $content = ob_get_clean();

    require("views/components/layout.php");

?>
