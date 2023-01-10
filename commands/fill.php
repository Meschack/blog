<?php

require dirname(__DIR__) . '/vendor/autoload.php';

// On instancie Faker pour générer des données aléatoires
$faker = Faker\Factory::create();

$pdo = new PDO('mysql:host=localhost;dbname=tutoblog;charset=utf8', 'root', '@compteMySQL04', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// On vide complètement la base de données
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$posts = [];
$categories = [];

// On insère les données aléatoires dans chacune des tables en utilisant si besoin, les méthodes utilitaires de Faker
for ($i = 0; $i < 50; $i++) {
  $pdo->exec(
    "INSERT INTO post
    SET name='{$faker->sentence()}',
        slug='{$faker->slug()}',
        created_at='{$faker->date()} {$faker->time()}',
        content='{$faker->paragraphs(rand(3, 15), true)}'
  "
  );

  $posts[] = $pdo->lastInsertId();
}

for ($i = 0; $i < 5; $i++) {
  $pdo->exec(
    "INSERT INTO category
    SET name='{$faker->sentence(3)}',
        slug='{$faker->slug()}'
  "
  );

  $categories[] = $pdo->lastInsertId();
}

// On insère d'abord les données de base et ensuite on utilise les liaisons pour lier les données entre elles
foreach ($posts as $post) {
  $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));

  foreach ($randomCategories as $randomCategory) {
    $pdo->exec(
      "INSERT INTO post_category
      SET post_id = $post,
          category_id = $randomCategory
    "
    );
  }
}

$password = password_hash("admin", PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='$password'");
