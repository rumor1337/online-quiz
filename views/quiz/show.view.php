<?php
    ob_start();
    require("views/components/navbar.php");
?>

<div class="box">
    <div class="quiz-container">



        <p>Question <?= $_SESSION['currentPosition'] + 1 ?> of <?= $totalQuestions ?></p>
        <progress id="progressBar" value="<?=$_SESSION['currentPosition'] + 1?>" max="<?=$totalQuestions?>"></progress>

        <h3><?= htmlspecialchars($currentQuestion['question']) ?></h3>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <div class="options">
                <?php for($i = 1; $i <= 4; $i++): ?>
                    <label class="option-block">
                        <input type="radio" name="answer" value="<?= $i ?>" required>
                        <?= htmlspecialchars($currentQuestion["option_$i"]) ?>
                    </label>
                <?php endfor; ?>
            </div>

            <input type="hidden" name="topic" value="<?= htmlspecialchars($currentQuestion['topic']) ?>">
            
            <div class="controls">
                <?php if ($_SESSION['currentPosition'] < $totalQuestions - 1): ?>
                    <button type="submit" name="next_question">Next Question</button>
                <?php else: ?>
                    <button type="submit" name="next_question">Finish Quiz</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require("views/components/layout.php");
?>