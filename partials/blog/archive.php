<?php

/**
 * Partial for blog archive
 * 
 * @package WordPress
 * @subpackage Femai-Theme
 */

$image = get_theme_mod('blog_heading_image');
$title = get_theme_mod('blog_heading_title');

if (!$title) $title = 'Blog';

?>

<div class="blog-archive">
    <div class="femai-heading pageheading" style="background-image: url('<?php echo $image; ?>');">
        <div class="container default-femai">
            <div class="title">
                <h1 m-auto>
                    <?php echo $title; ?>
                </h1>
            </div>
        </div>
    </div>

    <div class="container default-femai">
        <div class="categories-wrap d-flex">

            <?php get_template_part("partials/blog/categories"); ?>
        </div>
        <div class="search d-flex mt-4">
            <div class="m-auto">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

    <?php get_template_part("partials/blog/feed"); ?>

    <?php get_template_part("partials/pagination"); ?>
</div>