<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Gunpla Store | Plastic Model Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="./amado-master/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="./amado-master/css/core-style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./amado-master/js/app.js"></script>
    <script src="./amado-master/js/order.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

    <div id = "error" class= "modal" style = "display:none">
        <form class="modal-content animate" >
            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('error').style.display='none'"
                class="cancelbtn">Please enter Order Number.</button>
            </div>
        </form>
    </div>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-50">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="" method="get">
                            <!-- <input type="search" name="search" id="search" placeholder="Type your keyword..."> -->
                            <input type="text" id="myInput" onkeyup="filterByProductName()" placeholder="Search for names..">
                            <button type="submit"><img src="./amado-master/img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a  href="/welcome"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>

        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Logo -->
            <div class="logo">
                <a  href="/welcome"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
            </div>
            <p id="showUser"></p>
            <script>
                var x = sessionStorage.getItem('employeeNumber');
                if(x != null ){
                    document.getElementById('showUser').innerHTML="EmployeeID:" +x;
                }else{
                    window.location.href = "/";
                }
            </script>
            <input type="text" name="   ID" id="orderId" placeholder="Order ID ...">
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-30">
                <a href="/order" class="cart-nav"><img src="./amado-master/img/core-img/cart.png" alt=""> Order ( <span id="NumberCart">  </span> )</a>
                <!-- <a href="#" onclick="console.log(GetOrder())" class="fav-nav"><img src="./amado-master/img/core-img/favorites.png" alt=""> Favourite</a> -->
            </div>

            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                <div class="amado-nav">
                    <!--Scale bar-->
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#footerNavContent"
                        aria-controls="footerNavContent"
                        aria-expanded="false"
                        >SCALE
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="footerNavContent">
                        <ul>
                            <li class="nav-item" id="Scale">
                            </li>
                        </ul>
                    </div>
                    <!--Vendor bar-->
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#footer"
                        aria-controls="footerNavContent"
                        aria-expanded="false"
                        >VENDOR
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="footer">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item" id="Vendor">
                            </li>
                        </ul>
                    </div>
                </div>
                </ul>
            </nav>

            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="/welcome" class="btn amado-btn">Back</a>
                <br>
                <a href="/" class="btn amado-btn">Logout</a>
                <br>
                <button onclick="deleteCart()">delete cart</button>
            </div>
            <!-- Pop up -->
                <!--Login pop up-->
                <div id="id01" class="modal">
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="close" title="Close Modal">&times;
                    </span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" action="/action_page.php">
                        <div class="container">
                            <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname" required>
                            <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw" required>
                                <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                            <span class="psw"><a href="#">Forgot password?</a></span>
                        </div>
                        <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                            class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>
                <!-- product pop up -->
                <div id="id02" class="modal" style="display:none">
                    <!-- showProductDetail() -->
                </div>
        </header>
        <!-- Header Area End -->


        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix" id="productArea" >

        </div>
        <script type="text/javascript">
            var json = <?php echo $jsonProduct?>;
            var Vendor = <?php echo $jsonVendor?>;
            var Scale = <?php echo $jsonScale?>;
            dropdownVender(Vendor);
            dropdownScale(Scale);
            NumberCart();
            showProduct(json,false,true);

        </script>

        <!-- Product Catagories Area End -->

    </div>
    <br>
    <!-- ##### Main Content Wrapper End ##### -->

    <footer class="footer_area">
        <div >
        <!-- Logo -->
        <a href="/welcome" style="padding:0px 0px 0px 50px"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
        </div>
    </footer>


    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="./amado-master/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="./amado-master/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="./amado-master/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="./amado-master/js/plugins.js"></script>
    <!-- Active js -->
    <script src="./amado-master/js/active.js"></script>
    <!-- DB function -->
    <script src="./amado-master/js/app.js"></script>
    <script src="./amado-master/js/order.js"></script>


</body>

</html>
