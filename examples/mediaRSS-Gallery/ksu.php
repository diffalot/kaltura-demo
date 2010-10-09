<html>
<head>

<!--include external scripts and define constants -->
<?php 
	require_once("kaltura_client_v3/KalturaClient.php"); 
	
	//define constants in ksu-settings.php
  include "./ksu-settings.php";

	//define session variables
	$partnerUserID          = 'openvideoconference.tv';

	//Construction of Kaltura objects for session initiation
	$config           = new KalturaConfiguration(KALTURA_PARTNER_ID);
	$client           = new KalturaClient($config);
	$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_SECRET, $partnerUserID, KalturaSessionType::USER);
	//$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_ADMIN_SECRET, $partnerUserID, KalturaSessionType::ADMIN);

	$flashVars = array();
	$flashVars["uid"]   = $partnerUserID; 
	$flashVars["partnerId"] 		        = KALTURA_PARTNER_ID;
	$flashVars["subPId"] 		        = KALTURA_PARTNER_ID*100;
	$flashVars["entryId"] 	 = -1;	     
	$flashVars["ks"]   = $ks; 
	$flashVars["conversionProfile"]   = 5; 
	$flashVars["maxFileSize"]   = 250; 
	$flashVars["maxTotalSize"]   = 5000; 
	$flashVars["uiConfId"]   = 11500; 
	$flashVars["jsDelegate"]   = "delegate"; 
?>

<link rel="stylesheet" type="text/css" href="history/history.css" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="http://apis.kaltura.org/kalturaJsClient/kaltura.min.js.php" language="javascript"></script>
<script src="AC_OETags.js" language="javascript"></script>
<script src="history/history.js" language="javascript"></script>
<!---	Kaltura Javascript Client Setup -->
<script language="javascript">

// Kaltura Session Key and Partner ID are provided by PHP Kaltura Client on the Server
var ks = "<?php echo $ks;?>";
var kPartnerId = <?php echo KALTURA_PARTNER_ID ?>;

</script>

<!---set style to enable widget overlap -->
<style>
	body { margin: 0px; overflow:hidden }
	#flashContainer{ position:relative; }
		#flashContainer span{ color:#333; font-size:16px; }
		object, embed{ position:absolute; top:0; left:0; z-index:999;}
</style>

<!---	JavaScript handler methods to react to upload events. -->
<script type="text/javascript" src="./ksu.js">

</script>


</head>
<body onload=onLoadHandler();>
	<div id="flashContainer">
		<form>
			<input id="browse-button" type="button" value="Select a File">
		</form>
		<div id="uploader" style="display:none"> 
		</div>
		<script language="JavaScript" type="text/javascript">
			var params = {
				allowScriptAccess: "always",
				allowNetworking: "all",
				wmode: "transparent"

			};
			var attributes  = {
				id: "uploader",
				name: "KUpload"
			};
			// set flashVar object
			var flashVars = <?php echo json_encode($flashVars); ?>;
			 <!--embed flash object-->
			swfobject.embedSWF("http://www.kaltura.com/kupload/ui_conf_id/11500", "uploader", "200", "30", "9.0.0", "expressInstall.swf", flashVars, params,attributes);
			//swfobject.embedSWF("./KSU.swf", "uploader", "200", "30", "9.0.0", "expressInstall.swf", flashVars, params,attributes);
		</script>
	</div>
	<br/>
    <div id="progress-bar"></div>
	<div id="userInput">
	  <form>
			<input type="text" value="title here" id="titleInput" /><br />
			<input type="text" value="tags here, comma separated" id="tagsInput" /><br />
      <textarea id="descriptionInput">Please enter a description here.

we recommend using Markdown and writing the credits for your video like this:

[Your Name](http://yourwebsite.com "HoverText!")</textarea><br />
      <input id="save-button" type="button" value="Save" 	onclick="saveEntry()">
      <input id="add-button" type="button" value="Complete Upload" 	onclick="titleAndSaveEntry()">
		</form>
    <div id="flash">
    </div>
	<!--
	<form>
			<input type="button" value="Step 2 - Upload" 		onclick="upload()">
			<input type="button" value="Step 3 - Add entries" 	onclick="addEntries()">
			<input type="button" value="Cancel" 		        onclick="stopUploads()">
		</form>

		<form
			<input type="button" value="Cancel" 		        onclick="stopUploads()"><br />
		</form>

		<form>
		</form>

		<form>
			<input type="text" value="enter tags here" id="tagsInput" />
			<input type="text" value="0" id="tagsStartIndex" />
			<input type="text" value="1" id="tagsEndIndex" />
			<input type="button" value="Add tags" onclick="addTagsFromForm()">
			<input type="button" value="Set tags" onclick="setTagsFromForm()">
		</form>

		<form>
			<input type="text" value="enter title here" id="titleInput" />
			<input type="text" value="0" id="titleStartIndex" />
			<input type="text" value="1" id="titleEndIndex" />
			<input type="button" value="Set title" onclick="setTitleFromForm()">
		</form>

		<form>
			<input type="text" value="0" id="removeStartIndex" />
			<input type="text" value="0" id="removeEndIndex" />
			<input type="button" value="Remove Files" onclick="removeFilesFromForm()">
		</form>

		<form>
			<input type="text" value="0" id="maxUploadsInput" />
			<input type="button" value="Set max uploads" onclick="setMaxUploads(parseInt(maxUploadsInput.value))">
		</form>

		<form>
			<input type="text" value="partner data goes here" id="partnerDataInput" />
			<input type="button" value="Set partner data" onclick="setPartnerData(partnerDataInput.value)">
			<input id="groupId" />
			<input type="button" value="set group id " onClick="setGroupId(groupId.value)">
			<input id="permissions" />
			<input type="button" value="set permissions" onClick="setPermissions(permissions.value)">
			<input id="screenName" />
			<input type="button" value="Set screen name" onClick="setScreenName(screenName.value)">
			<input id="siteUrl" />
			<input type="button" value="set site url" onClick="setSiteUrl(siteUrl.value)">
		</form>
    -->
	</div>
</body>
</html>
