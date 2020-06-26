<?php

session_start();

require 'vendor/autoload.php';

Flight::route('/', function(){
    Flight::render('index1.php');
});

Flight::route('/categories', function(){
    Flight::render('categories.php');
});

Flight::route('/newcategory', function(){
    Flight::render('newCategory.php');
});


Flight::route('/insertnewcategory', function(){
  
        include_once 'conn.php';
        $parent = $_POST['sel1'];

        $temp = "";

        $query = "SELECT node.name, node.rgt, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth, MIN(node.lft) FROM nested_category AS node, nested_category AS parent, nested_category AS sub_parent, ( SELECT node.name, (COUNT(parent.name) - 1) AS depth FROM nested_category AS node, nested_category AS parent WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.name = '".$parent."' GROUP BY node.name ORDER BY node.lft )AS sub_tree WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt AND sub_parent.name = sub_tree.name GROUP BY node.name HAVING depth = 1 AND MIN(node.lft) ORDER BY node.lft";
        $result = $link->query($query);

        if ( mysqli_num_rows($result) > 0 ) { 

                $temp = 0;
                $usedNode = "";

                while ($row = mysqli_fetch_assoc($result)) {
                      if ($row['rgt'] > $temp ) { $temp = $row['rgt']; $usedNode = $row['name'];}
                }

                          $query1= "LOCK TABLE nested_category WRITE;";
                $query1 = $query1. "SELECT @myRight := rgt FROM nested_category";
                $query1 = $query1. " WHERE name = '" . $usedNode . "';";
                $query1 = $query1. "UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight;";
                $query1 = $query1. "UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight;";
                $query1 = $query1. "INSERT INTO nested_category(name, lft, rgt) VALUES('".$_POST['catName']."', @myRight + 1, @myRight + 2);";
                $query1 = $query1. "UNLOCK TABLES;";

                $result1 = $link->multi_query($query1);

                if( $result1 ) {

                  $_SESSION["insertsuccess"]= "yes";
                  Flight::redirect('/newCategory');

                } 
                
        }        

        if ( mysqli_num_rows($result) == 0 ) {    

          $query2 = "LOCK TABLE nested_category WRITE;";
          $query2 = $query2."SELECT @myRight := rgt FROM nested_category WHERE name = '" . $parent . "';";
          $query2 = $query2."SELECT @myLeft := lft FROM nested_category WHERE name = '" . $parent . "';";
          $query2 = $query2."UPDATE nested_category SET rgt = rgt + 2 WHERE rgt >= @myRight;";
          $query2 = $query2."UPDATE nested_category SET lft = lft + 2 WHERE lft > @myLeft;";
          $query2 = $query2."INSERT INTO nested_category(name, lft, rgt) VALUES('" . $_POST['catName'] . "', @myRight, @myRight + 1 );";
          $query2 = $query2."UNLOCK TABLES;";
                
          try {
                  $con = mysqli_connect($config['host'],$config['dbuser'],$config['dbpass'],$config['db']);
                  $result2 = $link->multi_query($query2);

                  $_SESSION["insertsuccess"]= "yes";
                  Flight::redirect('/newCategory');

              } catch (Exception $e) {
                  $_SESSION["insertsuccess"]= "no";
              }          
         }
       
});

Flight::route('/deletecategory', function(){
  
    include_once 'conn.php';
    // $to_delete = ltrim($_POST['sel2'], 'g');
    // $to_delete
    // $to_delete = str_replace("›","",$_POST['sel2']);
    // $to_delete = str_replace("› ","", $_POST['delId']);

    // echo $to_delete;

    $query= "LOCK TABLE nested_category WRITE;";
    $query = $query. "SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1 FROM nested_category WHERE category_id = '". $_POST['delId'] ."';";
    $query = $query. " DELETE FROM nested_category WHERE lft BETWEEN @myLeft AND @myRight;";
    $query = $query. "UPDATE nested_category SET rgt = rgt - @myWidth WHERE rgt > @myRight;";
    $query = $query. "UPDATE nested_category SET lft = lft - @myWidth WHERE lft > @myRight;";
    $query = $query. "UNLOCK TABLES;";

    $myFile = "-----.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $stringData = $query;
        fwrite($fh, $stringData);

    $resultDel = $link->multi_query($query);

    if( $resultDel ) {

        $_SESSION["deletesuccess"]= "yes";
        Flight::redirect('/newCategory');

    } 

       
});

Flight::route('/managecategory', function(){
  
    include_once 'conn.php';
    $json =  json_decode ($_POST['manageCat'], true)  ;

    $query_update1 = "UPDATE nested_category SET lft = (case ";

    for ( $i=0; $i < count($json); $i++)  {
        $query_update1 =  $query_update1 . " when category_id = " . $json[$i]['id'] ." then " . $json[$i]['lft'];
    }

    $query_update1 = $query_update1 . " end);";


    $query_update2 =  "UPDATE nested_category SET rgt = (case ";

    for ( $i=0; $i < count($json); $i++)  {
        $query_update2 =  $query_update2 . " when category_id = " . $json[$i]['id'] ." then " . $json[$i]['rgt'];
    }

    $query_update2 = $query_update2 . " end);";

    $query_final= "LOCK TABLE nested_category WRITE;";
    $query_final= $query_final . $query_update1;
    $query_final= $query_final . $query_update2;
    $query_final= $query_final . "UNLOCK TABLES;";

    // echo $query_final;

    $resultManage = $link->multi_query($query_final);

    if( $resultManage ) {

        $_SESSION["managesuccess"]= "yes";
        Flight::redirect('/newCategory');

    } 

       
});

Flight::start();