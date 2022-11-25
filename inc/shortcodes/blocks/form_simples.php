<?php

function form_simples($attrs)
{
    $attrs = shortcode_atts(array(
        'title' => 'PARA MAIS INFORMAÇÕES PREENCHA O FORMULÁRIO ABAIXO',
    ), $attrs);

    $shortcode = get_theme_mod('form_simple');

    ob_start();

?>

    <div class="form-simples">
        <div class="container default-femai text-center">
            <div class="form-wrap">
                <div class="title">
                    <h2 class="fs-3"><?php echo $attrs['title']; ?></h2>
                </div>
    
                <div class="shortcode">
                    <?php echo do_shortcode($shortcode); 
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php

    $output = ob_get_contents(); // collect buffered contents

    ob_end_clean(); // Stop HTML buffering

    return $output; // Render contents
}
