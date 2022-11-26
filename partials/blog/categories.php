<?php

/**
 * Partial for categories toggler
 * 
 * @package WordPress
 * @subpackage Femai-Theme
 */

$categories = get_categories();

if (isset($_GET['category'])) {
    $set_category_slug = $_GET['category'];
}

$show_reset_btn = true;
$reset_btn_label = 'Limpar seleção';

$blog_url = get_permalink(get_option('page_for_posts'));

?>

<span class="blog-categories mx-auto">
    <?php
    foreach ($categories as $category) :

        // Is this category the active one?
        if ($category->slug == $set_category_slug) {
            $class = "selected";
            $href = $blog_url . "?";
        } else {
            $class = "";
            $href = $blog_url . "?category={$category->slug}";
        }
    ?>
        <a class="category me-2 <?php echo $class; ?>" href="<?php echo $href; ?>">
            <?php echo $category->name; ?>
        </a>
    <?php
    endforeach;

    // Add reset button for the user to clear category selection
    if ($show_reset_btn && count($categories) > 0 && $set_category_slug != "") :
    ?>
        <a class="category-reset" href="?" title="<?php echo $reset_btn_label; ?>" aria-label="<?php echo $reset_btn_label; ?>">
            <span class="bi bi-arrow-counterclockwise"></span>
        </a>
    <?php endif; ?>

</span>