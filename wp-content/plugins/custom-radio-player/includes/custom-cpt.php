<?php
// Registro del Custom Post Type para Programación.
function register_program_schedule_cpt()
{
    $labels = array(
        'name' => __('Programaciones'),
        'singular_name' => __('Programación'),
        'menu_name' => __('Programaciones'),
        'name_admin_bar' => __('Programación'),
        'add_new' => __('Añadir Nueva'),
        'add_new_item' => __('Añadir Nueva Programación'),
        'new_item' => __('Nueva Programación'),
        'edit_item' => __('Editar Programación'),
        'view_item' => __('Ver Programación'),
        'all_items' => __('Todas las Programaciones'),
        'search_items' => __('Buscar Programaciones'),
        'parent_item_colon' => __('Programación Principal:'),
        'not_found' => __('No se encontraron programaciones.'),
        'not_found_in_trash' => __('No se encontraron programaciones en la papelera.')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'programaciones'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail')
    );

    register_post_type('programacion', $args);
}

add_action('init', 'register_program_schedule_cpt');


// Función para agregar los metaboxes personalizados
function agregar_metaboxes_programacion()
{
    add_meta_box(
        'detalles_programacion', // ID
        'Detalles de la Programación', // Título
        'mostrar_metaboxes_programacion', // Callback
        'programacion', // Post Type
        'normal', // Contexto
        'high' // Prioridad
    );
}

add_action('add_meta_boxes', 'agregar_metaboxes_programacion');

// Mostrar el contenido de los metaboxes
function mostrar_metaboxes_programacion($post)
{
    // Valores actuales (si existen)
    $hora_inicio = get_post_meta($post->ID, 'hora_inicio', true);
    $hora_fin = get_post_meta($post->ID, 'hora_fin', true);
    $locutores = get_post_meta($post->ID, 'locutores', true);

    // Campos del formulario
?>
    <label for="hora_inicio">Hora de Inicio:</label>
    <input type="time" name="hora_inicio" id="hora_inicio" value="<?php echo esc_attr($hora_inicio); ?>" />

    <label for="hora_fin">Hora de Fin:</label>
    <input type="time" name="hora_fin" id="hora_fin" value="<?php echo esc_attr($hora_fin); ?>" />

    <label for="locutores">Locutores (separados por comas):</label>
    <input type="text" name="locutores" id="locutores" value="<?php echo esc_attr($locutores); ?>" />
<?php
}

// Guardar los metadatos cuando se guarde la programación
function guardar_detalles_programacion($post_id)
{
    if (array_key_exists('hora_inicio', $_POST)) {
        update_post_meta($post_id, 'hora_inicio', $_POST['hora_inicio']);
    }
    if (array_key_exists('hora_fin', $_POST)) {
        update_post_meta($post_id, 'hora_fin', $_POST['hora_fin']);
    }
    if (array_key_exists('locutores', $_POST)) {
        update_post_meta($post_id, 'locutores', $_POST['locutores']);
    }
}

add_action('save_post', 'guardar_detalles_programacion');
