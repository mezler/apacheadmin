<?php  

require 'conn.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.staticfile.org/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/5.13.0/css/fontawesome.min.css">
    
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <script src="//code.jquery.com/jquery.js"></script> -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script>

      $('document').ready(function(){


          $('.menu_item').click(function(){

            if ($(this).parent().find('ul').css( "display") == 'none') { 

                          
              $(this).parent().find('ul').show(500)
              //$(this).parent().find('ul').css( "display", "block")
          
            }
            else{
              //$(this).parent().find('ul').css( "display", "none")
              $(this).parent().find('ul').hide(500)
            }

          })


          $('.check').click(function(){

                  origDepth = $(this).parent().attr('data-depth')

                  el = $(this).parent()  
                 
                  bol = false
                  counter = 0
                  do {
                    if (el.hasClass('exportdiv')) { 
                     
                        if (  origDepth - el.prev().attr('data-depth') == 1  &&  el.prev().find('input[type=checkbox]').is(':checked')) {
                            bol = true 
                            break  
                            
                          } 

                        if (  origDepth - el.prev().attr('data-depth') == 1  &&  !el.prev().find('input[type=checkbox]').is(':checked')) {
                          bol = false 
                          break  
                          
                        }

                        el = el.prev()

                    }
                    else { break }
                  }
                  while ( !bol )



                  if ( bol ) { $(this).prop('checked', true) }


                  if ( !bol ) {

                    checkedOrNot = $(this).is(':checked') 
                    originalMrg = parseInt( $(this).parent().css("margin-left").replace("px",""), 10)
                    
                    recursive ( $(this), originalMrg )

                  }
                  
          })  
      
          recursive = ( el ) => {

              if ( !(el.parent().next().css("margin-left") === undefined) ) {

                marg = parseInt( el.parent().next().css("margin-left").replace("px",""), 10)
                
                if (marg > originalMrg) {                 
                    el.parent().next().find('.check').prop('checked', checkedOrNot);
                    recursive (el.parent().next().find('.check'))
                }

              }

          }

          // recursiveFindFirstBiggerDepthNode = ( el, origDepth ) => {

          //       if ( el.prev().hasClass('check') ) {

          //         depth =  parseInt( el.prev().attr('data-depth') )  
          //        // alert ("again" + "  " + depth + "  " + origDepth)
          //         if (origDepth > depth) {  return true  }
          //         else { return recursiveFindFirstBiggerDepthNode ( el.prev() )  }

          //       }

          //       if ( !el.prev().hasClass('check') ) { return false }

          // }





      })






    </script>

    <style>

.navbar-header svg {

  color:#fff;

}

.navbar .navbar-default {

  
}

.a1 li {  display: inline-block; line-height: 2;}
.a1 li a { color: #fff}

.nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
  background-color: #438eb9;
  border-color: #337ab7;
}

.dropdown-menu {

  background-color: #438eb9;

}

