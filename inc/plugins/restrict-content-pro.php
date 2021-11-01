<?php

//https://wpquestions.com/Restrict_Content_Pro_remove_user_s_subscription_role/19602
//add_action('wp_loaded', 'remove_role_to_expired');
function remove_role_to_expired()
{
  $members = rcp_get_customers('expired');

  if ($members) {
    foreach ($members as $member) {
      $member = new RCP_Customer($member->ID);
      $user_role = rcp_get_user_role($member->ID);
      $member->remove_role($user_role);
    }
  }
}
