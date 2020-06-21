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

    <!-- <script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.css"> -->

    <script>

      $('document').ready(function(){

        $("a[href$='#managecat']").click(function(){
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

        })


        $('.reorder.glyphicon-circle-arrow-right').click(function(){


              alert ('bent')




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

                // var itemEl = evt.item;  // dragged HTMLElement
                // evt.to;    // target list
                // evt.from;  // previous list
                // evt.oldIndex;  // element's old index within old parent
                // evt.newIndex;  // element's new index within new parent
                // evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
                // evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
                // evt.clone // the clone element
                // evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
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

          $('#torol').click(function(){

            $('.alert-dismissible').remove();

            if ( $('#sel2').find(":selected").text() == "-- válasszon kategóriát --") {

              $('#torloform').append(             
              "<div class='alert alert-warning alert-dismissible show' role='alert'>" +
              "<strong>Válasszon kategóriát!</strong>" +
              "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
              "<span aria-hidden='true'>&times;</span>" +
              "</button>" +
              "</div>")

            }

            if ( $('#sel2').find(":selected").text() != "-- válasszon kategóriát --") {

              $('#deleteform').submit();

            }


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

              .glyphicon-remove {

                color: #c21313bf;

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
                    <a href="/products/import">
                      <i class="menu-icon fa fa-caret-right"></i>
                      <span class="menu-text"> Import </span>
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
                      <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
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
                            <div class="row" style="padding-top:40px; padding-left:20px; padding-bottom: 40px" >
                                <div class="col-sm-4" id="torloform">   

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
                                              <label for="sel2">Válasszon kategóriát:</label>
                                              <select class="form-control" id="sel2" name="sel2">
                                                  <option disabled selected value>-- válasszon kategóriát --</option>
                                                  <?php 

                                                    $query = "SELECT name FROM nested_category ORDER BY name;";
                                                    $result = $link->query($query);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option>" . $row['name'] . "</option>";
                                                    }
                                                                                              
                                                  ?>
                                  
                                                
                                              </select>

                                              <div style="margin-top:20px"> 
                                                <button type="button" id="torol" class="btn btn-primary">Töröl</button>
                                              </div>
                                            </div> 

                                          
                                              
                                        </form>
                                </div>
                            </div>
                          </div>
                   
                      </div>


                      <div role="tabpanel" class="tab-pane" id="managecat">

                          <div style="border-left: 1px solid #d9d7d7;border-right: 1px solid #d9d7d7; border-bottom: 1px solid #d9d7d7;">
                                <div class="row" style="padding-top:40px; padding-left:20px; padding-bottom: 40px" >
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

                                                    }

                                                    unset($_SESSION['deletesuccess']) ; 

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

                                                   //echo $row1['depth'];

                                                   array_push(  $row, $row1['depth'] );

                                                   array_push($arr,$row);




                                                }

                                                  
                                                  $json = json_decode(json_encode($arr), true);
                                                  echo (count($json));

                                                  for ($x = 0; $x < count($json); $x++) {
                                              
                                                    echo $json[ $x ]['name']."<BR/>";
                                                    echo $json[ $x ]['category_id']."<BR/>";
                                                    //echo ( (int)$json[ $x ][0] * 15 )."<BR/>";
                                                    $marg = (int)$json[ $x ][0] * 15;
                                                    echo "marg : ", $marg;
                     echo "<div class='sortdiv' style='margin-top:5px;cursor: move;margin-left:60px'><i class='glyphicon glyphicon-move'></i>   ". $json[ $x ]['name'] ."<span class='glyphicon glyphicon-remove reorder'></span><span class='glyphicon glyphicon-circle-arrow-right reorder'></span><span class='glyphicon glyphicon-circle-arrow-left reorder'></span></div>";
                    //  $myFile = "testFile.txt";
                    //  $fh = fopen($myFile, 'w') or die("can't open file");
                    //  $stringData = "<div class='sortdiv' style='margin-top:5px;cursor: move;margin-left:" . $marg  . "px'><i class='glyphicon glyphicon-move'></i>   ". $json[ $x ]['name'] ."<span class='glyphicon glyphicon-remove reorder'></span><span class='glyphicon glyphicon-circle-arrow-right reorder'></span><span class='glyphicon glyphicon-circle-arrow-left reorder'></span></div>\n";
                    //  file_put_contents('testFile.txt', $stringData.PHP_EOL , FILE_APPEND | LOCK_EX);
                     //fwrite($fh, $stringData);                      
                                                  
                    
                    
                    }
                                                  //  echo $json[11]['name']."<BR/>";
                                                  //  echo $json[11]['category_id']."<BR/>";
                                                  //  echo $json[11][0]."<BR/>";


                                                  // foreach($json['items'] as $item) {
                                                  //   echo 'name: ' . $item['name'] . '<br />';
                                                  //   echo 'category_id: ' . $item['category_id'] . '<br />';
                                                  //   echo 'depth: ' . $item["0"] . '<br />';
                                                  // }

                                              //  foreach($arr as $sor){
                                              //    echo $sor['category_id'];
                                              //  }

                                              //for($i = 0; $i < count($arr); $i++) { $value = $arr[$i]; echo $value[0]; }
                                              
                                              



                                                    
                                              // ****************** EREDETI ********************    
                                                    // $query = "SELECT node.name, (COUNT(parent.name) - 1) AS depth";
                                                    // $query = $query." FROM nested_category AS node, nested_category AS parent";
                                                    // $query = $query." WHERE node.lft BETWEEN parent.lft AND parent.rgt";
                                                    // $query = $query." GROUP BY node.name";
                                                    // $query = $query." ORDER BY node.lft;";
                                                    // echo $query;
                                                    // $result = $link->query($query);
                                                
                                                    // if( $result ) {

                                                    //   while ($row = mysqli_fetch_assoc($result)) {

                                                    //       echo "<div class='sortdiv' style='margin-top:5px;cursor: move;margin-left:" . $row['depth'] * 15  . "px'><i class='glyphicon glyphicon-move'></i>   ". $row['name'] ."<span class='glyphicon glyphicon-remove reorder'></span><span class='glyphicon glyphicon-circle-arrow-right reorder'></span><span class='glyphicon glyphicon-circle-arrow-left reorder'></span></div>";

                                                    //   }
                                                                                                     
                                                
                                                    // } else {
                                                    //     echo mysqli_error($link);
                                                    // }
                                                // ****************** EREDETI ********************  

                                        
                                            ?>
                                            </div>
 
                                            <form method="post" action="/deletecategory" id="deleteform">
                                              
                                                <div class="form-group">
                                                

                                                  <div style="margin-top:20px"> 
                                                    <button type="button" id="torol" class="btn btn-primary">Ment</button>
                                                  </div>
                                                </div> 

                                              
                                                  
                                            </form>
                                    </div>
                                </div>
                              </div>





                          </div>

                      <div role="tabpanel" class="tab-pane" id="settings">***</div>
                

                    </div>
  
                  </div>

              </div>

            </div>



          </div>

        </div>

    


    
</body>
</html>