<?php

// if ($_SESSION["insertsuccess"]) 

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
    
    
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- <script src="//code.jquery.com/jquery.js"></script> -->
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- <script src=https://cdn.staticfile.org/Sortable/1.10.2/Sortable.min.js></script> -->

    <!-- ALERTIFY -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="/css/jquery.filer.css">
    <link rel="stylesheet" href="/css/jquery.filer-dragdropbox-theme.css">
    <script src="/js/jquery.filer.min.js"></script>

                          
    

    <script>

      $(document).ready(function(){

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

        

        $('.succesprodinsert').hide();
        $('.succesprodmod').hide();
        $('#progressbar').hide();
        $('#progressbar2').hide();
        $('.badxlsxfile').hide();
        $('.badmod').hide();

        $('#files').filer({

          showThumbs: true,

          limit: 1,

          captions: {
              button: "Fájl kijelölése",
              feedback: "Válassza ki a feltöltendő fájlt!",
              feedback2: "fájl lett kiválasztva",
              drop: "Drop file here to Upload",
              removeConfirmation: "Are you sure you want to remove this file?",
              errors: {
                  filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                  filesType: "Csak .xlsx formátumú fájlok tölthetők fel.",
                  filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-fileMaxSize}} MB.",
                  filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB.",
                  folderUpload: "You are not allowed to upload folders."
              }
          },

          extensions: ["xlsx"]

        })


        if(typeof(EventSource) !== "undefined") {
          
          var source = new EventSource("/progressbar");
          source.onmessage = function(event) {

            console.log ( event.data )
           
            if (event.data == "error") {
              $('.badxlsxfile').show();
              $('#progressbar').hide()
              $('#progressbar2').hide()
              source.close();
             
            }

            if (event.data == "badmod") {
              $('.badmod').show();
              $('#progressbar').hide()
              $('#progressbar2').hide()
              source.close();
             
            }

            if (event.data == "start") {
              $('.badxlsxfile').hide();
              $('.badmod').hide();
              $('#progressbar').show()
              //$('#progressbar2').show()

            }

            if (event.data == "modstart") {
              $('.badxlsxfile').hide();
              $('.badmod').hide();
              $('#progressbar').show()
              //$('#progressbar2').show()

            }
     
            console.log ( "event data : " + event.data )
            if (event.data == 123456789) {
              
              //source.close();
             

                  // var source2 = new EventSource("/progressbar");
                  // source2.onmessage = function(event) {

                    $('#progressbar2').show()

                    $('.pb2').css("width", "0%")

                      let pbwidth = 0

                      interval = setInterval( () => {

                        if ( pbwidth < 100 ) {

                          pbwidth = pbwidth + 10
                          $('.pb2').css("width", pbwidth + "%")

                        }
                        else 
                        {
                            clearInterval( interval )
                            $('.pb2').css("width", "100%")
                            $('.succesprodmod').show();
                        }

                      }, 300);


                      // if ( event.data == "end" ) {

                      //   clearInterval(interval)
                      //   source2.close();

                      // }

                  //  }

            }       
            else {

              if ( event.data < 100 || event.data == 100) {

                $('.progress-bar').css("width", event.data + "%")

              }

            }



            if (event.data == "database")  {

              $('#progressbar2').show()

            }

            if ( event.data == "end") {

              
              source.close();

            }
              
          }

        } 
                      
       
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

              .deldiv {

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
                      <h3>Termék import</h3>
                  </div> 

                  <div style="margin-top:30px">

                      <div class="alert alert-warning" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px">
                      
                        <strong>Fontos!</strong> Termékek importálása kizárólag a lenti linkről letölthető formátumban lehetséges.  </br> 
                        A mintaformátumban a piros fejléccel megjelölt mezők kitöltése ill. az oszlopok sorrendjének megváltoztatása rendellenes működéshez vezet! 
                        Termékek módosítása esetén az 'id' oszlopnak mindenütt tartalmaznia kell az adott termék 'id'-ját. Üres 'id' cella, vagy az adatbázisban nem szereplő 
                        'id' érték esetén a módosítás nem fut le!
                      </div>

                      <div>                        
                          <a href="/other/minta.xlsx">
                            <span class='glyphicon glyphicon-download-alt'></span> Excel mintafájl letöltése
                          </a>
                      </div>

                      <div style="margin-top: 30px">
                       
                      </div>

                      <div id="fileupload" style = "margin-top: 30px;width: 35%;">

                          <form name="inzert" action="/productupload" method="post" enctype="multipart/form-data">

                                <div class="form-check">
                                    <?php 
                                      if (isset( $_SESSION["insertormod"] )) {

                                       if ( $_SESSION["insertormod"] == "inzert" ) {
                                          echo '<input class="form-check-input" type="radio" name="inzertormod" id="inzert" value="inzert" checked>';
                                       }

                                       if ( $_SESSION["insertormod"] == "mod" ) {
                                        echo '<input class="form-check-input" type="radio" name="inzertormod" id="inzert" value="inzert">';
                                      }

                                    } else {
                                      echo '<input class="form-check-input" type="radio" name="inzertormod" id="inzert" value="inzert" checked>';
                                    }

                                    ?>
                                      
                                      <label class="form-check-label" for="inzert">
                                        Termék inzert
                                      </label>
                                </div>
                                <div class="form-check" style="margin-bottom:20px">

                                     <?php 
                                      if (isset( $_SESSION["insertormod"] )) {
                                       if ( $_SESSION["insertormod"] == "inzert" ) {
                                          echo '<input class="form-check-input" type="radio" name="inzertormod" id="mod" value="mod">';
                                       }

                                       if ( $_SESSION["insertormod"] == "mod" ) {
                                        echo '<input class="form-check-input" type="radio" name="inzertormod" id="mod" value="mod" checked>';
                                      }
                                    } else
                                    {    echo '<input class="form-check-input" type="radio" name="inzertormod" id="mod" value="mod">'; }

                                    ?>
                                      <label class="form-check-label" for="mod">
                                        Meglévő termékek módosítása
                                      </label>
                                </div>
                                <input type="file" name="files" id="files" multiple="multiple">
                                <input type="submit" value="Feltölt" id="upload">                              
                          </form>

                      </div>

                      <div id="progressbar" style="width: 60%; margin-top: 30px">
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar"
                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                              Feltöltés és adatellenőrzés...
                            </div>
                          </div>
                      </div>
                      <div id="progressbar2" style="width: 60%; margin-top: 20px">
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped active pb2" role="progressbar"
                            aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                              Beírás az adatbázisba...
                            </div>
                          </div>
                      </div>

                      <div class="alert alert-success succesprodinsert" style="padding:5px;margin-top:15px;margin-left: 0px;margin-right: 60px; width:60%;">
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
                      </div>
                      
                  </div>

              </div>

            </div>

          </div>

        </div>

    


    
</body>
</html>