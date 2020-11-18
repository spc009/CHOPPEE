<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Customer Management | Gunpla Store Plastic Model Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="./amado-master/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="./amado-master/css/core-style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./amado-master/js/app.js"></script>
</head>

<body>
    <div style="display:none" id="Key">
        <p>username</p>
        <p>jobTitle</p>
        <p>employeeNumber</p>
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
                            <input type="text" id="myInput" onkeyup="filter(this.value,4)" placeholder="Search for names..">
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
                <a  href="/welcome"><img src="./amado-master/img/core-img/logoGunpla1.png" alt=""></a>

            </div>

            <!-- <li class="active"><a href="index.html">Home</a></li>
            <li><a href="shop">Shop</a></li>
            <li><a href="product-details.html">Product</a></li>
            <li><a href="cart.html">Cart</a></li>
            <li><a href="checkout.html">Checkout</a></li> -->

            <!-- <a href="#" class="search-nav"><img src="./amado-master/img/core-img/search.png" alt=""> </a> -->

            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>

        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">

            <!-- Close Icon -->
            <!-- <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div> -->
            <!-- Logo -->
            <div class="logo">
                <a  href="/welcome"><img src="./amado-master/img/core-img/logoGunpla1.png" alt=""></a>
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

            <!-- Cart Menu -->
            <div class="cart-fav-search mb-30">
                <a href="#" class="search-nav"><img src="./amado-master/img/core-img/search.png" alt=""> Search</a>
            </div>

            <!-- Button Group -->
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" onclick="document.getElementById('id04').style.display='block'" class="btn amado-btn-plus" >AddCustomer +</a>
                <br><br>
                <a href="welcome" class="btn amado-btn">Back</a>
                <br>
                <a href="/" class="btn amado-btn">Logout</a>
            </div>
            <!-- Pop up -->
                <!--Login pop up-->
                <!-- product pop up -->

                <div id="id03" class="modal" style="display:none">
                    <!-- showProductDetail() -->
                </div>
                <!-- popup add new employee -->
                <div id="id04" class="modal">
                    <span onclick="document.getElementById('id04').style.display='none'"
                        class="close" title="Close Modal">&times;
                    </span>
                    <!-- product-order -->
                    <form class="modal-content animate" action="/action_page.php">
                    <div class="cart-table-area section-padding-60">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="cart-title mt-50">
                                    <h2>New Customer</h2>
                                </div>
                                <div class="product-meta-data">
                                <label for="customerNum"><b>Customer Number</b></label>
                                <input id="wcusnum" type="text" placeholder="204" name="customerNum" required>
                                <label for="customerName"><b>Customer Name</b></label>
                                <input id="wcompany" type="text" placeholder="Your Company" name="customerName" required>
                                <label for="firstName"><b>First Name</b></label>
                                <input id="wfname" type="text" placeholder="" name="firstName" required>
                                <label for="lastName"><b>Last Name</b></label>
                                <input id="wlname" type="text" placeholder="" name="lastName" required>
                                <label for="phoneNum"><b>Phone number</b></label>
                                <input id="wphone" type="text" placeholder="Ex. 088xxxxxx" name="phoneNum" required>
                                <label for="addrline1"><b>Address Line 1</b></label>
                                <input id="wadd1" type="text" placeholder="" name="addrline1" required>
                                <label for="addrline2"><b>Address Line 2</b></label>
                                <input id="wadd2" type="text" placeholder="" name="addrline2">
                                <label for="city"><b>City</b></label>
                                <input id="wcity" type="text" placeholder="" name="city">
                                <label for="state"><b>State</b></label>
                                <input id="wstate" type="text" placeholder="" name="state">
                                <label for="postalCode"><b>PostalCode</b></label>
                                <input id="wpos" type="text" placeholder="" name="postalCode">
                                <label for="country"><b>Country</b></label>
                                <input id="wcoun" type="text" placeholder="" name="country">
                                <label for="saleRepEmNum"><b>SaleRepEmployeeNumber</b></label>
                                <input id="wsale" type="text" placeholder="4-digit code" name="saleRepEmNum" required>
                                <label for="credit"><b>CreditLimit</b></label>
                                <input id="wcredit" type="text" placeholder="" name="credit">
                                <button type="button" onclick="insertcus()">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>
                </div>

                <div id="id01" class="modal">

                </div>
                <!-- Pop up for edit address -->
                <div id="id05" class="modal" style="display:none">
                    <!-- PopUpAddress() -->
                </div>
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix" id="productArea"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
            var customer = <?php echo $jsoncustomer?>;
            showCustomer(customer);
        </script>
        <!-- Product Catagories Area End -->

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <br>
    <footer class="footer_area">
        <div >
        <!-- Logo -->
        <a href="/welcome" style="padding:0px 0px 0px 50px"><img src="./amado-master/img/core-img/logoDarkBG.png" alt=""></a>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

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
