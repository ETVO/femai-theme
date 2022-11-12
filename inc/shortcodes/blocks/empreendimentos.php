<?php

function empreendimentos($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $post_type = 'empreendimento';
    $orderby = 'date';
    $order = 'desc';

    // Posts Per Page (-1 means it shows all)
    $ppp = -1;

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

        <section class="short-empreendimentos py-md-5">
            <div class="container col-lg-9 mx-auto">
                <div class="items">
                    <?php
                    while ($query->have_posts()) :

                        $query->the_post();

                        $post = get_post();

                        $permalink = esc_url(get_the_permalink());
                        $name = get_the_title();

                        $image_url = get_the_post_thumbnail_url($post->ID, 'full');
                        $image_alt = get_the_post_thumbnail_caption();


                        $endereco = get_field('endereco');
                        $area = get_field('icones')['area'];
                        $dormitorios = get_field('icones')['dormitorios'];
                        $banheiros = get_field('icones')['banheiros'];
                        $images = get_field('imagens');

                        $destaque = get_post_meta(get_the_ID(), 'empreendimento_destaque', true);

                        $etiqueta = get_field('etiqueta')['texto'];
                        $exibir_etiqueta = get_field('etiqueta')['exibir_empreendimentos'];

                    ?>

                        <div class="item mx-auto my-5">
                            <div class="inner row">
                                <div class="col-12 col-md-6 images row g-2 g-md-3 m-0">
                                    <div class="col-12 highlight mt-0">
                                    <?php if ($exibir_etiqueta && $etiqueta != '') : ?>
                                        <span class="tag">
                                            <?php echo $etiqueta; ?>
                                        </span>
                                    <?php endif; ?>
                                        <img src="<?php echo $images['imagem_1']['url']; ?>" alt="<?php echo $images['imagem_1']['caption']; ?>">
                                    </div>
                                    <div class="col-6">
                                        <div class="ratio">
                                            <img src="<?php echo $images['imagem_2']['url']; ?>" alt="<?php echo $images['imagem_2']['caption']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="ratio">
                                            <img src="<?php echo $images['imagem_3']['url']; ?>" alt="<?php echo $images['imagem_3']['caption']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 content d-flex">
                                    <div class="">
                                        <a href="<?php echo $permalink; ?>">
                                            <h4 class="name"><?php echo $name; ?></h4>
                                        </a>
                                        <small class="local d-block mt-3 mb-3 mb-md-4 mb-lg-5">
                                            <span class="icon bi-geo-alt-fill text-primary"></span>
                                            <span class="text"><?php echo $endereco; ?></span>
                                        </small>
    
    
                                        <div class="custom">
                                            <?php if ($destaque) : foreach ($destaque as $carac) : ?>
                                                    <div class="carac d-flex">
                                                        <img src="<?php echo $carac['icon'] ?>" alt="">
                                                        <span><?php echo $carac['desc']; ?></span>
                                                    </div>
                                            <?php endforeach;
                                            endif; ?>
                                        </div>
    
                                    </div>
                                </div>
                                <div class="action col-12 pt-3 pb-5 pt-md-4">
                                    <a class="" href="<?php echo $permalink; ?>">mais detalhes</a>
                                </div>
                            </div>
                        </div>

                    <?php

                    endwhile;
                    ?>
                </div>
            </div>
        </section>

<?php
    }

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
