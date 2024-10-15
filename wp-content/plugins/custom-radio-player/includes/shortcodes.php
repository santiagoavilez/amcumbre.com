<?php
// Shortcode para mostrar el reproductor de radio.

function refrescar_programacion()
{
    // Incluye el código PHP de la consulta aquí
    // Asegúrate de que esta función devuelva los datos en formato JSON
    $hora_actual = current_time('H:i');
    $dia_actual = strtolower(current_time('l')); // Obtiene el día actual en formato texto y lo convierte a minúsculas

    // Traducción del nombre del día al español (opcional, si es necesario)
    $dias_ingles_a_espanol = array(
        'monday' => 'lunes',
        'tuesday' => 'martes',
        'wednesday' => 'miercoles',
        'thursday' => 'jueves',
        'friday' => 'viernes',
        'saturday' => 'sabado',
        'sunday' => 'domingo'
    );

    // Si el día está en inglés, lo traducimos a español
    if (array_key_exists($dia_actual, $dias_ingles_a_espanol)) {
        $dia_actual = $dias_ingles_a_espanol[$dia_actual];
    }

    // Argumentos para la consulta
    $args = array(
        'post_type' => 'programacion',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'hora_inicio',
                'value' => $hora_actual,
                'compare' => '<=',
                'type' => 'TIME'
            ),
            array(
                'key' => 'hora_fin',
                'value' => $hora_actual,
                'compare' => '>=',
                'type' => 'TIME'
            ),
            array(
                'key' => 'dias_semana', // Buscar en los días seleccionados
                'value' => $dia_actual, // Comparar con el día actual
                'compare' => 'LIKE' // Usamos LIKE porque 'dias_semana' es un array serializado
            )
        )
    );

    // Ejecutar la consulta
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $titulo = get_the_title();
            $imagen = get_the_post_thumbnail_url();
            $locutores = get_post_meta(get_the_ID(), 'locutores', true);
        }
    } else {
        // Mostrar mensaje si no hay programación actual
        $titulo = "Musicales CUMBRE";
        $imagen = "https://amcumbre.com/wp-content/uploads/2024/10/cumbre-logo-aguila.webp";
        $locutores = "";
    }

    wp_send_json(array(
        'titulo' => $titulo,
        'imagen' => $imagen,
        'locutores' => $locutores
    ));
    wp_die();
}

// Registrar las acciones AJAX
add_action('wp_ajax_refrescar_programacion', 'refrescar_programacion');
add_action('wp_ajax_nopriv_refrescar_programacion', 'refrescar_programacion');

function radio_player_shortcode($atts)
{

    $hora_actual = current_time('H:i');
    $dia_actual = strtolower(current_time('l')); // Obtiene el día actual en formato texto y lo convierte a minúsculas

    // Traducción del nombre del día al español (opcional, si es necesario)
    $dias_ingles_a_espanol = array(
        'monday' => 'lunes',
        'tuesday' => 'martes',
        'wednesday' => 'miercoles',
        'thursday' => 'jueves',
        'friday' => 'viernes',
        'saturday' => 'sabado',
        'sunday' => 'domingo'
    );

    // Si el día está en inglés, lo traducimos a español
    if (array_key_exists($dia_actual, $dias_ingles_a_espanol)) {
        $dia_actual = $dias_ingles_a_espanol[$dia_actual];
    }
    // Argumentos para la consulta
    $args = array(
        'post_type' => 'programacion',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'hora_inicio',
                'value' => $hora_actual,
                'compare' => '<=',
                'type' => 'TIME'
            ),
            array(
                'key' => 'hora_fin',
                'value' => $hora_actual,
                'compare' => '>=',
                'type' => 'TIME'
            ),
            array(
                'key' => 'dias_semana', // Buscar en los días seleccionados
                'value' => $dia_actual, // Comparar con el día actual
                'compare' => 'LIKE' // Usamos LIKE porque 'dias_semana' es un array serializado
            )
        )
    );

    // Ejecutar la consulta
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $titulo = get_the_title();
            $imagen = get_the_post_thumbnail_url();
            $locutores = get_post_meta(get_the_ID(), 'locutores', true);
        }
    } else {
        // Mostrar mensaje si no hay programación actual
        $titulo = "Musicales CUMBRE";
        $imagen = "https://amcumbre.com/wp-content/uploads/2024/10/cumbre-logo-aguila.webp";
        $locutores = "";
    }
    if (defined('DOING_AJAX') && DOING_AJAX) {
        wp_send_json(array(
            'titulo' => $titulo,
            'imagen' => $imagen,
            'locutores' => $locutores
        ));
        wp_die();
    }


    ob_start();
