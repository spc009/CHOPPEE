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
    <title>Order | Gunpla Store - Plastic Model Shop</title>

    <!-- Favicon  -->
    <link rel="icon" href="./amado-master/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="./amado-master/css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <script src="./amado-master/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
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
                <a href="/welcome"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
            </div>
            <!-- After Login interface -->
            <!-- <div class="amado-navbar-user" id="uname">
                <p>Welcome {username}</p>
            </div> -->
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
                <a href="/welcome"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
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

            <!-- Amado Nav -->
            <div class="amado-nav" style="cursor: default">
                <img src="./amado-master/img/core-img/employeeM.png">
                <!-- Button Group -->
                <div class="amado-btn-group mt-30 mb-100">
                    <a href="/mnod" class="btn amado-btn">Back</a>
                    <br>
                    <a href="/" class="btn amado-btn">Logout</a>
                </div>
            </div>

            <!-- Pop up -->
            <!-- PopUp Modal -->
            <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
                </span>
                <!-- Form inside popup -->
                <form class="modal-content animate">
                    <div class="container">
                        <h4>Adding Address</h4><br>
                        <label for="addressLine1"><b>Address Line 1</b></label>
                            <input type="text" placeholder="" id="addressLine1" name="addressLine1" required>
                        <label for="addressLine2"><b>Address Line 2</b></label>
                            <input type="text" placeholder="" id="addressLine2" name="addressLine2" required>
                        <label for="city"><b>City</b></label>
                            <input type="text" placeholder="" id="city" name="city" required>
                        <label for="state"><b>State</b></label>
                            <input type="text" placeholder="" id="state" name="state" required>
                        <label for="country"><b>Country</b></label>
                            <input type="text" placeholder="" id="country" name="country" required>
                        <label for="postalCode"><b>Postal Code</b></label>
                            <input type="text" placeholder="" id="postalCode" name="postalCode" required>
                        <label for="addrnum"><b>Address ID</b></label>
                            <input type="text" placeholder="" id="addrnum" name="addrnum" required>
                        <label for="custnum"><b>Customer ID</b></label>
                            <input type="text" placeholder="" id="custnum" name="custnum" required>
                        <a class="btn amado-btn w-100 mt-30" style="color: #ffffff" onclick="insertAddress()">Confirm</a>
                    </div>
                    <div class="container" style="background-color:#f1f1f1">
                        <a class="btn amado-btn-cancel" style="color: #ffffff" onclick="document.getElementById('id01').style.display='none'">Cancel</a>
                    </div>
                </form>
            </div>
            <!-- product pop up -->
            <div id="id02" class="modal" style="display:none">
                <!-- showProductDetail() -->
            </div>
            <div id="id03" class="modal" style="display:none">

            </div>
        </header>
        <!-- Header Area End -->

        <div class="cart-order-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Order</h2>
                        </div>
                        <div class="cart-table clearfix">
                            <table class="table table-responsive" id="order_table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price ($)</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="order_table_body">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>Subtotal :</span><span id="sumprice"></span></li>

                                <li>
                                    <div class="col-12" style="padding: 0px">
                                    <div>
                                        <form style="border: none">
                                        <input type="text" name="searchPro" id="searchPro" style="max-width:60%" placeholder=" Promotion Code...">
                                        <a class="btn amado-btn" style="width:20%" onclick="getPromotion()"><img src="./amado-master/img/core-img/search.png" alt=""></a>
                                        </form>
                                </div>
                            </div>
                                </li>
                                <li><span>Discount :</span><span id="discount">-</span></li>
                                <li><span>Total :</span> <span id="total"></span></li>
                                <li><span>Points :</span> <span id="mempoint"></span><span>Points</span></li>
                                <li><span>Member Points :</span> <span id="points"></span><span>Points</span></li>
                                <li><span>Shipping Date :</span>
                                    <div class="col-10">
                                        <input type="text" class="form-control" style="padding: 5px 10px" id="shipDate" placeholder="Shipping Date">
                                    </div>
                                </li>
                            </ul>
                            <div class="payment-method">
                                <label for="payment">Money Cheque :</label>
                                    <img class="ml-30" src="./amado-master/img/core-img/paypal.png" alt="">
                                    <img class="ml-5" src="./amado-master/img/core-img/paypal2.png" alt="" height="50" width="50">
                            </div>
                            <h5>Customer Address</h5>
                            <div class="col-12" style="padding: 0px">
                                <div>
                                    <form style="border: none">
                                        <input type="text" name="searchID" id="searchID" style="max-width:60%" placeholder="Type Customer Number...">
                                        <a class="btn amado-btn" style="width:20%" onclick=" getAddress(document.getElementById('searchID').value, false, 'addressArea', 'shippingAddr'); getAddress(document.getElementById('searchID').value, false, 'addressArea2', 'billingAddr');"><img src="./amado-master/img/core-img/search.png" alt=""></a>
                                    </form>
                                </div>
                            </div><br>
                            <h5>Select Shipping Address</h5>
                            <div class="checkout_details_area clearfix col-12" style="padding: 0px">
                                    <form style="border: none">
                                        <h5>Shipping Address</h5>
                                        <div class="form-control" id="shippingAddr" style="padding: 15px 20px"></div>
                                        <h5>Billing Address</h5>
                                        <div class="form-control" id="billingAddr" style="padding: 15px 20px"></div>
                                        <div>
                                            <a onclick="document.getElementById('id01').style.display='block'" class="btn amado-btn" style="width:48%;color: #fff;">Add Address</a>
                                            <a onclick="AddToOrder()" class="btn amado-btn" style="width: 48%;color: #fff;">Checkout</a>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        var json = <?php echo $product ?? ''?>;
                        showCart(json);
                        order_calculator() ;
                    </script>

                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <br>
    <footer class="footer_area">
        <div>
            <!-- Logo -->
            <a href="/welcome" style="padding:0px 0px 0px 50px"><img src="./amado-master/img/core-img/ChoppeeBlue.png" alt=""></a>
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
        <script src="./amado-master/js/order.js"></script>
</body>

</html>
