<?php 
  $relateds = ldev_get_related_posts_by_category(get_the_ID(), 3, 3);
  if(!empty($relateds)) :
?>
<div class="posts-relateds py-6 bg-light">
  <div class="container">
    <div class="row row-cols-1 gap-y-2 row-cols-lg-3">
      <div class="col-lg-12 mb-4">
        <h2 class="h3 fwl titulo-span-secondary"><b>Leia</b> também:</h2>
      </div>
      <?php foreach ($relateds as $related) : get_template_part('template-parts/components/blog/article', null, ['id'=>$related]); endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>