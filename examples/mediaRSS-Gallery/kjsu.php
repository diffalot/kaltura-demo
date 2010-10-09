<html>
<head>

<!-- initialize a kaltura session on the web server to obtain an access key securely -->
<?php 
	require_once("kaltura_client_v3/KalturaClient.php"); 
	
	//define constants in ksu-settings.php
  include "./ksu-settings.php";

	//Construction of Kaltura objects for session initiation
	$config           = new KalturaConfiguration(KALTURA_PARTNER_ID);
	$client           = new KalturaClient($config);
	$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_SECRET, $partnerUserID, KalturaSessionType::USER);
	//$ks               = $client->session->start(KALTURA_PARTNER_WEB_SERVICE_ADMIN_SECRET, $partnerUserID, KalturaSessionType::ADMIN);


  // setup our upload processor
  // this processor is based on: http://www.webdeveloper.com/forum/showthread.php?t=101466
  // first let's set some variables 

  // make a note of the current working directory relative to root. 
  $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 

  // make a note of the location of the upload handler script 
  $uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.php';

  // set a max file size for the html upload form 
  $max_file_size = 300000000000000000000000000; // size in bytes hehe

?>

<link rel="stylesheet" type="text/css" href="history/history.css" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

</head>
<body>

  <div id="html5-upload">
		<input type="file" multiple="multiple" id="upload_field" />
		<div id="progress_report">
			<div id="progress_report_name"></div>
			<div id="progress_report_status" style="font-style: italic;"></div>
			<div id="progress_report_bar_container" style="width: 90%; height: 5px;">
				<div id="progress_report_bar" style="background-color: blue; width: 0; height: 100%;"></div>
			</div>
		</div>
  </div>


<!-- Load Up Our Javascript -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="jquery-html5-upload/jquery.html5_upload.js" type="text/javascript"></script>
<script src="http://apis.kaltura.org/kalturaJsClient/kaltura.min.js.php" language="javascript"></script>

<!---	Kaltura  -->
<script language="javascript">

// Kaltura Session Key and Partner ID are provided by PHP Kaltura Client on the Server
var ks = "<?php echo $ks;?>";
var kPartnerId = <?php echo KALTURA_PARTNER_ID ?>;

</script>

<!-- load our javascript upload controller -->
<script type="text/javascript" src="./kjsu.js"></script>

</body>
</html>
