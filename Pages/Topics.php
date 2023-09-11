<h1>Форум Урал-Софт</h1>
<div class="buttons">
    <a href="?form=createTopic" class="btn btn-info" role="button">Создать тему</a>
</div>
<ul class="list-group">
    <?php foreach ($topics as $topic) { ?>
        <a href="?topic=<?= $topic['id'] ?>" class="list-group-item">
            <span class="badge">Сообщений:
                <?= $topic['count_messages'] ?>
            </span>
            <span class="badge">Автор:
                <?= $topic['user'] ?>
            </span>
            <h3>
                <?= $topic['name'] ?>
            </h3>
        </a>
    <?php } ?>
</ul>

<?php
if ($pages > 1) {
    for ($p = 1; $p <= $pages; $p++) {
        echo '<a href = "?page=' . $p . '">' . $p . ' </a>';
    }
}
?>