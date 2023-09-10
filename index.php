<?php

include('Db.php');
include('Users.php');
include('Topics.php');
include('Messages.php');

$t = new Topics();
$topics = $t->getTopics();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форум для Урал-Софт</title>

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
</head>
<body>
    <div class="container">
        <h1>Форум Урал-Софт</h1>
        <ul class="list-group">
            <?php foreach($topics as $topic) { ?>
            <a href="?topic=<?=$topic['id']?>" class="list-group-item">
                <span class="badge">Сообщений: <?=$topic['count_messages']?></span>
                <span class="badge">Автор: <?=$topic['user']?></span>
                <h3><?=$topic['name']?></h3>
            </a>
            <?php } ?>
        </ul>
    </div>
</body>
</html>