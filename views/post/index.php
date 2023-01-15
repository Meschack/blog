<?php
$title = 'Mon blog';

use App\Model\Post;

require '../src/Model/Post.php';

$pdo = new PDO('mysql:host=localhost;dbname=tutoblog', 'root', '@compteMySQL04', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class)
?>
<h1>Listing des articles</h1>

<div class="row">
  <?php foreach ($posts as $post) : ?>
    <div class="article col-md-3">
      <?php require 'card.php' ?>
    </div>
  <?php endforeach ?>
</div>