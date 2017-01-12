<?php
include('config.php');


 $ssql = 'select * from calenderevents';

$result= mysql_query($ssql);

 while ($record = mysql_fetch_array($result)) {
        $event_array[] = array(
            'id' => $record['ID'],
            'title' => $record['Title']    ,
            'start' => $record['StartDate'] ,
             'backgroundColor' =>  '#'.$record['TheColor'],
             'url' =>  'pgCases.php?cccd='.$record['url'].'&mark=1'
             
        );
    }

echo json_encode($event_array);



//$arr = array("title" => 'All Day Event', "start" =>  '2016-09-25 00:00:00.000000', "backgroundColor" => '#4b8df8');


 
?>
 