.nav-list {
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav-list>li {
    display: block;
    position: relative;
    float: none;
    padding: 0;
    border-style: solid;
    border-width: 1px 0 0;
    border-color: rgba(197,200,202,0.56);
}

.hsub .submenu {
  display:none;
}

.sidebar ul {
   list-style-type: none;
    padding-left: 0px;         
   }

   .sidebar ul li a {
   text-decoration: none;
   display: block;
   padding:10px;
  
   
   }
   .sidebar ul li {
      background-color: rgba(238,241,243,0.56);       
   }
   .sidebar ul li a svg:first-of-type:not(.fa-caret-right){
      min-width: 30px 
      }
   .sidebar ul li ul li a {
      margin-left: 20px;
   }
   .sidebar ul li ul li {

      border-top-width: 1px;
      border-top-style: dotted;
      border-top-color: rgba(197,200,202,0.56);

    }
    .sidebar ul li ul li:first-child {
      border:none;
    }

    .tab-content {           
        padding-bottom: 40px;
    }

    h3 {

        font-family: 'Open Sans', sans-serif;
        font-weight: 250;

    }

    .nav-tabs li.active a {

        background-color: #f6f7f8 !important;
        border-radius: 0 0 0 0;
        border-bottom-color: #ddd;

    }
    
    .nav-tabs li a {

      /* background-color: #f6f7f8 !important; */
      border-radius: 0 0 0 0;
      border-bottom-color: #ddd;
      border-top-color: #ddd;
      border-right-color: #ddd;
      border-left-color: #ddd;

      }

      .glyphicon-move {
          font-size: 12px;
      }

      .reorder { 

        float:right;
        margin-right: 5px;
        color: #438eb9;
        margin-top: 2px;
        cursor: pointer;
        
        }

        .sortdiv {

          padding-top: 5px;
          padding-bottom: 5px;
          padding-left:4px;
          background-color: #8f939536;
        }

        .exportdiv {

          padding-top: 5px;
          padding-bottom: 5px;
          padding-left:4px;
          background-color: #8f939536;
          }

        .glyphicon-remove {
          color: #c21313bf;
        }

        .reder { 
            background-color: #f5b4b4;
            transition: 1s;
        }

        .sui-button {

            float:left;

        }
/* 
        .reder { 
                  background-color: #f5b4b4;
                  transition: 1s;
              } */

</style>
    
</head>
<body>

        <?php            
          include $_SERVER['DOCUMENT_ROOT'] . "/layouts/navbar.php";
        ?>
        
        <div class="main-container">

          <div class=row>

            <?php
              include $_SERVER['DOCUMENT_ROOT'] . "/layouts/sidebar.php";
            ?>

            <div class="col-sm-10">

                  <div class="page-header" style="padding-bottom: 0; margin:0; color:#448abf">
                      <h3>Termék export</h3>
                  </div> 

                  <div style="margin-top:30px">

                      <div class="alert alert-warning" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px">
                      
                        <strong>Fontos!</strong> A kategóriák kijelölésénél, amennyiben szülőkategóriát jelöl ki, akkor a gyermekkategóriák mindegyike bekerül az exportba.
                      </div>

                      <div style="margin-top: 30px">
                       
                      </div>

                      <div id="fileupload" style = "margin-top: 30px;width: 35%;">

                          <div style = "margin-bottom:20px">

                            <h4>Válasszon kategórá(ka)t!</h4>

                          </div>

                          <form name="inzert" action="/productupload" method="post" enctype="multipart/form-data">
                                
                                <?php 
                                    
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

                                    $json = json_decode(json_encode($arr), true);
                                    for ($x = 0; $x < count($json); $x++) {
                        
                                      $marg = (int)$json[ $x ][0] * 15;
                                      echo "<div id='d". $json[ $x ][ 'category_id' ] ."'class='exportdiv check' data-depth=" . $json[ $x ][0] . " style='margin-top:5px; margin-left:" . $marg . "px'><i class='glyphicon glyphicon-menu-right' style='font-size: 8px; top: -2px;'></i>   ". $json[ $x ]['name'] ."<input id='". $json[ $x ]['category_id'] ."' data-depth=" . $json[ $x ][0] . " type='checkbox' class='form-check-input check' style='float:right; margin-right:5px'/></div>";
                                        
                                    }                                                                                                                                                                                                                                                                                             
                                                                    
                                ?>
                                <div style = "margin-top: 25px">
                                   <input type="submit" value="Letölt" id="download" >        

                                </div>
                                                      
                          </form>

                      </div>

                      

                      <!-- <div class="alert alert-success succesprodinsert" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px; width:60%;">
                        <strong>Sikeres termékimport!</strong>  
                      </div>

                      <div class="alert alert-success succesprodmod" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px; width:60%;">
                        <strong>Sikeres módosítás!</strong>  
                      </div>

                      <div class="alert alert-danger badxlsxfile" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px; width:60%;">
                        <strong>Hibás file!</strong> Ellenőrizze, hogy a csak számokat fogadó excel cellákban ( kat_id, garancia, EAN, Ar1, Ar2, Ar3, Ar4, csomag_db ) valóban számok szerepelnek-e, majd töltse fel újra a fájlt! 
                      </div>

                      <div class="alert alert-danger badmod" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px; width:60%;">
                        <strong>Hibás file!</strong> Ellenőrizze, hogy az 'id' mezők mindegyike kitöltött és, hogy létező értékeket tartalmaznak, ill., hogy a csak számokat fogadó excel cellákban ( kat_id, garancia, EAN, Ar1, Ar2, Ar3, Ar4, csomag_db )
                         valóban számok szerepelnek-e, majd töltse fel újra a fájlt! 
                      </div> -->
                      
                  </div>

              </div>

          </div>

        </div>


    
</body>
</html>