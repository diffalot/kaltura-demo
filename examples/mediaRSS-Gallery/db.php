<?php
// setup db
include('db-utils.php');
$dh = sqlite_open($db, 0666, $err) or die ($err);

//if this is a POST, we write a record to the db
if (isset($_POST['description']))
{
  if (!empty($_POST['kEntryId']) && !empty($_POST['description']) && !empty($_POST['name']) )
  {
    $kEntryId = sqlite_escape_string($_POST['kEntryId']);
    $description = sqlite_escape_string($_POST['description']);
    $name = sqlite_escape_string($_POST['name']);
    $sql = "INSERT INTO $et (id,kEntryId,description,name,email)
            VALUES (NULL,'$kEntryId','$description','$name',NULL);";
    $result = sqlite_query($dh, $sql) or die("Error in query: ".sqlite_error_string(sqlite_last_error($dh)));
    echo "<p><i>Record successfully inserted!</i></p>\n";
    print_r($_POST);
    }
  else
  {
     echo "<p><i>Incomplete form input. Record not inserted! Go Back</i></p>";
     }
  }

//if this is a GET, retreive all records and output a javascript object
if (isset($_GET))
//echo "descriptions = ";
{
  if (!sqlite_is_empty($dh))
  {
      $sql = "SELECT * FROM ".$et ;
      $result = sqlite_query($dh, $sql);
      if (sqlite_num_rows($result) > 0)
      {
        $descriptions = array();
        while (sqlite_has_more($result)) 
        {
          $row = sqlite_fetch_array($result);
          $descriptions[] = array("kEntryId" => $row['kEntryId'], "description" => $row['description'], "name" => $row['name']);
          }
        echo json_encode($descriptions); //, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);
        }
      else
      {
        echo 'Create DB first!<br />';
        }
      }
  }

sqlite_close($dh);
?>
