$(document).ready(function() {

    $("#start_date").datepicker({
        dateFormat: "yy-mm-dd",
        showOn: 'button',
        buttonImageOnly: true,
        buttonImage: './Asset/image/admin-calendar-blue.png'
    });

    $("#end_date").datepicker({
        dateFormat: "yy-mm-dd",
        showOn: 'button',
        buttonImageOnly: true,
        buttonImage: './Asset/image/admin-calendar-blue.png'
    });

    $("#serviceDate").datepicker({
        dateFormat: "yy-mm-dd",
    });

})

function admin(evt, service) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(service).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultopen").click();