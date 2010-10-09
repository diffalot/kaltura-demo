f<?php
// Set your return content type
header('Content-type: application/xml');

// Website url to open
$daurl = 'http://lthree.kaltura.com/index.php/partnerservices2/executeplaylist?uid=&partner_id=22646&subp_id=2264600&format=8&ks={ks}&playlist_id=1_i1ax3az7&';

// Get that website's content
$handle = fopen($daurl, "r");

// If there is something, read and return
if ($handle) {
      while (!feof($handle)) {
                $buffer = fgets($handle, 4096);
                        echo $buffer;
                            }
          fclose($handle);
}
?>
