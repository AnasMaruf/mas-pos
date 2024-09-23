@extends('layouts.mainDashboard') @section('container') @if(empty($cart) ||
count($cart) == 0)
<h1 class="text-center text-3xl mt-40 text-red-600">
    Tidak ada product di cart
</h1>
<div class="relative flex mx-auto my-5">
    <a
        href="/"
        class="text-blue bg-white border-2 border-blue hover:bg-blue hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 mx-auto mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >Back to Home</a
    >
</div>
@else
<div class="relative mx-24 mt-5">
    <table class="w-full text-sm text-center text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-white">
            <tr class="border-b-2">
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ID</span>
                </th>
                <th scope="col" class="px-4 py-3">Product</th>
                <th scope="col" class="py-3">
                    <span class="sr-only">image</span>
                </th>
                <th scope="col" class="px-6 py-3">Qty</th>
                <th scope="col" class="px-6 py-3">Price</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody class="border-b-2">
            <?php $grandtotal=0; ?>
            @foreach($cart as $ct=>$val)
            <?php
            $subtotal= $val['price'] * $val['qty'];
            ?>
            <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cartpage"
            >
                <td
                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white"
                >
                    {{ $loop->iteration }}
                </td>
                <td class="w-32 p-4">
                    <img
                        src="{{ asset('storage/'.$val['image']) }}"
                        alt="Apple Watch"
                    />
                </td>
                <td
                    class="px-6 py-4 font-semibold text-gray-900 dark:text-white text-left"
                >
                    <h4 id="name">{{ $val["name"] }}</h4>
                    <h4 id="harga">Rp. {{ number_format($val["price"]) }}</h4>
                </td>
                <td class="pl-28 py-4">
                    {{--
                    <input
                        type="hidden"
                        class="product_id"
                        value="{{ $val['id'] }}"
                    />
                    --}}
                    <div class="flex items-center space-x-3">
                        <button
                            data-id="{{ $val['id'] }}"
                            class="minus-button changeQuantity inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button"
                        >
                            <img
                                class="w-8"
                                src="{{ asset('img/minus.png') }}"
                                alt=""
                            />
                        </button>
                        <input
                            type="number"
                            id="product-quantity-{{ $val['id'] }}"
                            name="qty"
                            class="qty-input w-14 text-sm rounded-lg block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $val['qty'] }}"
                            required
                        />
                        <button
                            data-id="{{ $val['id'] }}"
                            class="changeQuantity plus-button inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                            type="button"
                        >
                            <img
                                class="w-8"
                                src="{{ asset('img/plus.png') }}"
                                alt=""
                            />
                        </button>
                    </div>
                </td>
                <td
                    id="{{ 'total-price'.$val['id'] }}"
                    class="total-price px-6 py-4 font-semibold text-gray-900 dark:text-white"
                >
                    Rp. {{ number_format($subtotal) }}
                </td>
                <td class="px-6 py-4">
                    <a
                        href="{{ url('/cart/hapus/'.$ct) }}"
                        class="font-medium text-white bg-red-600 hover:bg-red-800 p-3 rounded-md"
                        >Remove Item</a
                    >
                </td>
            </tr>
            <?php
                $grandtotal += $subtotal;
                // number_format($grandtotal)
            ?>
            @endforeach
        </tbody>

        <tfoot>
            <tr class="font-semibold text-gray-900 dark:text-white">
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ID</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ID</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ID</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">ID</span>
                </th>
                <th scope="row" class="px-6 py-3 text-base">Total</th>
                <td id="grandtotal" class="px-6 py-3">
                    Rp. {{ number_format($grandtotal) }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-20">
        <a
            href="/transaksi/tambah"
            type="button"
            class="text-white bg-blue float-right hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-3 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            >Pay Bill</a
        >
        <a
            href="/"
            class="text-blue bg-white float-right border-2 border-blue hover:bg-blue hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >Back to Home</a
        >
    </div>
</div>
<script>
    function changePrice(newQuantity, harga, id) {
        const hargaBarang = parseInt(harga);
        const total = newQuantity * hargaBarang;
        const target = "#total-price" + id;
        // console.log(target);
        $(target).html(
            "Rp. " +
                Intl.NumberFormat("en-US", { style: "decimal" }).format(total)
        );
    }

    function grandtotal() {
        const data = $(".total-price");
        let total = 0;
        for (x = 0; x < data.length; x++) {
            const target = "#" + data[x]["id"];
            console.log(target);
            const value = parseInt(
                $(target)
                    .text()
                    .replace(/^\D+/g, "")
                    .replace(",", "")
                    .replace(".", "")
            );
            // console.log(value);
            total += value;
        }
        // console.log(total);
        $("#grandtotal").html(
            "Rp. " +
                Intl.NumberFormat("en-US", { style: "decimal" }).format(total)
        );
    }

    $(".plus-button").on("click", function () {
        const quantityInput = $(this).parent().find(".qty-input");
        const harga = $("#harga").text();
        const id = $(this).data("id");
        const productQuantity = $("#product-quantity-" + id);
        const newQuantity = parseInt(quantityInput.val()) + 1;
        productQuantity.val(newQuantity);
        console.log("id:", id);
        console.log("quantity:", newQuantity);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/cart/increment-decrement/" + id,
            method: "POST",
            data: { id: id, quantity: newQuantity },
            dataType: "json",
            success: function (response) {
                changePrice(
                    response.data.qty,
                    response.data.price,
                    response.data.id
                );
                grandtotal();
                console.log(response);
            },
        });
    });

    $(".minus-button").on("click", function () {
        const quantityInput = $(this).parent().find(".qty-input");
        const harga = $("#harga").text();
        const id = $(this).data("id");
        const productQuantity = $("#product-quantity-" + id);
        const newQuantity =
            parseInt(quantityInput.val()) - 1 >= 1
                ? parseInt(quantityInput.val()) - 1
                : 1;
        productQuantity.val(newQuantity);
        console.log("id:", id);
        console.log("quantity:", productQuantity);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/cart/increment-decrement/" + id,
            method: "POST",
            data: { id: id, quantity: newQuantity },
            dataType: "json",
            success: function (response) {
                changePrice(
                    response.data.qty,
                    response.data.price,
                    response.data.id
                );
                grandtotal();
                console.log(response);
            },
            error: function (response) {
                var errors = response.responseJSON;
                console.log(errors);
            },
        });
    });
</script>
@endif @endsection
