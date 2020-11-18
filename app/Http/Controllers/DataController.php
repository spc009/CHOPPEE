<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Data;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(){
        $data = DB::select('select * from products');
        $distinctvendor = DB::select('select distinct productVendor from products');
        $distinctscale = DB::select('select distinct productScale from products');
        $jsonProduct = json_encode($data);
        $jsonVendor = json_encode($distinctvendor);
        $jsonScale = json_encode($distinctscale);
        return view('index',['jsonProduct'=>$jsonProduct, 'jsonVendor'=>$jsonVendor, 'jsonScale'=>$jsonScale]);
    }
    public function employeeInfo(Request $request){
        $data = DB::select("select * from employees where employeeNumber = '$request->showUser'");
        $jsonEmployee = json_encode($data);
        return view('welcome',['jsonEmployee'=>$jsonEmployee]);
    }

    public function mnproduct(){
        $data = DB::select('select * from products');
        $datastock = DB::select('select * from stock');
        $jsonProduct = json_encode($data);
        $jsonstock = json_encode($datastock);
        return view('manage-product',['jsonProduct'=>$jsonProduct, 'jsonstock'=>$jsonstock]);
    }
    public function mnorder(){
        $data = DB::select('select * from products');
        $distinctvendor = DB::select('select distinct productVendor from products');
        $distinctscale = DB::select('select distinct productScale from products');
        $jsonProduct = json_encode($data);
        $jsonVendor = json_encode($distinctvendor);
        $jsonScale = json_encode($distinctscale);
        return view('manage-order',['jsonProduct'=>$jsonProduct, 'jsonVendor'=>$jsonVendor, 'jsonScale'=>$jsonScale]);
    }
    // public function mnemployee(){
    //     $employee = DB::select('select * from employees');
    //     $jsonEmployee = json_encode($employee);
    //     return view('manage-employee',['jsonEmployee'=>$jsonEmployee]);
    // }
    public function mncus(){
        $customer = DB::select('select * from customers');
        $jsoncustomer = json_encode($customer);
        return view('manage-customer',['jsoncustomer'=>$jsoncustomer]);
    }
    public function insertToCart(Request $request){
        $x = DB::select("select qty from cart where productCode ='$request->productCode'");
        $z = DB::select("select count(*) as n from cart group by productCode");
        if($z != null){
            $a = $z[0]->n;
            $a++; 
        }else{
            $a = 1;
        }
        if($x != null){
            $y = $x[0]->qty+$request->qty;
            DB::update("update cart set qty = $y where productCode = '$request->productCode'");
            // return json_encode($y);
        }else{
            DB::insert("
                insert into cart(orderNumber,Name,orderLineNumber,productCode,priceEach,qty)
                values ('$request->orderNumber','$request->Name','$a','$request->productCode','$request->price','$request->qty')
            ");
        }
        $data = DB::select('select * from cart');
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }

    public function NumberCart(){
        $Qty = DB::select("select sum(qty) as Qty from cart");
        return json_encode($Qty);
    }


    public function deleteCart(){
        DB::delete('delete from cart');
    }

    public function editProduct($code){
        $jdata = DB::select("select * from products where productCode = '$code'");
        $jsoneditProduct = json_encode($jdata);
        return $jsoneditProduct;
    }

    public function editcus($code){
        $customer = DB::select("select * from customers where customerNumber = '$code'");
        $jsoneditcus = json_encode($customer);
        return $jsoneditcus;
    }

    public function editstatus($code){
        $jdata = DB::select("select * from orders where orderNumber = '$code'");
        $jsoneditstatus = json_encode($jdata);
        return $jsoneditstatus;
    }
    public function detailstatus($code){
        $jdata = DB::select("select * from orderdetails where orderNumber = '$code'");
        $jsoneditstatus = json_encode($jdata);
        return $jsoneditstatus;
    }
    

    public function order(Request $request){
        $product = DB::select('select * from cart');
        return view('cart',['product'=>json_encode($product),'jsonCustomer'=> '']);
    }
    //and deleteFlag = 'flase'
    public function getAddress($code){
        // $address = DB::select("select * from addresses where customerNumber like '$code' and deleteFlag = 'false'");
        $address = DB::select("select addressLine1,addressLine2,city,state,postalCode,country,addressNumber from addresses where customerNumber like '$code' ");

        $point = DB::select("select points from customers where customerNumber like '$code'");
        return [json_encode($address),json_encode($point)];
    }
    public function addAddress(Request $request, $code){
        $c = DB::select("select count(*) as c from addresses where customerNumber = '$code'");
        $a = 0;
        if($c != null){
            $a = $c->c;
        }
        DB::insert("insert into addresses(addressLine1,addressLine2,city,state,postalCode,country,customerNumber,addressNumber)
            values ('$request->addrline1','$request->addrline2','$request->city','$request->state','$request->postalcode','$request->country','$code','$a')" );
        $product = DB::select("select * from addresses where customerNumber = '$code'");
        $jsonp = json_encode($product);
        return $jsonp;
    }
    public function editAddress($code){
        $data = DB::select("select * from addresses where customerNumber = '$code'");
        return json_encode($data);
    }
    public function updateAddress(Request $request, $code, $addr){
        DB::update("update addresses set addressLine1 = ?,addressLine2 = ?,city = ?,state = ?,postalCode = ?,country = ? where addressNumber = ? and customerNumber = ?",
        [$request->addrline1,$request->addrline2,$request->city,$request->state,$request->postalcode,$request->country,$addr,$code]);
        $data = DB::select("select * from addresses where customerNumber = '$code'");
        return json_encode($data);
    }
    public function deleteAddress($code){      //Soft-delete -> still available on shipping details
        DB::update("update addresses set deleteFlag = 'true' where customerNumber = '$code'");
        $data = DB::select("select * from customers");
        return json_encode($data);
    }

    public function successOrder(Request $request){
        $OrderNumber = DB::select('select distinct orderNumber from cart ');
        $ProductCode = DB :: select('select distinct productCode from cart ');
        $x = $OrderNumber[0];
        $date = date('Y-m-d',time());
        DB::insert("
            insert into orders(orderNumber,orderDate,requiredDate, status, customerNumber,shippingAddr, billingAddr)
            values ('$x->orderNumber','$date','$request->shippingDate','in progress','$request->customerNumber','$request->shippingAddr', '$request->billingAddr')
        ");

        // DB::insert("
        // insert into orders(orderNumber,orderDate,requiredDate, status, customerNumber,comments,shippedDate)
        // values ('$x->orderNumber','$date','$request->shippingDate','in progress','$request->customerNumber','','')
        // ");

        // insert order details each row from cart to orderdetails
        $i = 1;
        $j = 1;
        foreach($ProductCode as $P){
            $p = $P->productCode ;
            $Qty = DB::select("select sum(qty) as QTY from cart where productCode like '$p' Group by productCode");
            $pricEach = DB::select("select buyPrice from products where productCode like '$p'");
            $qty = $Qty[0];
            $price = $pricEach[0];
            DB:: insert("
                insert into orderdetails(orderNumber,productCode,quantityOrdered,priceEach,orderLineNumber)
                values ('$x->orderNumber','$P->productCode', '$qty->QTY', '$price->buyPrice', '$i')
            ");
            $i = $i + $j;
        }

        //update point in customer table
        $z = (int)$request->Point;
        $Point = DB::select("select points from customers where customerNumber like '$request->customerNumber'");
        $x = $Point[0];
        $y = $x->points;
        $x = $z+$y;
        DB::update("update customers set points =$x where customerNumber like '$request->customerNumber'");

        $x=json_encode($request->code);
        
            //update qty of promotion in promotion table
            
        DB::update("update promotion set qty =qty-1 where promotionCode like '$request->code'");

        //delete cart
        DB::delete('delete from cart');

         return view('welcome');
    }


    // public function getAdd(){
    //     $address = DB::select("select customerNumber,addressLine1,addressLine2,city,state,postalCode,country from customers");
    //     foreach($address as $A){
    //         // $p = $P->productCode ;
    //         DB:: insert("
    //             insert into addresses(customerNumber,addressLine1,addressLine2,city,state,postalCode,country)
    //             values ('$A->cutomerNumber','$A->addressLine1', '$A->addressLine2', '$A->city', '$A->state','$A->postalCode','$A->couuntry')
    //         ");
    //     }
        
    // }

    public function login(Request $request)
    {
        // getAdd();
        // normal function
        $x = sha1($request->psw);
        $employeekey = DB::select("select * from passwords where employeeNumber like '$request->uname' and passwords like '$x'");
        if($employeekey != null)
        {
            $employeeDetail = DB::select("select * from employees where employeeNumber = '$request->uname' ");
            $emp = json_encode($employeeDetail);
            // $pro = DB::select('select * from promotion');
            // $jsonpro = json_encode($pro);
            // $sale = DB::select("select * from employees ");
            return redirect ('welcome')-> with('firstLogin',$emp);
            //return view(,['userDetail'=>json_encode($employeeDetail),'jsonpro'=>$jsonpro])->with();
        }
        else
        {
            return redirect ('/')-> with('alert', 'wrong username or password');
        }
        $data = DB::select("select employeeNumber from employees");
        $ans= '';
        foreach($data as $a){
            $x = sha1($a->employeeNumber);
            DB::insert("insert into passwords values ($a->employeeNumber, '$x')");
            $ans ++;
        }
        return redirect ('/')-> with('alert', success);
    }
    public function reqSell(Request $request){
        $x = DB::select("select * from employees where employeeNumber = '$request->employeeNumber' and jobTitle like '%'||'Sale'||'%'");
        if($x != null){
            return json_encode($x);
        }else{
            return json_encode('error');
        }
    }
    public function reqPro(Request $request){
        $x = DB::select("select * from employees where employeeNumber = '$request->employeeNumber' and jobTitle like '%'||'VP marketing'||'%'");
        if($x != null){
            return json_encode($x);
        }else{
            return json_encode('error');
        }
    }
    public function getMyEmployee(Request $request){
        $x = DB::select("select * from employees where reportsTo = '$request->employeeNumber'");
        return json_encode($x);
    }
    public function insertProduct(Request $request){
        $pro = DB::select("select * from products where productCode = '$request->pcode'");
        if($pro != null){
            $qtyjson = DB::select("select quantityInStock from products where productCode like '$request->pcode'");
            $qtystring = $qtyjson[0]->quantityInStock;
            $qty = (int)$qtystring+(int)$request->pnumber;
            DB::update("update products set quantityInstock = ? where productCode = ?",
            [$qty,$request->pcode]);
        }else{
            DB::insert("insert into products(productCode,quantityInstock)
            values ('$request->pcode','$request->pnumber')");
        }
        DB::insert("insert into stock(stockNumber,stockDate,productCode,qty)
        values ('$request->snum','$request->pdate','$request->pcode','$request->pnumber')");
        $data = DB::select('select * from products');
        $datastock = DB::select('select * from stock');
        $jsonProduct = json_encode(array($data,$datastock));
        return $jsonProduct;
    }

    public function insertEm(Request $request){
        DB::insert("insert into employees(employeeNumber,lastName,firstName,extension,email,officeCode,reportsTo,jobTitle)
        values ('$request->enumber','$request->elname','$request->efname','$request->eex','$request->eemail','$request->ecode','$request->ere','$request->ejob')");
        $data = DB::select("select * from employees where reportsTo = '$request->er'");
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }
    public function updatePayment(Request $request){
        DB::insert("insert into payments(customerNumber,checkNumber,paymentDate,amount)
        values ('$request->customerNumber','$request->checkNumber','$request->paymentDate','$request->amount')");
        $Payment = DB::select('select * from payments');
        $jsonPayment = json_encode($Payment);
        return $jsonPayment;
    }

    public function insertcus(Request $request){
        DB::insert("insert into customers(customerNumber,customerName,contactLastName,contactFirstName,phone,city,state,postalCode,country,salesRepEmployeeNumber,creditLimit)
        values ('$request->wcusnum','$request->wcompany','$request->wlname','$request->wfname','$request->wphone','$request->wcity','$request->wstate','$request->wpos','$request->wcoun','$request->wsale','$request->wcredit')");
        $data = DB::select('select * from customers');
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }

    public function insertpromotion(Request $request){
        DB::insert("insert into promotion(promotionId,promotionCode,qty,detail,expairDate)
        values ('$request->promid','$request->promcode','$request->promnum','$request->promdetail','$request->promdate')");
        $data = DB::select('select * from promotion');
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }

    public function updateProduct(Request $request,$code){
        DB::update("update products set productName = ?,productScale = ?,productVendor = ?,productDescription = ?,quantityInstock = ?,buyPrice = ? where productCode = ?",
        [$request->pname,$request->pscale,$request->pvendor,$request->pdes,$request->pnumber,$request->pprice,$code]);
        $data = DB::select('select * from products');
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }
    public function updateEm(Request $request,$code){
        $x = DB::select("select reportsTo from employees where employeeNumber = '$code'");
        $x = $x[0]->reportsTo;
        DB::update("update employees set lastName = ?,firstName = ?,extension = ?,email = ?,officeCode = ?,reportsTo = ?,jobTitle = ? where employeeNumber = ?",
        [$request->eln,$request->efn,$request->ee,$request->eem,$request->eof,$request->er,$request->ej,$code]);
        $data = DB::select("select * from employees where reportsTo = '$x'");
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }
    public function updatecus(Request $request,$code){
        DB::update("update customers set customerNumber = ?,customerName = ?,contactLastName = ?,contactFirstName = ?,phone = ?,salesRepEmployeeNumber = ?,creditLimit = ?,point = ? where customerNumber = ?",
        [$request->cusnum,$request->cusname,$request->cusfname,$request->cuslname,$request->cusphone,$request->salerep,$request->cuslimit,$request->cuspoint,$code]);
        $data = DB::select('select * from customers');
        $jsonProduct = json_encode($data);
        return $jsonProduct;
    }
    public function updateship(Request $request,$code){
        DB::update("update orders set shippedDate = ?,status = ?,comments = ? where orderNumber = ?",
        [$request->shipdate,$request->odstatus,$request->shipcom,$code]);
        $data = DB::select('select * from orders');
        $jsonProduct = json_encode($data);
        // $jsonProduct = json_encode(array($data,$addr));
        return $jsonProduct;
    }

    public function shippingaddr($code){

        $a = DB::select("select customerNumber,shippingAddr,billingAddr from orders where orderNumber = '${code}'");
        $order = $a[0];
        $shippingAddr = DB::select("select addressLine1,addressLine2,city,state,postalCode,country from addresses where customerNumber = '$order->customerNumber' and addressNumber = '$order->shippingAddr'");
        $billingAddr = DB::select("select addressLine1,addressLine2,city,state,postalCode,country from addresses where customerNumber = '$order->customerNumber' and addressNumber = '$order->billingAddr'");
        // $jsonProduct = json_encode($data);
        $jsonProduct = json_encode(array($shippingAddr,$billingAddr));
        return $jsonProduct;
    }

    public function shipping(){
        $Order = DB::select('select * from orders');
        $jsonOrder = json_encode($Order);
        return view('shipping',['jsonOrder'=>$jsonOrder]);
    }

    public function payment(){
        $Payment = DB::select('select * from payments');
        $jsonPayment = json_encode($Payment);
        return view('payment',['jsonPayment'=>$jsonPayment]);
    }

    public function promotion(){
        $data = DB::select("delete from promotion where expairDate = date('now','localtime')");
        $pro = DB::select('select * from promotion');
        $jsonpro = json_encode($pro);
        return view('welcome',['jsonpro'=>$jsonpro]);
        return view('welcome');
    }

    public function deleteProduct($code){
        $data = DB::select("delete from products where productCode = '$code'");
        $data2 = DB::select('select * from products');
        return $data2;
    }

    public function deleteEm($code){
        $data = DB::select("select reportsTo from employees where employeeNumber = '$code' ");
        DB::select("delete from employees where employeeNumber = '$code'");
        $data2 = DB::select("select * from employees where reportsTo = '$data'");
        return $data2;
    }

    public function deletecus($code){
        $data = DB::select("delete from customers where customerNumber = '$code'");
        $data2 = DB::select('select * from customers');
        return $data2;
    }

    public function getPromotion(Request $code){
        $qty = DB::select("select qty from promotion where promotionCode like '$code->code'");
        $c = DB::select("select detail from promotion where promotionCode like '$code->code'");
        return [$c,json_encode($qty)];
    }
    public function deletepromotion(){
        $data = DB::select("delete from promotion where expairDate = date('now','localtime') or qty = 0");
        // // $data = DB::select("delete from promotion where expairDate = strftime('%Y-%m-%d',date('now'))");
        $data2 = DB::select('select * from promotion');
        return $data2;
    }
}

