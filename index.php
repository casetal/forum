<?php

include('Db.php');
include('Users.php');
include('Topics.php');
include('Messages.php');

$t = new Topics();
$m = new Messages();

$topic = null;
$topics = [];
$messages = [];

if (isset($_GET['topic'])) {
    $topic = $t->getTopic($_GET['topic']);
    $messages = $m->getTopicMessages($_GET['topic']);
} else {
    $topics = $t->getTopics();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форум для Урал-Софт</title>

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <?php
        if (isset($_GET['topic'])) {
            ?>

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

        <?php } else { ?>

            <h1>Форум Урал-Софт</h1>
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

        <?php } ?>
    </div>
</body>

</html>