<?php

/**
 * Partial for blog archive feed
 * 
 * @package WordPress
 * @subpackage Femai-Theme
 */

?>

<div class="blog-feed">
    <div class="container default-femai">
        <div class="posts row m-0 w-100 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 justify-content-center">
            <?php
            if (have_posts()) {
                while (have_posts()) :
                    the_post();
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

                endwhile;
            }
            ?>
        </div>
    </div>
</div>