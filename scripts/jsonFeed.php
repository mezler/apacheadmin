<?php
        header('Access-Control-Allow-Origin: *');
        require '../conn.php';
        $arr = [];
        $query = "SELECT name, category_id, lft, rgt FROM `nested_category` WHERE `category_id` in (SELECT `category_id` FROM nested_category WHERE 1) ORDER BY lft;";
        $result = $link->query($query);

        while ($row = mysqli_fetch_assoc($result)){
        
            $query2 = "SELECT node.name, (COUNT(parent.name) - 1) AS depth ";
            $query2 = $query2 . "FROM nested_category AS node, ";
            $query2 = $query2 . "nested_category AS parent ";
            $query2 = $query2 . "WHERE node.lft BETWEEN parent.lft AND parent.rgt ";
            $query2 = $query2 . "AND node.category_id = '" . $row['category_id'] . "';";

            $result2 = $link->query($query2);

            $row1 = mysqli_fetch_assoc($result2);

            array_push(  $row, $row1['depth'] );

            array_push($arr,$row);

        }

        $json = json_encode(($arr), true);
        echo $json;
        // for ($x = 0; $x < count($json); $x++) {

        //     $marg = (int)$json[ $x ][0] * 15;
        //     echo "<div id='d". $json[ $x ][ 'category_id' ] ."'class='exportdiv check' data-depth=" . $json[ $x ][0] . " style='margin-top:5px; margin-left:" . $marg . "px'><i class='glyphicon glyphicon-menu-right' style='font-size: 8px; top: -2px;'></i>   ". $json[ $x ]['name'] ."<input id='". $json[ $x ]['category_id'] ."' data-depth=" . $json[ $x ][0] . " type='checkbox' class='form-check-input check' style='float:right; margin-right:5px'/></div>";
            
        // }  