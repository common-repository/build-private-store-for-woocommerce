<?php


add_action('init','bpsfw_comman_fileadded',1);
       
         function bpsfw_comman_fileadded() {
            global $bpsfw_comman;
            $optionget = array(              
                'bpsfw_enable_private_store' => 'yes',
                'bpsfw_enable_private_whole_website' => 'yes',
                'bpsfw_include_p_categories' => '',
                'bpsfw_include_p_tags' => '',
                'bpsfw_login_form_title' => 'Login User',
                'bpsfw_registration_form_title' => 'Register User',
                'bpsfw_registration_successful_message' => 'Registration successful.',
                'bpsfw_approve_registration' => 'yes',
                'bpsfw_pending_account_approval' => 'your account is not active please, wait for admin approval...!',
                'bpsfw_account_disale_email' => 'yes',
                'bpsfw_reject_email_subject' => 'Rejected Your Account..',
                'bpsfw_reject_email_message' => 'hiii, your accound has been disable.',
                'bpsfw_approve_email_subject' => 'Approve Your Account..',
                'bpsfw_approve_email_message' => 'hii, your account has been approve. welcome to our site..!',
                'bpsfw_account_approve_email' => 'yes',
                'bpsfw_disble_price_addtocartbutton'=>'yes',
                'bpsfw_login_to_see_price'=>'Login to see prices',
                'woo_login_title_color'=>'#000000',
                'bpsfw_login_to_see_price_color'=>'#000000',
                'bpsfw_admin_email'=>'yes',
                'bpsfw_admin_reject_email_subject'=>'Rejected Customer Account..',
                'bpsfw_admin_reject_email_message'=>'{customer_name} account has been disable.',
                'bpsfw_admin_approve_email_subject'=>'Approve Customer Account.',
                'bpsfw_admin_approve_email_message'=>'{customer_name} account has been approve.',
                'bpsfw_redirect_url'=>'',
                'bpsfw_user_regi_email_notification'=>'yes',
                'bpsfw_user_regi_email'=>'',
                'bpsfw_user_regi_email_subject'=> 'New User Registration',
                'bpsfw_user_regi_email_msg'=> 'A new user has registered with the username: {customer_name}',
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {
               $bpsfw_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
            }
        }

?>