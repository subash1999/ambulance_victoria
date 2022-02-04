<?php
/**
 * $type : success, alert, warning, danger
 * $heading: heading of alert, provide null or blank string if you donot want to show heading
 * $messages: [], array of messages that you want to display
 */
function dispalyAlert($type, $heading = null, $messages = [])
{
  $html = '<div class="alert alert-'.$type.'" role="alert">';

  if ($heading != null && $heading != '') {
    $html .= '<h4 class="alert-heading">'.$heading.'</h4>';
  }
  $html .= '<ul>';
  foreach ($messages as $msg) {
    $html .= '<li><small>'.$msg.'</small></li>';
  }
  $html .= '</ul></div>';
  return $html;
}
