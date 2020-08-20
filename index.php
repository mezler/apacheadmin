<?php

session_start();

ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

require 'vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT']."/vendor/spout-3.1.0/src/Spout/Autoloader/autoload.php";
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

Flight::route('/', function(){
    Flight::render('index1.php');
});

Flight::route('/categories', function(){
    Flight::render('categories.php');
});

Flight::route('/newcategory', function(){
    Flight::render('newCategory.php');
});

Flight::route('/setcategory', function(){
    Flight::render('setCategory.php');
});

Flight::route('/prodCategorySetting', function(){
    Flight::render('prodCategorySetting.php');
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
                                              
                $query1 = "LOCK TABLE nested_category WRITE;";
                $query2 = "SELECT @myRight := rgt FROM nested_category WHERE name = '" . $usedNode . "';";
                $query3 = "UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight;";
                $query4 = "UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight;";
                $query5 = "INSERT INTO nested_category(name, lft, rgt) VALUES('".$_POST['catName']."', @myRight + 1, @myRight + 2);";
                $query6 = "UNLOCK TABLES;";
                
                unset($_SESSION['insertsuccess']);
                mysqli_begin_transaction($link);
				 
				$link->query($query1);
                
				if( !$link->query($query2) ) {

				  $_SESSION["insertsuccess"] = "no";
                                 
                } 
                
                if( !$link->query($query3) ) {

				  $_SESSION["insertsuccess"] = "no";
                  
                } 
                
                if( !$link->query($query4) ) {

				  $_SESSION["insertsuccess"] = "no";
                  
                } 
                
                if( !$link->query($query5) ) {
                
				  $_SESSION["insertsuccess"] = "no";
                  
                }   
                
                if (  isset( $_SESSION["insertsuccess"] ) ) {

                    mysqli_rollback($link);
                    Flight::redirect('/newCategory');
                  
                } else {

                    $_SESSION["insertsuccess"] = "yes";
                    $link->query($query6);
                    mysqli_commit($link);
                    Flight::redirect('/newCategory');

                }

        } 


    if ( mysqli_num_rows($result) == 0 ) {    

          $query1 = "LOCK TABLE nested_category WRITE;";
          $query2 = "SELECT @myRight := rgt FROM nested_category WHERE name = '" . $parent . "';";
          $query3 = "SELECT @myLeft := lft FROM nested_category WHERE name = '" . $parent . "';";
          $query4 = "UPDATE nested_category SET rgt = rgt + 2 WHERE rgt >= @myRight;";
          $query5 = "UPDATE nested_category SET lft = lft + 2 WHERE lft > @myLeft;";
          $query6 = "INSERT INTO nested_category(name, lft, rgt) VALUES('" . $_POST['catName'] . "', @myRight, @myRight + 1 );";
          $query7 = "UNLOCK TABLES;";
          
          unset($_SESSION['insertsuccess']);
          mysqli_begin_transaction($link);
          
          $link->query($query1);
                
			if( !$link->query($query2) ) {

			  $_SESSION["insertsuccess"] = "no";
						 
			} 
		
			if( !$link->query($query3) ) {

			  $_SESSION["insertsuccess"] = "no";
		  
			} 
		
			if( !$link->query($query4) ) {

			  $_SESSION["insertsuccess"] = "no";
		  
			} 
		
			if( !$link->query($query5) ) {
		
			  $_SESSION["insertsuccess"] = "no";
		  
			} 
			
			if( !$link->query($query6) ) {
		
			  $_SESSION["insertsuccess"] = "no";
		  
            } 

            if (  isset( $_SESSION["insertsuccess"] ) ) {

                mysqli_rollback($link);
                Flight::redirect('/newCategory');
              
            } else {

                $_SESSION["insertsuccess"] = "yes";
                $link->query($query7);
                mysqli_commit($link);
                Flight::redirect('/newCategory');

            }

                  
        }
       
});


