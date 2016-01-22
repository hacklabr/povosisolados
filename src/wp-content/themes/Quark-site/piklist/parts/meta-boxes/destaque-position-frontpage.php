<?php
/*
Title: Posição do post na página da FrontPage
Post Type: post
*/
piklist('field', array(
 'type' => 'select'
 ,'field' => 'page_function'
 ,'label' => 'Posição'
 ,'description' => 'Escolha a posição desse post nas caixinas de destaque da FrontPage'
 ,'attributes' => array(
 'class' => 'text'
 )
 ,'choices' => array(
 NULL => 'Nenhum'
 ,'cen_sup' => 'Coluna central linha superior'
 ,'esq_inf' => 'Coluna esquerda linha inferior'
 ,'dir_inf' => 'Coluna direita linha inferior'
 )
));
?>
