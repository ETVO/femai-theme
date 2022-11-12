<?php

function diferenciais($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    $diferenciais = get_theme_mod('diferenciais_lista');

    ob_start(); // Start HTML buffering

?>

    <section class="short-diferenciais">
        <div class="content">
            <div class="inner row w-100 m-0">
                <div class="col-12 col-lg-6 text-wrap">
                    <div class="text">
                        <h2 class="mb-4">Diferenciais</h2>
                        <div class="diferenciais">
                            <?php foreach ($diferenciais as $item) : ?>
                                <div class="item">
                                    <div class="icon <?php echo 'bi-' . $item['icon']; ?>"></div>
                                    <div class="desc"> <?php echo $item['desc']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 image">
                    <img src="<?php echo get_theme_mod('diferenciais_image') ?>" alt="">
                </div>
            </div>
        </div>
    </section>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
