<?php 

return array(
  'title' => 'Astuces pour la mise en page des articles',
  'html' => function() {
    return tpl::load(__DIR__ . DS . 'astuces.html.php', array());
  }  
);