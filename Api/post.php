<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'] . ''); ?>

<?php
if (isset($_GET['id']) && strlen($_GET['id'] !== 0)) {
    $post = Post::find_post_by_id($_GET['id']);
    if ($post) {

    } else {
        redirect('/');
    }
} else {
    redirect('/');
}
?>

<!-- Page Content -->
<div class="container">
  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">

      <!-- Title -->
      <h1 class="mt-4"><?= $post->title; ?></h1>

      <!-- User -->
      <p class="lead">
        by
        <a href="#"><?= $post->find_user_name(); ?></a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted on <?= $post->created_at; ?></p>

      <hr>

      
      <!-- Post Content -->
      <div style="text-align: justify;"><?= $post->content; ?></div>

      <hr>

    </div>

    
  </div>
</div>

