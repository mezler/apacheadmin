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
    
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src=https://cdn.staticfile.org/Sortable/1.10.2/Sortable.min.js></script>

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

    <!-- <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css"> -->

    <script>

      $('document').ready(function(){

        // $("a[href$='#managecat']").click(function(){
        //       let i = 0
        //       $('.sortdiv').each(function(){
                          
        //                   if ( i != 0 ) {
      
        //                       actual = parseInt( $(this).css("margin-left").replace("px",""), 10)
        //                       prev = parseInt( $(this).prev().css("margin-left").replace("px",""), 10)
      
        //                       if ( prev < actual) {                      
        //                       $(this).css("margin-left", prev + 15 + "px")
        //                     }
        //                   }
        //                   i++
        //     })

        // })


        $('.reorder.forth').click(function(){

              if (  parseInt( $(this).parent().css("margin-left").replace("px",""), 10) - parseInt( $(this).parent().prev().css("margin-left").replace("px",""), 10)  == 15 )
              {   
                alertify.alert("A közvetlen szűlőkategória és a módostandó kategória között nem lehet már nagyobb távolság. Ez a módosítás nem hajtható végre.", function(){
                         //alertify.message('OK');
                      }).set({title:"Helytelen módosítási kísérlet!"}).set({labels:{ok:'Forward', cancel: 'Backward'}});
              }
              else
              {

                  origmrg =   parseInt( $(this).parent().css("margin-left").replace("px",""), 10) 
                  custmrg =  origmrg + 15
                  $(this).parent().css("margin-left", custmrg + "px")

              }

              

        })

        $('.reorder.back').click(function(){

              origmrg =   parseInt( $(this).parent().css("margin-left").replace("px",""), 10) 
              custmrg =  origmrg - 15
              $(this).parent().css("margin-left", custmrg + "px")

        })


        let leftWall = 0

          let depth = 0

        new Sortable(draganddrop, {

              animation: 150,
              ghostClass: 'blue-background-class',
          onMove: function ( evt, originalEvent) {

              // depth = $(evt.related).css("margin-left")

              // $(evt.dragged).css( "margin-left", depth )

           },

          onStart: function (evt) {
            
            },
            
          onEnd: function (evt) {

                let i = 0
                $('.sortdiv').each(function(){
                      
                   if ( i != 0 ) {

                       actual = parseInt( $(this).css("margin-left").replace("px",""), 10)
                       prev = parseInt( $(this).prev().css("margin-left").replace("px",""), 10)

                       if ( prev < actual) {                      
                        $(this).css("margin-left", prev + 15 + "px")
                      }
                   }
                   i++
                })  

              }
          });

          
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

          $('#ment').click(function(){

            $('.alert-dismissible').remove();

            if( $('#catName').val() == "") { 
              
                  $('#insertform').append(             
                  "<div class='alert alert-warning alert-dismissible show' role='alert'>" +
                  "<strong>A kategória neve nem lehet üres!</strong>" +
                  "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                  "<span aria-hidden='true'>&times;</span>" +
                  "</button>" +
                  "</div>")
              
           }

            if ( $('#sel1').find(":selected").text() == "-- válasszon szülőkategóriát --") {

                  $('#insertform').append(             
                  "<div class='alert alert-warning alert-dismissible show' role='alert'>" +
                  "<strong>Válasszon szülőkategóriát!</strong>" +
                  "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                  "<span aria-hidden='true'>&times;</span>" +
                  "</button>" +
                  "</div>")
            }

            if (  $('#catName').val() != "" && $('#sel1').find(":selected").text() != "-- válasszon szülőkategóriát --")
            {

                  $('#categoryform').submit();

            }

           

          })

          $('.delbutton').click(function(){

            $('.alert-dismissible').remove();
            $('#deleteform').submit();

          })

          $('.delbutton').mouseenter(function(){

            $('input[name="delId"]').val($(this).attr('id'))

          })

          $('.deldiv').mouseenter(function(){
                  
            originalMrg = parseInt( $(this).css("margin-left").replace("px",""), 10)
            $(this).addClass("reder")
            recursive ( $(this), originalMrg )

          })  

          recursive = ( el ) => {

            if ( !(el.next().css("margin-left") === undefined) ) {
              marg = parseInt( el.next().css("margin-left").replace("px",""), 10)
              if (marg > originalMrg) { 
                  el.next().addClass("reder")
                  recursive (el.next())
              }
            }

          }

          
          recursive2 = ( k, el, orig ) => {

            console.log ( k )
            let b = k
            
            console.log ( " id : " + el.attr("id") +  " b  fent : " + b  )
            if ( el.next().hasClass("sortdiv") ) {
              
                marg = parseInt( el.next().css("margin-left").replace("px",""), 10 )
                
                if ( marg > orig ) { 
                    b = b + 1
                    recursive2 (b, el.next(), orig )
                }
                               
            } 
            console.log ( " id : " + el.attr("id") +  " b  lent : " + b )
            return b

          }

          // ChildrenNo = ( k, el ) => {
          //         origMargin = parseInt(  el.css('margin-left').replace('px',"") )
          //         if ( el.next().hasClass('sortdiv')  ) {
                 
          //          if( !( el.next().css('margin-left')  === undefined) )  {
                    
          //             if (  parseInt(  el.next().css('margin-left').replace('px',"") ) > origMargin ) {
          //               k++    
                                   
          //               return ChildrenNo ( k, el.next() )
          //             }
          //           } 
          //         }                  
          //         return k 
          //   }

            ChildrenNo = ( k, el, origMargin ) => {
                  // origMargin = parseInt(  el1.css('margin-left').replace('px',"") )
                  if ( el.next().hasClass('sortdiv')  ) {
                 
                   if( !( el.next().css('margin-left')  === undefined) )  {
                    
                      if (  parseInt(  el.next().css('margin-left').replace('px',"") ) > origMargin ) {
                        console.log(el.text())
                        k++    
                                   
                        return ChildrenNo ( k, el.next(), origMargin )
                      }
                    } 
                  }                  
                  return k 
            }

         

         




          $('.deldiv').mouseleave(function(){

              $('.deldiv').removeClass("reder")
                     
          })  

          $('#management').click(function(){
           
              let arr = []
              let obj = {}
              let lft = 0
              let rgt = 0
            
              obj = {}
  

              $('.sortdiv').each( function(){

                  origMargin = parseInt(  $(this).css('margin-left').replace('px',"") )
                 
                  let p = ChildrenNo( 0, $(this), origMargin  )

                  $(this).attr('data-noofchilds',  p )
                  
                  id = $(this).attr('id')

                  let noOfChildren = $(this).attr('data-noofchilds')

                  let orig = parseInt( $(this).css("margin-left").replace("px",""), 10 )


                  if( !($(this).prev().css("margin-left") === undefined) && $(this).prev().hasClass('sortdiv') ) {
                     
                      if( parseInt(  $(this).prev().css('margin-left').replace('px',"") ) <  orig  ) {
                          lft++
                          rgt = lft + noOfChildren * 2 + 1
                      }
                      if( parseInt(  $(this).prev().css('margin-left').replace('px',"") ) ==  orig ) {
                          lft = lft + 2
                          rgt = lft + noOfChildren * 2 + 1
                      }
                      if( parseInt(  $(this).prev().css('margin-left').replace('px',"") ) >  orig  ) {                        
                          //  lft = lft + 1 + ( (parseInt(  $(this).css('margin-left').replace('px',"") ) - $(this).next().css('margin-left').replace('px',"")) / 15 )

                          diff =  ((parseInt($(this).prev().css('margin-left').replace('px',"")) - parseInt($(this).css('margin-left').replace('px',""))) / 15)
                          lft = lft + diff * 2 - ( diff - 2 )
                          rgt = lft + noOfChildren * 2 + 1


                          // switch ( diff ) {

                          //       case 2:
                          //           lft = lft + diff * 2
                          //           rgt = lft + noOfChildren * 2 + 1
                          //           break;
                          //       case 3:
                          //           lft = lft + diff * 2 - 1
                          //           rgt = lft + noOfChildren * 2 + 1
                          //           break;
                          //       case 4:
                          //           lft = lft + diff * 2 - 2
                          //           rgt = lft + noOfChildren * 2 + 1
                          //           break;    
                          //   }
                      
                        }

                      obj.lft = lft
                      obj.rgt = rgt
                      obj.id = id
                      arr.push ( obj )
                      obj = {}

                  }
                  else
                  {

                      lft = 1
                      rgt = lft + noOfChildren * 2 + 1

                      obj.lft = lft
                      obj.rgt = rgt
                      obj.id = id
                      arr.push ( obj )
                      obj = {}



                  }

                  // console.log ( "--------------------------"  )

              })
                  
                  $('input[name="manageCat"]').val( JSON.stringify(arr) )
                  
                  
                  console.log ( JSON.stringify(arr) )
                 // console.log( f[0]['rgt'] ) 
                  $('#manageform').submit()

         
          })
      
     
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

    </style>
    
</head>
<body>
        <div class="navbar navbar-default" id="navbar" style="background: #438eb9; color:#fff">
      
          
              <button id="menu-toggler" class="navbar-toggle menu-toggler pull-left" type="button">
              <span class="sr-only">Toggle sidebar</span>
        
              <span class="fa fa-bars" style="font-size:1.4em;"></span>
              </button>
        
              <div class="navbar-header pull-left">
              <a class="navbar-brand lighter" href="" target="_blank" title="preview">
                <i class="ace-icon fa fa-cubes" ></i>
                  <small style="color:#fff; font-family: 'Open Sans';">Smartcorner</small>
              </a>
              </div>
        
              <div role="navigation" class="navbar-buttons navbar-header pull-right">
              <ul class="nav a1">
                <li class="grey" style="display:none">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ace-icon fa fa-tasks"></i>
                    <span class="badge badge-grey">4</span>
                  </a>
      
              <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                  <li class="dropdown-header">
                    <i class="ace-icon fa fa-check"></i>
                    4 Tasks to complete
                  </li>
          
                  
          
                  <li class="dropdown-footer">
                    <a href="#">
                      See tasks with details
                      <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                  </li>
               </ul>
              </li>
      
              <li class="purple" style="display:none">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ace-icon fa fa-bell fa fa-animated-bell"></i>
                <span class="badge badge-important">8</span>
              </a>
      
              <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
              <li class="dropdown-header">
                <i class="ace-icon fa fa-exclamation-triangle"></i>
                8 Notifications
              </li>
      
              <li>
                <a href="#">
                  <div class="clearfix">
                                                  <span class="pull-left">
                                                      <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                      New Comments
                                                  </span>
                    <span class="pull-right badge badge-info">+12</span>
                  </div>
                </a>
              </li>
      
              <li>
                <a href="#">
                  <i class="btn btn-xs btn-primary fa fa-user"></i>
                  Bob just signed up as an editor ...
                </a>
              </li>
      
              <li>
                <a href="#">
                  <div class="clearfix">
                                                  <span class="pull-left">
                                                      <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                      New Orders
                                                  </span>
                    <span class="pull-right badge badge-success">+8</span>
                  </div>
                </a>
              </li>
      
              <li>
                <a href="#">
                  <div class="clearfix">
                                                  <span class="pull-left">
                                                      <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                      Followers
                                                  </span>
                    <span class="pull-right badge badge-info">+11</span>
                  </div>
                </a>
              </li>
      
              <li class="dropdown-footer">
                <a href="#">
                  See all notifications
                  <i class="ace-icon fa fa-arrow-right"></i>
                </a>
              </li>
              </ul>
              </li>
        
              <li class="green" style="display:none">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ace-icon fa fa-envelope fa fa-animated-vertical"></i>
                <span class="badge badge-success">5</span>
              </a>
        
              
              </li>
        
              <li class="btn-group" id="notification-button" data-last-known-update="1591999546">
              <!--a href="#" class="dropdown-toggle" data-toggle="dropdown"-->
              <a href="#" style="background: #1c4c68;">
                <i class="ace-icon fa fa-bell fa fa-animated-bell"></i>
              </a>
          
            
              </li>
        
        
              <li class="grey">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                Smartcorner
                (Account manager)
        
                <i class="ace-icon fa fa-caret-down"></i>
              </a>
        
              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li style="display:none">
                  <a href="#">
                    <i class="ace-icon fa fa-cog"></i>
                    Settings
                  </a>
                </li>
        
                <li>
                  <a href="/profiles">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                  </a>
                </li>
        
                <li>
                  <a href="/users/edit">
                    <i class="ace-icon fa fa-key"></i> Edit password
                  </a>
                </li>
        
                <li class="divider"></li>
        
                <li>
                  <a href="/users/sign_out"><i class="ace-icon fa fa-power-off"></i> Logout</a>
                </li>
              </ul>
              </li>
              </ul>
              </div>
            
          <!-- /.navbar-container -->
        </div>
        
        <div class="main-container">

          <div class=row>

              <div class="sidebar responsive col-sm-2" id="sidebar">
                <ul class="nav nav-list" style="top: 0px;">
                  <li>
                    <a href="/dashboard">
                      <i class="menu-icon fa fa-tachometer"></i>
                      <span class="menu-text"> Dashboard </span>
                    </a>
              
                    <b class="arrow"></b>
                  </li>
              
                  <li class="">
                    <a href="/orders">
                      <i class="menu-icon fa fa-file"></i>
                      <span class="menu-text"> Orders </span>
                    </a>
                    </li>
              
                  
              
              
                  <li class="active">
                    <a href="/admin/customers">
                      <i class="menu-icon fa fa-users"></i>
                      <span class="menu-text"> Customers </span>
                    </a>
                    </li>
              
              
                  <li class="hsub">
              
                    <a class="dropdown-toggle menu_item" href="#">
                      <i class="menu-icon fa fa-tag" style="min-width:30px"></i>
                      <span class="menu-text"> Products </span>
                      <b class="arrow fa fa-angle-down"></b>
                    </a>
              
                    <b class="arrow"></b>
                    <ul class="submenu">
                      <li class="">
                    <a href="/products">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Products </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/pricelists">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Price Lists </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/options">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Options </span>
                    </a>
                    </li>
                          <li class="">
                    <a href="/admin/manufacturers">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Brands </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/productimport">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Termék import </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/products/export">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Export </span>
                    </a>
                    </li>
                      
                    </ul>
                  </li>
              
                  <li class="">
                    <a href="categories.php">
                      <i class="menu-icon fa fa-folder"></i>
                      <span class="menu-text"> Product Categories </span>
                    </a>
                    </li>
              
              
                  <li class="hsub">
                    <a class="dropdown-toggle menu_item" href="#">
                      <i class="menu-icon fa fa-wrench"></i>
                      <span class="menu-text"> Tools </span>
              
                      <b class="arrow fa fa-angle-down"></b>
                    </a>
              
                    <b class="arrow"></b>
              
                    <ul class="submenu">
                      <li class="">
                    <a href="/catalogs">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> PDF Catalog </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/product_customer_prices/import">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import Customer Prices </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/customers/import">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import Customers </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/product_discounts/import">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import Product Discounts </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/product_variants/import">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import Product Variants </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/orders/import_past_orders">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import Orders </span>
                    </a>
                    </li>
              
                      <li class="">
                    <a href="/admin/log_imports">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Imports log </span>
                    </a>
                    </li>
                    </ul>
                  </li>
              
                  <li class="">
                    <a href="/admin/banners">
                      <i class="menu-icon fa fa-picture-o"></i>
                      <span class="menu-text"> Banners </span>
                    </a>
                    </li>
                  <li class="">
                    <a href="/admin/news">
                      <i class="menu-icon fa fa-pencil"></i>
                      <span class="menu-text"> News </span>
                    </a>
                    </li>
              
                  <li class="">
                    <a href="/admin/pages">
                      <i class="menu-icon fa fa-edit"></i>
                      <span class="menu-text"> Pages </span>
                    </a>
                    </li>
                  <li class="">
                    <a href="/admin/sales_reps">
                      <i class="menu-icon fa fa-suitcase"></i>
                      <span class="menu-text"> Sales Reps </span>
                    </a>
                    </li>
                           
                  <li class="hsub">
                    <a class="dropdown-toggle menu_item" href="#">
                      <i class="menu-icon fa fa-line-chart"></i>
                      <span class="menu-text"> Reports </span>
                      <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
              
                    <ul class="submenu">
                      <li class="">
                    <a href="/admin/reports/sales_reps_performance">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Sales reps performance </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/customers_performance">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Customers performance </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/orders_per_month">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Orders per month </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/product_sales">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Product Sales </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/product_order_status">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Products by order status </span>
                    </a>
                    </li>
                        <li class="">
                    <a href="/admin/reports/inventory_control">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Inventory control </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/sales_per_category_per_month">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Sales per category per month </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/reports/sales_per_product_per_month">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Sales per product per month </span>
                    </a>
                    </li>
                    </ul>
                  </li>
              
                  <li class="hsub">
                    <a class="dropdown-toggle" href="#">
                      <i class="menu-icon fa fa-gears"></i>
                      <span class="menu-text"> Settings </span>
              
                      <b class="arrow fa fa-angle-down"></b>
                    </a>
              
                    <b class="arrow"></b>
              
                    <ul class="submenu">
                      <li class="">
                    <a href="/profiles">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Profile </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/payment_ways">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Payment options </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/shipping_options">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Shipping options </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/users/edit">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Edit password </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/status_orders">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Order Statuses </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/status_products">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Product Statuses </span>
                    </a>
                    </li>
              
                      <li class="">
                    <a href="/admin/privacy_groups">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Privacy groups </span>
                    </a>
                    </li>
              
                      <li class="">
                    <a href="/admin/coupons">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Coupons </span>
                    </a>
                    </li>
              
                      <li class="">
                    <a href="/admin/vat_rules">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> VAT </span>
                    </a>
                    </li>
                      <li class="">
                    <a href="/admin/measurement_units">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Measurement unit </span>
                    </a>
                    </li>
              
                      <li class="">
                    <a href="/admin/company_activities">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Company activities </span>
                    </a>
                    </li>
              
              
                          <li class="">
                    <a href="/admin/users">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Users </span>
                    </a>
                    </li>
              
                          <li class="">
                    <a href="/admin/email_templates">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Email Templates </span>
                    </a>
                    </li>
              
              
              
                      
              
                    </ul>
                  </li>
              
                </ul>


              </div>

              <div class="col-sm-10">

                  <div class="page-header" style="padding-bottom: 0; margin:0; color:#448abf">
                      <h3>Termék kategóriák</h3>
                  </div> 

              
                  <div style="margin-top:30px">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#newcat" aria-controls="newcat" role="tab" data-toggle="tab">Új kategória</a></li>
                      <li role="presentation"><a href="#deletecat" aria-controls="deletecat" role="tab" data-toggle="tab">Kategória törlés</a></li>
                      <li role="presentation"><a href="#managecat" aria-controls="managecat" role="tab" data-toggle="tab">Kategória hierarchia beállítás</a></li>
                    
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                      <div role="tabpanel" class="tab-pane active" id="newcat">

                          <div style="border-left: 1px solid #d9d7d7;border-right: 1px solid #d9d7d7; border-bottom: 1px solid #d9d7d7;">
                            <div class="row" style="padding-top:40px; padding-left:20px; padding-bottom: 40px" >
                                <div class="col-sm-4" id="insertform">   

                                        <?php 

                                              if ( isset($_SESSION["insertsuccess"]) ) {

                                                if ( $_SESSION["insertsuccess"]== "yes" ) {
                                                  
                                                  echo '<div class="alert alert-success alert-dismissible show" role="alert">';
                                                  echo '<strong>Sikeres kategória inzert!</strong>' ;
                                                  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                                  echo '<span aria-hidden="true">&times;</span>';
                                                  echo '</button>';
                                                  echo '</div>';

                                                }

                                                unset($_SESSION['insertsuccess']) ; 

                                              }                                    
                                        
                                        ?>
                              
                                        <form method="post" action="/insertnewcategory" id="categoryform">

                                            <div class="form-group">
                                              <label for="catName">Kategória neve</label>
                                              <input type="text" class="form-control" id="catName" name="catName" aria-describedby="emailHelp">
                                            </div>

                                            <div class="form-group">
                                              <label for="sel1">Szülő kategória:</label>
                                              <select class="form-control" id="sel1" name="sel1">
                                                  <option disabled selected value>-- válasszon szülőkategóriát --</option>
                                                  <?php 

                                                    $query = "SELECT name FROM nested_category ORDER BY name;";
                                                    $result = $link->query($query);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option>" . $row['name'] . "</option>";
                                                    }
                                                                                              
                                                  ?>
                                  
                                                
                                              </select>

                                              <div style="margin-top:20px"> 
                                                <button type="button" id="ment" class="btn btn-primary">Ment</button>
                                              </div>
                                            </div> 

                                          
                                              
                                        </form>
                                </div>
                            </div>
                          </div>

                      </div>
                    
                     <div role="tabpanel" class="tab-pane" id="deletecat">
                        
                      <div style="border-left: 1px solid #d9d7d7;border-right: 1px solid #d9d7d7; border-bottom: 1px solid #d9d7d7;">
                      <div class="alert alert-warning" style="padding:5px;margin-top:15px;margin-left: 10px;margin-right: 60px">
                        <strong>Fontos!</strong> Szülő kategória törlésénél a vonatkozó  alkategóriák mindegyike törlődik. A törlésre kerülő alkategóriákat halványpiros színnel kiemeljük,  </br> 
                        amikor a "Töröl" gombra viszi az egérmutatót. A kitörölt kategóriákhoz tartozó termékek a megmaradó, közvetlen szülőkategóriába kerülnek át.
                      </div>
                            <div class="row" style="padding-top:20px; padding-left:20px; padding-bottom: 40px" >
                                <div class="col-sm-5" id="torloform">   

                                        <?php 

                                              if ( isset($_SESSION["deletesuccess"]) ) {

                                                if ( $_SESSION["deletesuccess"]== "yes" ) {
                                                  
                                                  echo '<div class="alert alert-success alert-dismissible show" role="alert">';
                                                  echo '<strong>Sikeres kategória törlés!</strong>' ;
                                                  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                                  echo '<span aria-hidden="true">&times;</span>';
                                                  echo '</button>';
                                                  echo '</div>';
                                                  echo '<script>';
                                                  echo "(function(){";
                                                  echo  "$( '#deletecat' ).addClass('active');";
                                                  echo  "$( '#newcat' ).removeClass( 'active' );";
                                                  echo  "$( '#managecat' ).removeClass( 'active' );";
                                                  echo "$('a[href=\\u0022#deletecat\\u0022]').parent().addClass( 'active' );";
                                                  echo "$('a[href=\\u0022#newcat\\u0022]').parent().removeClass( 'active' );";
                                                  echo "$('a[href=\\u0022#managecat\\u0022]').parent().removeClass( 'active' );";
                                                  echo  "})();";
                                                  echo '</script>';

                                                }

                                                unset($_SESSION['deletesuccess']) ; 

                                              }                                    
                                        
                                        ?>
                              
                                        <form method="post" action="/deletecategory" id="deleteform">
                                          
                                            <div class="form-group">
                                              <label for="sel2" style="margin-bottom:20px">Válasszon kategóriát:</label>
                                              <input type="hidden" id="delId" name="delId" value="">
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
                                                    echo "<div id='". $json[ $x ][ 'category_id' ] ."'class='deldiv' style='margin-top:5px;cursor: move;margin-left:" . $marg . "px'><i class='glyphicon glyphicon-move'></i>   ". $json[ $x ]['name'] ."<button id='". $json[ $x ]['category_id'] ."' type='button' class='btn btn-danger btn-xs delbutton' style='float:right; margin-right:5px'>Töröl</button></div>";
                                                      
                                                  }
                                                                                  
                                              ?>

                                              
                                            </div> 

                                          
                                              
                                        </form>
                                </div>
                            </div>
                          </div>
                   
                      </div>


                      <div role="tabpanel" class="tab-pane" id="managecat">

                          <div style="border-left: 1px solid #d9d7d7;border-right: 1px solid #d9d7d7; border-bottom: 1px solid #d9d7d7;">

                          <div class="alert alert-warning" style="padding:5px;margin-top:15px;margin-left: 10px;margin-right: 60px">
                                <strong>Fontos!</strong> Szülő kategória törlésénél a vonatkozó  alkategóriák mindegyike törlődik. A törlésre kerülő alkategóriákat halványpiros színnel kiemeljük,  </br> 
                                amikor a "Töröl" gombra viszi az egérmutatót. A kitörölt kategóriákhoz tartozó termékek a megmaradó, közvetlen szülőkategóriába kerülnek át.
                              </div>
                                <div class="row" style="padding-top:20px; padding-left:20px; padding-bottom: 40px" >
                                    <div class="col-sm-5" id="managediv">   
                                      
                                            <?php 

                                                  if ( isset($_SESSION["managesuccess"]) ) {

                                                    if ( $_SESSION["managesuccess"]== "yes" ) {
                                                      
                                                      echo '<div class="alert alert-success alert-dismissible show" role="alert">';
                                                      echo '<strong>Sikeres kategória módosítás!</strong>' ;
                                                      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                                      echo '<span aria-hidden="true">&times;</span>';
                                                      echo '</button>';
                                                      echo '</div>';

                                                    }

                                                    unset($_SESSION['managesuccess']) ; 

                                                  }                                    
                                            
                                            ?>

                                            <div id="draganddrop">
                                            <?php 
                                                $arr = [];
                                                $query = "SELECT name, category_id, lft, rgt FROM `nested_category` WHERE `category_id` in (SELECT `category_id` FROM nested_category WHERE 1) ORDER BY lft;";
                                                $result = $link->query($query);
                                                //$arr = mysqli_fetch_assoc($result);
                                                
                                                while ($row = mysqli_fetch_assoc($result)){

                                                  
                                                  $query2 = "SELECT node.name, (COUNT(parent.name) - 1) AS depth ";
                                                  $query2 = $query2 . "FROM nested_category AS node, ";
                                                  $query2 = $query2 . "nested_category AS parent ";
                                                  $query2 = $query2 . "WHERE node.lft BETWEEN parent.lft AND parent.rgt ";
                                                  $query2 = $query2 . "AND node.category_id = '" . $row['category_id'] . "';";

                                                  //echo $query2 . "<BR />";

                                                   $result2 = $link->query($query2);
                                                   $row1 = mysqli_fetch_assoc($result2);
                                                   array_push(  $row, $row1['depth'] );
                                                   array_push($arr,$row);

                                                }

                                                $json = json_decode(json_encode($arr), true);
                                              
                                                for ($x = 0; $x < count($json); $x++) {

                                                    $query3 = "SELECT COUNT(node.name)-1 AS noofchilds FROM nested_category AS node, nested_category AS parent";
                                                    $query3 = $query3 . " WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.rgt BETWEEN parent.lft AND parent.rgt AND parent.category_id=" . $json[ $x ]['category_id'] . ";";
                                                    $result3 = $link->query( $query3 );  
                                                    $row3 = mysqli_fetch_assoc( $result3 );

                                              
                                                    $marg = (int)$json[ $x ][0] * 15;
                                                    echo "<div data-noofchilds=" . $row3['noofchilds'] . " id='". $json[ $x ]['category_id'] ."' class='sortdiv' style='margin-top:5px;cursor: move;margin-left:" . $marg . "px'><i class='glyphicon glyphicon-move'></i>   ". $json[ $x ]['name'] ."<span class='glyphicon glyphicon-circle-arrow-right reorder forth'></span><span class='glyphicon glyphicon-circle-arrow-left reorder back'></span></div>";
                                                      
                                                }
                                        
                                            ?>
                                            </div>
 
                                            <form method="post" action="/managecategory" id="manageform">
                                                <input type="hidden" id="manageCat" name="manageCat" value="">
                                                <div class="form-group">
                                                  <div style="margin-top:20px"> 
                                                    <button type="button" id="management" class="btn btn-primary">Ment</button>
                                                  </div>
                                                </div> 
                                                 
                                            </form>
                                    </div>
                                </div>
                              </div>

                          </div>

                    </div>
  
                  </div>

              </div>

            </div>

          </div>

        </div>

    


    
</body>
</html>