Flight::route('/deletecategory', function(){
  
    include_once 'conn.php';

    $query= "LOCK TABLE nested_category WRITE;";
    $query = $query. "SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1 FROM nested_category WHERE category_id = '". $_POST['delId'] ."';";
    $query = $query. " DELETE FROM nested_category WHERE lft BETWEEN @myLeft AND @myRight;";
    $query = $query. "UPDATE nested_category SET rgt = rgt - @myWidth WHERE rgt > @myRight;";
    $query = $query. "UPDATE nested_category SET lft = lft - @myWidth WHERE lft > @myRight;";
    $query = $query. "UNLOCK TABLES;";

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


Flight::route('/productimport', function(){
    Flight::render('productimport.php');    
});

Flight::route('/productexport', function(){
    Flight::render('productexport.php');    
});

// Flight::route('/productimport1', function(){
//     Flight::render('productimport1.php');    
// });

//Flight::render('sidebar', 'sidebar_content');


Flight::route('/productupload', function(){

    // header('Content-Type: text/event-stream');
    // header('Cache-Control: no-cache');

         $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
        foreach($files as $file){ 
        if(is_file($file))
            unlink($file); 
        }

        if (  isset( $_POST['inzertormod'] ) ) {

            $_SESSION["insertormod"]= $_POST['inzertormod'];

        }
               

        if(isset($_FILES['files'])){

            $file_name = $_FILES['files']['name'];
            $file_size =$_FILES['files']['size'];       
            
            if( empty($errors) == true ){
               
               $dateTime = new \DateTime();
    
               move_uploaded_file( $_FILES["files"]["tmp_name"],  $_SERVER['DOCUMENT_ROOT'] . '/uploaded/' . "termeklista" . $dateTime->format('Y-m-d H:i:s') . ".xlsx"  );

            } 
         }

        Flight::redirect('/productimport');
      
});


Flight::route('/progressbar', function(){

  
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        include_once 'conn.php';

        $arr=[];
        $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/termeklista*.xlsx');
        $filecount = count($files);
        foreach($files as $file) {
            $name = $file; 
        }

        if ( $filecount != 1 ) {

            if (ob_get_level() == 0) ob_start();
            echo "data: nofile\n\n";
            echo str_pad('',4096)."\n"; 
            ob_flush();
            flush();

            exit;
        
        } 

        $reader = ReaderEntityFactory::createReaderFromFile($name);
        $reader2 = ReaderEntityFactory::createReaderFromFile($name);

            if ( $filecount == 1 && $reader && $reader2 ) {

                if (ob_get_level() == 0) ob_start();
                echo "data: start\n\n";
                echo str_pad('',4096)."\n"; 
                ob_flush();
                flush();

            }

            $counter = 0;
            $reader->open($name);

            if (ob_get_level() == 0) ob_start();

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $counter++;
                }
            }

            $counter--;

            unset ( $reader ); 

            $counter2 = 0;
            $d = 0;
            $errors=[];
            $reader2->open($name);


       if ($_SESSION["insertormod"] == "inzert")  {


                foreach ($reader2->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                        //error_log ("rownumber". "   " . $rowNumber );
                        if($rowNumber == 1){
                            continue;
                        }
                            
                        $counter2++;
                        $cells = $row->getCells();

                        if ( !preg_match( '/^[0-9]*$/', $cells[0]->getValue()) or !preg_match( '/^[0-9]*$/', $cells[2]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[7]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[8]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[11]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[12]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[13]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[14]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[16]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[17]->getValue() )  ) {
                            
                            $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                            foreach($files as $file){ 
                            if(is_file($file))
                                unlink($file); 
                            }

                            echo "data: error\n\n";
                            echo str_pad('',4096)."\n"; 
                            ob_flush();
                            flush();

                        }
                            
                        $d=(100/$counter)*$counter2;
                        echo "data: {$d}\n\n";
                        echo str_pad('',4096)."\n";   
                        ob_flush();
                        flush();

                        array_push($arr,[$cells[0]->getValue(),$cells[1]->getValue(),$cells[2]->getValue(),$cells[3]->getValue(),$cells[4]->getValue(),$cells[5]->getValue(),$cells[6]->getValue(),$cells[7]->getValue(),$cells[8]->getValue(),$cells[9]->getValue(),$cells[10]->getValue(),$cells[11]->getValue(),$cells[12]->getValue(),$cells[13]->getValue(),$cells[14]->getValue(), $cells[15]->getValue(), $cells[16]->getValue(), $cells[17]->getValue(),$cells[18]->getValue(),$cells[19]->getValue()]);
                        
                        if ( $counter2 == $counter) {

                            echo "data: 123456789\n\n";
                            echo str_pad('',4096)."\n"; 
                            ob_flush();
                            flush();

                            $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                            foreach($files as $file){ 
                            if(is_file($file))
                                unlink($file); 
                            }
                        }
                        
                    }

                    // **************   ADATBÁZIS INZERT ****************

                    echo "data: database\n\n";
                    echo str_pad('',4096)."\n"; 
                    ob_flush();
                    flush();
                    
                    $qy = "INSERT INTO `Products`(`cikkSzam`, `kat_id`, `Brand`, `Termeknev`, `Megnevezes`, `Leiras`, `Garancia`, `EAN`, `kepURL`, `kisKepURL`, `Ar1`, `Ar2`, `Ar3`, `Ar4`, `Beszallito`, `Aktiv`, `Raktarkeszlet`, `InzertDatum`, `csomag_db`) VALUES ";  

                    foreach( $arr as $row ) {

                    $qy = $qy . "('$row[1]',$row[2],'$row[3]','$row[4]','$row[5]','$row[6]',$row[7],$row[8],'$row[9]','$row[10]',$row[11],$row[12],$row[13],$row[14],'$row[15]',$row[16],$row[17], NOW(), $row[19]),";

                    }
                
                    $qy = substr($qy, 0, -1);

                    $insertresult = $link->query($qy);

                    if ( $insertresult ) {

                        error_log ( "end inzert");

                        echo "data: end\n\n";
                        echo str_pad('',4096)."\n"; 
                        ob_flush();
                        flush(); 

                    }   

                // **************   ADATBÁZIS INZERT ****************

       }   

    }


    if ($_SESSION["insertormod"] == "mod")  {


        echo "data: modstart";
                        echo str_pad('',4096)."\n";   
                        ob_flush();
                        flush();


        foreach ($reader2->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $rowNumber => $row) {
                //error_log ("rownumber". "   " . $rowNumber );
                if($rowNumber == 1){
                    continue;
                }
                    
                $counter2++;
                $cells = $row->getCells();

                if ( !preg_match( '/^[0-9]*$/', $cells[0]->getValue()) or !preg_match( '/^[0-9]*$/', $cells[2]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[7]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[8]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[11]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[12]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[13]->getValue() )  or !preg_match( '/^[0-9]*$/', $cells[14]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[16]->getValue() ) or !preg_match( '/^[0-9]*$/', $cells[17]->getValue()) or $cells[0]->getValue() == ""  ) {

                    error_log ( "id oszlop érték   : " . $cells[0]->getValue() );
                    
                    $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                    foreach($files as $file){ 
                    if(is_file($file))
                        unlink($file); 
                    }

                    echo "data: error\n\n";
                    echo str_pad('',4096)."\n"; 
                    ob_flush();
                    flush();

                }

                $d=(100/$counter)*$counter2;
                        echo "data: {$d}\n\n";
                        echo str_pad('',4096)."\n";   
                        ob_flush();
                        flush();

                    
                array_push($arr,[$cells[0]->getValue(),$cells[1]->getValue(),$cells[2]->getValue(),$cells[3]->getValue(),$cells[4]->getValue(),$cells[5]->getValue(),$cells[6]->getValue(),$cells[7]->getValue(),$cells[8]->getValue(),$cells[9]->getValue(),$cells[10]->getValue(),$cells[11]->getValue(),$cells[12]->getValue(),$cells[13]->getValue(),$cells[14]->getValue(), $cells[15]->getValue(), $cells[16]->getValue(), $cells[17]->getValue(),$cells[18]->getValue(),$cells[19]->getValue()]);
                
                if ( $counter2 == $counter) {

                    echo "data: 123456789\n\n";
                    echo str_pad('',4096)."\n"; 
                    ob_flush();
                    flush();

                    $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                    foreach($files as $file){ 
                    if(is_file($file))
                        unlink($file); 
                    }
                }
                 
            }
         }




            // **************   ADATBÁZIS MÓDOSÍTÁS ****************

            echo "data: database\n\n";
            echo str_pad('',4096)."\n"; 
            ob_flush();
            flush();

            $counter2 = 0;

            foreach( $arr as $row ) {


                $qy = "UPDATE `Products` SET `cikkSzam`='$row[1]',`kat_id`=$row[2],`Brand`='$row[3]',`Termeknev`='$row[4]',`Megnevezes`='$row[5]',`Leiras`='$row[6]',`Garancia`=$row[7],`EAN`=$row[8],`kepURL`='$row[9]',`kisKepURL`='$row[10]',`Ar1`=$row[11],`Ar2`=$row[12],`Ar3`=$row[13],`Ar4`=$row[14],`Beszallito`='$row[15]',`Aktiv`=$row[16],`Raktarkeszlet`=$row[17],`csomag_db`=$row[19] WHERE id =" . $row[0] .";";

                $counter2++;
                error_log ( "counter2 érték : " . $counter2 . "counter érték : " . $counter );

                error_log ( $qy );

                $modresult = $link->query($qy);

                
                //error_log( "aff rows : " . mysqli_affected_rows($link)  );

                if ( mysqli_affected_rows($link) == -1 ) {

                    error_log ( "hibasor : " . $counter2  );

                    echo "data: badmod\n\n";
                    echo str_pad('',4096)."\n";   
                    ob_flush();
                    flush();

                    $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                    foreach($files as $file){ 
                    if(is_file($file))
                        unlink($file); 
                    }

                } 


                if ( mysqli_affected_rows($link) > 0 ) {

                    $d1=(100/$counter)*$counter2;
                    echo "data: {$d1}\n\n";
                    echo str_pad('',4096)."\n";   
                    ob_flush();
                    flush();

                }  

                if ( $counter2 == $counter) {

                    echo "data: 123456789\n\n";
                    echo str_pad('',4096)."\n"; 
                    ob_flush();
                    flush();

                    $files = glob($_SERVER['DOCUMENT_ROOT'].'/uploaded/*'); 
                    foreach($files as $file){ 
                    if(is_file($file))
                        unlink($file); 
                    }
                }  

                 
        
            // $qy = substr($qy, 0, -1);

           

        // **************   ADATBÁZIS MÓDOSÍTÁS ****************



        }
    
    }


        ob_end_flush();
        $reader->close();
        $reader2->close();

        unset( $_SESSION["insertormod"] );

});

Flight::start();