<?php

function blog_recentes($attrs)
{
    $attrs = shortcode_atts(array(
        'title' => 'Blog Femai'
    ), $attrs);

    $archive_link = get_permalink(get_option('page_for_posts'));

    $post_type = 'post';
    $orderby = 'date';
    $order = 'DESC';

    // Posts Per Page (-1 means it shows all)
    $ppp = 4;

    // WP_Query arguments
    $args = array(
        'post_type'              => $post_type,
        'post_status'            => array('publish'),
        'has_password'           => false,
        'posts_per_page'         => $ppp,
        'no_found_posts'         => true,

        // Order ASC first by 'menu_order', only after by 'title' or 'date'
        'orderby'                => array('menu_order' => 'ASC', $orderby => $order),
    );

    // The Query
    $query = new WP_Query($args);

    ob_start(); // Start HTML buffering

    if ($query->have_posts()) {
?>
        <div class="blog-recentes blog-feed">
            <div class="container default-femai">
                <div class="title">
                    <h2 class="text-primary text-uppercase text-center text-md-start">
                        <?php echo $attrs['title']; ?>
                    </h2>
                </div>

                <div class="posts row m-0 w-100 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 justify-content-center">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
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
                    ?>
                </div>
                
                <div class="action">
                    <a class="text-uppercase" href="<?php echo $archive_link; ?>">
                        Ver Todos
                    </a>
                </div>
            </div>
        </div>
<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
