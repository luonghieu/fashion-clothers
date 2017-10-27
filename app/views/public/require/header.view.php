<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shop</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <script type="text/javascript" src="/public/assets/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/app.js"></script>
    <script type="text/javascript" src="/public/assets/js/shop.js"></script>
    <script type="text/javascript" src="/public/assets/js/public.js"></script>
</head>
<body>
    <div class="wrapper">
        <header id="header">
            <nav class="container" id="navbar">
                <div class="navbar-full hidden-mobile hidden-tablet row">
                    <div class=" col-md-2 col-lg-3">
                        <div class="logo-shop cover">
                            <a href="/"><p>Fashion & <span>Style</span></p></a>
                        </div>
                    </div>
                    <?php 
                    $url=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
                    ?>
                    <div class="col-md-5 col-lg-4">
                        <div class="cover menu">
                            <ul>
                                <li><a class="<?php if($url==''){echo 'active';}?>"  href="/">HOME</a></li>
                                <li>
                                    <a href="/men" class="<?php if($url=='men'){echo 'active';}?>" >MEN</a>
                                    <div class="menu-child">
                                        <ul>
                                            <?php
                                                foreach ($gender_men_cats as $key => $item) {
                                                    $id=$item->id;
                                                    $name=$item->name;
                                            ?>
                                            <li>
                                                <a href="/cat/<?php echo $id; ?>"><?php echo $name; ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="box-img">
                                            <img src="/public/assets/img/men-logo.jpeg" alt="">
                                        </div>
                                    </div>

                                </li>
                                <li>
                                    <a href="/women" class="<?php if($url=='women'){echo 'active';}?>">WOMEN</a>
                                    <div class="menu-child">
                                        <ul>
                                            <?php
                                                foreach ($gender_women_cats as $key => $item) {
                                                    $id=$item->id;
                                                    $name=$item->name;
                                            ?>
                                            <li>
                                                <a href="/cat/<?php echo $id; ?>"><?php echo $name; ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="box-img">
                                            <img src="/public/assets/img/women-logo.jpg" alt="">
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-md-3 col-lg-3 ">
                        <div class="cover search-box">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input class="search" type="search" placeholder="search">
                        </div>
                    </div> -->
                    <div class="col-md-5 col-lg-5" style="text-align: right;">
                        <div class="cover account-box">
                            <a class="bag" href="/cart">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span class='showCart'>
                                        <?php

                                        if (isset($_SESSION['num'])){
                                            
                                           if($_SESSION['num'] !=0) {
                                        ?>
                                            <span class='indicator'><?php echo $_SESSION['num'] ;?></span>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </span>
                              
                               
                            </a>
                            
                                <?php
                                    if(isset($_SESSION['login'])){ 
                                        echo $_SESSION['login']->username;
                                    }
                                ?>
                            
                            <?php 
                                if(!isset($_SESSION['login'])){ 
                                    echo '<button class="account" id="account"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>';
                                }else{
                                    echo '<a href="/logout" style="margin-left:10px;" title="">Log out</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="hidden-desktop hidden-lage-screen row ">
                    <div class="col-xs-2 col-sm-2">
                        <div class="btn-bag">
                            <a href="/cart">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                <span class='showCart'>
                                        <?php

                                        if (isset($_SESSION['num'])){
                                            
                                           if($_SESSION['num'] !=0) {
                                        ?>
                                            <span class='indicator'><?php echo $_SESSION['num'] ;?></span>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </span>
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-8 col-sm-8">
                        <div class="logo-shop">
                            <a href="index.html"><p>Fashion & <span>Style</span></p></a>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2">
                        <div class="btn-menu" id="btn-menu">
                            <i class="fa fa-bars" aria-hidden="true"></i>

                        </div>
                    </div>
                    <div class="mobile-menu" id="mobile-menu">
                        <ul>
                            <li>
                                <h3 class="title-menu">Categories</h3>
                            </li>
                            <li>
                                <div class="box-search">
                                    <input type="text" name="" placeholder="search">

                                </div>

                            </li>
                            <li>
                                <h4>For Men</h4>
                            </li>
                            <li><a href="product.html">T-Shirt</a></li>
                            <li><a href="product.html">Shirt</a></li>
                            <li><a href="product.html">Jacket</a></li>
                            <li><a href="product.html">Trousers</a></li>
                            <li><a href="product.html">Jean</a></li>
                            <li><a href="product.html">Khaki</a></li>
                            <li>
                                <h4>For Women</h4>
                            </li>
                            <li><a href="product.html">T-Shirt</a></li>
                            <li><a href="product.html">Shirt</a></li>
                            <li><a href="product.html">Jacket</a></li>
                            <li><a href="product.html">Trousers</a></li>
                            <li><a href="product.html">Jean</a></li>
                            <li><a href="product.html">Khaki</a></li>
                            <li><a href="product.html">Account</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
