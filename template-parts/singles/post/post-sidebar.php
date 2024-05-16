<?php
  $user_avatar = get_avatar_url(get_the_author_meta('ID'));
  $user_name   = get_the_author_meta('display_name');
  // split author name and put an <b> between the last name
  $user_name   = explode(' ', $user_name);
  $user_name   = $user_name[0] . ' <b>' . end($user_name) . '</b>';
  $category = get_the_category();
  $category_name = isset($category[0]) ? $category[0]->name : '';
  $category_link = isset($category[0]) ? get_category_link($category[0]->term_id) : '';

  $date = get_the_date('j \d\e F \d\e Y');
  $share = ldev_share_posts();
?>
<aside class="col-lg-3 sidebar">
  <div class="ps-sticky">
    <?php if($user_avatar): ?>
      <div class="user-info" itemscope itemtype="http://schema.org/Person">
        <meta itemprop="name" content="<?= $user_name ?>">
        <?php if($user_avatar): ?><meta itemprop="image" content="<?= $user_avatar ?>"><?php endif; ?>
        <img src="<?= $user_avatar ?>" alt="<?= $user_name ?>" class="avatar mb-3" width="96" height="96">
        <h3 class="user-name h5 mb-0 ff-headings fwl"><?= $user_name ?></h3>
      </div>
    <?php endif; if($category_name): ?>
      <p class="category-info titulo-span-secondary mb-0 ff-headings">
        <?php if($category_link): ?>
          Postado em <a href="<?= $category_link ?>" class="category-link"><b><?= $category_name ?></b></a>
        <?php endif; ?>
      </p>
    <?php endif; if($date): ?>
      <p class="post-date ff-headings fs-sm">
        <span class="date-value"><?= $date ?></span>
      </p>
    <?php endif; if($share): ?>
      <div class="share-buttons mt-4">
        <h4 class="share-label fwl ff-headings h5 mb-4">Compartilhar <br>Postagem</h4>
        <ul class="sm-icons">
          <?php foreach ($share as $rede) : ?>
            <li><a href="<?= $rede['url'] ?>" class="share-button" target="_blank" title="<?= $rede['title'] ?>"></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</aside>