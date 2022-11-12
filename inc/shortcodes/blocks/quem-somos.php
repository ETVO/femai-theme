<?php

function quem_somos($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    ob_start(); // Start HTML buffering

?>

    <section class="short-quem-somos">
        <div class="content">
            <div class="container col-md-10 col-lg-9 mx-auto">
                <div class="inner row">
                    <div class="col-12 col-lg-6 col-xl-4 mb-4 mb-lg-0 text-wrap">
                        <div class="text">
                            <?php echo get_theme_mod('quem_somos'); ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-5 logo">
                        <img src="<?php echo wp_get_attachment_url(get_theme_mod('custom_logo')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
