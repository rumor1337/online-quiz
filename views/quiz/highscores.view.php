<?php
ob_start();
require("views/components/navbar.php");
?>

<div class="box">
    <h2>Augstākie rezultāti</h2>

    <div class="scores-nav">
        <a href="/highscores">Mani Rezultāti</a>
        <?php foreach ($topics as $topic): ?>
            | <a href="/highscores?topic=<?= $topic['id'] ?>"><?= htmlspecialchars($topic['name']) ?></a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($highScores)): ?>
        <p>Nav rezultātu.</p>
    <?php else: ?>
        <table class="scores-table">
            <thead>
                <tr>
                    <th>Lietotājvārds</th>
                    <?php if (!isset($_GET['topic'])): ?>
                        <th>Tēma</th>
                    <?php endif; ?>
                    <th>Rezultāts</th>
                    <th>Datums</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($highScores as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['username']) ?></td>
                        <?php if (!isset($_GET['topic'])): ?>
                            <td><?= htmlspecialchars($score['topic_name'] ?? 'Nezināms') ?></td>
                        <?php endif; ?>
                        <td><?= $score['score'] ?>/<?= $score['total_questions'] ?></td>
                        <td><?= date('Y-m-d H:i', strtotime($score['completed_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require("views/components/layout.php");
?>
