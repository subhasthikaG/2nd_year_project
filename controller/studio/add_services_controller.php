<?php    
    require_once('../../inc/connection.php');
    session_start();
    if(isset($_GET['studio_id'])){ //check if the studio_id succesfully passed
        $studio_id=$_GET['studio_id']; //store the studio_id which passed from add_services.html file
            if(isset($_POST['submit_service1'])){ //if the user pressed the save button 
                    $rows=$_GET['rows'];                     
                    for ($i=1; $i<$rows+2; ++$i){
                        if(isset($_POST['check'.$i.'']) && isset($_POST['charge'.$i.''])){
                            $service_name=$_POST['check'.$i.'']; //store the service in service_name variable
                            $charge=$_POST['charge'.$i.''];//store the charge in charge variable                    
                            $query ="INSERT INTO studio_service(studio_id,service_name,service_charge) VALUES('{$studio_id}','{$service_name}','{$charge}')";
                            $result_set=mysqli_query($connection,$query);                                   
                        }
                        else{
                             header('Location: ../../view/studio/add_services.php?added=service added');//for loop break
                        }
                    }
                            

            }
            else if(isset($_POST['submit_service2'])){// user has added service first time, now he could change service(delete or change the charge)
                    $rows=$_GET['rows'];   //store the number of results which take from the query 
                    for ($i=1; $i<$rows+1; ++$i){
                        if(isset($_POST['check'.$i.'']) && isset($_POST['charge'.$i.''])){                   
                            $service_name=$_POST['check'.$i.'']; //store the service in service_name variable
                            $charge=$_POST['charge'.$i.''];//store the charge in charge variable                           
                            $query ="UPDATE studio_service SET service_charge=$charge, status=1 WHERE studio_id=$studio_id AND service_name='$service_name' ";
                            $result_set=mysqli_query($connection,$query);
                            if($result_set){
                                $updated="Service charge updated";
                            }
                                            
                        }
                        else if(isset($_POST['uncheck'.$i.''])){//get unchecked services for delete
                            $unchecked_service_name=$_POST['uncheck'.$i.'']; //store the service in service_name variable
                            $query ="UPDATE studio_service SET status=0 WHERE studio_id=$studio_id AND service_name='$unchecked_service_name' ";
                            $result_set = mysqli_query($connection,$query);                            
                            if($result_set){
                                $deleted=$unchecked_service_name." updated ";
                            }
                            
                        }                     

                    }
                    header('Location: ../../view/studio/add_services.php?deleted='.$deleted.'&updated='.$updated);
                
            }
            if(isset($_POST['submit_other_service'])){
                if(isset($_POST['service_name']) && isset($_POST['charge'])){
                    $service_name=$_POST['service_name'];
                    $charge=$_POST['charge'];        
                    $query ="INSERT INTO studio_service(studio_id,service_name,service_charge) VALUES('{$studio_id}','{$service_name}','{$charge}')";
                    $result_set=mysqli_query($connection,$query);
                    if($result_set){
                        $new_service=' New service added ';
                        header('Location: ../../view/studio/add_services.php?new_service='.$new_service); 
                    }
                    else{
                        $error='You already added this service';
                        header('Location: ../../view/studio/add_services.php?error='.$error);
                    }

                    
                }
               
            }
           
        
}

?>