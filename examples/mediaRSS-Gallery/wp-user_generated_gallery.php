<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Kaltura User Generated Gallery
*/
?>

<!--include external scripts and define constants -->
<?php 
	require_once("/home/openvideoalliance/user_generated_gallery/kaltura_client_v3/KalturaClient.php"); 
	
	//define constants in ksu-settings.php
  include "/home/openvideoalliance/user_generated_gallery/ksu-settings.php";

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

<?php get_header(); ?>


<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/jparse/jparse.min.js"></script>
<script type="text/javascript" src="http://html5.kaltura.org/js"></script>  
<script src="http://apis.kaltura.org/kalturaJsClient/kaltura.min.js.php" language="javascript"></script>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/ksu.js"></script>

<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/Lawnchair.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/adaptors/LawnchairAdaptorHelpers.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/lawnchair/src/adaptors/DOMStorageAdaptor.js"></script>
<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/libs/showdown.js"></script>


<script type="text/javascript">

// Kaltura Session Key and Partner ID are provided by PHP Kaltura Client on the Server
var ks = "<?php echo $ks;?>";
var kPartnerId = <?php echo KALTURA_PARTNER_ID ?>;
// set flashVar object
var ksuflashVars = <?php echo json_encode($flashVars); ?>;

</script>


<script type="text/javascript" src="http://www.openvideoconference.org/user_generated_gallery/user_generated_gallery.js"></script>


    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="http://www.openvideoconference.org/wp-content/themes/ovcclassic/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="http://www.openvideoconference.org/user_generated_gallery/style.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="http://www.openvideoconference.org/user_generated_gallery/spinner.css" type="text/css" media="screen" /> 


<div id="gallery" style="width:970px;position:relative;left:-15px;margin-left:auto;margin-right:auto">
		<div id="upload-now">
      <p align="right">
			  <a id="start-upload" onclick="showUpload()">Upload a Video</a>
      </p>
		</div>
    <div class="video-highlight box270">
        <div id="video-player"></div>
    </div>
    <div class="infobox box270">
        <div id="video-description"></div>
    </div>
    <div id="thumbs-viewport">
        <div id="thumbs-container"></div>
    </div>

    <div class="navbar">
        <span class="left-arrow" id="nav-link-previous">&uArr;</span>
        <span class="right-arrow" id="nav-link-next">&dArr;</span>
    </div>

    <div id="mediaRSS" style="display:none">
    </div>
    
    <div id="upload-dialog">
    </div>

</div>
<div id="ksu" style="display:none;visibility:visible">
  <!---set style to enable widget overlap -->
<style>
#ksu { margin: 0px; overflow:hidden }
#flashContainer{ position:relative; }
#flashContainer span{ color:#333; font-size:16px; }
object, embed{ position:absolute; top:0; left:0; z-index:1001;}
</style>


	<div id="flashContainer">
		<form>
			<input id="browse-button" type="button" value="Select a File">
		</form>
		<div id="uploader"> 
		</div>
    <script type="text/javascript">
			 <!--embed flash object-->
			swfobject.embedSWF("http://www.kaltura.com/kupload/ui_conf_id/11500", "uploader", "200", "30", "9.0.0", "expressInstall.swf", ksuflashVars, ksuparams,ksuattributes);
			//swfobject.embedSWF("./KSU.swf", "uploader", "200", "30", "9.0.0", "expressInstall.swf", flashVars, params,attributes);
    </script>


	</div>
	<br/>
   <div id="spinner">
    <div class="spinner1"></div>
    <div class="spinner2"></div>
    <div class="spinner3"></div>
    <div class="spinner4"></div>
    <div class="spinner5"></div>
    <div class="spinner6"></div>
    <div class="spinner7"></div>
    <div class="spinner8"></div>
  </div><br/>

  <div id="progress-bar"></div><br/>
  <div id="flash"></div><br/>

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
    
  </div>

</div>
<?php get_footer(); ?>
