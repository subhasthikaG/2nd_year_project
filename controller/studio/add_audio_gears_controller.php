<?php    
    require_once('../../inc/connection.php');
    session_start();
    if(isset($_GET['studio_id'])){ //check if the studio_id succesfully passed
        $studio_id=$_GET['studio_id']; //store the studio_id which passed from add_services.html file       
            if(isset($_POST['submit_add_audio_gear2'])){// user has added service first time, now he could change service(delete or change the charge)
                    $rows=$_GET['rows'];   //store the number of results which take from the query 
                    for ($i=1; $i<$rows+1; ++$i){
                        if(isset($_POST['check'.$i.'']) && isset($_POST['charge'.$i.''])){                   
                            $instrument_name=$_POST['check'.$i.'']; //store the instrument in instrument_name variable
                            $charge=$_POST['charge'.$i.''];//store the charge in charge variable    
                            $qty=$_POST['qty'.$i.''];
                            
                            $list=[]; //array
                            $query2 = "SELECT * FROM studio_audio_gear WHERE name = '$instrument_name' AND studio_id='$studio_id'";
                            $result_set2 = mysqli_query($connection,$query2);
                            if(mysqli_num_rows($result_set2)>0){
                              while($record2=mysqli_fetch_assoc($result_set2)){
                                array_push($list,$record2);    
                              }
                              
                              if(count($list)>$qty){
                                $diff = (count($list)-$qty);
                                for($k=0; $k<count($list);$k++){
                                  $query4 = "UPDATE studio_audio_gear SET charge='{$charge}',status=1 WHERE audio_id='{$list[$k]['audio_id']}'";
                                  $result_set4 = mysqli_query($connection,$query4);
                                } 
                                for($j=0;$j<$diff;$j++){
                                  $query3 = "DELETE FROM studio_audio_gear WHERE audio_id='{$list[$j]['audio_id']}'";
                                  $result_set3 = mysqli_query($connection,$query3);       
                                } 
                              }
                              else if(count($list)<$qty){
                                $diff = ($qty - count($list));
                                for($i=0;$i<count($list);$i++){
                                  $query3 = "UPDATE studio_audio_gear SET charge='{$charge}',status=1 WHERE audio_id='{$list[$i]['audio_id']}'";
                                  $result_set3 = mysqli_query($connection,$query3); 
                                }
                                for($j=0;$j<$diff;$j++){
                                  $query4 = "INSERT INTO studio_audio_gear (studio_id,name,charge) VALUES ('{$studio_id}','{$instrument_name}','{$charge}')";
                                  $result_set4 = mysqli_query($connection,$query4);      
                                }
                              }
                              else if(count($list)==$qty){
                                for($j=0;$j<$qty;$j++){
                                  $query3 = "UPDATE studio_audio_gear SET charge='{$charge}',status=1 WHERE audio_id='{$list[$j]['audio_id']}'";
                                  $result_set3 = mysqli_query($connection,$query3);          
                                }            
                              }
                            }
                            
                            $updated="Audio gear details updated";                    
                        }
                        else if(isset($_POST['uncheck'.$i.''])){//get unchecked services for delete
                            $unchecked_instrument_name=$_POST['uncheck'.$i.'']; //store the instrumet in instrumet_name variable
                            $query ="UPDATE studio_audio_gear SET status=0 WHERE studio_id=$studio_id AND name='$unchecked_instrument_name' ";
                            $result_set = mysqli_query($connection,$query);                            
                            if($result_set){
                                $deleted=$unchecked_instrument_name." Updated ";
                            }
                            
                        }                     

                    }
                    header('Location: ../../view/studio/add_audio_gears.php?deleted='.$deleted.'&updated='.$updated);
                
            }
            if(isset($_POST['submit_other_instrument'])){
                if(isset($_POST['instrument_name']) && isset($_POST['charge'])){
                    $instrument_name=$_POST['instrument_name'];
                    $charge=$_POST['charge']; 
                    $qty=$_POST['qty'];
                    
                    for($k=0;$k<$qty;$k++){
                      $query ="INSERT INTO studio_audio_gear(studio_id,name,charge) VALUES('{$studio_id}','{$instrument_name}','{$charge}')";
                      $result_set=mysqli_query($connection,$query);     
                    }
                    $new_instrument=' New audio gear added ';
                    header('Location: ../../view/studio/add_audio_gears.php?new_instrument='.$new_instrument);
                }        
            }
    }            
?>