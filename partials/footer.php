<?php

/**
 * Footer component
 * 
 * @package WordPress
 */

$footer_logo = get_theme_mod('footer_logo');

$social = get_theme_mod('social_icons');

$whatsapp = get_theme_mod('info_whatsapp');
$address = get_theme_mod('info_address');

$chars = ['(', ')', ' ', '-', '+'];
$whatsapp_url = str_replace($chars, '', $whatsapp);
if (substr('$whatsapp_url', 0, 2) != '55') $whatsapp_url = '55' . $whatsapp_url;
$whatsapp_url = 'https://api.whatsapp.com/send/?phone=' . $whatsapp_url;

$address_url = "https://google.com/maps/place/" . htmlspecialchars(strip_tags(str_replace('</p>', '+', $address)));

?>

<div class="cookies-consent" id="cookiePopup">
    <div class="heading">
        <img src="<?php echo get_site_icon_url(); ?>">
        <b>Este site utiliza cookies.</b>
    </div>
    <div class="text">
        Ao navegar, você está concordando com o armazenamento e uso de cookies em nosso site.
    </div>
    <div class="action">
        <button class="btn btn-outline-primary" id="cookieAccept">aceitar</button>
    </div>
</div>

<footer>
    <div class="footer-1">

        <div class="container default-femai d-flex align-items-center">
            <div class="logo me-3">
                <a href="<?php echo home_url(); ?>">
                    <img class="footer-logo" src="<?php echo get_theme_mod('footer_logo'); ?>" alt="">
                </a>
            </div>
            <div class="social-icons mx-auto ms-md-3">
                <?php foreach ($social as $link) : ?>
                    <a href="<?php echo $link['url']; ?>" title="<?php echo $link['icon']; ?>" target="_blank">
                        <span class="bi bi-<?php echo $link['icon']; ?>"></span>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php
            wp_nav_menu(
                array(
                    'theme_location'    => 'footer_menu',
                    'depth'             => 2,
                    'container_class'   => 'ms-auto',
                    'menu_class'        => 'navbar-nav',
                    'walker'            => new BS_Menu_Walker()
                )
            );
            ?>
        </div>
    </div>
</footer>