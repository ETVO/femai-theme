<?php

function address_map($attrs) {
    $attrs = shortcode_atts( array(
    ), $attrs );

    $address = get_theme_mod('contato_address', get_bloginfo('name'));

    $map_address = htmlspecialchars(strip_tags(str_replace('</p>', '+', $address)));

    $map_url = "https://maps.google.com/maps?q=" . $map_address 
    . "&t=m&mrt=yp&z=16&output=embed&iwloc=addr&msa=0";

    $directions_url = "https://www.google.com/maps/dir//$map_address";
    
    $logo = get_theme_mod( 'contato_logo' );

    $show_address = $address;
    
    ob_start(); // Start HTML buffering
    
    if($address):
    ?>

        <section class="address-map">
            <div class="overlay d-flex">
                <div class="m-auto">
                    <div class="logo">
                        <img src="<?php echo $logo; ?>" alt="">
                    </div>
                    <div class="address">
                        <?php echo $show_address; ?>
                    </div>
                    <div class="action text-center">
                        <a href="<?php echo $directions_url; ?>" target="_blank" class="btn btn-outline-light">
                            COMO CHEGAR
                        </a>
                    </div>
                </div>
            </div>

            <iframe frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="<?php echo $map_url; ?>" title="<?php echo $map_address; ?>" aria-label="<?php echo $address ?>">
            </iframe>
        </section>

    <?php
    endif;

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}