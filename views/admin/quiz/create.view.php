<?php
    ob_start();
    require("views/components/navbar.php");
?>

<div class="box">
    <header class="form-header">
        <h2>Admin Panelis</h2>
        <p>Pievienot jaunu jautājumu</p>
    </header>

    <form action="/admin/quiz/create" method="POST" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
        
        <div class="form-group">
            <label for="question">Jautājums</label>
            <input type="text" id="question" name="question" required placeholder="Ievadiet jautājumu...">
        </div>

        <div class="form-group">
            <label for="topic">Tēma</label>
            <select name="topic" id="topic">
                <?php foreach($topics as $topic): ?>
                    <option value="<?=$topic['id'] ?? 'null'?>"><?=$topic['name'] ?? 'nav pieejami'?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr>

        <div class="options-grid">
            <?php for($i = 1; $i <= 4; $i++): ?>
                <div class="form-group">
                    <label for="choice_<?= $i ?>">Opcija <?= $i ?></label>
                    <input type="text" id="choice_<?= $i ?>" name="choices[]" required placeholder="Variants <?= $i ?>">
                </div>
            <?php endfor; ?>
        </div>

        <hr>

        <div class="form-group">
            <label for="correct">Pareizās atbildes indekss (1-4)</label>
            <input type="number" id="correct" name="correct" min="1" max="4" required value="1">
        </div>

        <button type="submit" class="btn-submit">Ievietot datubāzē</button>
    </form>
</div>

<?php
    $content = ob_get_clean();
    require("views/components/layout.php");
?>