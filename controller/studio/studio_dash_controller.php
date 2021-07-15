
<?php
require_once('../../inc/connection.php');
session_start();

        if(isset($_POST['submit-search']) && isset($_POST['type']) ){ 
            $type=$_POST['type'];
            search($type);
        }
        function search($type){
            $_SESSION['type']=$type; //for studio search result page 
            if(!strlen(trim($_POST['search']))>0){
                header('Location: ../../view/studio/studio_search_results.php?error=Please enter the studio name'); 
            }
            else{
                $search =mysqli_real_escape_string($GLOBALS['connection'],$_POST['search']);                
                if($type=='all'){
                    $query="SELECT DISTINCT studio.studio_id FROM studio  LEFT JOIN studio_service ON studio.studio_id=studio_service.studio_id WHERE studio.studio_name LIKE '%$search%' OR studio.distric LIKE '%$search%' OR studio_service.service_name LIKE '%$search%' ";                    
                }
                else if($type=='name'){
                    $query="SELECT DISTINCT studio_id FROM studio WHERE studio_name LIKE '%$search%' ";
                }
                else if($type=='service'){
                    $query="SELECT DISTINCT studio.studio_id FROM studio INNER JOIN studio_service ON studio_service.studio_id=studio.studio_id WHERE studio_service.service_name LIKE '%$search%' ";
                }
                else{
                    $query="SELECT DISTINCT studio_id FROM studio WHERE distric LIKE '%$search%' ";
                }                
                $result_set=mysqli_query($GLOBALS['connection'] ,$query);         
                if($result_set){
                    $no_results=mysqli_num_rows($result_set);
                    if($no_results>=1){
                        $i=0;
                        $record=array(); //set an integer array
                        while($i<$no_results){
                            array_push($record,mysqli_fetch_array($result_set)); //add studio_id(search results) to array 
                            $i++;
                        }
                        echo '<pre>';
                        // print_r($record);
                        echo '</pre>';
                        header('Location: ../../view/studio/studio_search_results.php?search_result='.urlencode(serialize($record))); //send the array with an url
                    }else{
                        //$error="not found";
                       header('Location: ../../view/studio/studio_search_results.php?error= sorry! studio not found');
                    }
    
                }


            }


        }



    
    

?>