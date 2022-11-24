<?php

function empreendimentos_em_destaque($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $id = 'empreendimentosFemai' . rand(0, date('Y'));

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

        <div class="empreendimentos-em-destaque">
            <div class="container default-femai">
                <div class="title">
                    <h2 class="text-primary text-uppercase text-center text-md-start">Empreendimentos</h2>
                </div>

                <div class="posts">
                    <div class="multi-carousel carousel slide items" data-bs-ride="false" data-custom-indicators="false" id="<?php echo $id; ?>">

                        <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <div class="carousel-inner">
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

                            ?>
                                <div class="carousel-item <?php if ($i++ == 0) echo "active"; ?>">
                                    <div class="item col-12 col-sm-6 col-lg-4">
                                        <div class="image">
                                            <div class="inner">
                                                <div class="etiqueta">
                                                    <span><?php echo $etiqueta; ?></span>
                                                </div>
                                                <a href="<?php echo $permalink; ?>">
                                                    <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <div class="info-content">
                                                <div class="title">
                                                    <h3 class="fs-5 text-uppercase"><?php echo $title; ?></h3>
                                                </div>
                                                <div class="location">
                                                    <?php echo $localizacao; ?>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="info-content">
                                                <div class="carac">
                                                    <img class="icon me-2" src="<?php echo THEME_IMG_URI . '/dormitorio.svg' ?>">
                                                    <span class="text"><?php echo $dormitorios; ?></span>
                                                </div>
                                                <div class="carac">
                                                    <img class="icon me-2" src="<?php echo THEME_IMG_URI . '/banheiro.svg' ?>">
                                                    <span class="text"><?php echo $banheiros; ?></span>
                                                </div>
                                                <div class="linha">
                                                    <a class="badge rounded-pill" href="<?php echo $linha_url; ?>">
                                                        <?php echo $linha->name; ?>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <a class="action btn btn-success" href="<?php echo $permalink; ?>">
                                            Saiba Mais <span class="bi-chevron-right"></span>
                                        </a>
                                    </div>
                                </div>

                            <?php endwhile; ?>

                        </div>

                        <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $id; ?>" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Seguinte</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
