
$(document).ready(function () {


    $("header nav .main_navbar .nav_links").css("top", $("header").height());

    $("#nav_toggle").click(() => {
        $(this).find("i.fa-bars").toggleClass("fa-times");
        $("header nav .main_navbar .nav_links").slideToggle();
    })

    $("#search_toggle").click(() => {
        $(".search_bar").fadeToggle();
    })



    $(".addtocart_btn").click(function () {
        var id = $(this).attr("data-att");
        var cookie = $.cookie('cart_items');

        if (cookie != undefined && cookie != "" && cookie != null) {
            alert("You Can Buy Only 1 Book at a Time!")
        }
        else {
            $.cookie("cart_items", id, { expires: 365 }, { path: '/' });
            swal("Done!", "Your Book Has Been Successfully Added to Cart", "success");
            updateCartProducts();
        }

    })

    $(".freecart_btn").click(function () {
        swal("The Book is already FREE!");
    })

    $(".quiz_btn").click(function () {
        swal("Please Logged In!");
    })


    $(".plan_btn").click(function () {
        var val = $(this).attr("data-name");
        var price = $(this).attr("data-price");
        $.post("includes/plan.inc.php", { name: val, price: price }, function (data) {
            if (data == 0) {
                alert("Failed");
            }
            else if (data == 2) {
                swal("You have already a Membership");
            }
            else {
                //swal("Done!", "You have Successfully Buy a Membership", "success");

                swal("Enter Card Number here:", {
                    content: "input",
                  })
                  .then((value) => {
                    swal("Done!", "You have Successfully Buy a Membership", "success");
                  });
            }
        })
    })


    updateCartProducts();
    function updateCartProducts() {
        var existingCookieData = $.cookie('cart_items');

        if (existingCookieData != undefined && existingCookieData != "" && existingCookieData != null) {
            $("#cart_count").html(existingCookieData.length);
        }
        else {
            $("#cart_count").html(0);
        }


    };







})