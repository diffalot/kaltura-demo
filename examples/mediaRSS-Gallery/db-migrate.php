<?php

// REMOTE_ADDR should always be set by the server, if it is we're not running on the CLI - exit
if(isset($_SERVER['REMOTE_ADDR'])){
    print "Must be called from the command line.";
      exit(1);
}

// define constants
$et = 'entries';
$db = 'database/entry_db.sqlite';

function sqlite_table_exists($dh, $mytable)
{
    $result = sqlite_query($dh,"SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name='$mytable'");
    // casts into integer
    $count = intval(sqlite_fetch_single($result));
    return $count > 0;
    }

function sqlite_table_list($dh)
{
    $result = sqlite_query($dh,"SELECT name FROM sqlite_master WHERE type='table'");
    if (sqlite_num_rows($result) > 0)
    {
      $s = 'Tables:<br />';
      while (sqlite_has_more($result)) {
        $row = sqlite_fetch_single($result);
        $s .= $row.'<br />';
        }
      }
    else
    {
      $s = 'Empty DB: No tables';
      }
    return $s;
    }


// checking if SQLite library is loaded, just in case ...
if (!extension_loaded("sqlite"))
{
    echo 'sqlite was not loaded, loading . . .<br />';
      dl("sqlite.so");
}
else
{
    echo 'sqlite was already loaded, OK<br />';
}

// databse handle
$dh = sqlite_open($db, 0666, $err) or die ($err); // open if exists, create if not
echo sqlite_table_list($dh).'<br />';

// entries table migration
if (!sqlite_table_exists($dh,$et)) // 'entries' does not exists, creating
{
    $sql = "create table $et (id INTEGER PRIMARY KEY, kEntryId CHAR(255), description TEXT, name CHAR(255), email CHAR(255))";
      $result = sqlite_query($dh, $sql) or
                    die("Error in query: ".sqlite_error_string(sqlite_last_error($dh)));
        echo " Table $et was created<br>";  // double-quoted string can embed variables, $jt in this case
}
else
{
    $sql = "SELECT id FROM $et";
    $result = sqlite_query($dh, $sql);
    $num = sqlite_num_rows($result);
    echo " Table $et has $num records<br>";
}

?>
