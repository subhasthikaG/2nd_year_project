<?php

  function build_calendar($month,$year,$array,$blocked_list,$booked_list,$temp_blocked_list,$connection){
    
    $daysOfWeek = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    $numberDays = date('t',$firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth); //details of month's first date (array)
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');   //today

    //defining the calendar table
    $calendar = "<table class='table'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
      
    $calendar.= " <a class='cbtn' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    $calendar.= "<a class='cbtn' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
      
    $calendar .= "<tr>";
      foreach($daysOfWeek as $day){
      $calendar .= "<th class='header'>$day</th>"; 
    }
      
    $currentDay = 1;      //day index (1-30)

    $calendar .= "</tr><tr>";

    if($dayOfWeek>0){
      for($k=0;$k<$dayOfWeek;$k++){ 
        $calendar .= "<td class='empty'></td>";     //empty dates before first day
      } 
    }
    
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);     //month index
    
    while($currentDay<=$numberDays){

      if($dayOfWeek == 7){ 
        $dayOfWeek = 0; 
        $calendar .= "</tr><tr>"; 
      }

      $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);     //date
      $date = "$year-$month-$currentDayRel"; 
      $dayname = strtolower(date('l', strtotime($date))); 
      $eventNum = 0; 
      $today = $date==date('Y-m-d')? "today" : "";

	  $isblocked = 0;                                 
	  for($i=0; $i<count($blocked_list); $i++){            //return studio's blocked dates
		if($date==$blocked_list[$i]['dates']){
		  $isblocked = 1;
		  break;
		}
	  }

    $isbooked = 0;
    for($i=0; $i<count($booked_list); $i++){             //return completely booked job list
      if($date==$booked_list[$i]['date']){
        $isbooked = 1;
        break;
      }
    }

    $istempblocked = 0;
    for($i=0; $i<count($temp_blocked_list); $i++){             //return temporarily blocked job list
      if($date==$temp_blocked_list[$i]['date']){
        $istempblocked = 1;
        $tempbid = $i;
        break;
      }
    }

    if($date<=date('Y-m-d')){
      $calendar.="<td style='background-color:rgba(255,204,203,0.4);'><h4 style='color:grey;'>$currentDay</h4>"; 
    }

	  else if($isblocked==1){
		$calendar.="<td style='background-color:rgba(255,234,0,0.5);'><h4 style='color:grey;'>$currentDay</h4><p style='color:grey; font-size:0.9rem;'><i>Holiday</i></p>"; 
	  }

    else if($isbooked==1){
      $calendar.="<td style='background-color:rgba(247,90,32,0.4);'><h4 style='color:grey;'>$currentDay</h4><p style='color:grey; font-size:0.9rem;'><i>Reserved</i></p>";
    }

	  else if($date>date('Y-m-d') && $array['issatblocked']==1 && $dayname == 'saturday'){
		$calendar.="<td style='background-color:rgba(255,234,0,0.5);'><h4 style='color:grey;'>$currentDay</h4><p style='color:grey; font-size:0.9rem;'><i>Holiday</i></p>"; 
	  }

	  else if($date>date('Y-m-d') && $array['issunblocked']==1 && $dayname == 'sunday'){
	    $calendar.="<td style='background-color:rgba(255,234,0,0.5);'><h4 style='color:grey;'>$currentDay</h4><p style='color:grey; font-size:0.9rem;'><i>Holiday</i></p>"; 
	  }

    else if($istempblocked==1){
      $choosetime = $temp_blocked_list[$tempbid]['choose_time'];
      $cutoff = date( "Y-m-d H:i:s", strtotime( $choosetime ) + 900);
      $cur_time = date("Y-m-d H:i:s");

      $cur_time2 = strtotime($cur_time);
      $cutoff2 = strtotime($cutoff);

      $jobid = $temp_blocked_list[$tempbid]['job_id'];

      if($cur_time2>$cutoff2){
        $query57 = "UPDATE reserved_job SET temp_blocked = 0 WHERE job_id = $jobid";
        $result_set57 = mysqli_query($connection,$query57);
        $calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>";     
      }
      else{
        $calendar.="<td style='background-color:rgba(255,234,0,0.5);'><h4 style='color:grey;'>$currentDay</h4><p style='color:grey; font-size:0.9rem;'><i>N/A</i></p>";      
      }     
    }

	  else if($date>date('Y-m-d') && $array['issatblocked']==1 && $dayname != 'saturday'){
	    $calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>"; 
	  }
	
    else if($date>date('Y-m-d') && $array['issunblocked']==1 && $dayname != 'sunday'){
	    $calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>"; 
	  }

	  else if($date>date('Y-m-d') && $array['issatblocked']==0 && $dayname == 'saturday'){
		$calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>"; 
	  }

	  else if($date>date('Y-m-d') && $array['issunblocked']==0 && $dayname == 'sunday'){
		$calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>";  
	  }

      else{
        $calendar.="<td><h4>$currentDay</h4> <form action='select_service.php' method='post'><input type='hidden' name='date' value= $date> <button type='submit' name='book' class='avbtn'>BOOK</button></form>"; 
      }
    
      $calendar .="</td>";
        
      $currentDay++; 
      $dayOfWeek++; 
    }

    if($dayOfWeek!=7){ 
      $remainingDays = 7-$dayOfWeek; 
      for($l=0;$l<$remainingDays;$l++){ 
        $calendar .= "<td class='empty'></td>"; 
      } 
    }
      
    $calendar .= "</tr>"; 
    $calendar .= "</table>";
      
    echo $calendar;
  }

  $query11 = "SELECT * FROM studio_schedule WHERE id = $studio_id";
  $res_set11 = mysqli_query($connection,$query11);

  if(mysqli_num_rows($res_set11)>0){                //select the field if it is already there
    $record11 = mysqli_fetch_assoc($res_set11);
  }

  else{
    $query12 = "INSERT INTO studio_schedule (id) VALUES ($studio_id)";              //if not, create a field
    $res_set12 = mysqli_query($connection,$query12);
    $query11 = "SELECT * FROM studio_schedule WHERE id = $studio_id";           //select created field
    $res_set11 = mysqli_query($connection,$query11);
    $record11 = mysqli_fetch_assoc($res_set11);
  }

  //Blocked date array creation
  $blocked_list=[];
  $query16 = "SELECT * FROM blocked_dates WHERE sid=$studio_id";
  $res_set16 = mysqli_query($connection,$query16);
  
  if(mysqli_num_rows($res_set16)>0){
    while($row=mysqli_fetch_assoc($res_set16)){
      array_push($blocked_list,$row);
    }
  }
  
  //Booked job list
  $booked_list=[];
  $query17 = "SELECT date FROM reserved_job WHERE studio_id=$studio_id AND isplaced = 1";
  $res_set17 = mysqli_query($connection,$query17);
  if(mysqli_num_rows($res_set17)>0){
    while($row=mysqli_fetch_assoc($res_set17)){
      array_push($booked_list,$row);
    }
  }
  
  //temp_blocked list
  $temp_blocked_list=[];
  $query18 = "SELECT * FROM reserved_job WHERE temp_blocked=1";
  $res_set18 = mysqli_query($connection,$query18);
  if(mysqli_num_rows($res_set18)>0){
    while($row=mysqli_fetch_assoc($res_set18)){
      array_push($temp_blocked_list,$row);
    }
  }
?>