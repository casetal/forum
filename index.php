<?php

include('./Classes/Db.php');
include('./Classes/Users.php');
include('./Classes/Topics.php');
include('./Classes/Messages.php');

$t = new Topics();
$m = new Messages();
$u = new Users();

$topic = null;
$topics = [];
$messages = [];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_GET['topic'])) {
    $topic = $t->getTopic($_GET['topic']);
    $messages = $m->getTopicMessages($_GET['topic'], $page);
    $pages = $messages['pages'];
    unset($messages['pages']);

    if (isset($_POST['username']) && isset($_POST['message'])) {
        $username = $_POST['username'];
        $message = $_POST['message'];

        $user_id = $u->createUser($username);

        $m->createMessage($_GET['topic'], $user_id, $message);

        header("Refresh:0");
    }
} else if (isset($_GET['form'])) {
    if ($_GET['form'] == "createTopic") {
        if (isset($_POST['username']) && isset($_POST['title']) && isset($_POST['description'])) {
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
                include('./Pages/Topic.php');
            } else if (isset($_GET['form'])) {
                if ($_GET['form'] == "createTopic") {
                    include('./Pages/CreateTopic.php');
                }
            } else {
                include('./Pages/Topics.php');
            }
        ?>
    </div>
</body>

</html>