function set_service(evt, level) {
    var i, tabcontent, tablinks;
    var ch = parseInt(level.charAt(4));

    for (j = ch + 1; j <= 4; j++) {
        document.getElementById("tab" + j + "btn").disabled = true;

    }

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active");
    }
    document.getElementById(level).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();

$(document).ready(function() {
    $("#add_address").click(function() {
        $('#add_address').hide();
        $('.address_form').show();
    })
    $("#cancel").on("click", function() {
        $('#add_address').show();
        $('.address_form').hide();

    })
});

$(document).ready(function() {

    $("#selected_date").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: "+1d"
    });

    var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();
    var tomorrow_date = year + "-" + month + "-" + day;
    document.querySelector('#booking_date').innerHTML = tomorrow_date;

    $("#selected_date").on("change", function() {
        var selected = $(this).val();
        document.querySelector('#booking_date').innerHTML = selected;
        //alert(selected);
    });
})

$(document).ready(function() {
    var servicetime = $("#servicetime option:selected").val();
    document.querySelector('#basic_time').innerHTML = servicetime;
    document.querySelector('#total_hours').innerHTML = servicetime;
    $("#servicetime").on("change", function() {
        var basic_time = $("#basic_time").text();
        basic_time = parseFloat(basic_time);
        var total_time = $("#total_hours").text();
        total_time = parseFloat(total_time);
        var extra_time = parseFloat(total_time - basic_time);
        var service_time = $("#servicetime option:selected").val();
        service_time = parseFloat(service_time);
        var newtotal_time = service_time + extra_time;
        document.querySelector('#basic_time').innerHTML = service_time;
        document.querySelector('#total_hours').innerHTML = newtotal_time;
        var total_time = $("#total_hours").text();
        total_time = parseFloat(total_time);
        var discount = $("#discount").text();
        discount = parseFloat(discount);
        var price = (service_time * 25) + (extra_time * 30);
        //alert(price);
        var totalpayment = price - discount;
        document.querySelector('#total_price').innerHTML = price;
        document.querySelector('#total_payment').innerHTML = totalpayment;
        document.querySelector('#effective_price').innerHTML = totalpayment;

    });

});


$(document).ready(function() {
    var selectedtime = $("#selectedtime option:selected").text();
    // alert(selectedtime);
    document.querySelector('#booking_time').innerHTML = selectedtime;

    $("#selectedtime").on("change", function() {
        var selected_time = $("#selectedtime option:selected").text();;
        document.querySelector('#booking_time').innerHTML = selected_time;
        //alert(selected);
    });
});

$(document).ready(function() {
    var selectedbed = $("#selectedbed option:selected").val();
    //alert(servicetime);
    document.querySelector('#booking_bed').innerHTML = selectedbed;

    $("#selectedbed").on("change", function() {
        var selected_bed = $("#selectedbed option:selected").val();;
        document.querySelector('#booking_bed').innerHTML = selected_bed;
        //alert(selected);
    });
});

$(document).ready(function() {
    var selectedbath = $("#selectedbath option:selected").val();
    //alert(selectedtime);
    document.querySelector('#booking_bath').innerHTML = selectedbath;

    $("#selectedbath").on("change", function() {
        var selected_bath = $("#selectedbath option:selected").val();;
        document.querySelector('#booking_bath').innerHTML = selected_bath;
        //alert(selected);
    });
});


function extrabtnclick(id, i) {

    if (document.getElementById(id).checked) {
        document.getElementById(id + "Img").src = ("./Asset/image/" + i + "-green.png");
        // alert("extra" + i);
        var extratime = 0;

        document.getElementById("extra" + i).style.display = "block";
        document.getElementById("extra" + i + 1).style.display = "block";
        var total_time = parseFloat(document.getElementById("total_hours").innerHTML);
        document.getElementById("total_hours").innerHTML = total_time + 0.5;
        var total_price = parseFloat(document.getElementById("total_price").innerHTML);
        total_price = total_price + 15;
        document.getElementById("total_price").innerHTML = total_price;
        var discount = parseFloat(document.getElementById("discount").innerHTML);
        total_payment = total_price - discount;
        document.getElementById("total_payment").innerHTML = total_payment;
        document.getElementById("effective_price").innerHTML = total_payment;

    } else {
        document.getElementById(id + "Img").src = ("./Asset/image/" + i + ".png");
        document.getElementById("extra" + i).style.display = "none";
        document.getElementById("extra" + i + 1).style.display = "none";
        var total_time = parseFloat(document.getElementById("total_hours").innerHTML);
        document.getElementById("total_hours").innerHTML = total_time - 0.5;
        var total_price = parseFloat(document.getElementById("total_price").innerHTML);
        total_price = total_price - 15;
        document.getElementById("total_price").innerHTML = total_price;
        var discount = parseFloat(document.getElementById("discount").innerHTML);
        total_payment = total_price - discount;
        document.getElementById("total_payment").innerHTML = total_payment;
        document.getElementById("effective_price").innerHTML = total_payment;
    }
}