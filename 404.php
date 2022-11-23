<?php

/**
 * 404 error page template
 * 
 * @package WordPress
 */

get_header();

?>
<div class="inner-404 flex-fill d-flex">

    <div class="m-auto text-center">
        <h1 class="text-dark fw-bold">Erro 404</h1>
        <div class="text">Página não encontrada.</div>
        <div class="action mt-3">
            <a href="<?php echo home_url(); ?>">Voltar à Home</a>
        </div>
    </div>

</div>
<?php
get_footer();
