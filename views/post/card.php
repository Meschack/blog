<div class="card mb-3">
  <div class="card-body">
    <h4 class="card-title"><?= htmlentities($post->getName()) ?></h4>
    <p class="card-text"><?= $post->getExcerpt() ?></p>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
    <p><a href='<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>' class="btn btn-primary">Voir plus</a></p>
  </div>
</div>