?>

    <div class="container-radio">

        <div class="radio-player">
            <p class="radio-catch-mobile" style="font-size: 1.25rem;">Ahora:</p>

            <div class="radio-image">
                <img width="480" height="480" src="<?php echo esc_url($imagen); ?>" alt="Imagen del programa">
                <button class="button-audio-mobile" onclick='togglePlayPause("https://cdn.instream.audio/:9366/stream")'>
                    <svg id="playIconCumbre" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play icon-player  active ">
                        <polygon points="6 3 20 12 6 21 6 3" />
                    </svg>
                    <svg id="pauseIconCumbre" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pause icon-player">
                        <rect x="14" y="4" width="4" height="16" rx="1" />
                        <rect x="6" y="4" width="4" height="16" rx="1" />
                    </svg>
                </button>
            </div>

            <div class="programa-actual">
                <p class="radio-catch">Escuchá en vivo:</p>

                <h3><?php echo esc_html($titulo); ?></h3>

                <p><?php echo esc_html($locutores); ?></p>
            </div>
            <button class="button-audio" onclick='togglePlayPause("https://cdn.instream.audio/:9366/stream")'>
                <svg id="playIconCumbre" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play icon-player active ">
                    <polygon points="6 3 20 12 6 21 6 3" />
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pause icon-player">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="10" x2="10" y1="15" y2="9" />
                    <line x1="14" x2="14" y1="15" y2="9" />
                </svg>
            </button>
            <span class="audio-label"> Escuchar CUMBRE EN VIVO</span> <!-- Icono de Pausa -->

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded')

            function refrescarProgramacion() {
                console.log('refrescando programacion')
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '<?php echo admin_url('admin-ajax.php?action=refrescar_programacion'); ?>', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        let data = JSON.parse(xhr.responseText);
                        console.log('refrescando programacion', data)

                        let tituloElement = document.getElementById('programa-titulo');
                        let imagenElement = document.getElementById('programa-imagen');
                        let locutoresElement = document.getElementById('programa-locutores');
                        console.log(data)
                        if (tituloElement) {
                            tituloElement.textContent = data.titulo;
                        }
                        if (imagenElement) {
                            imagenElement.src = data.imagen;
                        }
                        if (locutoresElement) {
                            locutoresElement.textContent = data.locutores;
                        }
                    }
                };
                xhr.send();
            }

            // Refrescar cada 5 minutos (300000 ms)
            setInterval(refrescarProgramacion, 300000);
        });
    </script>
    <script>
        let audioElement = null;

        function togglePlayPause(streamUrl) {
            if (audioElement === null | audioElement === undefined) {
                audioElement = new Audio(streamUrl + "?nocache=" + new Date().getTime());
            }
            console.log(audioElement);

            const isPlaying = !audioElement.paused;
            const playIconId = 'playIconCumbre';
            const pauseIconId = 'pauseIconCumbre';
            const playIcons = document.getElementsByClassName('lucide-play');
            const pauseIcons = document.getElementsByClassName('lucide-pause');
            const playIcon = document.getElementById(playIconId);
            const pauseIcon = document.getElementById(pauseIconId);

            if (isPlaying) {
                audioElement.pause();
                for (let i = 0; i < playIcons.length; i++) {
                    playIcons[i].classList.add('active');
                }
                for (let i = 0; i < pauseIcons.length; i++) {

                    pauseIcons[i].classList.remove('active');
                }

            } else {
                audioElement.src = streamUrl + "?nocache=" + new Date().getTime();
                audioElement.load();
                audioElement.play();
                for (let i = 0; i < playIcons.length; i++) {
                    console.log(playIcons[i]);
                    playIcons[i].classList.remove('active');
                }
                for (let i = 0; i < pauseIcons.length; i++) {
                    pauseIcons[i].classList.add('active');
                }
            }
        }
    </script>
    <style>
        .container-radio {
            padding: 1rem;
            position: relative;
            height: auto;
        }

        .radio-player {
            display: flex;
            width: 100%;
            gap: 0.75rem;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 1rem auto;
            padding: 1.5rem;
            background-color: #515151;
            color: #fafafa;
            border-radius: 0.5rem;
            max-width: 960px;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

        }

        @media screen and (min-width: 768px) {
            .radio-player {
                flex-direction: row;
                justify-content: center;
                align-items: center;

            }

            .radio-image {
                width: 8rem;
                height: 8rem;
            }

            .radio-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 0.5rem;

            }

            .button-audio {
                background-color: transparent;
                padding: 1rem;
                aspect-ratio: 1/1;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: auto;
                color: #efb900;
                border: none;
                font-size: 16px;
                cursor: pointer;
                max-width: 6rem;
            }

            .programa-actual {
                margin: auto 0.5rem;
                text-align: left;

            }

            .button-audio-mobile {
                display: none;
            }

            .radio-catch-mobile {
                display: none;
            }

        }

        @media screen and (max-width: 768px) {
            .radio-image {
                display: block;
                position: relative;
                width: 100%;
                aspect-ratio: 1/1;
                height: 100%;

            }

            .radio-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 0.5rem;

            }

            .radio-catch {
                display: none;
            }

            .button-audio-mobile {
                background-color: rgb(255, 255, 255, 0.9);
                padding: 1.25rem;
                aspect-ratio: 1/1;
                border-radius: 999px;
                width: 4rem;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                display: flex;
                align-items: center;
                justify-content: center;
                color: black;
                /* Gris más claro */
                border: none;
                font-size: 16px;
                cursor: pointer;
            }

            .button-audio {
                display: none;
            }

            .programa-actual {
                place-self: center;
                text-align: center;
                margin-left: 1rem;
                display: flex;
                flex-direction: column;
            }

        }



        .programa-actual h3 {
            font-size: 2.25rem;
            margin: 0;
        }

        .programa-actual p {
            font-size: 1.25em;
            margin: 0;
        }

        .icon-player {
            display: none;
            margin: auto;
            aspect-ratio: 1/1;

            /* Inicialmente oculto */
        }

        .icon-player.active {
            display: inline;
            /* Mostrar solo el icono activo */
        }

        .audio-label {
            color: #fafafa;
            font-family: 'Jost', sans-serif;
            /* Usando la fuente Jost */
            font-size: 13px !important;
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
            /* Tamaño de la fuente forzado */
        }
    </style>
<?php
    return ob_get_clean();
}

add_shortcode('radio_player', 'radio_player_shortcode');
