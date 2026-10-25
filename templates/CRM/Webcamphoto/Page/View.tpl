<h3>Contact Photo</h3>
<div>
	<div id="save_mode" style="display:none;">
		<div id="uploadbuttons">
			<div>Click Freeze/Unfreeze to preview the image before saving.</div>	
			<div style="padding: 2px 0px; width:480px; overflow:hidden;">
				<div style="float:left;">
					<input id="freezebutton" type=button value="Freeze" onClick="freeze();">
					<input id="unfreezebutton" type=button value="Unfreeze" onClick="unfreeze();">
				</div>
				<div style="float:right;">
					<input id="savebutton" type=button value="Save" onClick="save('{$uploadurl}');">
					<input id="cancelbutton" type=button value="Cancel" onClick="cancel();">
				</div>
				<div id="uploadprogress">
					<div id="progressbar" style="width:480px;"></div>
				</div>
			</div>
			<div id="my_camera" style="width:480px;height:480px;"></div>
		</div>
	</div>
	<div id="view_mode">
		<div>
			<div>Click Take a Photo to take a new photo for this contact.</div>	
			<div style="padding: 2px 0px;"><input type=button value="Take a Photo" onClick="preview()"></div>
		</div>
		<div>
			<img id="my_photo" src="{$imgsrc}" style="max-width:480px;max-height:480px;">
		</div>
	</div>
</div>

<script>
  (function() {
    var originalCreateObjectURL = URL.createObjectURL;
    URL.createObjectURL = function(obj) {
      // If webcam.min.js passes a stream, grab the video element and assign it properly
      if (obj instanceof MediaStream) {
        setTimeout(function() {
          var video = document.querySelector('video');
          if (video && !video.srcObject) {
            video.srcObject = obj;
          }
        }, 1);
        return '';
      }
      return originalCreateObjectURL.call(URL, obj);
    };
  })();
</script>

{crmScript url="//cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.22/webcam.min.js" }
{crmScript ext="com.jasontdc.webcamphoto" file="webcamphoto.js"}
