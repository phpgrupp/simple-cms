<?php

require '../app/start.php';
require APP_ROOT . '/classes/post.php';
require APP_ROOT . '/classes/users.php';

$userId = $_SESSION["user_id"];
$currentPage = 'add.php';
$user = $USERS->get_full_user($userId);

if (!empty($_POST)) {

  $insertPage = new Post($userId, $_POST['title'], $_POST['body'], $_POST['tags'], $pdo);
  $insertPage->store_post();

  header('Location: ' . BASE_URL . '/user/list.php?success=created');
}

require VIEW_ROOT . '/user/add.php';
