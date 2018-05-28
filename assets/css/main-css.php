<?php
// First of all send css header
header("Content-type: text/css");

// Array of css files
$css = array(
    'parts/reset.css',
    'parts/typo.css',
    'parts/forms.css',
    'parts/image.css',
    'parts/helpers.css',
    'parts/grid.css',
    'parts/nav.css',
    'parts/gallery.css',
    'parts/colors.css',
    'parts/folder.css',
    'main.css'
);

// Prevent a notice
$css_content = '';

// Loop the css Array
foreach ($css as $css_file) {
    // Load the content of the css file 
    $css_content .= file_get_contents($css_file);
}

// print the css content
echo $css_content;
?>