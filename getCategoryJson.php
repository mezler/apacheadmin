<?php  

require 'conn.php';

$arr=[];
$jsondata ="";
$temp = "";
$query = "SELECT name FROM nested_category ORDER BY category_id;";
$result = $link->query($query);

while ($row = mysqli_fetch_assoc($result)) {

    if(getDirectParent ( $row["name"] ))
    {
        $temp = getDirectParent ( $row["name"] );
    }
    else
    {
        $temp = "NINCS";
    }

    $newdata =  array (
        'nodename' => $row["name"],
        'parent' => $temp,
        
      );
    
    array_push($arr, $newdata);
    $newdata=[];


    //  echo "Node name:".$row["name"]."  " . "Parent name:" . "  " . getDirectParent ( $row["name"] );
   
}


echo json_encode( $arr );


function getDirectParent($nodeName) {

    require 'conn.php';
    $query="SELECT parent.name, node.lft - parent.lft as diff FROM nested_category AS node, nested_category AS parent WHERE (node.lft-parent.lft) % 2 <> 0 AND node.name='" .$nodeName . "' AND (node.lft - parent.lft) > 0 AND node.lft > parent.lft AND node.rgt < parent.rgt";

    $res = $link->query($query);
    $temp_diff =100;
    $temp_name = "";
    while ($row=mysqli_fetch_assoc($res)) {
        
        if( $row["diff"] < $temp_diff ) {
             
            $temp_diff = $row["diff"]; 
            $temp_name = $row["name"];
            
        }
      

    }

    return $temp_name;
    
}