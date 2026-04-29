<?php
    ob_start();
    require("views/components/navbar.php");
?>

<div class="box">
    <h2>Rezultāti</h2>
    <div class="score-card">
        <p>Jūs atbildējāt <strong><?= $score ?></strong> jautājumiem no <strong><?= $total ?></strong> pareizi</p>
    </div>

    <a href="/quiz/get" class="btn">Atpakaļ</a>
</div>

<?php
    $content = ob_get_clean();
    require("views/components/layout.php");
?>