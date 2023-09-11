<div class="row grid thumbnail card-shadow" style="margin-top: 30px;">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-5 card">
        <h3>
            <?= $topic['user'] ?>
        </h3>
        <p>Сообщений:
            <?= $topic['user_count_messages'] ?>
        </p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-9 card">

        <div class="caption">
            <h3 class="card-label">
                <?= $topic['name'] ?>
            </h3>
            <p>
                <?= $topic['description'] ?>
            </p>
        </div>
        <div class="caption card-footer">
            <ul class="list-inline">
                <li><i>Дата создания темы:
                        <?= $topic['created_at'] ?>
                    </i></li>
            </ul>
        </div>

    </div>

</div>

<?php foreach ($messages as $message) { ?>
    <div class="row grid thumbnail card-shadow">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-5 card">
            <h3>
                <?= $message['user'] ?>
            </h3>
            <p>Сообщений:
                <?= $message['user_count_messages'] ?>
            </p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-9 card">

            <div class="caption">
                <p>
                    <?= $message['message'] ?>
                </p>
            </div>
            <div class="caption card-footer">
                <ul class="list-inline">
                    <li><i>Дата сообщения:
                            <?= $message['created_at'] ?>
                        </i></li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>

<?php
if ($pages > 1) {
    for ($p = 1; $p <= $pages; $p++) {
        echo '<a href = "?topic=' . $_GET['topic'] . '&page=' . $p . '">' . $p . ' </a>';
    }
}
?>

<div class="messageForm">
    <h3>Ответить</h3>
    <form method="POST">
        <div class="input-group input-group-sm">
            <span class="input-group-addon">Имя пользователя:</span>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="input-group input-group-sm">
            <span class="input-group-addon">Сообщение:</span>
            <textarea name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>