<?php

/**
 * Search form template
 * 
 * @package WordPress
 */

$search_validity = __('Por favor insira um termo de pesquisa');
$search_label = __('Pesquisar');

?>

<form class="searchform d-flex form" 
    action="<?php echo esc_url(home_url('/')); ?>" method="get">

    <input type="search" class="input form-control" name="s" id="search" value="<?php the_search_query(); ?>" oninvalid="this.setCustomValidity('<?php echo $search_validity; ?>')" placeholder="<?php echo $search_label; ?>" required>

    <button type="submit" class="submit btn btn-secondary" title="<?php echo $search_label; ?>">
        <span class="bi bi-search"></span>
    </button>

    <input type="hidden" name="post_type" value="post" required>
</form>