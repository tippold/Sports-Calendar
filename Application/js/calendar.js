$(document).ready(function() {

    $("#eventdetail_close").click(function() {
        $("#eventdetail").hide();
        $("#eventdetail-backdrop").hide();
    });

    $(".event_listing").click(function() {

        var request = $.ajax({
            url: "/sportradar/event/eventdetail",
            method: "POST",
            data: {
                eventid: $(this).data('eventid')
            }
        });

        request.done(function(response){
            //console.log(response);
            var event = jQuery.parseJSON(response);
            $("#eventdetail h3").html(event.home_team_name + " - " + event.away_team_name +
                ' <a href="/sportradar/event/edit/'+event.eventid+'"><i class="far fa-edit fa-xs"></i></a>');
            $("#eventdetail .date").html("<b>Date: </b>" + event.date);
            $("#eventdetail .time").html("<b>Start time: </b>" + event.start_time);
            $("#eventdetail .sport").html("<b>Sport: </b>" + event.sport_name);
            $("#eventdetail").show();
            $("#eventdetail-backdrop").show();
        });
    });
});