<?php
/*
Plugin Name: Programación Accordion
Description: Muestra la programación en un acordeón con días de la semana.
Version: 1.0
Author: Santiago Avilez
Author URI: https://santiagoavilez.com
Plugin URI: https://github.com/santiagoavilez/amcumbre.com
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue scripts and styles
function programacion_enqueue_scripts()
{
    wp_enqueue_style('programacion-accordion-style', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('programacion-accordion-script', plugin_dir_url(__FILE__) . 'js/accordion.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'programacion_enqueue_scripts');

// Shortcode to display the accordion
function programacion_accordion_shortcode()
{
    ob_start();
?>
    <div class="programacion-accordion">
        <div class="accordion-item active">
            <div class="accordion-title">
                <h3>Lunes a Viernes</h3>
                <span class="accordion-toggle ">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" zoomAndPan="magnify" viewBox="0 0 22.5 12.75" height="17" preserveAspectRatio="xMidYMid meet" version="1.0">
                        <defs>
                            <clipPath id="9e3afb0b3a">
                                <path d="M 0.277344 0.3125 L 21.554688 0.3125 L 21.554688 11.878906 L 0.277344 11.878906 Z M 0.277344 0.3125 " clip-rule="nonzero" />
                            </clipPath>
                            <clipPath id="dfa601b75e">
                                <path d="M 0.277344 0.0976562 L 21.554688 0.0976562 L 21.554688 11.664062 L 0.277344 11.664062 Z M 0.277344 0.0976562 " clip-rule="nonzero" />
                            </clipPath>
                        </defs>
                        <g clip-path="url(#9e3afb0b3a)">
                            <path fill="#100f0d" d="M 21.253906 2.136719 C 21.664062 1.707031 21.652344 1.027344 21.230469 0.613281 C 20.816406 0.210938 20.160156 0.210938 19.75 0.613281 L 10.914062 9.539062 L 2.082031 0.613281 C 1.65625 0.203125 0.984375 0.214844 0.578125 0.640625 C 0.179688 1.058594 0.175781 1.71875 0.574219 2.136719 L 9.734375 11.382812 C 10.386719 12.042969 11.445312 12.042969 12.097656 11.382812 L 21.253906 2.136719 " fill-opacity="1" fill-rule="nonzero" />
                        </g>
                        <g clip-path="url(#dfa601b75e)">
                            <path fill="#100f0d" d="M 21.253906 1.917969 C 21.664062 1.492188 21.652344 0.8125 21.230469 0.398438 C 20.816406 -0.00390625 20.160156 -0.00390625 19.75 0.398438 L 10.914062 9.320312 L 2.082031 0.398438 C 1.65625 -0.0117188 0.984375 -0.00390625 0.578125 0.425781 C 0.179688 0.839844 0.175781 1.5 0.574219 1.917969 L 9.734375 11.167969 C 10.386719 11.828125 11.445312 11.828125 12.097656 11.167969 L 21.253906 1.917969 " fill-opacity="1" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </div>
            <div class="accordion-content">
                <?php echo obtener_programacion_por_dia(array('lunes', 'martes', 'miercoles', 'jueves', 'viernes')); ?>


            </div>
        </div>
        <div class="accordion-item ">
            <div class="accordion-title">
                <h3>Lunes, miercoles y viernes</h3>
                <svg class="accordion-toggle"" xmlns=" http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" zoomAndPan="magnify" viewBox="0 0 22.5 12.75" height="17" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <defs>
                        <clipPath id="9e3afb0b3a">
                            <path d="M 0.277344 0.3125 L 21.554688 0.3125 L 21.554688 11.878906 L 0.277344 11.878906 Z M 0.277344 0.3125 " clip-rule="nonzero" />
                        </clipPath>
                        <clipPath id="dfa601b75e">
                            <path d="M 0.277344 0.0976562 L 21.554688 0.0976562 L 21.554688 11.664062 L 0.277344 11.664062 Z M 0.277344 0.0976562 " clip-rule="nonzero" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#9e3afb0b3a)">
                        <path fill="#100f0d" d="M 21.253906 2.136719 C 21.664062 1.707031 21.652344 1.027344 21.230469 0.613281 C 20.816406 0.210938 20.160156 0.210938 19.75 0.613281 L 10.914062 9.539062 L 2.082031 0.613281 C 1.65625 0.203125 0.984375 0.214844 0.578125 0.640625 C 0.179688 1.058594 0.175781 1.71875 0.574219 2.136719 L 9.734375 11.382812 C 10.386719 12.042969 11.445312 12.042969 12.097656 11.382812 L 21.253906 2.136719 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                    <g clip-path="url(#dfa601b75e)">
                        <path fill="#100f0d" d="M 21.253906 1.917969 C 21.664062 1.492188 21.652344 0.8125 21.230469 0.398438 C 20.816406 -0.00390625 20.160156 -0.00390625 19.75 0.398438 L 10.914062 9.320312 L 2.082031 0.398438 C 1.65625 -0.0117188 0.984375 -0.00390625 0.578125 0.425781 C 0.179688 0.839844 0.175781 1.5 0.574219 1.917969 L 9.734375 11.167969 C 10.386719 11.828125 11.445312 11.828125 12.097656 11.167969 L 21.253906 1.917969 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                </svg>
            </div>
            <div class="accordion-content">
                <?php echo obtener_programacion_por_dia(array('lunes', 'miercoles', 'viernes')); ?>


            </div>
        </div>

        <div class="accordion-item ">
            <div class="accordion-title">
                <h3>Martes y jueves</h3>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" zoomAndPan="magnify" viewBox="0 0 22.5 12.75" height="17" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <defs>
                        <clipPath id="9e3afb0b3a">
                            <path d="M 0.277344 0.3125 L 21.554688 0.3125 L 21.554688 11.878906 L 0.277344 11.878906 Z M 0.277344 0.3125 " clip-rule="nonzero" />
                        </clipPath>
                        <clipPath id="dfa601b75e">
                            <path d="M 0.277344 0.0976562 L 21.554688 0.0976562 L 21.554688 11.664062 L 0.277344 11.664062 Z M 0.277344 0.0976562 " clip-rule="nonzero" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#9e3afb0b3a)">
                        <path fill="#100f0d" d="M 21.253906 2.136719 C 21.664062 1.707031 21.652344 1.027344 21.230469 0.613281 C 20.816406 0.210938 20.160156 0.210938 19.75 0.613281 L 10.914062 9.539062 L 2.082031 0.613281 C 1.65625 0.203125 0.984375 0.214844 0.578125 0.640625 C 0.179688 1.058594 0.175781 1.71875 0.574219 2.136719 L 9.734375 11.382812 C 10.386719 12.042969 11.445312 12.042969 12.097656 11.382812 L 21.253906 2.136719 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                    <g clip-path="url(#dfa601b75e)">
                        <path fill="#100f0d" d="M 21.253906 1.917969 C 21.664062 1.492188 21.652344 0.8125 21.230469 0.398438 C 20.816406 -0.00390625 20.160156 -0.00390625 19.75 0.398438 L 10.914062 9.320312 L 2.082031 0.398438 C 1.65625 -0.0117188 0.984375 -0.00390625 0.578125 0.425781 C 0.179688 0.839844 0.175781 1.5 0.574219 1.917969 L 9.734375 11.167969 C 10.386719 11.828125 11.445312 11.828125 12.097656 11.167969 L 21.253906 1.917969 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                </svg>
            </div>
            <div class="accordion-content">
                <?php echo obtener_programacion_por_dia(array('martes', 'jueves')); ?>


            </div>
        </div>
        <div class="accordion-item">
            <div class="accordion-title">
                <h3>Sábado</h3>
                <svg class="accordion-toggle"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" zoomAndPan="magnify" viewBox="0 0 22.5 12.75" height="17" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <defs>
                        <clipPath id="9e3afb0b3a">
                            <path d="M 0.277344 0.3125 L 21.554688 0.3125 L 21.554688 11.878906 L 0.277344 11.878906 Z M 0.277344 0.3125 " clip-rule="nonzero" />
                        </clipPath>
                        <clipPath id="dfa601b75e">
                            <path d="M 0.277344 0.0976562 L 21.554688 0.0976562 L 21.554688 11.664062 L 0.277344 11.664062 Z M 0.277344 0.0976562 " clip-rule="nonzero" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#9e3afb0b3a)">
                        <path fill="#100f0d" d="M 21.253906 2.136719 C 21.664062 1.707031 21.652344 1.027344 21.230469 0.613281 C 20.816406 0.210938 20.160156 0.210938 19.75 0.613281 L 10.914062 9.539062 L 2.082031 0.613281 C 1.65625 0.203125 0.984375 0.214844 0.578125 0.640625 C 0.179688 1.058594 0.175781 1.71875 0.574219 2.136719 L 9.734375 11.382812 C 10.386719 12.042969 11.445312 12.042969 12.097656 11.382812 L 21.253906 2.136719 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                    <g clip-path="url(#dfa601b75e)">
                        <path fill="#100f0d" d="M 21.253906 1.917969 C 21.664062 1.492188 21.652344 0.8125 21.230469 0.398438 C 20.816406 -0.00390625 20.160156 -0.00390625 19.75 0.398438 L 10.914062 9.320312 L 2.082031 0.398438 C 1.65625 -0.0117188 0.984375 -0.00390625 0.578125 0.425781 C 0.179688 0.839844 0.175781 1.5 0.574219 1.917969 L 9.734375 11.167969 C 10.386719 11.828125 11.445312 11.828125 12.097656 11.167969 L 21.253906 1.917969 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                </svg>
            </div>
            <div class="accordion-content">
                <?php echo obtener_programacion_por_dia('sabado'); ?>
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-title">
                <h3>Domingo</h3>
                <svg class="accordion-toggle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" zoomAndPan="magnify" viewBox="0 0 22.5 12.75" height="17" preserveAspectRatio="xMidYMid meet" version="1.0">
                    <defs>
                        <clipPath id="9e3afb0b3a">
                            <path d="M 0.277344 0.3125 L 21.554688 0.3125 L 21.554688 11.878906 L 0.277344 11.878906 Z M 0.277344 0.3125 " clip-rule="nonzero" />
                        </clipPath>
                        <clipPath id="dfa601b75e">
                            <path d="M 0.277344 0.0976562 L 21.554688 0.0976562 L 21.554688 11.664062 L 0.277344 11.664062 Z M 0.277344 0.0976562 " clip-rule="nonzero" />
                        </clipPath>
                    </defs>
                    <g clip-path="url(#9e3afb0b3a)">
                        <path fill="#100f0d" d="M 21.253906 2.136719 C 21.664062 1.707031 21.652344 1.027344 21.230469 0.613281 C 20.816406 0.210938 20.160156 0.210938 19.75 0.613281 L 10.914062 9.539062 L 2.082031 0.613281 C 1.65625 0.203125 0.984375 0.214844 0.578125 0.640625 C 0.179688 1.058594 0.175781 1.71875 0.574219 2.136719 L 9.734375 11.382812 C 10.386719 12.042969 11.445312 12.042969 12.097656 11.382812 L 21.253906 2.136719 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                    <g clip-path="url(#dfa601b75e)">
                        <path fill="#100f0d" d="M 21.253906 1.917969 C 21.664062 1.492188 21.652344 0.8125 21.230469 0.398438 C 20.816406 -0.00390625 20.160156 -0.00390625 19.75 0.398438 L 10.914062 9.320312 L 2.082031 0.398438 C 1.65625 -0.0117188 0.984375 -0.00390625 0.578125 0.425781 C 0.179688 0.839844 0.175781 1.5 0.574219 1.917969 L 9.734375 11.167969 C 10.386719 11.828125 11.445312 11.828125 12.097656 11.167969 L 21.253906 1.917969 " fill-opacity="1" fill-rule="nonzero" />
                    </g>
                </svg>
            </div>
            <div class="accordion-content">
                <?php echo obtener_programacion_por_dia('domingo'); ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('programacion_accordion', 'programacion_accordion_shortcode');

// Function to get the programming by day
function obtener_programacion_por_dia($dias)
{
    // Asegurarse de que $dias sea un array
    if (!is_array($dias)) {
        $dias = array($dias); // Asegúrate de que $dias siempre sea un array
    }

    // Argumentos para la consulta
    $meta_query = array('relation' => 'AND'); // Relación 'OR' para permitir coincidencias en cualquier día

    foreach ($dias as $dia) {
        $meta_query[] = array(
            'key' => 'dias_semana',
            'value' => $dia,
            'compare' => 'LIKE', // Coincidencias parciales dentro del campo 'dias_semana'
        );
    }

    $args = array(
        'post_type' => 'programacion',
        'meta_query' => $meta_query, // Meta query para buscar coincidencias en los días
        'meta_key' => 'hora_inicio', // Clave meta para ordenar por hora de inicio
        'orderby' => array(
            'meta_value_num' => 'ASC', // Ordena por hora de inicio (número)
            'meta_value' => 'ASC', // Ordena por hora de fin si es necesario
        ),
        'meta_type' => 'TIME', // Indica que es un campo de tiempo (hora_inicio y hora_fin)
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $output = '<ul style=" list-style: none">';
        while ($query->have_posts()) {
            $query->the_post();
             $dias_programacion = get_post_meta(get_the_ID(), 'dias_semana', true);
            // $dias_programacion_array = explode(',', $dias_programacion);

             if (count($dias_programacion) !== count($dias)) {
                if (!empty($dias_programacion)) {
                    // Comparar los días exactos
                    sort($dias_programacion);
                    sort($dias);
                    if ($dias_programacion !== $dias) {
                        continue;
                    }

                }


             }
            $hora_inicio = get_post_meta(get_the_ID(), 'hora_inicio', true);
            $hora_fin = get_post_meta(get_the_ID(), 'hora_fin', true);
            $locutores = get_post_meta(get_the_ID(), 'locutores', true);
            $imagen = get_the_post_thumbnail_url();
            $descripcion = get_the_content(); // La descripción del CPT

            // $output .= '<li>
            //                 <img width="96" height="96" src=" '.esc_url($imagen) .'" alt="Imagen del programa">

            //  <strong>' . esc_html($hora_inicio) . ' - ' . esc_html($hora_fin) . ':</strong> ' . get_the_title() . ' (' . esc_html($locutores) . ')</li>';
            $output .= '<li style="display: flex; align-items: flex-start; margin-bottom: 0.25rem;">';

            // Imagen a la izquierda
            $output .= '<div style="flex-shrink: 0; margin-right: 1rem;  ">
                    <img style="aspect-ratio: 1 / 1; padding: 0.5rem; border-radius: 0.5rem;" width="96" height="96" src="' . esc_url($imagen) . '" alt="Imagen del programa">
                </div>';

            // Contenedor de texto a la derecha
            $output .= '<div style="display: flex; flex-direction: column; padding-top: 1rem;">';

            // Información actual (hora, título, locutores)
            $output .= '<p> <strong>' . esc_html($hora_inicio) . ' - ' . esc_html($hora_fin) . ':</strong> ' . get_the_title() . ' (' . esc_html($locutores) . ') </p>';

            // Descripción debajo
            $output .= '<p style="margin-top: 0.5rem;">' . esc_html($descripcion) . '</p>';

            // Cierre del contenedor de texto
            $output .= '</div>';

            // Cierre del contenedor flex
            $output .= '</li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
        return $output;
    } else {
        $output = ' <p>No hay programación disponible.</p>';
        return  $output;
    }
}
