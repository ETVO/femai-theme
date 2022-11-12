<?php

function sbpe($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    ob_start(); // Start HTML buffering

?>

    <section class="short-sbpe">
        <img class="texture" src="<?php echo THEME_IMG_URI . 'texture.jpg'; ?>" alt="">
        <div class="content">
            <div class="container">
                <div class="d-flex m-auto flex-column flex-lg-row">
                    <div class="title">
                        <img src="<?php echo THEME_IMG_URI . 'sbpe-frame.svg'; ?>" alt="">
                        <h2>
                            Financie
                            <br>
                            com <span>SBPE</span>
                        </h2>
                    </div>
                    <div class="text-wrap">
                        <div class="text">
                            <?php echo get_theme_mod('sbpe_text'); ?>
                        </div>
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
