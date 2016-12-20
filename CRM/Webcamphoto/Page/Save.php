<?php

require_once 'CRM/Core/Page.php';

class CRM_Webcamphoto_Page_Save extends CRM_Core_Page {
  public function run() {
		try {
			//grab the contact id
			$cid = CRM_Utils_Request::retrieve('cid', 'Int');

			//load the file upload directory from the config, and move the uploaded file
			$config = CRM_Core_Config::singleton();
			$filename = $cid. "-" . md5(uniqid(rand(), true)) . '.jpg';
			move_uploaded_file($_FILES['webcam']['tmp_name'], $config->customFileUploadDir . '/' . $filename);

			//construct the new image URL and update the contact
			$imageurl = CRM_Utils_System::url('civicrm/contact/imagefile', 'photo=' . $filename, TRUE, NULL, TRUE, TRUE);
			$apicall = array(
				'id' => $cid,
				'image_URL' => $imageurl,
			);
	    $result = civicrm_api3('Contact', 'create', $apicall);
		} catch (Exception $e) {
			$result['is_error'] = 1;
		}
		echo json_encode($result);
		CRM_Utils_System::civiExit();
  }
}
