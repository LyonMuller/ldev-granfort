<?php
function render_technology_columns($columns_data) {
  foreach ($columns_data as $column) {
    $args = [
      'image'    => $column['image'],
      'subtitle' => $column['subtitle'],
      'title'    => $column['title'],
      'text'     => $column['text'],
      'style'    => isset($column['style']) ? $column['style'] : 'bg-white',
    ];
    if(is_post_type_archive('boat') || is_tax('category_boat')) get_template_part('template-parts/components/cards/technology', 'column-archive', $args);
    else get_template_part('template-parts/components/cards/technology', 'column', $args);
  }
}

function get_technology_columns_data($is_archive) {
  $columns_data = [];
  $has_light_bg = false;
  $has_white_bg = false;

  if ($is_archive) {
    for ($i = 1; $i <= 3; $i++) {
      $columns_data[] = [
        'image'    => get_theme_mod('ldev_boats_technology_image_' . $i),
        'subtitle' => get_theme_mod('ldev_boats_technology_subtitle_' . $i),
        'title'    => get_theme_mod('ldev_boats_technology_title_' . $i),
        'text'     => get_theme_mod('ldev_boats_technology_text_' . $i),
        'style'    => 'bg-white', // Default style for archive
      ];
      $has_white_bg = true;
    }
  } else {
    $details_section = get_field('details_section');
    if ($details_section && isset($details_section['items'])) {
      foreach ($details_section['items'] as $item) {
        $columns_data[] = [
          'image'    => $item['image'],
          'subtitle' => $item['headline'],
          'title'    => $item['title'],
          'text'     => $item['description'],
          'style'    => 'bg-light',
        ];
        $has_light_bg = true;
      }
    }
  }

  // Determine the section background based on card styles
  $section_bg = $has_light_bg ? 'bg-white' : 'bg-light';
  return [$columns_data, $section_bg];
}

$is_archive = is_post_type_archive('boat') || is_tax('category_boat');
$section_title = $is_archive ? get_theme_mod('ldev_boats_technology_section_title') : (isset(get_field('details_section')['title']) ? get_field('details_section')['title'] : '');
if ($section_title) :
  list($columns_data, $section_bg) = get_technology_columns_data($is_archive);
?>
  <section class="technology-section <?= esc_attr($section_bg); ?> py-6" id="details" data-section="Details & Techonology">
    <div class="container">
      <div class="row row-cols-lg-3 gap-y-2">
        <div class="col-lg-12">
          <h2 class="section-title txt-ct t-up fwn"><?= esc_html($section_title); ?></h2>
        </div>
        <?php render_technology_columns($columns_data); ?>
      </div>
    </div>
  </section>
<?php endif; ?>