<?php

/**
 * Partial for single post content rendering
 * 
 * @package WordPress
 * @subpackage Femai-Theme
 */

// Initialize meta data array
$meta = array(
    "date" => array(
        "name" => __("Data"),
        "value" => "",
        "show" => true,
    ),
    "category" => array(
        "name" => __("Categoria"),
        "value" => "",
        "show" => true,
    ),
);

// Get theme mod for meta separator 
$separator = "&bull;";

// Get the blog information 
$blog_url = get_post_type_archive_link('post');

// Get the post information
$post = get_post();

$permalink = esc_url(get_the_permalink());


$has_image = has_post_thumbnail();
if ($has_image)
    $image = get_image_props_id(get_post_thumbnail_id($post->ID));

$title = get_the_title();
$excerpt = get_the_excerpt();

$date = get_the_date();
$categories = get_the_category();

$category = "";

for ($i = 0; $i < count($categories); $i++) {
    if ($i > 0) $category .= ", ";
    $category_link = $blog_url . "?category=" . $categories[$i]->slug;
    $category .= "<a class=\"onhover\" href=\"$category_link\">";
    $category .= $categories[$i]->name;
    $category .= "</a>";
}

// Set meta properties to meta array
$meta["date"]["value"] = $date;
$meta["category"]["value"] = $category;

// Generate meta HTML
$meta_html = "";
$i = 0;
$show_separator = false;
foreach ($meta as $property) {

    if ($property["show"]) {
        if ($i > 0 && $show_separator) $meta_html .= "&nbsp;$separator&nbsp;";
        if ($property["value"] != "") {
            $meta_html .= "<small aria-label=\"{$property["name"]}\">";
            $meta_html .= $property["value"];
            $meta_html .= "</small>";
        }
        $show_separator = true;
    }

    $i++;
}

?>

<div class="blog-single">
    <div class="container default-femai">
        <div class="heading mb-2">
            <div class="action">
                <a href="<?php echo $blog_url; ?>" class="d-flex">
                    <span class="bi bi-arrow-left">
                        Voltar ao Blog
                    </span>
                </a>
            </div>
            <div class="title mt-2">
                <h1><?php echo $title; ?></h1>
            </div>
            <div class="meta pb-2">
                <?php echo $meta_html; ?>
            </div>
        </div>
        <div class="excerpt mb-3">
            <p>
                <?php echo $excerpt; ?>
            </p>
        </div>
        <?php if ($has_image) : ?>
            <div class="image mb-3">
                <img class="img-fluid m-auto" 
                    src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" >
            </div>
        <?php endif; ?>
        <div class="content">
            <?php the_content(); ?>
        </div>
        <div class="after-content blog-feed">
            <div class="title">
                <h2 class="fs-3 text-uppercase mb-2">Posts relacionados</h2>
            </div>
            <?php

            $related = get_posts(array(
                'category__in' => wp_get_post_categories($post->ID),
                'numberposts' => 4,
                'post__not_in' => array($post->ID)
            ));

            if ($related) :

            ?>
                <div class="posts row m-0 w-100 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 justify-content-start">
                    <?php
                    foreach ($related as $post) :
                        setup_postdata($post);

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());

                        $title = get_the_title();

                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();

                        $categories = get_the_category();

                    ?>

                        <div class="post col">
                            <div class="card h-100">
                                <div class="image">
                                    <a href="<?php echo $permalink; ?>">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="categories mb-1">
                                        <?php foreach ($categories as $category) : ?>
                                            <a class="category" href="<?php echo "?category={$category->slug}" ?>">
                                                • <?php echo $category->name; ?>
                                            </a>
                                            &nbsp;
                                        <?php endforeach; ?>
                                    </div>

                                    <a class="title" href="<?php echo $permalink; ?>">
                                        <h3><?php echo $title; ?></h3>
                                    </a>

                                </div>
                                <div class="card-footer">
                                    <a class="action btn btn-secondary" href="<?php echo $permalink; ?>">
                                        Ver Mais <span class="bi-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php

                    endforeach;

                    ?>
                </div>
            <?php

            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>