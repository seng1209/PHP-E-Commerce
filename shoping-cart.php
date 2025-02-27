<?php
    require "./admin/lib/ShipmentMethodDB.php";
    $shipmentMethodObj = new ShipmentMethodDB();
    $shippingObj = new Shipping();
    $shipping_id = $image = $shipping_name = $price = $sub_total = $total_price = "";

    $cities = array("Phnom Penh", "Siem Reap", "Battambang", "Banteay Meanchey", "Kandal", "Sihanoukville", "Oddar Meanchey", "Pursat", "Kampong Thom", "Kampong Speu", "Svay Rieng", "Takéo", "Kampong Chhnang", "Kampong Cham", "Prey Veng", "Tboung Khmum", "Kampot", "Ratanakiri", "Koh Kong", "Preah Vihear", "Mondulkiri", "Kep");
?>

<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4"> Shoping Cart </span>
    </div>
</div>

<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">

                        </div>

                        <div
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" onclick="btnRemoveAllItems()">
                            Remove All
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2"> Subtotal: </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2 sub-total"> </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2"> Shipping: </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <div class="p-t-15">
                                <span class="stext-112 cl8"> Calculate Shipping </span>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time">
                                        <option selected disabled>Select a city....</option>
                                        <?php

                                        foreach ($cities as $city) {


                                        ?>
                                            <option value="<?=$city?>"><?=$city?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state"
                                        placeholder="Khan" />
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                                        placeholder="Sangkat" />
                                </div>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode"
                                           placeholder="Village" />
                                </div>

                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time" id="shipping-method">
                                        <option selected disabled>Shipping Methods...</option>
                                        <?php
                                            $shipment_methods = $shipmentMethodObj->readAll();
                                            foreach($shipment_methods as $s){
                                                $shipment_method_id = $s['$shipment_method_id'];
                                                $shipping_name = $s['name'];
                                                $price = $s['price'];
                                        ?>
                                            <option value="<?=$shipment_method_id?>"><?=$shipping_name?>-$<?=$price?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2"> Payment: </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <div class="p-t-15">
                                <span class="stext-112 cl8"> Calculate Payment </span>
                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                    <select class="js-select2" name="time">
                                        <option selected disabled>Select a city....</option>
                                        <?php
                                        foreach ($cities as $city) {
                                            ?>
                                            <option value="<?=$city?>"><?=$city?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2"> Total: </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total-amount">  </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    const updateCartTable = () => {
        const cartListTables = document.getElementsByClassName('table-shopping-cart');
        
        cartListTables.innerHTML = '';
        if (cartListTables.length > 0) {
            const cartListTable = cartListTables[0]; // Select the first element in the collection

            cart.forEach(item => {
                const listTable = document.createElement('tr');
                listTable.classList.add('table_row');

                // column-1
                const tableData1 = document.createElement('td');
                tableData1.classList.add('column-1');
                const itemCart1 = document.createElement('div');
                itemCart1.classList.add('how-itemcart1');
                const imgElement = document.createElement('img');
                imgElement.src = `./admin/uploads/images/products/${item.image}`; // Set the source URL
                imgElement.alt = `${item.image}`; // Set the alt text
                itemCart1.appendChild(imgElement);
                tableData1.appendChild(itemCart1);

                // column-2
                const tableData2 = document.createElement('td');
                tableData2.classList.add('column-2');
                tableData2.textContent = `${item.name}`;

                // column-3 
                const tableData3 = document.createElement('td');
                tableData3.classList.add('column-3');
                tableData3.textContent = `\$${item.price}`;

                // column-4 (if needed, add your code here)
                const tableData4 = document.createElement('td');
                tableData4.classList.add('column-4');
                const wrap = document.createElement('div');
                wrap.classList.add('wrap-num-product', 'flex-w', 'm-l-auto', 'm-r-0');
                const down = document.createElement('div');
                down.classList.add('btn-num-product-down', 'cl8', 'hov-btn3', 'trans-04', 'flex-c-m');
                
                const downIcon = document.createElement('i');
                downIcon.classList.add('fs-16','zmdi','zmdi-minus');
                down.appendChild(downIcon);

                const input = document.createElement('input');
                input.classList.add('mtext-104', 'cl3', 'txt-center', 'num-product');
                input.type = 'number';
                input.name = 'num-product1';
                input.min = 1;
                input.defaultValue = 1;
                input.value = item.qty;

                const up = document.createElement('div');
                up.classList.add('btn-num-product-up', 'cl8', 'hov-btn3', 'trans-04', 'flex-c-m');
                
                const upIcon = document.createElement('i');
                upIcon.classList.add('fs-16', 'zmdi', 'zmdi-plus');
                up.appendChild(upIcon);

                wrap.appendChild(down);
                wrap.appendChild(input);
                wrap.appendChild(up);

                tableData4.appendChild(wrap);

                // column-5
                const tableData5 = document.createElement('td');
                tableData5.classList.add('column-4');
                tableData5.textContent = `\$${(item.qty * item.price).toFixed(2)}`;

                down.onclick = () => {
                    const existProduct = cart.find((p) => p.productId === item.productId);
                    if (existProduct) {
                        if(existProduct.qty > 1){
                            existProduct.qty -= 1;
                            localStorage.setItem('cart', JSON.stringify(cart));
                            updateCart();
                            tableData5.textContent = `\$${(item.qty * item.price).toFixed(2)}`;
                        }
                    }
                }

                up.onclick = () => {
                    const existProduct = cart.find((p) => p.productId === item.productId);
                    if (existProduct) {
                        existProduct.qty += 1;
                        localStorage.setItem('cart', JSON.stringify(cart))
                        updateCart();
                        tableData5.textContent = `\$${(item.qty * item.price).toFixed(2)}`;
                    }
                }

                // remove cloumn
                const tableRemove = document.createElement('td');
                tableRemove.classList.add('column-5')
                const removeIcon = document.createElement('i');
                removeIcon.classList.add('zmdi', 'zmdi-close', 'remove-item-icon');
                tableRemove.appendChild(removeIcon);

                removeIcon.onclick = () => {
                    cart = cart.filter(product => product.productId !== item.productId);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCart();
                }

                // add td to tr
                listTable.appendChild(tableData1);
                listTable.appendChild(tableData2);
                listTable.appendChild(tableData3);
                listTable.appendChild(tableData4);
                listTable.appendChild(tableData5);
                listTable.appendChild(tableRemove);
                // Append the row to the table
                cartListTable.appendChild(listTable);
            });
        } else {
            console.error('No table with class "table-shopping-cart" found.');
        }
        
    }
    updateCartTable();
    const btnRemove = document.querySelector('.remove-item-icon');
    btnRemove.addEventListener('click', () => {
        window.location.reload();
    })

    const btnRemoveAllItems = () =>{
        removeAllItems();
        window.location.reload();
    }

    document.getElementById('shipping-method').onchange = function() {
        const selectedValue = this.value;
        const selectedText = this.options[this.selectedIndex].text;
        // console.log('Selected Shipping Method ID:', selectedValue);
        // console.log('Selected Shipping Method Name:', selectedText);
        const arr = selectedText.split("-");
        // console.log('Shipping Name:', arr[0]);
        // console.log('Shipping Price:', arr[1]);

        const subtotal = document.querySelector('.sub-total');
        // console.log("Sub total:", subtotal.textContent);
        const total_price = parseFloat(subtotal.textContent.replace(/[$,]/g, '')) + parseFloat(arr[1].replace(/[$,]/g, '')) + "";
        document.querySelector('.total-amount').innerHTML = "$" + total_price;
    };

</script>
