<?php 
   function load_plugin() {
              $args = array('orderby' => 'ID');
              $wp_user_query = new WP_User_Query($args);
              $users = $wp_user_query->results;
              foreach ($users as $value) {
                if($value->roles != 'administrator'){
                  update_user_meta($value->ID, 'approval_confirmation', 'confirm_approve');
                }
              }
            }
 register_activation_hook( __FILE__,'load_plugin');
