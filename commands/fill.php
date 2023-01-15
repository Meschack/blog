<?php

require dirname(__DIR__) . '/vendor/autoload.php';

// On instancie Faker pour générer des données aléatoires
$faker = Faker\Factory::create('fr_FR');

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

  $statement = $pdo->prepare("INSERT INTO post SET name=?, slug=?, created_at=?, content=?");

  $statement->execute([
    $faker->sentence(),
    $faker->slug(),
    $faker->date() . ' ' . $faker->time(),
    // $faker->realTextBetween(500, 1000), // Pour avoir du contenu en français
    $faker->paragraph(15),
  ]);

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
