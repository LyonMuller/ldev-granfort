<?php if(!defined('ABSPATH')) die('Access denied'); ?>
<?php if(have_rows('video_section')) : while(have_rows('video_section')) : the_row();
  $video       = get_sub_field('video');
  $placeholder = get_sub_field('placeholder');
  if($video) :
?>
<section class="video-section ps-rel ovf-h">
  <video 
    class="lozad w-100 mh-100 object-cover"
    id="video"
    data-poster="<?= $placeholder['url'] ?>"
    data-src="<?= $video['url'] ?>"
    controls
  >
    Your browser does not support the video tag.
  </video>
  <script>
    const video = document.getElementById('video');
    video.addEventListener('mouseenter', () => {
      video.setAttribute('controls', 'controls');
    });

    video.addEventListener('mouseleave', () => {
      video.removeAttribute('controls');
    });
  </script>
</section>
<?php endif; endwhile; wp_reset_query(); wp_reset_postdata(); endif; ?>