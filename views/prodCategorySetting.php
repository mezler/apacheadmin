<?php


// if ($_SESSION["insertsuccess"]) 

require 'conn.php';

// $q = "SELECT * FROM Products";

// $res = $link->query( $q );

// $arr = [];

// while( $row = mysqli_fetch_assoc( $res )) {

//   array_push($arr, $row);

// }

// $json = json_encode( $arr );




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



    <!-- BOOTSTRAP SELECT-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- BOOTSTRAP SELECT-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.min.js"></script>

   

    <script>

      const selectModal =  (content) =>  {

               BootstrapDialog.show({
                    message: content,
                    title: '<i class="fa fa-list" aria-hidden="true"></i> Válassza ki a kategóriát!',
                    
                    onshown: function(){

                      // $('.modal-content').css({ 'display': 'none'})
                         
                          $('.modal-header').css({'background-color' : '#337ab7', 'color' : 'white'})
                          
                          $('.child').each( function() {
                           
                            if( $(this).next('div').hasClass('nodegroup') ) {
                            
                                $(this).removeClass('child').addClass('parent')
                              
                                let txt =  $(this).find('p').text()

                                $(this).find('p').html(`<i class='fa fa-plus fa-xs' aria-hidden='true'></i>     ${txt}`)
                                
                                $(this).find('p').css({"padding-left" : "15px"})

                                $(this).addClass('shifted')
                              
                            }
                          })

                          $('.parent').each( function() {
                           
                              $(this).css({'width': '50%', 'background-color': '#3379b7', 'color': 'white', 'padding-left': '10px', 'cursor': 'pointer', 'margin-left' : 'auto', 'margin-right' : 'auto', 'margin-bottom' : '-9px' })
                              
                              if( $(this).hasClass('shifted') ) {

                                    $(this).next('.nodegroup').css({"padding-left" : "50px"})

                              }

                          })

                          $('.nodegroup').each( function() {
                                                      
                              if( $(this).parent().hasClass('nodegroup') ) {

                                    $(this).removeClass('nodegroup')
                                    $(this).addClass('nodegroup_2nd')
                                    $(this).parent().css({'width': '100%'})
                                 
                              }
                          })

                          $('.nodegroup_2nd').each( function() {                                                     
                              $(this).css({'padding-left': '0px'})
                          })

                          $(document).off('click').on('click','.parent',function(evt){
                              $(this).next('div').slideToggle('medium')
                          }) 

                          $('.child').off('click').on('click', function(){

                              //  $('.bootstrap-dialog-message > div').removeClass('choosen')  
                               $('.child').css({'background-color' : 'white'})  
                               $('*').removeClass('choosen') 
                               $(this).addClass('choosen')

                               $(this).css({'background-color' : '#c59292f7'})  
                            
                          }) 

                          // $('.modal-content').css({ 'display': 'block'})

                    },
                    buttons: [{
                        // icon: 'glyphicon glyphicon-send',
                        label: 'Kiválaszt / ment',
                        cssClass: 'btn-primary'                   
                    }, {
                        label: 'Bezár',
                        action: function(dialogRef){
                            dialogRef.close();
                        }
                    }]
                });

            

      }

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

          $('#categoryTable').DataTable( {
            //    data : data
                ajax: {url: 'prodJson.php', dataSrc: ''},
                columns: [
                      { data: 'id' },
                      { data: 'Name' },
                      { data: 'LongName' },
                      { data: 'name' },
                      {
                          data: 'id',
                          render: function(data, type, row, meta) {
                              return type === 'display' ?
                                  '<div style="padding-left:40%"><button class="ide" style="border: none; margin-left: 15px; background-color: #438eb9; color: white;"> Választ </button><button style="border: none; margin-left: 15px; background-color: #438eb9; color: white;"> Ment </button></div>' :
                                  data;
                          }
                      }
                    ],
                  drawCallback: function( ) {

                      let cont = ""

                      $('.ide').on('click', function(){

                        fetch('https://adminapache.ddev.site/scripts/jsonFeed.php')
                        .then(resp => resp.json())
                        .then(json => renderContent(json))
                        
                      })
                     
                  }
            });


          function renderContent(json) {

              let st = ""
              let prev = 2

              let last = json.pop()
              json.push(last)

              json.forEach( item => {
                
                if ( item[0] == 0 ) {                
                  return true 
                }

                if ( item[0] > prev ) {
                  d = `<div class='nodegroup' ><div class='child' id=${item.category_id}>` + `<p><i class='fa fa-caret-right fa-xs' aria-hidden='true'></i>  ${item.name}</p>` + "</div>"
                }

                if ( item[0] == prev ) {
                  d = `<div class='child' id=${item.category_id}>` + `<p><i class='fa fa-caret-right fa-xs' aria-hidden='true'></i>  ${item.name}</p>` + "</div>"
                }

                if ( item[0] < prev && item[0] == 1 ) {
                  d = "</div><div class='parent'>" + `<p><i class='fa fa-plus fa-xs' aria-hidden='true'></i>  ${item.name}</p>` + "</div>"
                }

                if ( item[0] < prev && item[0] == 2 ) {
                  d = "</div><div class='parent shifted' >" + `<p style="padding-left: 15px"><i class='fa fa-plus fa-xs' aria-hidden='true'></i>  ${item.name}</p>` + "</div>"
                }

                // if ( (item[0] == 2 && prev == 3)  ) {
                //   d = "</div></div>".concat(d)
                // }





                // if ( item[0] == 2 && prev == 3 ) {
                //   d = "</div><div class='parent'>" + `<p><i class='fa fa-plus fa-xs' aria-hidden='true'></i>  ${item.name}</p>` + "</div>"
                // }





                if ( item.category_id == last.category_id && item[0] == 3 && prev == 3 ) {
                  d = d.concat("</div></div>")
                }

                prev = item[0] 
                st = st + d
         
              })

              console.log ( st )
              selectModal(st)
       

          }

      });
         

    </script>

    <style>


      /* .child.choosen { background-color: black;} */

      .nodegroup {

          width : 50%; 
          margin-left: auto;
          margin-right: auto; 
          display: none;

      }

      .nodegroup_2nd {

          width : 50%;
          padding-left:0px;
          margin-left: auto;
          margin-right: auto; 
          display: none;

      }

      .nodegroup > .child {

          padding-left:20px;
          margin-bottom: -9px;
          cursor: pointer;
          /* background-color: #91afc0;
          color: #ffffff; */
          border-left: 3px solid #337ab7;

      }

      .nodegroup_2nd > .child {

          padding-left:20px;
          margin-bottom: -9px;
          cursor: pointer;
          /* background-color: #91afc0;
          color: #ffffff; */
          border-left: 3px solid #337ab7;

      }

      .child:hover { 

          background-color: #91afc0;
          color: black;

      }

      .nodegroup_2nd > .child:hover {

          background-color: #91afc0;
          color: black;

      }

     

      .navbar-header svg {

          color:#fff;

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

               
                  <div style="margin-top: 30px;padding-left:50px;padding-right: 50px">
                      <table id="categoryTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%; background-color: #d1d2d3f2">id</th>
                                    <th style="width:10%; background-color: #d1d2d3f2">Name</th>
                                    <th style="width:35%; background-color: #d1d2d3f2">Longname</th>
                                    <th style="width:20%; background-color: #d1d2d3f2">Kategória</th>
                                    <th style="width:30%; background-color: #d1d2d3f2"></th>
                                </tr>
                            </thead>
                        </table>
                  </div>
                  
              
                  

              </div>

            </div>

          </div>

        </div>

        <script>

            // let node = document.getElementById("ide")
            // node.addEventListener('click', selectModal)  

            



        </script>


    
</body>
</html>