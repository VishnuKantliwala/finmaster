var busy = false;
var limit = 10;
var offset = 0;

function displayRecords(lim, off, val, sdate, edate) {
    
    $.ajax({
        type: "GET",
        async: false,
        url: "getdocuments.php?val=" + val + "&sdate=" + sdate + "&edate=" + edate,
        data: "limit=" + lim + "&offset=" + off,
        cache: false,
        beforeSend: function () {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
        },
        success: function (html) {

            $("#results").append(html);
            $('#loader_image').hide();
            
            window.busy = false;


        }
    });
}

$("#datewiseSearch").on('click', function() {
	
	var searchval = document.getElementById('textsearch').value;
	var sdate = document.getElementById('from_date').value;
    var edate = document.getElementById('to_date').value;
    offset = 0;

    displayRecords(limit, offset, searchval, sdate, edate);

});

$(document).ready(function () {
    // start to load the first set of data
    if (busy == false) {
        busy = true;
        // start to load the first set of data
        // var searchval = document.getElementById('textsearch').value;
        // var sdate = document.getElementById('from_date').value;
        // var edate = document.getElementById('to_date').value;

        var searchval = "";
        var sdate = "";
        var edate = "";
        
        displayRecords(limit, offset, searchval, sdate, edate);
    }


    $(window).scroll(function () {
        // make sure u give the container id of the data to be loaded in.
        if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
            busy = true;
            offset = limit + offset;


            var searchval = document.getElementById('textsearch').value;
            var sdate = document.getElementById('from_date').value;
            var edate = document.getElementById('to_date').value;
            // this is optional just to delay the loading of data
            setTimeout(function () { displayRecords(limit, offset, searchval, sdate, edate); }, 500);

            // you can remove the above code and can use directly this function
            // displayRecords(limit, offset);

        }
    });

});