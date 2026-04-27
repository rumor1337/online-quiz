<?php
    ob_start();
    require("views/components/navbar.php");
?>

<div class="box">
    <h2>Quiz Results</h2>
    <div class="score-card">
        <p>You got <strong><?= $score ?></strong> out of <strong><?= $total ?></strong> correct!</p>
    </div>

    <hr>

    <div class="summary">
        <?php foreach ($summary as $item): ?>
            <div class="result-item <?= $item['is_correct'] ? 'correct' : 'incorrect' ?>">
                <p><strong>Q: <?= htmlspecialchars($item['question']) ?></strong></p>
                <p>Your answer: <?= htmlspecialchars($item['user_answer']) ?></p>
                <?php if (!$item['is_correct']): ?>
                    <p style="color: green;">Correct answer: <?= htmlspecialchars($item['correct_answer']) ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="/quiz/get" class="btn">Back to Quiz</a>
</div>

<?php
    $content = ob_get_clean();
    require("views/components/layout.php");
?>