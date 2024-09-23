{{-- Add Update transaksi Modal --}}

<!-- Modal toggle -->
{{--
<button
    data-modal-target="update-transaksi-modal"
    data-modal-toggle="update-transaksi-modal"
    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button"
>
    Update Record Transaksi
</button>
--}}

<!-- Main modal -->
<div
    id="update-transaksi-modal"
    tabindex="-1"
    aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button
                type="button"
                class="hide-modal absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="hide-transaksi-modal"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3
                    class="mb-4 text-xl font-medium text-gray-900 dark:text-white"
                >
                    Update Record Transaksi
                </h3>
                <ul id="updateform_errList"></ul>
                <form class="space-y-6" action="#">
                    <input
                        type="hidden"
                        id="edit_keranjang_id"
                        name="edit_keranjang_id"
                    />
                    <div>
                        <label
                            for="edit_product_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Product Name</label
                        >
                        <select
                            id="{{ 'edit_product_id_'.$id }}"
                            data-id="{{ $id }}"
                            name="edit_product_id"
                            class="select-edit-product bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            @foreach($products as $product)
                            @if(old('edit_product_id') == $product->id)
                            <option value="{{ $product->id }}" selected>
                                {{ $product->name }}
                            </option>
                            @else
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                            {{--
                            <option value="{{ $cart->id }}">
                                {{ $cart->product->name }}
                            </option>
                            --}} @endif @endforeach
                            <option></option>
                        </select>
                    </div>
                    {{--
                    <div>
                        <label
                            for="qty"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Quantity</label
                        >
                        <input
                            type="number"
                            name="edit_qty"
                            id="qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required
                        />
                    </div>
                    --}}
                    <div>
                        <label
                            for="subtotal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Harga</label
                        >
                        <input
                            type="number"
                            name="edit_subtotal"
                            id="subtotal"
                            class="subtotal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required
                            readonly
                        />
                    </div>
                    {{--
                    <div>
                        @foreach ($products as $product)
                        <input
                            type="hidden"
                            name="price"
                            value="{{ $product->price }}"
                        />

                        @endforeach
                    </div>
                    --}}
                    <button
                        type="submit"
                        id="update_transaksi"
                        class="update_transaksi w-full text-white bg-blue hover:bg-blue focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const url = window.location.href;
        const site = "mas-pos.test";
        const route = "/record/transaksi/";
        let id = parseInt(
            url.replace(/^https?:\/\//, "").replace(site + route, "")
        );
        // console.log('id transaksi:'+id);
        fetchData();
        function fetchData() {
            $.ajax({
                type: "GET",
                url: "/record/keranjang/" + id,
                dataType: "json",
                success: function (response) {
                    console.log(response.keranjangs);
                    $("tbody").html("");

                    $.each(response.keranjangs, function (key, item) {
                        let keyy = key + 1;
                        console.log(item.id);
                        // $('tfoot').hide();
                        // $('.pricexx').hide();
                        $("tbody").append(
                            '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">\
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                                keyy +
                                '</td>\
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                                item.product.name +
                                '</td>\
                                <td class="px-6 py-4"><div class="flex items-center space-x-3"><button data-id="' +
                                item.id +
                                '" class="minus-button changeQuantity inline-flex items-center p-1 m-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button"><img class="w-8" src="{{ asset('img/minus.png') }}" alt=""></button><input type="number" id="product-quantity-' +
                                item.id +
                                '" name="qty" class="qty-input w-14 text-sm rounded-lg block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="' +
                                item.qty +
                                '" required><button data-id="' +
                                item.id +
                                '" class="changeQuantity plus-button inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button"><img class="w-8" src="{{ asset('img/plus.png') }}" alt=""></button></div></td>\
                                <td class="total-price px-6 py-4" id="total-price' +
                                item.id +
                                '">Rp. ' +
                                Intl.NumberFormat("en-US", {
                                    style: "decimal",
                                }).format(item.subtotal) +
                                '</td>\
                                <td class="px-6 py-4"><button data-modal-toggle="update-transaksi-modal" data-keranjang="' +
                                item.id +
                                '" value="' +
                                item.id +
                                '" type="button" class="edit-keranjang text-white bg-sky-300 hover:bg-blue focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-900">Edit</button></td>\
                                <td class="harga" id="harga">' +
                                item.product.price +
                                "</td>\
                            </tr>\
                            "
                        );
                        $(".harga").hide();
                        // $('.subtotal').hide();
                    });

                    function changePrice(total, id) {
                        const target = "#total-price" + id;
                        $(target).html(
                            "Rp. " +
                                Intl.NumberFormat("en-US", {
                                    style: "decimal",
                                }).format(total)
                        );
                    }

                    function grandTotal(id) {
                        const data = $(".total-price");
                        console.log("idnya grandtotal:" + id);
                        // console.log('data-length'+data.length);
                        let total = 0;
                        for (x = 0; x < data.length; x++) {
                            const target = "#" + data[x]["id"];
                            // console.log(target);
                            const value = parseInt(
                                $(target)
                                    .text()
                                    .replace(/^\D+/g, "")
                                    .replace(",", "")
                                    .replace(".", "")
                            );
                            total += value;
                        }

                        $("#grandtotal").html(
                            "Rp. " +
                                Intl.NumberFormat("en-US", {
                                    style: "decimal",
                                }).format(total)
                        );

                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        $.ajax({
                            url: "/modal/grandtotal/" + id,
                            type: "PUT",
                            data: { total: total },
                            dataType: "json",
                            success: function (response) {},
                        });
                    }

                    $(".plus-button").on("click", function () {
                        const url = window.location.href;
                        const site = "mas-pos.test";
                        const route = "/record/transaksi/";
                        let transaksiId = parseInt(
                            url
                                .replace(/^https?:\/\//, "")
                                .replace(site + route, "")
                        );
                        // console.log('transaksiId:'+transaksiId);
                        const quantityInput = $(this)
                            .parent()
                            .find(".qty-input");
                        const harga = $("#harga").text();
                        const hargaBarang = parseInt(harga);
                        const id = $(this).data("id");
                        const productQuantity = $("#product-quantity-" + id);
                        const newQuantity = parseInt(quantityInput.val()) + 1;
                        const total = newQuantity * hargaBarang;
                        productQuantity.val(newQuantity);
                        console.log("id:", id);
                        console.log("product-quantity:", productQuantity);
                        console.log("quantity", newQuantity);

                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        $.ajax({
                            url: "/update/quantity-transaksi/" + id,
                            method: "PUT",
                            data: { quantity: newQuantity },
                            dataType: "json",
                            success: function (response) {
                                changePrice(response.total, response.data.id);
                                grandTotal(transaksiId);
                                // console.log('aaaaaaa'+transaksiId);
                                // console.log(response);
                            },
                            error: function (response) {
                                var errors = response.responseJSON;
                                console.log(errors);
                            },
                        });
                    });

                    $(".minus-button").on("click", function () {
                        const url = window.location.href;
                        const site = "mas-pos.test";
                        const route = "/record/transaksi/";
                        let transaksiId = parseInt(
                            url
                                .replace(/^https?:\/\//, "")
                                .replace(site + route, "")
                        );
                        const quantityInput = $(this)
                            .parent()
                            .find(".qty-input");
                        const harga = $("#harga").text();
                        const hargaBarang = parseInt(harga);
                        const id = $(this).data("id");
                        const productQuantity = $("#product-quantity-" + id);
                        const newQuantity =
                            parseInt(quantityInput.val()) - 1 >= 1
                                ? parseInt(quantityInput.val()) - 1
                                : 1;
                        const total = newQuantity * hargaBarang;
                        productQuantity.val(newQuantity);
                        console.log("id:", id);
                        console.log("quantity:", productQuantity);
                        // const newQuantity =
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                        });

                        $.ajax({
                            url: "/update/quantity-transaksi/" + id,
                            method: "PUT",
                            data: { quantity: newQuantity },
                            dataType: "json",
                            success: function (response) {
                                changePrice(response.total, response.data.id);
                                grandTotal(transaksiId);
                                // console.log(response);
                            },
                            error: function (response) {
                                var errors = response.responseJSON;
                                console.log(errors);
                            },
                        });
                    });
                },
            });
        }

        function changePrice(id, product_id, price) {
            if (id == product_id) {
                $('input[name="edit_subtotal"]').val(price);
            }
        }

        $(document).on("change", ".select-edit-product", function (e) {
            let id = $(this).val();
            let product_id = $('select[name="edit_product_id"]').val();

            $.ajax({
                url: "/modal/price/" + id,
                type: "GET",
                data: { id: id },
                dataType: "json",
                success: function (response) {
                    changePrice(id, product_id, response.data.price);
                },
            });
        });

        $(document).on("click", ".edit-keranjang", function (e) {
            e.preventDefault();
            let keranjang_id = $(this).val();
            // console.log('aaaa', keranjang_id);
            let product_id = $(this).data("keranjang");
            // console.log('aaa'+product_id);
            $("#update-transaksi-modal").show();
            $.ajax({
                type: "GET",
                url: "/record/keranjang/" + product_id + "/edit",
                success: function (response) {
                    console.log(response.cart);
                    if (response.status == 404) {
                        $("#success_message").html("");
                        $("#success_message").addClass(
                            "flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        );
                        $("#success_message").text(response.message);
                    } else {
                        $('select[name="edit_product_id"]').val(
                            response.cart.product_id
                        );
                        $('input[name="edit_qty"]').val(
                            parseInt(response.cart.qty)
                        );
                        $('input[name="edit_subtotal"]').val(
                            parseInt(response.product)
                        );
                        $('input[name="edit_keranjang_id"]').val(product_id);
                    }
                },
            });
        });
        $(document).on("click", ".hide-modal", function (e) {
            e.preventDefault();
            $("#update-transaksi-modal").hide();
        });

        function grandTotal(id) {
            const data = $(".total-price");
            // console.log('idnya grandtotal:'+id);
            // console.log('data-length'+data.length);
            let total = 0;
            for (x = 0; x < data.length; x++) {
                const target = "#" + data[x]["id"];
                // console.log(target);
                const value = parseInt(
                    $(target)
                        .text()
                        .replace(/^\D+/g, "")
                        .replace(",", "")
                        .replace(".", "")
                );
                total += value;
            }

            $("#grandtotal").html(
                "Rp. " +
                    Intl.NumberFormat("en-US", { style: "decimal" }).format(
                        total
                    )
            );

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            $.ajax({
                url: "/modal/grandtotal/" + id,
                type: "PUT",
                data: { total: total },
                dataType: "json",
                success: function (response) {},
            });
        }

        $(document).on("click", ".update_transaksi", function (e) {
            e.preventDefault();
            $(this).text("Updating");
            const url = window.location.href;
            const site = "mas-pos.test";
            const route = "/record/transaksi/";
            let transaksiId = parseInt(
                url.replace(/^https?:\/\//, "").replace(site + route, "")
            );
            let keranjang_id = $('input[name="edit_keranjang_id"]').val();
            console.log(keranjang_id);
            function changePrice(total, id) {
                const target = "#total-price" + id;
                $(target).html(
                    "Rp. " +
                        Intl.NumberFormat("en-US", { style: "decimal" }).format(
                            total
                        )
                );
            }
            let data = {
                product_id: $('select[name="edit_product_id"]')
                    .find(":selected")
                    .val(),
                //     // 'qty': $('input[name="edit_qty"]').val(),
                subtotal: $('input[name="edit_subtotal"]').val(),
            };
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "PUT",
                url: "/record/keranjang/" + keranjang_id,
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log("hasil", response);

                    if (response.status == 400) {
                        $("#updatetransaksi_errList").html("");
                        $("#updatetransaksi_errList").addClass(
                            "flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                        );
                        $.each(response.errors, function (key, err_values) {
                            $("#updatetransaksi_errList").append(
                                "<li>" + err_values + "</li>"
                            );
                        });

                        $(".update_transaksi").text("Update");
                    } else if (response.status == 404) {
                        $("#updatetransaksi_errList").html("");
                        $("#success_message").addClass("alert alert-success");
                        $("#success_message").text(response.message);
                        $(".update_transaksi").text("Update");
                    } else {
                        $("#updatetransaksi_errList").html("");
                        $("#success_message").html("");
                        $("#success_message").addClass(
                            "flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        );
                        $("#success_message").text(response.message);
                        $("#update-transaksi-modal").hide();
                        $("#update_transaksi").text("Update");
                        fetchData();
                        changePrice(response.total, response.data.id);
                        grandTotal(transaksiId);
                        $("#exampleModal").find("trix-editor").val("");
                        $("#exampleModal").find("select").val(1);
                    }
                },
            });
        });
    });
</script>
