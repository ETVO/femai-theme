<?php

function empreemdestaque($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $post_type = 'empreendimento';
    $orderby = 'date';
    $order = 'DESC';

    // Posts Per Page (-1 means it shows all)
    $ppp = 3;

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

        <section class="short-empreemdestaque">
            <div class="container col-md-10 col-lg-9 mx-auto">
                <h2 class="title text-center">Empreendimentos</h2>

                <div class="items row g-3 w-100 m-0">
                    <?php
                    while ($query->have_posts()) :

                        $query->the_post();

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());
                        $name = get_the_title();

                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();


                        $etiqueta = get_field('etiqueta')['texto'];
                        
                        $localizacao = get_field('localizacao');
                        $icones = get_field('icones');
                        $area = get_field('icones')['area'];
                        $dormitorios = get_field('icones')['dormitorios'];
                        $banheiros = get_field('icones')['banheiros'];

                    ?>

                        <div class="item mx-auto col-12 col-sm-6 col-xl-4">
                            <div class="inner">
                                <div class="image">
                                    <?php if ($etiqueta != '') : ?>
                                        <span class="tag">
                                            <?php echo $etiqueta; ?>
                                        </span>
                                    <?php endif; ?>
                                    <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                </div>

                                <div class="content">
                                    <a href="<?php echo $permalink; ?>">
                                        <h4 class="name"><?php echo $name; ?></h4>
                                    </a>
                                    <small class="local d-block">
                                        <span class="icon me-1 bi-geo-alt-fill text-primary"></span>
                                        <span class="text text-uppercase">
                                            <?php echo $localizacao; ?>
                                        </span>
                                    </small>

                                    <div class="caracters">
                                        <div class="carac">
                                            <img class="icon" src="<?php echo THEME_IMG_URI . 'area.svg'; ?>"></img>
                                            <span class="text"><?php echo $area; ?></span>
                                        </div>
                                        <div class="carac">
                                            <img class="icon" src="<?php echo THEME_IMG_URI . 'dormitorios.svg'; ?>"></img>
                                            <span class="text"><?php echo $dormitorios; ?></span>
                                        </div>
                                        <div class="carac">
                                            <img class="icon" src="<?php echo THEME_IMG_URI . 'banheiros.svg'; ?>"></img>
                                            <span class="text"><?php echo $banheiros; ?></span>
                                        </div>
                                    </div>

                                    <div class="action">
                                        <a class="btn-icon" href="<?php echo $permalink; ?>">mais detalhes <span class="bi-chevron-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php

                    endwhile;
                    ?>
                </div>

                <div class="view-all">
                    <a href="<?php echo get_permalink(get_theme_mod('empreendimentos_page')); ?>">ver todos</a>
                </div>
            </div>
        </section>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
