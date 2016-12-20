cj(function() {
      Webcam.on( 'uploadProgress', function(progress) {
          // Upload in progress
          // 'progress' will be between 0.0 and 1.0
          progress *= 100;
          cj("#progressbar" ).progressbar({
          	value: progress
          });
      });

      Webcam.on( 'uploadComplete', function(code, text) {
          // Upload complete!
          // 'code' will be the HTTP response code from the server, e.g. 200
          // 'text' will be the raw response content
				try {
	        if(code != 200)
	        	throw code;

					var result = JSON.parse(text);
					
					if(result === null || result.is_error !== 0)
						throw "Error saving image.";
					
					var imgurl = result.values[result.id].image_URL.replace(/&amp;/g, '&');

					if(imgurl === null || imgurl === "")
						throw "Error saving image.";
					
					//refresh image in photo tab and summary tab
					cj("#my_photo").attr("src", imgurl + "&" + new Date().getTime());	
					cj(".crm-contact_image > a > img").attr("src", imgurl + "&" + new Date().getTime());	
					cj(".crm-contact_image > a").attr("href", imgurl);
	
					CRM.alert("The photo has been saved.", "Photo Saved", "success");

				} catch (err) {
					CRM.alert("An error occurred when trying to upload and save the photo. Please try again. If the error persists, contact your system administrator.", "Upload Error", "error");
				}

				try {
					Webcam.reset();
				} catch (err) { }

				try {
					Webcam.off();
				} catch (err) { }

				cj('#uploadprogress').hide();
				cj('#uploadbuttons').show();
				cj('#view_mode').show();
				cj('#save_mode').hide();				
      });
	
    Webcam.on('error', function(err) {
			//display error message
			CRM.alert("An error occurred when trying to initialize the webcam. Please ensure that your webcam is connected and that you have granted permissions for CiviCRM to access it.", "Webcam Error", "error");
			cancel();
    });
    
		Webcam.set({
			// live preview size
			width: 640,
			height: 480,
			
			// device capture size
			dest_width: 640,
			dest_height: 480,
			
			// final cropped size
			crop_width: 480,
			crop_height: 480,
			
			// format and quality
			image_format: 'jpeg',
			jpeg_quality: 90
		});
});

function save(uploadurl) {
	cj('#uploadbuttons').hide();
	cj('#uploadprogress').show();
  Webcam.snap( function(data_uri) {
			Webcam.freeze();
      Webcam.upload( data_uri, uploadurl);
  });
}

function freeze() {
	try {
		Webcam.freeze();
	} catch(err) { /* do nothing */ }
}

function unfreeze() {
	try {
		Webcam.unfreeze();
	} catch(err) { /* do nothing */ }
}

function preview() {
	cj('#view_mode').hide();
	cj('#save_mode').show();

	try {
		Webcam.attach( '#my_camera' );
	} catch(err) {
		//display error message
		CRM.alert("An unknown error occurred when trying to initialize the webcam. Please ensure that your webcam is connected, and try again.", "Webcam Error", "error");
	}
}

function cancel() {
	try {
		Webcam.off();
		Webcam.reset();
	} catch(err) { 
	//todo: figure out what's throwing an exception here after successful upload
	}
	try {			
		cj('#view_mode').show();
		cj('#save_mode').hide();
	} catch(err) { /* do nothing */ }
}