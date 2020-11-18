var tableproduct = "<br><br><br>";
function showProduct() {
//updateProductList = showProduct(json,true,false)
                //updateProductOrderList = showProduct(json,false,true)
                    // var i = 0;
        tableproduct = '<br><br><br>';
                    // json.forEach(function (a) {
        console.log("showproduct Starting")
        tableproduct += `<thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">PRODUCT</th>
            <th scope="col">IN-STOCK</th>
            <th scope="col">PRICE</th>
            <th scope="col">SALES</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row" class="align-middle">356121</th>
            <td class="align-middle"><img src="pic/product1.jpg" class="product-pic"> Bathing Shampoo</td>
            <td class="align-middle">451</td>
            <td class="align-middle">$654</td>
            <td class="align-middle">822</td>
            <td class="align-middle"><button class="btn btn-outline-secondary">Order</button></td>
        </tr>
        <tr>
            <th scope="row" class="align-middle">356122</th>
            <td class="align-middle"><img src="pic/product2.jpg" class="product-pic"> Running Shoes</td>
            <td class="align-middle">0</td>
            <td class="align-middle">$654</td>
            <td class="align-middle">700</td>
            <td class="align-middle">
                <button class="btn btn-outline-danger">Out-of-stock</button>
                <button class="btn btn-outline-success">Pre-order</button>
            </td>
        </tr>
        <tr>
            <th scope="row" class="align-middle">356123</th>
            <td class="align-middle"><img src="pic/product3.jpg" class="product-pic"> Toilet Papers</td>
            <td class="align-middle">560</td>
            <td class="align-middle">$654</td>
            <td class="align-middle">500</td>
            <td class="align-middle"><button class="btn btn-outline-secondary">Order</button></td>
        </tr>
    </tbody>`
        // if (editable === true) {
        //     tableproduct += `<button href="#" onclick="PopUpProduct('${a.productCode}',true)" class="btn amado-btn qty-btn">Edit</button>`;
        // }
        // if (orderable === true) {

        //     tableproduct += `
        // <div class="d-flex" class="btn amado-btn">
        //     <div style="width:20%;margin:15px 0px">
        //         <span class="qty-minus" onclick="var effect = document.getElementById('qty${i}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
        //         <input class="setZero" style="width:20%" id="qty${i}" step="1" min="0" max="300" name="quantity" value="0">
        //         <span class="qty-plus" onclick="var effect = document.getElementById('qty${i}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
        //     </div>
        //     <button href="#" onclick="AddToCart(document.getElementById('orderId').value,'${a.productName}','${a.buyPrice}', '${a.productCode}', document.getElementById('qty${i}').value,'qty${i}')" class="btn amado-btn" style="margin:0px">Buy</button>
        // </div>`;
        //     i++;
        // }
        tableproduct += `</div>`;
    // });
    console.log(tableproduct)
    document.getElementById("productArea").innerHTML = tableproduct;
}


