<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Gunpla Store | Plastic Model Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="./amado-master/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="./amado-master/css/core-style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./amado-master/js/app.js"></script>
</head>

<body>
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
                            <input type="text" id="myInput" onkeyup="filter(this.value,5)" placeholder="Search for names..">
                            <button type="submit"><img src="./amado-master/img/core-img/search.png" alt=""></button>
                        </form>
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
                <a href="/"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
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
                <a href="/"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-30">
                <a href="#" class="search-nav"><img src="./amado-master/img/core-img/search.png" alt=""> Search</a>
                <a href="cart.html" class="cart-nav"><img src="./amado-master/img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="./amado-master/img/core-img/favorites.png" alt=""> Favourite</a>
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
                                <li class="nav-item" id="Scale"></li>
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
                                <li class="nav-item" id="Vendor"></li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </nav>
            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn" >Discount</a><br>
                <a href="#" onclick = "document.getElementById('id01').style.display='block'" class="btn amado-btn">Login</a><br>
                <a href="#" onclick = "categorize(Vendor,'Vendor')" class="btn amado-btn">Catagorize by Vendor</a><br>
                <a href="#" onclick = "categorize(Scale,'Scale')" class="btn amado-btn">Catagorize by Scale</a><br>
                <a href="#" onclick = "showProduct(json,false,false)" class="btn amado-btn">No Catagorize</a>
            </div>
        </header>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    <!--Login pop up-->
    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="close" title="Close Modal">&times;
        </span>
        <!-- Modal Content -->
        <form class="modal-content animate" action="/login" method = "post">
            <div class="container">
                {{ csrf_field() }}
                <label for="uname"><b>Username</b></label><input type="text" name="uname" placeholder="Enter Username" required>
                <label for="psw"><b>Password</b></label><input type="password" name="psw" placeholder="Enter Password" required>
                <button>Login</button>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>
    <!-- alert pop up -->
    @if(session()->has('alert'))
    <div id = "loginError" class= "modal" style = "display:block">
        <form class="modal-content animate" id="loginError">
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('loginError').style.display='none'" 
                class="cancelbtn" id="aleartsession">{{ session('alert') }}
                </button>
            </div>
        </form>
    </div>
    @endif
    <!-- product pop up -->
    <div id="id02" class="modal">
    <!-- showProductDetail() -->
    </div>
    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix" id="productArea" >
    
    </div>
    
    <script>
        var json = <?php echo $jsonProduct?>;
        var Vendor = <?php echo $jsonVendor?>;
        var Scale = <?php echo $jsonScale?>;
        showProduct(json, false, false);
        dropdownVender(Vendor);
        dropdownScale(Scale);
        sessionStorage.clear();
    </script>
    
    <!-- Product Catagories Area End -->

    <!-- ##### Main Content Wrapper End ##### -->
    <br>
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

</body>
</html>
