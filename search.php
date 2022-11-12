<?php
/**
 * Search results template
 * 
 * @package WordPress
 */

get_header();

$search_query = get_search_query();
$title = "Resultados para <b>'$search_query'</b>";

?>

<div class="blog-wrap">
    <div class="container col-lg-10 col-xl-9 py-5 mx-auto">
        <div class="heading row pb-3">
            <div class="row col-12 mb-3 col-md-auto mb-md-0">
                <div class="col-auto my-auto">
                    <div class="search-title m-auto text-center text-lg-start">
                        <h2 class="m-0">
                            <?php echo $title; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="search col-auto ms-auto">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="feed">
            <?php get_template_part("partials/blog/feed"); ?>
        </div>
    </div>
</div>

<?php

get_footer();