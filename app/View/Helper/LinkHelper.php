<?php
App::uses('AppHelper', 'View/Helper');
App::uses('Sanitize', 'Utility');
/**
 * Description of LinkHelper
 *
 * @author bokac
 */
class LinkHelper extends AppHelper {
    public $helpers = array('Html', 'Form', 'Time');
    
    /**
     * Custom link
     * 
     * @param string $title
     * @param string $url
     * @param string $iconName
     * @param array options Options to pass to HTML link method
     * @return type
     */
    public function cLink($title = '', $url = '/pages/index', $classes = 'fa ', $options = array()) {
        $defaults = array('escape' => false);
        $mr = am($defaults, $options);
        return $this->Html->link('<i class="'.$classes.'"></i> '.$title, $url, $mr);
    }
    
    /**
     * Custom delete link
     * 
     * @param string $title
     * @param string $url
     * @param string $iconName
     * @return string
     */
    public function dLink($title = '', $url = '/pages/index', $classes = 'fa ', $delId = 0) {
        return $this->Form->postLink('<i class="'.$classes.'"></i> '.$title, $url, array('escape' => false), __('Are you sure you want to delete # %s?', $delId));
    }
    
    public function displayUrl($url, $name) {
        $url = htmlentities(strip_tags($url));
        $name = htmlentities(strip_tags($name));
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->Html->link(h($name), $url);
        }
        
        return h($name);
    }
    
    /**
     * Display icons with checked/unchecked mark or yes/no state depending on the field value
     * 
     * @param boolean $field
     * @param boolean $yesno
     * @return string
     */
    public function binaryState($field, $yesno = false) {
        if (!$yesno) {
            $icon = $field === false ? "remove-sign" : "ok-circle";
           return "<i class=\"glyphicon glyphicon-$icon\"></i>";
        } else {
            $r = $field === "" ? "No" : "Yes";
            return $r;
        }
    }
    
    public function displayDate($date) {
      $date = $this->Time->format('F-d-Y', $date);
      $parts = explode('-', $date);
      $day = '<div class="post-day">'.$parts[1]."</div>";
      $month = '<div class="post-month">'.substr($parts[0], 0, 3)."</div>";
      $year = '<div class="post-year">'.$parts[2]."</div>";
      $returnDate = $day.$month.$year;
      return $returnDate;
    }
}

?>
