<?php  

require 'conn.php';

// echo $_POST["sel1"];

$arr=[];
$jsondata ="";
$temp = "";

// $query = "SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth, MIN(node.lft) FROM nested_category AS node, nested_category AS parent, nested_category AS sub_parent, ( SELECT node.name, (COUNT(parent.name) - 1) AS depth FROM nested_category AS node, nested_category AS parent WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.name = 'PORTABLE ELECTRONICS' GROUP BY node.name ORDER BY node.lft )AS sub_tree WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt AND sub_parent.name = sub_tree.name GROUP BY node.name HAVING depth = 1 AND MIN(node.lft) ORDER BY node.lft";
// $result = $link->query($query);

// while ($row = mysqli_fetch_assoc($result)) {

//     if(getDirectParent ( $row["name"] )) {}


// }