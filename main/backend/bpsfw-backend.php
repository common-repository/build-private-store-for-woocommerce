<?php

        function bpsfw_submenu_page() {
            add_menu_page(__( 'woocommerce', 'Private Store' ),'Private Store','manage_options','private-store', 'bpsfw_callback');
        }

        function bpsfw_callback() {
        	global $bpsfw_comman, $wp_roles;
        	$user_roles = $wp_roles->get_names();
        	//$user_roles['guest']="Guest";
        	$user_roles = array_merge(['guest' => 'Guest'], $user_roles);

        	?>
        	<div class="bpsfw_container">
	            <form method="post" >
	            	<div class="wrap">
	                	<h2><?php echo __('Woocomerce Private Store Settings','build-private-store-for-woocommerce');?></h2>
	            	</div>
	            	<div class="card bpsfw_notice">
	                    <h2><?php echo __('Please help us spread the word & keep the plugin up-to-date', 'build-private-store-for-woocommerce');?></h2>
	                    <p>
	                        <a class="button-primary button" title="<?php echo __('Support Private Store', 'build-private-store-for-woocommerce');?>" target="_blank" href="https://www.plugin999.com/support/"><?php echo __('Support', 'build-private-store-for-woocommerce'); ?></a>
	                        <a class="button-primary button" title="<?php echo __('Rate Private Store', 'build-private-store-for-woocommerce');?>" target="_blank" href="https://wordpress.org/support/plugin/build-private-store-for-woocommerce/reviews/?filter=5"><?php echo __('Rate the plugin ★★★★★', 'build-private-store-for-woocommerce'); ?></a>
	                    </p>
	                </div>
	                <?php if(isset($_REQUEST['message']) && $_REQUEST['message'] == 'success'){ ?>
		                <div class="notice notice-success is-dismissible"> 
		                    <p><strong><?php echo __( 'Setting saved successfully.', 'build-private-store-for-woocommerce' );?></strong></p>
		                </div>
		            <?php } ?>
	                <ul class="nav-tab-wrapper woo-nav-tab-wrapper">
	                    <li class="nav-tab" data-tab="bpsfw-tab-general"><?php echo __('General','build-private-store-for-woocommerce');?></li>
	                    <li class="nav-tab" data-tab="bpsfw-tab-registration-form-settings"><?php echo __('Registration Form Settings','build-private-store-for-woocommerce');?></li>
	                    <li class="nav-tab" data-tab="bpsfw-tab-new-user-registration-settings"><?php echo __('New User Registration Settings','build-private-store-for-woocommerce');?></li>
	                    <li class="nav-tab" data-tab="bpsfw-tab-admin-email-settings"><?php echo __('Administrator Email Settings','build-private-store-for-woocommerce');?></li>
	                    <li class="nav-tab" data-tab="bpsfw-tab-user-register-settings"><?php echo __('Notification','build-private-store-for-woocommerce');?></li>
	                </ul>
	                <div id="bpsfw-tab-general" class="tab-content current"> 
	                	<div class="postbox-header">
	                		<h3><?php echo __('General Control Setting','build-private-store-for-woocommerce');?></h3>
	                	</div>
	                    <table class="data_table">
	                        <tbody>
								<?php foreach( $user_roles as $userrole_key => $userrole_val){ ?>
		                           	<tr class="product_private" style="background-color: grey; color: white;">
		                           		<th colspan="2"><?php echo $userrole_val; ?></th>
		                           	</tr> 	
		                           	<?php if ($userrole_key === 'guest') { ?>
		                            	<tr class="product_private">
			                                <th>
			                                	<label><?php echo __('Private Products Price and Add to cart Button','build-private-store-for-woocommerce');?></label>
			                                </th>
			                                <td>
			                                	<input type="checkbox"  name="bpsfw_comman[bpsfw_disble_price_addtocartbutton]" value="yes"<?php if ($bpsfw_comman['bpsfw_disble_price_addtocartbutton'] == "yes" ) { echo "checked"; } ?>>
			                                	<label><?php echo __('If this Enable option then  below product show but not show price and Add to cart button for guest user And not Check this option Then below product not show for guest user','build-private-store-for-woocommerce');?></label>
			                                </td>
			                            </tr>
			                           	<tr class="product_private">
			                           		<th>
			                           			<label><?php echo __('Login to see prices text' , 'build-private-store-for-woocommerce'); ?></label>
			                           		</th>
			                           		<td>
			                                	<input type="text" name="bpsfw_comman[bpsfw_login_to_see_price]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_login_to_see_price']);?>">
			                            		
			                                </td>
			                           	</tr>
			                           	<tr>
			                           		<th>
			                           			<label><?php echo __('Login to see prices text Color' , 'build-private-store-for-woocommerce'); ?></label>
			                           		</th>
			                           		<td>
			                            		<input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($bpsfw_comman['bpsfw_login_to_see_price_color']); ?>" name="bpsfw_comman[bpsfw_login_to_see_price_color]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_login_to_see_price_color']); ?>"/>  
			                            	</td>
			                           	</tr>
									<?php } ?>
		                            <tr class="product_private">
		                                <th>
		                                	<label><?php echo __('Private Products','build-private-store-for-woocommerce');?></label>
		                                </th>
		                                <td>
		                                	<select class="bpsfw_select_product" name="bpsfw_select2[<?php echo $userrole_key?>][]" multiple="multiple" style="width:60%;">
					                           	<?php 
					                           		$productsa = get_option('wg_combo_'.$userrole_key);
					                           		if($productsa){
						                           		foreach ($productsa as $value) {
					                              			$productc = wc_get_product( $value );
															if($productc &&  $productc->is_purchasable()){
						                                 		$title = $productc->get_name();
						                                 		$title = ( mb_strlen( $title ) > 50 ) ? mb_substr( $title, 0, 49 ) . '...' : $title; ?>
							                                 		<option value="<?php echo esc_attr($value); ?>" selected="selected"><?php echo esc_attr($title);?></option>
							                                 	<?php  
															}
						                           		}
					                           		}
					                           	?>
				                           	</select> 
		                                	<p class="description"><?php echo __('Private Product for '.$userrole_val.' User','build-private-store-for-woocommerce');?></p>
		                                </td>
		                            </tr>
		                            <tr class="product_private">
		                                <th>
		                                	<label><?php echo __('Private Product Categories','build-private-store-for-woocommerce');?></label>
		                                </th>
		                                <td>
		                                	<select class="bpsfw_select_cats" name="bpsfw_cats_select2[<?php echo $userrole_key?>][]" multiple="multiple" style="width:60%;" disabled>
						                           	<?php
						                           		$appended_terms = get_option('wg_cats_select2_'.$userrole_key);
						                           		if( $appended_terms ) {
											                foreach( $appended_terms as $term_id ) {
											                    $term_name = get_term( $term_id )->name;
											                    $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
											                    echo '<option value="' . esc_attr($term_id) . '" selected="selected">' . esc_attr($term_name) . '</option>';
											                }
											            }
						                           	?>
					                           </select> 
					                           <label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?><a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
		                                	<p class="description"><?php echo __('Private Category for '.$userrole_val.' User','build-private-store-for-woocommerce');?></p>
		                                </td>
		                            </tr>
		                            <tr class="product_private">
		                                <th>
		                                	<label><?php echo __('Private Product Tags','build-private-store-for-woocommerce');?></label>
		                                </th>
		                                <td>
		                                	<select class="bpsfw_select_tags" name="bpsfw_tags_select2[<?php echo $userrole_key?>][]" multiple="multiple" style="width:60%;" disabled>
					                           	<?php
					                           		$appended_terms = get_option('bpsfw_tags_select2_'.$userrole_key);
					                           		if( $appended_terms ) {
										                foreach( $appended_terms as $term_id ) {
										                    $term_name = get_term( $term_id )->name;
										                    $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
										                    echo '<option value="' . esc_attr($term_id) . '" selected="selected">' . esc_attr($term_name) . '</option>';
										                }
										            }
					                           	?>
					                        </select>
					                        <label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?><a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
		                                	<p class="description"><?php echo __('Private Tag for '.$userrole_val.' User','build-private-store-for-woocommerce');?></p>
		                                </td>
		                            </tr>
		                            <tr class="product_private">
		                                <th>
		                                	<label><?php echo __('Private Pages','build-private-store-for-woocommerce');?></label>
		                                </th>
		                                <td>
		                                	<select class="wg_select_pags" name="wg_pags_select2[<?php echo $userrole_key?>][]" multiple="multiple" style="width:60%;">
					                           	<?php
					                           		$appended_pags = get_option('wg_pags_select2_'.$userrole_key);

					                           		if(  $appended_pags ) {
										                foreach( $appended_pags as $page_id ) {
										                    $term_name = get_page( $page_id )->post_title;
										                    $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
										                    echo '<option value="' . esc_attr($page_id) . '" selected="selected">' . esc_attr($term_name) . '</option>';
										                }
										            }
					                           	?>
					                           </select>
		                                	<p class="description"><?php echo __('Private Pages For '.$userrole_val.' Users','build-private-store-for-woocommerce');?></p>
		                                </td>
		                            </tr>
		                            <tr>
		                                <th>
		                                	<label><?php echo __('User Login Redirect Url','build-private-store-for-woocommerce');?></label>
		                                </th>
		                                <td>
		                                	<?php $bpsfw_redirect_url = get_option('bpsfw_redirect_url_'.$userrole_key); ?>
		                                	<input type="text" name="bpsfw_redirect_url[<?php echo $userrole_key; ?>]" value="<?php echo esc_attr($bpsfw_redirect_url); ?>" style="width:60%;">
		                                	<p class="description"><?php echo __('Redirect '.$userrole_val.' Users after login'); ?></p>
		                                </td>
		                            </tr>
		                            <tr>
		                            	<th>
		                            		<label><?php echo __('Redirect Url For Private Product And Pages', 'build-private-store-for-woocommerce'); ?></label>
		                            	</th>
		                            	<td>
		                            		<?php 
                  								$my_account_url = get_permalink ( get_option( 'woocommerce_myaccount_page_id' ) );
                  								$bpsfw_prod_redirect_url = get_option('bpsfw_prod_redirect_url_'.$userrole_key); 
                  							?>
		                            		<input type="text" name="bpsfw_prod_redirect_url[<?php echo $userrole_key; ?>]" value="<?php echo esc_attr($bpsfw_prod_redirect_url); ?>" style="width: 60%;">
		                            		<p class="description">
		                            			<?php echo __('Redirect '.$userrole_val.' User if they try to access private products or private pages'); ?>
		                            			<br>
		                            			<?php echo __('default url: '.$my_account_url); ?>
		                            		</p>
		                            	</td>
		                            </tr>
		                             
		                        <?php } ?>

	                        </tbody>                         
	                    </table>
	                </div>               
	                <div id="bpsfw-tab-registration-form-settings" class="tab-content">
	                	<div class="postbox-header">
		                	<h3><?php echo __('Private User Login/Registration Form Setting','build-private-store-for-woocommerce');?></h3>
		                </div>
	                    <table class="data_table">
	                        <tbody>
	                            <tr>
	                            	<th>
	                            		<label><?php echo __('Login Form Title','build-private-store-for-woocommerce');?></label>	                            		
	                            	</th>
	                            	<td>
	                            		<input type="text" name="bpsfw_comman[bpsfw_login_form_title]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_login_form_title']);?>">
	                            		<p><?php echo __('Enter the login form title','build-private-store-for-woocommerce');?></p>
	                            	</td>
	                            </tr>
	                            <tr>
	                            	<th>
	                            		<label><?php echo __('Registration Form Title','build-private-store-for-woocommerce');?></label>	                            		
	                            	</th>
	                            	<td>
	                            		<input type="text" name="bpsfw_comman[bpsfw_registration_form_title]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_registration_form_title']);?>">
	                            		<p><?php echo __('Enter the registration form title','build-private-store-for-woocommerce');?></p>
	                            	</td>
	                            </tr>
	                            <tr>
	                            	<th>
	                            		<label><?php echo __('Registration Successful Message','build-private-store-for-woocommerce');?></label>	                            		
	                            	</th>
	                            	<td>
	                            		<input type="text" name="bpsfw_comman[bpsfw_registration_successful_message]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_registration_successful_message']);?>">
	                            		<p><?php echo __('Enter the registration successful message','build-private-store-for-woocommerce');?></p>
	                            	</td>
	                            </tr>
	                            <tr>
	                            	<th>
	                            		<label><?php echo __('Form Title Color','build-private-store-for-woocommerce');?></label>	                            		
	                            	</th>
	                            	<td>
	                            		<input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($bpsfw_comman['woo_login_title_color']); ?>" name="bpsfw_comman[woo_login_title_color]" value="<?php echo esc_attr($bpsfw_comman['woo_login_title_color']); ?>"/>  
	                            	</td>
	                            </tr>		
	                                                      
	                        </tbody>                        
	                    </table>
	                </div>
	                <div id="bpsfw-tab-new-user-registration-settings" class="tab-content">
	                	<div class="postbox-header">
	                		<h3><?php echo __('Approve New Users Registration Settings','build-private-store-for-woocommerce');?></h3>
	                	</div>
	                    <table class="data_table">
	                        <tbody>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Manually Approve New Registration','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="bpsfw_comman[bpsfw_approve_registration]" value="yes"<?php if($bpsfw_comman['bpsfw_approve_registration'] == 'yes'){echo "checked";}?>>
	                                	<p><?php echo __('Disable manual approval of new users registration.','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Message For Pending Account For Approval','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_pending_account_approval]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_pending_account_approval']); ?>">
	                                	<p><?php echo __('Message for users when account is pending for approval.','build-private-store-for-woocommerce');?></p>
	                                	
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Disable Email','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="bpsfw_comman[bpsfw_account_disale_email]" value="yes"<?php if($bpsfw_comman['bpsfw_account_disale_email'] == 'yes'){echo "checked";}?>>
	                                	<p><?php echo __('Notify users will by an E-mail when their registration is rejected.','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Reject Email Subject','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_reject_email_subject]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_reject_email_subject']);?> "disabled>
	                                	<label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?> <a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
	                                	<p><?php echo __('Account reject email subject','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Reject Email message','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<textarea class="bpsfw_tex" rows="5" cols="30" name="bpsfw_comman[bpsfw_reject_email_message]" disabled><?php echo esc_attr($bpsfw_comman['bpsfw_reject_email_message']);?></textarea>
	                                	<label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?> <a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
	                                	<p><?php echo __('Account reject email message','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Approve Email','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="bpsfw_comman[bpsfw_account_approve_email]" value="yes"<?php if($bpsfw_comman['bpsfw_account_approve_email'] == 'yes'){echo "checked";}?>>
	                                	<p><?php echo __('Notify users will by an E-mail when their registration is approved.','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Approve Email Subject','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_approve_email_subject]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_approve_email_subject']);?>"disabled>
	                                	<label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?> <a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
	                                	<p><?php echo __('Account approve email subject','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Approve Email message','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<textarea class="bpsfw_tex" rows="5" cols="30" name="bpsfw_comman[bpsfw_approve_email_message]"disabled><?php echo esc_attr($bpsfw_comman['bpsfw_approve_email_message']);?></textarea>
	                                	<label class="bpsfw_comman_link"><?php echo __('This Option Available in ','build-private-store-for-woocommerce');?> <a href="https://www.plugin999.com/plugin/build-private-store-for-woocommerce/" target="_blank"><?php echo __('Pro Version','build-private-store-for-woocommerce');?></a></label>
	                                	<p><?php echo __('Account approve email message','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div> 
	                <div id="bpsfw-tab-admin-email-settings" class="tab-content">
	                	<div class="postbox-header">
	                		<h3><?php echo __('Administrator Email Settings','build-private-store-for-woocommerce');?></h3>
	                	</div>
	                    <table class="data_table">
	                        <tbody>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Email For Administrator','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="bpsfw_comman[bpsfw_admin_email]" value="yes"<?php if($bpsfw_comman['bpsfw_admin_email'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Reject Email Subject','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_admin_reject_email_subject]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_admin_reject_email_subject']);?>">
	                                	<p><?php echo __('Account reject email subject','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Reject Email message','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<textarea class="bpsfw_tex" rows="5" cols="30" name="bpsfw_comman[bpsfw_admin_reject_email_message]"><?php echo esc_attr($bpsfw_comman['bpsfw_admin_reject_email_message']);?></textarea>
	                                	<p><?php echo __('Account reject email message','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>

	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Approve Email Subject','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_admin_approve_email_subject]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_admin_approve_email_subject']);?>">
	                                	<p><?php echo __('Account approve email subject','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Account Approve Email message','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<textarea class="bpsfw_tex" rows="5" cols="30" name="bpsfw_comman[bpsfw_admin_approve_email_message]"><?php echo esc_attr($bpsfw_comman['bpsfw_admin_approve_email_message']);?></textarea>
	                                	<p><?php echo __('Account approve email message','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div> 
	               
	                <div id="bpsfw-tab-user-register-settings" class="tab-content">
	                	<div class="postbox-header">
	                		<h3><?php echo __('User Register Email Notification','build-private-store-for-woocommerce');?></h3>
	                	</div>
	                    <table class="data_table">
	                        <tbody>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('User Register Email Notification','build-private-store-for-woocommerce-pro');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="bpsfw_comman[bpsfw_user_regi_email_notification]" value="yes" <?php if($bpsfw_comman['bpsfw_user_regi_email_notification'] == 'yes'){echo "checked";}?> >
	                                	<label><?php echo __('Enable or Disable this setting to send email notification to below email address when new user registerd.','build-private-store-for-woocommerce');?></lable>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Add Email','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_user_regi_email]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_user_regi_email']); ?>">
	                                	<p><?php echo __('Add ", " between two emails to send multiple email notification. ','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Email Subject','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_user_regi_email_subject]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_user_regi_email_subject']);?>">
	                                	<p><?php echo __('Customer register email subject','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th>
	                                	<label><?php echo __('Email Message','build-private-store-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="bpsfw_tex" name="bpsfw_comman[bpsfw_user_regi_email_msg]" value="<?php echo esc_attr($bpsfw_comman['bpsfw_user_regi_email_msg']);?>">
	                                	<p><?php echo __('Customer register email message','build-private-store-for-woocommerce');?></p>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	                <div class="submit_button">
	                    <input type="hidden" name="bpsfw_private_store" value="bpsfw_save_option">
	                    <input type="submit" value="Save changes" name="submit" class="button-primary" id="bpsfw-btn-space">
	                </div>              
	            </form>  
	        </div>
        <?php
        }

        function custom_user_profile_fields($user){?>
    		<table class="form-table">
            	<tr>
                	<th><label>Approval confirmation</label></th>
                	<td>
                    	<select name="approval_confirmation">
                      		<option value="confirm_approve"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'confirm_approve'){echo "selected";}?>><?php echo __('Approve Confirm','build-private-store-for-woocommerce');?></option>
                      		<option value="denied_user"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'denied_user'){echo "selected";}?>><?php echo __('Denied Users','build-private-store-for-woocommerce');?></option>
                      		<option value="not_confirm_approve"<?php if(isset($user->ID) && get_user_meta($user->ID,'approval_confirmation',true) == 'not_confirm_approve'){echo "selected";}?>><?php echo __('User Pending','build-private-store-for-woocommerce');?></option>
                    	</select>
                	</td>
            	</tr>
        	</table>
        	<?php
      	
        }


        function save_custom_user_profile_fields($user_id){
            
            if(!current_user_can('manage_options')){
              	return false;
            }

            update_user_meta( $user_id, 'approval_confirmation', sanitize_text_field($_POST['approval_confirmation']) );

            if ( isset( $_POST['approval_confirmation'] ))
		    {
		        update_user_meta($user_id, 'approval_confirmation', sanitize_text_field($_POST['approval_confirmation']));
		    }
        } 


		function mktbn_user_register( $user_id )
		{
			
		        update_user_meta($user_id, 'approval_confirmation', 'not_confirm_approve');
		   

		}

        function BPSFW_recursive_sanitize_text_field( $array ) {
        	if (is_array($array) || is_object($array)){
	            foreach ( $array as $key => &$value ) {
	                if ( is_array( $value ) ) {
	                    $value = BPSFW_recursive_sanitize_text_field($value);
	                }else{
	                    $value = sanitize_text_field( $value );
	                }
	            }
        	}
            return $array;
        
        }

        function bpsfw_save_option() {
	        if( current_user_can('administrator') ) { 

	        	global $bpsfw_comman, $wp_roles;
	        	$user_roles = $wp_roles->get_names();
	        	$user_roles['guest']="Guest";

	            if(isset($_REQUEST['bpsfw_private_store']) && $_REQUEST['bpsfw_private_store'] == 'bpsfw_save_option'){

                    $isecheckbox = array(
                        // 'bpsfw_enable_private_store',
                        // 'bpsfw_enable_private_whole_website',
                        'bpsfw_disble_price_addtocartbutton',
                        'bpsfw_include_p_categories',
                        'bpsfw_include_p_tags',
                        'bpsfw_approve_registration',
                        'bpsfw_account_disale_email',
                        'bpsfw_account_approve_email',
                        'bpsfw_admin_email',
	                    'bpsfw_user_regi_email_notification'
                    );

                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
                        if(!isset($_REQUEST['bpsfw_comman'][$value_isecheckbox])){
                            $_REQUEST['bpsfw_comman'][$value_isecheckbox] ='no';
                        }
                    }

                   	if(isset($user_roles)){
                   		foreach ($user_roles as $user_roles_key => $user_roles_value) {
                   			if(isset($_REQUEST['bpsfw_select2'][$user_roles_key])){
	                   			$bpsfw_select2 = BPSFW_recursive_sanitize_text_field($_REQUEST['bpsfw_select2'][$user_roles_key]);
		            			update_option('wg_combo_'.$user_roles_key, $bpsfw_select2, 'yes');
		            		}else{
		            			update_option('wg_combo_'.$user_roles_key, '', 'yes');
		            		}

		            		if(isset($_REQUEST['bpsfw_cats_select2'][$user_roles_key])){
			                   	$bpsfw_cats_select2 = BPSFW_recursive_sanitize_text_field($_REQUEST['bpsfw_cats_select2'][$user_roles_key]);
		        				update_option('wg_cats_select2_'.$user_roles_key, $bpsfw_cats_select2, 'yes');
							}else{
			            		update_option('wg_cats_select2_'.$user_roles_key, '', 'yes');
							}

							if(isset($_REQUEST['bpsfw_tags_select2'][$user_roles_key])){
			                   	$bpsfw_tags_select2 = BPSFW_recursive_sanitize_text_field($_REQUEST['bpsfw_tags_select2'][$user_roles_key]);
		        				update_option('bpsfw_tags_select2_'.$user_roles_key, $bpsfw_tags_select2, 'yes');
							}else{
			            		update_option('bpsfw_tags_select2_'.$user_roles_key, '', 'yes');
							}

							if(isset($_REQUEST['wg_pags_select2'][$user_roles_key])){
			                   	$wg_pags_select2 = BPSFW_recursive_sanitize_text_field($_REQUEST['wg_pags_select2'][$user_roles_key]);
		        				update_option('wg_pags_select2_'.$user_roles_key, $wg_pags_select2, 'yes');
							}else{
			            		update_option('wg_pags_select2_'.$user_roles_key, '', 'yes');
							}

							if(isset($_REQUEST['bpsfw_redirect_url'][$user_roles_key])){
								$bpsfw_redirect_url = sanitize_text_field($_REQUEST['bpsfw_redirect_url'][$user_roles_key]);
								update_option('bpsfw_redirect_url_'.$user_roles_key, $bpsfw_redirect_url, 'yes');
							}else{
								update_option('bpsfw_redirect_url_'.$user_roles_key, '', 'yes');
							}

							if(isset($_REQUEST['bpsfw_prod_redirect_url'][$user_roles_key])){
								$bpsfw_prod_redirect_url = sanitize_text_field($_REQUEST['bpsfw_prod_redirect_url'][$user_roles_key]);
								update_option('bpsfw_prod_redirect_url_'.$user_roles_key, $bpsfw_prod_redirect_url, 'yes');
							}else{
								update_option('bpsfw_prod_redirect_url_'.$user_roles_key, '', 'yes');
							}
                   		}
	                }

					if(isset($_REQUEST['bpsfw_form_bg_image'])){
	                   	$bpsfw_form_bg_image = BPSFW_recursive_sanitize_text_field( $_REQUEST['bpsfw_form_bg_image']);
        				update_option('bpsfw_form_bg_image', $bpsfw_form_bg_image, 'yes');
					}else{
	            		update_option('bpsfw_form_bg_image', '', 'yes');
					}
         
                    foreach ($_REQUEST['bpsfw_comman'] as $key_bpsfw_comman => $value_bpsfw_comman) {
                        update_option($key_bpsfw_comman, sanitize_text_field($value_bpsfw_comman), 'yes');
                    }
	                 
	                wp_redirect( admin_url( '/admin.php?page=private-store&message=success' ) );
	                exit;     
	            }
	        }
	    }

	    function BPSFW_product_ajax() {
            $return = array();
            $post_types = array( 'product','product_variation');
            $search_results = new WP_Query( array( 
                's'=> sanitize_text_field($_GET['q']),
                'post_status' => 'publish',
                'post_type' => $post_types,
                'posts_per_page' => -1,
                'meta_query' => array(
	                array(
	                    'key' => '_stock_status',
	                    'value' => 'instock',
	                    'compare' => '=',
	                )
	            )
            ));

            if( $search_results->have_posts() ) :
               	while( $search_results->have_posts() ) : $search_results->the_post();   
                  	$productc = wc_get_product( $search_results->post->ID );
                  	if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
						$title = $search_results->post->post_title;
						$price = $productc->get_price_html();
						$return[] = array( $search_results->post->ID, $title, $price);   
                  	}
               	endwhile;
            endif;
            echo json_encode( $return );
            die;
      	}

      	function BPSFW_cats_ajax() {
      
         	$return = array();

            $product_categories = get_terms( ['taxonomy' => 'product_cat'] );

            if( !empty($product_categories) ){
                foreach ($product_categories as $key => $category) {
                    $category->term_id;
                    $title = ( mb_strlen( $category->name ) > 50 ) ? mb_substr( $category->name, 0, 49 ) . '...' : $category->name;
                    $return[] = array( $category->term_id, $title );
                }
            }

            echo json_encode( $return );
            die;
      	}

      	function BPSFW_tags_ajax() {
      
         	$return = array();

         	$args = array(
			    'number'     => '',
			    'orderby'    => '',
			    'order'      => '',
			    'hide_empty' => '',
			    'include'    => ''
			);

			$product_tags = get_terms( 'product_tag', $args );

            if( !empty($product_tags) ){
                foreach ($product_tags as $key => $tag) {
                    $tag->term_id;
                    $title = ( mb_strlen( $tag->name ) > 50 ) ? mb_substr( $tag->name, 0, 49 ) . '...' : $tag->name;
                    $return[] = array( $tag->term_id, $title );
                }
            }

            echo json_encode( $return );
            die;
      	}

      	function BPSFW_pages_ajax() {
      
         	$return = array();

            $pages = get_pages();

            if( !empty($pages) ){
                foreach ($pages as $key => $page) {
                    $page->ID;
                    $title = $page->post_title;
                    $return[] = array( $page->ID, $title );
                }
            }

            echo json_encode( $return );
            die;
      	}

     
        	global $bpsfw_comman;
            add_action( 'admin_menu','bpsfw_submenu_page');
            add_action( 'init','bpsfw_save_option');
		    add_action( 'wp_ajax_nopriv_wg_product_ajax','BPSFW_product_ajax');
		    add_action( 'wp_ajax_wg_product_ajax','BPSFW_product_ajax');
		 	add_action( 'wp_ajax_nopriv_wg_cats_ajax','BPSFW_cats_ajax');
		    add_action( 'wp_ajax_wg_cats_ajax','BPSFW_cats_ajax');
		    add_action( 'wp_ajax_nopriv_wg_tags_ajax','BPSFW_tags_ajax');
		    add_action( 'wp_ajax_wg_tags_ajax','BPSFW_tags_ajax');
		    add_action( 'wp_ajax_nopriv_wg_pages_ajax','BPSFW_pages_ajax');
		    add_action( 'wp_ajax_wg_pages_ajax','BPSFW_pages_ajax');
		   

		    
     
			add_action('init','bpsfw_init',8);
			function bpsfw_init(){
				global $bpsfw_comman;
				if($bpsfw_comman['bpsfw_approve_registration'] == 'yes'){
			    add_action( 'show_user_profile','custom_user_profile_fields');
			    add_action( 'edit_user_profile','custom_user_profile_fields');
			    add_action( 'user_new_form','custom_user_profile_fields');
			    add_action( 'edit_user_profile_update','save_custom_user_profile_fields');
			    add_action( 'personal_options_update','save_custom_user_profile_fields');
				add_action( 'user_register','mktbn_user_register', 10, 1 );
				}
			}
?>
