function login() {
    var user = jQuery(".formLogin input[name='user']").val();
    var pass = jQuery(".formLogin input[name='pass']").val();
    var data = {"user": user, "pass" : pass};

    jQuery.ajax({
        type: "POST",
        url: "/controllers/login.php",
        data: data,
        success: function (response) {
            window.location.reload();
        },
        error: function (response) {
            console.log(response);
        }
    });

}

function register() {
    var user = jQuery(".formRegister input[name='user']").val();
    var pass = jQuery(".formRegister input[name='pass']").val();
    var email = jQuery(".formRegister input[name='email']").val();
    var data = {"user": user, "pass" : pass,"email": email};

    jQuery.ajax({
        type: "POST",
        url: "/controllers/register.php",
        data: data,
        success: function (response) {
            jQuery("#main").load("/index.php",function(){
                customers();
            });
            setTimeout(function(){jQuery(".login").prepend(response);}, 300);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });

}

function goTo(e) {
    jQuery("#main").load("/modules/"+e+".php", function () {
        window[e]();
    });
}


function customers() {
    jQuery(".modal-trigger").click(function () {
        var id = jQuery(this).attr("href");
        jQuery(".modal").load("/components/customers/newCustomer.php",function () {
            closeModal();
        });
        jQuery(id).show();
    });

}

function closeModal() {
    jQuery(document).keydown(function(e) {
        if (e.keyCode === 27) {
            jQuery("#close").parent().parent().hide("fast");
        }
    });
    jQuery("#close").click(function() {
        jQuery(this).parent().parent().hide();
    });

}

function newCustomer() {
    var error = false;
    jQuery("input").each(function(){
        var val = jQuery(this).val();
        if(val.length <= 0 ){
            jQuery(this).attr("style","border-bottom: 2px solid red");
            jQuery(this).attr("error", true);
        } else {
            jQuery(this).attr("error", false);
        }
    });


    jQuery("input").each(function(){
        var val = jQuery(this).attr("error");
        if (val == "true"){
            console.log(val);
            throw new Error();
        }

    });
    var fullName = jQuery("input[name='fullName']").val();
    var address = jQuery("input[name='address']").val();
    var city = jQuery("input[name='city']").val();
    var country = jQuery("input[name='country']").val();
    var cp = jQuery("input[name='cp']").val();
    var nif = jQuery("input[name='nif']").val();
    var mail = jQuery("input[name='mail']").val();
    var phone = jQuery("input[name='phone']").val();

    var data = {"action": "newCustomer","fullName": fullName, "address": address, "city": city, "country": country, "cp": cp, "nif": nif, "phone": phone, "mail": mail};

    jQuery.ajax({
        type: "POST",
        url: "/controllers/customers.php",
        data: data,
        success: function (response) {
            jQuery("#close").click();
            jQuery("#main").load("/modules/customers.php",function(){
                customers();
            });
            setTimeout(function(){jQuery(".module").prepend(response);}, 300);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }

    });
}

function modalDeleteUser(e){
    var id = jQuery(e).attr("customer");
    var fullName = jQuery(e).parent().parent().children("td[name='fullName']").html();
    jQuery.ajax({
        type: "POST",
        url: "/components/customers/deleteCustomer.php",
        data: {"id": id, "fullName": fullName},
        success: function(response){
            var res = response.replace("[[fullName]]", fullName);
            jQuery(".modal").html(res);
            jQuery("a[goTo='close']").click(function () {
                jQuery(this).parent().hide();
            });
            closeModal();
        }
    });
    jQuery(".modal").show();

}

function deleteUser(e){
    jQuery.ajax({
        type: "POST",
        url: "/controllers/customers.php",
        data: {"action": "deleteCustomer", "id": e},
        success: function (response) {
            jQuery("#close").click();
            jQuery("#main").load("/modules/customers.php",function(){
                customers();
            });
            setTimeout(function(){jQuery(".module").prepend(response);}, 300);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function editCustomer(e){
    var id = jQuery(e).attr("customer");
    jQuery.ajax({
        type: "POST",
        url: "/components/customers/editCustomer.php",
        data: {"id": id},
        success: function (response) {
            jQuery(".modal").html(response);
            jQuery(".modal").show();
            jQuery("a[goTo='close']").click(function () {
                jQuery(this).parent().hide();
            });
            closeModal();
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function saveCustomer(e){

    var fullName = jQuery("input[name='fullName']").val();
    var address = jQuery("input[name='address']").val();
    var city = jQuery("input[name='city']").val();
    var country = jQuery("input[name='country']").val();
    var cp = jQuery("input[name='cp']").val();
    var nif = jQuery("input[name='nif']").val();
    var mail = jQuery("input[name='mail']").val();
    var phone = jQuery("input[name='phone']").val();

    var data = {"action": "saveCustomer","fullName": fullName, "address": address, "city": city, "country": country, "cp": cp, "nif": nif, "phone": phone, "mail": mail,"id": e};
    jQuery.ajax({
        type: "POST",
        url: "/controllers/customers.php",
        data: data,
        success: function (response) {
            jQuery("#main").load("/modules/customers.php");
            setTimeout(function(){jQuery(".module").prepend(response);}, 100);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}



function logout(){
    jQuery.ajax({
        type: "POST",
        url: "/controllers/logout.php",
        data: {"action":"logout"},
        success: function (response) {
            window.location.reload();
        },
        error: function (response) {
            console.log(response);
        }
    });
}


function saveProfile(e){

    var fullName = jQuery("input[name='fullName']").val();
    var phone = jQuery("input[name='phone']").val();
    var email = jQuery("input[name='mail']").val();
    var address = jQuery("input[name='address']").val();
    var city = jQuery("input[name='city']").val();
    var country = jQuery("input[name='country']").val();
    var cp = jQuery("input[name='cp']").val();
    var nif = jQuery("input[name='nif']").val();
    var prefixInv = jQuery("input[name='prefixInv']").val();
    var rate = jQuery("input[name='rate']").val();
    var yearInv = jQuery("select[name='yearInv']").val();

    var data = {"action": "saveProfile","fullName": fullName, "address": address, "city": city, "country": country, "cp": cp, "nif": nif, "phone": phone, "email": email,"id": e, "prefixInv": prefixInv, "yearInv": yearInv, "rate": rate};

    jQuery.ajax({
        type: "POST",
        url: "/controllers/profile.php",
        data: data,
        success: function (response) {
            jQuery("#main").load("/modules/myProfile.php");
            setTimeout(function(){jQuery(".module").prepend(response);}, 100);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}
function invoice(){
    jQuery(".modal-trigger").click(function () {
        var id = jQuery(this).attr("href");
        jQuery(".modal").load("/components/invoices/newInvoice.php",function () {
            closeModal();
        });
        jQuery(id).show();
    });
}

function moreDetail(){
    var detail = jQuery("div[copy='copy']").html();
    var i = jQuery("input[name='idElement']").val();
    var e = parseInt(i)+1;
    jQuery("input[name='idElement']").attr("value",e);
    var res = detail.replace('style="display: none;"', detail);
    var res = detail.replace('value="1"', 'value="'+e+'"');
    jQuery(".detailsInvoice").append('<div class="row" detail="row">'+res+"</div>");
}

function removeDetail(){
    jQuery(".detailsInvoice").find("div[detail='row']:last-child").remove();

    var i = jQuery("input[name='idElement']").val();
    var e = parseInt(i)-1;
    jQuery("input[name='idElement']").attr("value",e);
}

function newInvoice(){
    var customerId = jQuery("select[name='customer'] option:selected").attr("idcustomer");
    var rate = jQuery("input[name='rate']").val();
    var comment = jQuery("textarea[name='comment']").val();
    var details = [];
    var i = 1;
    jQuery("div[detail='row']").each(function () {
        if(jQuery(this).attr("copy")){
            return;
        }
        var quantity = jQuery(this).find("input[name='quantity']").val();
        var detail = jQuery(this).find("input[name='detail']").val();
        var price = jQuery(this).find("input[name='price']").val();
        details[i] = {"quantity" : quantity, "detail": detail, "price": price};
        i = i+1;
    });

    data = {"action": "newInvoice","customerId": customerId, "rate": rate, "details": details, "comment": comment};
    jQuery.ajax({
        type: "POST",
        url: "/controllers/invoice.php",
        data: data,
        success: function (response) {
            jQuery("#main").load("/modules/invoice.php", function () {
                invoice();
            });
            setTimeout(function(){jQuery(".module").prepend(response);}, 100);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function recalculate(){
    jQuery("input[name='totals']").attr("value","0 €");
    jQuery("div[detail='row']").each(function () {
        var price = jQuery(this).find("input[name='price']").val();
        var quantity = jQuery(this).find("input[name='quantity']").val();

        if(price == ""){
            return true;
        }

        var price = parseFloat(price) * parseFloat(quantity);

        var current = jQuery("input[name='totals']").val();
        var current = current.replace(" €", "");
        var current = parseFloat(current);

        var now = current + price;
        jQuery("input[name='totals']").attr("value",now+ " €");

    });


    var totals = jQuery("input[name='totals']").val();
    var totals = totals.replace(" €", "");
    var totals = parseFloat(totals);
    var priceIva = totals * 0.21;
    jQuery("input[name='rateTotal']").attr("value",priceIva + " €");

    var totalFra = priceIva + totals;
    jQuery("input[name='totalFra']").attr("value",totalFra + " €");

}

function modalDeleteInvoice(e){
    var id = jQuery(e).attr("invoice");
    var fullName = jQuery(e).parent().parent().children("td[name='date']").html();
    jQuery.ajax({
        type: "POST",
        url: "/components/invoices/deleteInvoice.php",
        data: {"id": id, "fullName": fullName},
        success: function(response){
            var res = response.replace("[[fullName]]", fullName);
            jQuery(".modal").html(res);
            jQuery("a[goTo='close']").click(function () {
                jQuery(this).parent().hide();
            });
            closeModal();
        }
    });
    jQuery(".modal").show();

}

function deleteInvoice(e){

    jQuery.ajax({
        type: "POST",
        url: "/controllers/invoice.php",
        data: {"action": "deleteInvoice", "id": e},
        success: function (response) {
            jQuery("#close").click();
            jQuery("#main").load("/modules/invoice.php",function(){
                customers();
            });
            setTimeout(function(){jQuery(".module").prepend(response);}, 300);
            setTimeout(function(){
                jQuery("#notice").hide("slow");
            },1500);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function editInvoice(e){
    var id = jQuery(e).attr("customer");
    jQuery.ajax({
        type: "POST",
        url: "/components/invoices/editInvoice.php",
        data: {"id": id},
        success: function (response) {
            jQuery(".modal").html(response);
            jQuery(".modal").show();
            jQuery("a[goTo='close']").click(function () {
                jQuery(this).parent().hide();
            });
            closeModal();
        },
        error: function (response) {
            console.log(response);
        }
    });
}
