<?php
/*
 * About Us Progress Bar Active Callback Function.
*/
function sparklestore_pro_active_progressbar(){
  $about_progressbar = get_theme_mod('sparklestore_pro_aboutus_progressbar',true);
  if ($about_progressbar == true) {
    return true;
  }else {
    return false;
  }
}

/*
 * About Us Button Active Callback Function.
*/
function sparklestore_pro_active_about_button(){
  $about_button = get_theme_mod('sparklestore_pro_aboutus_content', 'excerpt');
  if ($about_button == 'excerpt') {
    return true;
  }else {
    return false;
  }
}