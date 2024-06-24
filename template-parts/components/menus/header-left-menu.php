<?php 
  $menu_label = isset($args['label']) ? $args['label'] : '';
  $menu = isset($args['menu']) ? $args['menu'] : '';

  $categories = get_terms(array(
    'taxonomy' => 'boat_category',
    'hide_empty' => true,
    'parent' => 0,
  ));

  if(!$menu_label && !$menu && !empty($categories)) return;
?>
<div class="menu-boats">  
  <button class="navbar-toggler gap-0-5 inline-flex aic" type="button" data-bs-toggle="offcanvas" data-bs-target="#left-menu" aria-controls="left-menu" aria-label="Toggle navigation">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M3 18H21" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
    <?= $menu_label ?>
  </button>
  <div class="offcanvas offcanvas-start" tabindex="-1" id="left-menu" aria-labelledby="offcanvasLabel">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 px-0 menu-container">
          <div class="offcanvas-header aic">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18" stroke="#191C1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 6L18 18" stroke="#191C1F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            <div class="favicon"><?= ldev_favicon() ?></div>
          </div>
          <div class="offcanvas-body px-0">
            <h2 class="mb-3 py-1 h4 fwn border-bottom gray-250 t-gray px-2"><?= $menu_label ?></h2>
            <nav class="boats-menu px-2">
              <ul class="nav">
                <?php
                  $first_post = '';
                  foreach ($categories as $c => $category) {
                    $show = $c === 0 ? 'show' : '';
                    echo "<li class='nav-link category-title flex aic gap-1 flex-wrap $show'>" . $category->name;
                    
                    $boat_query = get_posts(array(
                      'post_type'      => 'boat',
                      'fields'         => 'ids',
                      'posts_per_page' => -1,
                      'tax_query' => [[
                        'taxonomy' => 'boat_category',
                        'field'    => 'term_id',
                        'terms'    => $category->term_id,
                      ]],
                    ));

                    if (!empty($boat_query)) {
                      echo "<ul class='nav pl-2 boat-links w-100 $show'>";
                        foreach($boat_query as $c2 => $boat) :
                          $active = $c2 === 0 ? 'active' : '';
                          $permalink = get_permalink($boat);
                          $title = get_the_title($boat);
                          $featured_image = get_the_post_thumbnail_url($boat);
                          $first_post = $c2 === 0 ? $boat : $first_post;
                          echo "<li class='nav-item'><a class='nav-link $active' href='$permalink' data-bg='$featured_image'>$title</a></li>";
                        endforeach;
                      echo '</ul>';
                    }
                    wp_reset_postdata();
                    echo '</li>';
                  }
                ?>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-md-8 pr-0 boat-container flex" style="--bg: url(<?= get_the_post_thumbnail_url($first_post) ?>)">
          <div class="image-bg"></div>
          <div class="text flex t-primary gap-1 aic ps-rel">
            <div class="favicon"><?= ldev_favicon() ?></div>
            <h2 class="h3 t-primary fwb title-boat mb-0" data-text="<?= get_the_title($first_post) ?>"></h2>
            <a class="t-wh btn-black ps-abs flex aic" href="<?= get_the_permalink($first_post) ?>">Discover</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>