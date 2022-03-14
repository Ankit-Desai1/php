function upcoming_service(evt, service) {
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


$(document).ready(function() {
    var vtab_id = 'dashboard_btn';
    var temp_url = new URLSearchParams(window.location.search);
    var new_url = temp_url.toString();
    if (new_url.includes('tablinks=')) {
        var hashtag = new_url.lastIndexOf('=');
        vtab_id = new_url.substring(hashtag + 1, new_url.length);
    }
    document.getElementById(vtab_id).click();
});

document.getElementById('export').addEventListener('click', () => {

    var type = 'xlsx';
    var data = document.getElementById('service_history_data_table');
    var file = XLSX.utils.table_to_book(data, { sheet: "sheet1" });
    XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
    XLSX.writeFile(file, 'ServiceHistory.' + type);
});

$(document).on("click", "#save_details", function() {
    for (i = 1; i < 7; i++) {
        document.getElementById(i + "avtar").style.display = "none";
    }
});