<?php

include('Db.php');
include('Users.php');
include('Topics.php');
include('Messages.php');

$t = new Topics();
$m = new Messages();
$u = new Users();

$topic = null;
$topics = [];
$messages = [];

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_GET['topic'])) {
    $topic = $t->getTopic($_GET['topic']);
    $messages = $m->getTopicMessages($_GET['topic'], $page);
    $pages = $messages['pages'];
    unset($messages['pages']);
    
    if(isset($_POST['username']) && isset($_POST['message'])) {
        $username = $_POST['username'];
        $message = $_POST['message'];

        $user_id = $u->createUser($username);

        $m->createMessage($_GET['topic'], $user_id, $message);

        header("Refresh:0");
    }
} else if(isset($_GET['form'])) {
    if($_GET['form'] == "createTopic") {
        if(isset($_POST['username']) && isset($_POST['title']) && isset($_POST['description'])) {
            $username = $_POST['username'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $user_id = $u->createUser($username);

            $topic_id = $t->createTopic($user_id, $title, $description);

            header("Location: ?topic=" . $topic_id);
        }
    }
} else {
    $topics = $t->getTopics($page);
    $pages = $topics['pages'];
    unset($topics['pages']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форум для Урал-Софт</title>

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
        .input-group {
            margin: 15px 0;
        }
    </style>
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

            <?php
                if($pages > 1) {
                    for($p = 1; $p <= $pages; $p++) {  
                        echo '<a href = "?topic=' + $_GET['topic'] + '&page=' . $p . '">' . $p . ' </a>';  
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
            <?php } else if(isset($_GET['form'])) { ?>

                <?php if($_GET['form'] == "createTopic") { ?>
                    <h1>Создание темы</h1>
                    <form method="POST">
                    <div class="input-group input-group-sm">
                            <span class="input-group-addon">Имя пользователя:</span>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Имя темы:</span>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Сообщение:</span>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </form>

                <?php } ?>
        <?php } else { ?>

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
                if($pages > 1) {
                    for($p = 1; $p <= $pages; $p++) {  
                        echo '<a href = "?page=' . $p . '">' . $p . ' </a>';  
                    }
                }
            ?>

        <?php } ?>
    </div>
</body>

</html>