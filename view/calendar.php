<?php
  function build_calendar($month,$year){
      $daysOfWeek = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

      $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
      $numberDays = date('t',$firstDayOfMonth);
      $dateComponents = getdate($firstDayOfMonth);
      $monthName = $dateComponents['month'];
      $dayOfWeek = $dateComponents['wday'];

      $datetoday = date('Y-m-d');

      $calendar = "<table class='table'>";
      $calendar .= "<center><h2>$monthName $year</h2>";
      
      $calendar.= "<a class='cbtn' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
      $calendar.= " <a class='cbtn' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
      $calendar.= "<a class='cbtn' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
      
      $calendar .= "<tr>";
      foreach($daysOfWeek as $day){
        $calendar .= "<th class='header'>$day</th>"; 
      }
      
      $currentDay = 1;

      $calendar .= "</tr><tr>";
      if($dayOfWeek>0){
        for($k=0;$k<$dayOfWeek;$k++){ 
            $calendar .= "<td class='empty'></td>"; 
        } 
      }
      $month = str_pad($month, 2, "0", STR_PAD_LEFT);
      while($currentDay<=$numberDays){
        if ($dayOfWeek == 7){ 
            $dayOfWeek = 0; 
            $calendar .= "</tr><tr>"; 
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT); 
        $date = "$year-$month-$currentDayRel"; 
        $dayname = strtolower(date('l', strtotime($date))); 
        $eventNum = 0; 
        $today = $date==date('Y-m-d')? "today" : "";

        if($date<date('Y-m-d')){
          $calendar.="<td><h4>$currentDay</h4> <button class='nabtn'>N/A</button>"; 
        }
        else{
          $calendar.="<td><h4>$currentDay</h4> <button class='nabtn'>AV</button>"; 
        }
    
        $calendar .="</td>";
        
        $currentDay++; 
        $dayOfWeek++; 
      }

      if ($dayOfWeek!=7){ 
        $remainingDays = 7-$dayOfWeek; 
        for($l=0;$l<$remainingDays;$l++){ 
            $calendar .= "<td class='empty'></td>"; 
        } 
      }
      $calendar .= "</tr>"; 
      $calendar .= "</table>";
      
      echo $calendar;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="../css/calendar.css">
    <style>
      .container{
      font-family: sans-serif;
      width: 30%;
      padding-right:15px;
      padding-left:15px;
      margin-right:auto;
      margin-left:auto;
      }
    </style>
</head>
<body>
    <div class="container"> 
    <div class="row"> 
 
        <?php 
        $dateComponents = getdate(); 
        if(isset($_GET['month']) && isset($_GET['year'])){
          $month = $_GET['month']; 			     
          $year = $_GET['year'];
        }
        else{
          $month = $dateComponents['mon']; 			     
          $year = $dateComponents['year'];
        }
        build_calendar($month,$year); 
        ?> 
    </div> 
    </div> 
</body>
</html>