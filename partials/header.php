<?php
/**
 * Header component
 * 
 * @package WordPress
 */

$whatsapp = get_theme_mod('info_whatsapp');

$chars = ['(', ')', ' ', '-', '+'];
$whatsapp_url = str_replace($chars, '', $whatsapp);
if (substr('$whatsapp_url', 0, 2) != '55') $whatsapp_url = '55' . $whatsapp_url;
$whatsapp_url = 'https://api.whatsapp.com/send/?phone=' . $whatsapp_url;

?>

<header class="navbar navbar-expand-lg" id="header">
    <div class="container default-femai">
        <div class="navbar-brand m-0">
            <?php the_custom_logo(); ?>
        </div>
        
        <button class="navbar-toggler m-0" type="button" 
		data-bs-toggle="collapse" data-bs-target="#mainMenuDropdown" 
		aria-controls="mainMenuDropdown" aria-expanded="false" aria-label="<?php echo __("Ativar Menu") ?>">
            <span class="icon bi bi-list"></span>
		</button>

        <div class="collapse navbar-collapse" id="mainMenuDropdown">
            <?php 
                wp_nav_menu(
                    array( 
                        'theme_location'    => 'main_menu',
                        'depth'             => 2,
                        'container_class'   => 'ms-auto mx-lg-auto',
                        'menu_class'        => 'navbar-nav',
                        'walker'            => new BS_Menu_Walker()
                    )
                ); 
            ?>
            
            <div class="cta-header">
                <a class="whatsapp-btn d-flex" href="<?php echo $whatsapp_url; ?>">
                    <span class="icon bi-whatsapp my-auto me-2"></span>
                    <span class="number my-auto">
                        <?php echo $whatsapp; ?>
                    </span>
                </a>
            </div>
        </div>
        
    </div>
</header>