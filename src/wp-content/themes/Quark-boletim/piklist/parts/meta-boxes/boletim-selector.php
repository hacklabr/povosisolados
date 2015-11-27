<?php
/*
Title: Escolha o boletim que esse post vai ser associado
Post Type: post
*/
piklist('field', array(
      'type' => 'select'
      ,'field' => 'boletim'
      ,'label' => 'Boletim'
      ,'description' => 'Escolha o boletim'
      ,'help' => 'Escolha o boletim que esse post vai fazer parte'
      ,'attributes' => array(
        'class' => 'text'
      )
      ,'choices' => array(
        '' => 'Escolha o boletim'
      ) + piklist( get_posts(array(
            'post_type' => 'page',
            'meta_query' => array(
                              array(
                                'key' => 'is_boletim',
                                'value' => 'boletim',
                                'compare' => 'IN',
                              )
                            ),
          )), array('post_name', 'post_title')
          )
));
//var_dump(get_posts(array('category_name' => array("boletim",))));
