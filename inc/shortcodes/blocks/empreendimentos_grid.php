<?php

function empreendimentos_grid($attrs)
{
    $attrs = shortcode_atts(array(
        'show_all' => false,
        'title' => 'Empreendimentos Femai',
        'texture' => true,
    ), $attrs);

    $id = 'empreendimentosGrid' . rand(0, date('Y'));
    $delay = 0;
    $i = 0;

    $texture = boolval($attrs['texture']);
    $show_all = boolval($attrs['show_all']);

    $texture_style = "style=\"background-image: url('" . THEME_IMG_URI . '/texture.jpg' . "');\"";
    

    $archive_link = get_permalink(get_theme_mod('empreendimentos_page'));

    $post_type = 'empreendimento';
    $orderby = 'date';
    $order = 'DESC';

    // Posts Per Page (-1 means it shows all)
    $ppp = 6;
    if($show_all) $ppp = -1;

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

        <div class="empreendimentos-grid <?php if(!$texture) echo 'no-texture'; ?>" 
            <?php if($texture) echo $texture_style; ?>>
            <div class="container default-femai">
                <?php if($attrs['title']): ?>
                <div class="title">
                    <h2 class="text-primary text-uppercase text-center text-md-start"><?php echo $attrs['title']; ?></h2>
                </div>
                <?php endif; ?>

                <div class="posts row w-100 m-0">
                    <?php
                    while ($query->have_posts()) :

                        $query->the_post();

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());

                        $title = get_the_title();

                        $image_url = get_the_post_thumbnail_url($post->ID, 'thumbnail');
                        $image_alt = get_the_post_thumbnail_caption();

                        $banheiros = get_field('banheiros');
                        $dormitorios = get_field('dormitorios');

                        $localizacao = get_field('localizacao');

                        $etiqueta = get_field('etiqueta');

                        $linha = get_the_terms($post->ID, 'linha')[0];

                        $linha_url = get_term_link($linha->term_id);

                        $delay++;

                    ?>
                        <div class="item col-12 col-sm-6 col-lg-4">
                            <div class="card h-100">
                                <div class="image">
                                    <div class="inner">
                                        <div class="etiqueta <?php if (!$etiqueta) echo 'd-none'; ?>">
                                            <span><?php echo $etiqueta; ?></span>
                                        </div>
                                        <a href="<?php echo $permalink; ?>">
                                            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="info">
                                        <div class="info-content">
                                            <a class="title" href="<?php echo $permalink; ?>">
                                                <h3 class="fs-5 text-uppercase"><?php echo $title; ?></h3>
                                            </a>
                                            <div class="location">
                                                <?php echo $localizacao; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a class="action btn btn-success" href="<?php echo $permalink; ?>">
                                        Saiba Mais <span class="bi-chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <?php if(!$show_all): ?>
                <div class="action">
                    <a class="text-uppercase" href="<?php echo $archive_link; ?>">
                        Ver Mais
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
