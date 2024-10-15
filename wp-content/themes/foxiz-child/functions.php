<?php
// abrir todos los links en una nueva ventana

// fin abrir todos los links en una nueva ventana

function filter_article_title( $title ) {
  // Reemplazar o eliminar palabra o frase del título

  $title = str_replace( '» Alerta Digital', '', $title );
  return $title;
}
add_filter( 'title_save_pre', 'filter_article_title' );
// Reemplazar o eliminar palabra o frase del título


function custom_date_format() {
    // Obtén la fecha actual en el formato deseado
    $custom_date = date_i18n('l j F \d\e\l Y');

    // Reemplaza los nombres de los meses en inglés por los nombres en español
    $meses_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $meses_es = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    $custom_date = str_replace($meses_en, $meses_es, $custom_date);

    // Capitaliza la primera letra del nombre del día
    $custom_date = ucfirst($custom_date);

    return $custom_date;
}

// Añade un shortcode para mostrar la fecha en el formato personalizado
add_shortcode('custom_date', 'custom_date_format');

// Fin de obtén la fecha actual en el formato deseado

