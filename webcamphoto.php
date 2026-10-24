<?php

require_once 'webcamphoto.civix.php';

function webcamphoto_civicrm_tabset($tabsetName, &$tabs, $context) {
  //check if the tabset is Contact Summary Page
  if ($tabsetName == 'civicrm/contact/view') {
    if (!empty($context)) {
    	$contactId = $context['contact_id'];
      $url = CRM_Utils_System::url( 'civicrm/contact/webcamphoto/view',
        "snippet=json&reset=1&cid=$contactId" );

      //add a new Photo tab along with url
      $tabs['webcamphoto'] = array(
        'id' => 'webcamphoto',
        'title' => ts('Photo'),
        'url' => $url,
        'valid' => 1,
        'active' => 1,
        'weight' => 1,
        'current' => false,
//        'class' => 'livePage',
      );
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function webcamphoto_civicrm_config(&$config) {
  _webcamphoto_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function webcamphoto_civicrm_install() {
  _webcamphoto_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function webcamphoto_civicrm_enable() {
  _webcamphoto_civix_civicrm_enable();
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function webcamphoto_civicrm_navigationMenu(&$menu) {
  _webcamphoto_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.jasontdc.webcamphoto')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
} // */
