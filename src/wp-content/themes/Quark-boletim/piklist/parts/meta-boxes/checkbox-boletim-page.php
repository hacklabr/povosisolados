<?php
/*
Title: Boletim
Post Type: page
*/
piklist('field', array(
'type' => 'checkbox'
,'field' => 'is_boletim'
//,'value' => 'option2' // Sets default to Option 2
,'label' => 'Boletim'
,'description' => 'Selecione a opção ao lado caso essa página seja um boletim'
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'boletim' => 'É um boletim'
)
));
?>
