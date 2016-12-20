<?php

require_once 'CRM/Core/Page.php';

class CRM_Webcamphoto_Page_View extends CRM_Core_Page {
  public function run() {
    CRM_Utils_System::setTitle(ts('WebcamPhoto'));
    $cid = CRM_Utils_Request::retrieve('cid', 'Int');
    $this->assign('cid', $cid);

		$uploadurl = CRM_Utils_System::url('civicrm/contact/webcamphoto/save', 'cid=' . $cid, TRUE, NULL, TRUE, TRUE);
		$this->assign('uploadurl', $uploadurl);

		$result = civicrm_api3('Contact', 'get', array(
		  'sequential' => 1,
		  'return' => array("image_URL"),
		  'id' => $cid,
		));

		$src = "";
		if($result && $result['count'] == 1) {
			$src = $result['values'][0]["image_URL"];
		}
	  
	  $this->assign('imgsrc', $src);
    
    parent::run();
  }
}
