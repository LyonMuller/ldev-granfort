
<form role="search" method="get" id="searchform" class="searchform ps-rel" action="<?= site_url('/') ?>">
  <label class="screen-reader-text" for="s">Digite no campo abaixo sua pesquisa</label>
  <input type="text" value="" name="s" id="s" placeholder="<?= is_search() ? 'Fazer nova Pesquisa' : 'Buscar' ?>">
  <input type="hidden" name="post_type" value="post">
  <input type="submit" id="searchsubmit" value="Pesquisar">
</form>