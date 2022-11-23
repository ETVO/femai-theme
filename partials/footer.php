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

        <div class="container default-femai d-flex align-items-center flex-column flex-md-row">
            <div class="logo me-3">
                <a href="<?php echo home_url(); ?>">
                    <img class="footer-logo" src="<?php echo get_theme_mod('footer_logo'); ?>" alt="">
                </a>
            </div>
            <div class="d-block my-2"></div>
            <div class="social-icons mx-auto ms-md-3">
                <?php foreach ($social as $link) : ?>
                    <a href="<?php echo $link['url']; ?>" title="<?php echo $link['icon']; ?>" target="_blank">
                        <span class="bi bi-<?php echo $link['icon']; ?>"></span>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="d-block my-2"></div>
            <?php
            wp_nav_menu(
                array(
                    'theme_location'    => 'footer_menu',
                    'depth'             => 2,
                    'container_class'   => 'mx-auto ms-md-auto text-center text-md-start',
                    'menu_class'        => 'navbar-nav',
                    'walker'            => new BS_Menu_Walker()
                )
            );
            ?>
        </div>
    </div>

    <div class="footer-2">
        <div class="container default-femai d-flex align-items-center flex-column flex-lg-row">
            <a class="whatsapp-number d-flex align-items-center" href="<?php echo $whatsapp_url; ?>" target="_blank">
                <span class="icon bi-whatsapp"></span>
                <span class="number"><?php echo $whatsapp; ?></span>
            </a>
            <div class="d-block my-2"></div>
            <a class="address m-auto text-center" href="<?php echo $address_url; ?>" target="_blank">
                <?php echo $address; ?>
            </a>
            <div class="d-block my-2"></div>
            <a class="whatsapp-btn btn btn-success d-flex align-items-center" href="<?php echo $whatsapp_url; ?>">
                <span class="icon bi-whatsapp"></span>
                <span class="text">femai zap</span>
            </a>
        </div>
    </div>

    <div class="footer-3">
        <div class="container default-femai d-flex align-items-center">
            <small class="bottom-text m-auto text-center">
                <?php echo date('Y'); ?> - FEMAI EMPREENDIMENTOS • DESENVOLVIDO POR <a href="https://www.imobmark.com.br/" target="_blank">IMOBMARK</a>
            </small>
        </div>
    </div>
</footer>