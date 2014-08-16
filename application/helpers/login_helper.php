<?php
function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session

    if ($CI->session->userdata('logged_in'))
    {
      return true;
    }
    else
      {
        return false;
      }
}
?>
