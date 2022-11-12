<?php

function localizacao($attrs)
{
    $attrs = shortcode_atts(array(), $attrs);

    // Get theme mods
    $endereco = get_theme_mod('endereco');
    $logo = get_theme_mod('local_logo');

    // Treat address data
    $endereco_mapa = htmlspecialchars(strip_tags(str_replace('</p>', '+', $endereco)));

    $map_url = "https://maps.google.com/maps?q=" . $endereco_mapa
        . "&t=m&mrt=yp&z=16&output=embed&iwloc=addr&msa=0";

    $directions_url = "https://www.google.com/maps/dir//$endereco_mapa";

    $show_endereco = $endereco;

    ob_start(); // Start HTML buffering

?>

    <section class="short-localizacao">
        <div class="overlay">
            <div class="inner">
                <div class="logo">
                    <img src="<?php echo $logo; ?>" alt="">
                </div>
                <div class="address mt-3 mb-4">
                    <?php echo $show_endereco; ?>
                </div>
                <div class="action">
                    <a href="<?php echo $directions_url; ?>" target="_blank">Como chegar</a>
                </div>
            </div>
        </div>
        <iframe frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $map_url; ?>" title="<?php echo $endereco_mapa; ?>" aria-label="<?php echo $endereco; ?>">
        </iframe>
    </section>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
