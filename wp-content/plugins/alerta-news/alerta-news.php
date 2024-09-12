<?php

/*
Plugin Name: Alerta News Plugin
 Description: Muestra las últimas 4 noticias de Alerta Digital en la página de inicio.
Version: 1.0
Author: Santiago Avilez
Author URI: https://santiagoavilez.com
Plugin URI: https://github.com/santiagoavilez/amcumbre.com
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) exit;

// Función para registrar los scripts solo en la página de inicio
function alerta_news_enqueue_scripts()
{
    if (is_front_page()) {
        // Swiper CSS
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', [], '10.0', 'all');

        // Swiper JS como módulo
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', [], '10.0', true);

        // Archivo JS personalizado para inicializar Swiper
        wp_enqueue_script('alerta-news-swiper-init', plugin_dir_url(__FILE__) . 'js/alerta-news-swiper.js', ['swiper-js'], '1.0', true);

        // Archivo CSS personalizado para el layout
        wp_enqueue_style('alerta-news', plugin_dir_url(__FILE__) . 'css/alerta-news-styles.css');

    }
}
add_action('wp_enqueue_scripts', 'alerta_news_enqueue_scripts');


function fetch_alertadigital_news()
{
    $rss = fetch_feed('https://alertadigital.ar/feed/');

    if (!is_wp_error($rss)) {
        $max_items = $rss->get_item_quantity(8);  // Obtenemos las primeras 8 noticias
        $rss_items = $rss->get_items(0, $max_items);

        if ($max_items > 0) {
            $output = '<div class="alerta-news-wrapper">';
            // Swiper para computadoras (muestra 4 noticias simultáneamente)
            $output .= '<div class="swiper-button-next"></div>';
            $output .= '<div  class="swiper-button-prev"></div>';
            $output .= '<div class="swiper-container desktop-swiper">';

            $output .= '<div class="swiper-wrapper">';

            foreach ($rss_items as $item) {
                $title = esc_html($item->get_title());
                $link = esc_url($item->get_permalink());
                $date = esc_html($item->get_date('j F Y'));
                $image_url = esc_url($item->get_enclosure()->link); // Aquí debes extraer la URL de la imagen de las noticias del feed

                $output .= '<div class="swiper-slide">';
                $output .= '<div class="alerta-news-item">';
                $output .= ' <a href="' . $link . '" target="_blank"> <img src="' . $image_url . '" alt="' . $title . '" /> </a>'; // Imagen
                $output .= '<h4><a href="' . $link . '" target="_blank">' . $title . '</a></h4>';
                $output .= '<p>' . $date . '</p>';
                $output .= '</div>';
                $output .= '</div>';
            }

            // Botones de navegación



            $output .= '</div>';

            $output .= '<div class="swiper-pagination"></div>';

            $output .= '</div>'; // Fin del contenedor Swiper para computadoras

            // Swiper para móviles (primer grupo de 4 noticias)
            $output .= '<div class="swiper-container mobile-swiper-1">';
            $output .= '<div class="swiper-wrapper">';

            for ($i = 0; $i < 4 && $i < $max_items; $i++) {
                $item = $rss_items[$i];
                $title = esc_html($item->get_title());
                $link = esc_url($item->get_permalink());
                $date = esc_html($item->get_date('j F Y'));
                $image_url = esc_url($item->get_enclosure()->link);  // Extraer la URL de la imagen

                $output .= '<div class="swiper-slide">';
                $output .= '<div class="alerta-news-item">';
                $output .= '<img src="' . $image_url . '" alt="' . $title . '" />';
                $output .= '<h4><a href="' . $link . '" target="_blank">' . $title . '</a></h4>';
                $output .= '<p>' . $date . '</p>';
                $output .= '</div>';
                $output .= '</div>';
            }

            // Botones de navegación


            $output .= '</div>';
            $output .= '<div class="swiper-pagination"></div>';

            $output .= '</div>'; // Fin del primer Swiper para móviles

            // Swiper para móviles (segundo grupo de 4 noticias)
            $output .= '<div class="swiper-container mobile-swiper-2">';
            $output .= '<div class="swiper-wrapper">';

            for ($i = 4; $i < 8 && $i < $max_items; $i++) {
                $item = $rss_items[$i];
                $title = esc_html($item->get_title());
                $link = esc_url($item->get_permalink());
                $date = esc_html($item->get_date('j F Y'));
                $image_url = esc_url($item->get_enclosure()->link);  // Extraer la URL de la imagen

                $output .= '<div class="swiper-slide">';
                $output .= '<div class="alerta-news-item">';
                $output .= '<img src="' . $image_url . '" alt="' . $title . '" />';
                $output .= '<h4><a href="' . $link . '" target="_blank">' . $title . '</a></h4>';
                $output .= '<p>' . $date . '</p>';
                $output .= '</div>';
                $output .= '</div>';
            }

            // Botones de navegación


            $output .= '</div>';
            $output .= '<div class="swiper-pagination"></div>';
            $output .= '</div>'; // Fin del segundo Swiper para móviles

            $output .= '</div>'; // Fin del wrapper principal
        } else {
            $output = '<p>No hay noticias disponibles en este momento.</p>';
        }
    } else {
        $output = '<p>Hubo un problema al recuperar las noticias.</p>';
    }

    return $output;
}
add_shortcode('alerta_news', 'fetch_alertadigital_news');
