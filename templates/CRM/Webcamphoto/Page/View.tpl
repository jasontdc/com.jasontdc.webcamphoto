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
{crmScript ext=com.jasontdc.webcamphoto file=webcamjs/webcam.js}
{crmScript ext=com.jasontdc.webcamphoto file=webcamphoto.js}
