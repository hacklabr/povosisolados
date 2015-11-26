<?php
/*
Title: Escolha o boletim que esse post vai ser associado
Post Type: post
*/
piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text'
    ,'label' => 'Text Box'
    ,'description' => 'Field Description'
    ,'value' => ''
    ,'help' => 'This is help text.'
    ,'attributes' => array(
      'class' => 'text'
    )
  ));

  piklist('field', array(
      'type' => 'select'
      ,'field' => 'demo_select'
      ,'label' => 'Select Box'
      ,'description' => 'Choose from the drop-down.'
      ,'help' => 'This is help text.'
      ,'attributes' => array(
        'class' => 'text'
      )
      ,'choices' => array(
        '' => 'Escolha o boletim'
      ) + piklist( get_posts(array(
            'category_name' => array("boletim",),
            'post_type' => 'page',
          )), array('ID', 'post_title')
          )
    ));
//var_dump(get_posts(array('category_name' => array("boletim",))));
  piklist('field', array(
      'type' => 'colorpicker'
      ,'field' => 'demo_colorpicker'
      ,'label' => 'Choose a color'
      ,'value' => '#aee029'
      ,'description' => 'Click in the box to select a color.'
      ,'help' => 'This is help text.'
      ,'attributes' => array(
        'class' => 'text'
      )
    ));;
