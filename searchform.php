<?php

/**
 * Search form template
 * 
 * @package WordPress
 */

$search_validity = __('Por favor insira um termo de pesquisa');
$search_label = __('Pesquisar');

?>

<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="searchform d-flex form">

    <div class="d-flex">
        <input type="search" class="input form-control" name="s" id="search" value="<?php the_search_query(); ?>" oninvalid="this.setCustomValidity('<?php echo $search_validity; ?>')" placeholder="<?php echo $search_label; ?>" required>

        <button type="submit" class="submit" title="<?php echo $search_label; ?>">
            <span class="bi bi-search"></span>
        </button>
    </div>

    <input type="hidden" name="post_type" value="post" required>
</form>