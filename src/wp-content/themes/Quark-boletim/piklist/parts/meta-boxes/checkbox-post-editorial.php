<?php
/*
Title: Post Editorial
Post Type: post
*/
piklist('field', array(
'type' => 'checkbox'
,'field' => 'is_editorial'
,'label' => 'Editorial'
,'description' => 'Selecione a opção ao lado caso esse post seja um editorial'
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'editorial' => 'É um editorial'
)
));
?>
