/**
  * Created by sharanyanair on 4/24/16.
  */
// Your use of the YouTube API must comply with the Terms of Service:
// https://developers.google.com/youtube/terms


// Helper function to display JavaScript value on HTML page.
        function showResponse(response)
    {
        var responseString = JSON.stringify(response, '', 2);
        document.getElementById('response').innerHTML += responseString;
    }

// Called automatically when JavaScript client library is loaded.
    function onClientLoad() {
        gapi.client.load('youtube', 'v3', onYouTubeApiLoad);
    }

// Called automatically when YouTube API interface is loaded (see line 9).
    function onYouTubeApiLoad() {
        // This API key is intended for use only in this lesson.
        // See https://goo.gl/PdPA1 to get a key for your own applications.
        gapi.client.setApiKey('AIzaSyDZ2FowQR_0TbL2A6Nkfa0h-og_9C4OlAk');

        search();
    }
    //generate random colors for slideshow template of Youtube
    function getRandomColor(val) {
        var colors = ["rgb(222, 244, 93)","coral","rgb(193, 242, 164)","#a9ffd4","#f2d996","#ff9900","#7BAABE","#ccddff"];
        return colors[val];

    }

// Called automatically with the response of the YouTube API request.
    function onSearchResponse(response) {

        function search() {
            // Use the JavaScript client library to create a search.list() API call.
            var request = gapi.client.youtube.videos.list({
                part: 'contentDetails',
                maxResults: "5",
                id: "_V7ZKk-NJVA"

            });

            // Send the request to the API server,
            // and invoke onSearchRepsonse() with the response.
            request.execute(onSearchResponse2);
        }

        function onSearchResponse2(response) {
            // showResponse(response);
            //var videoId = response.items[i].id.videoId;
            var videoDuration= response.items[0].contentDetails.duration;

            var time = videoDuration.split(/[^1-9]/);

            if(time.length == 6) {
                var durationHour = parseInt(time[time.length - 4]) * 3600;
                var durationMin = parseInt(time[time.length - 3]) * 60;
                var durationSec = parseInt(time[time.length - 2]);
            } else if (time.length == 5){
                var durationHour = 0;
                var durationMin = parseInt(time[time.length - 3]) * 60;
                var durationSec = parseInt(time[time.length - 2]);
            } else {
                var durationHour = 0;
                var durationMin = 0;
                var durationSec = parseInt(time[time.length - 2]);
            }
            var duration = durationHour + durationMin + durationSec;

            document.getElementById('response').innerHTML += duration ;
        }

        //showResponse(response);
        for (var i = 0; i < 50; i++) {

            if (response.items[i].id.kind == "youtube#video") {
                var videoId = response.items[i].id.videoId;
                var title = response.items[i].snippet.title;
                var time = response.items[i].snippet.publishedAt;
                var channel = response.items[i].snippet.channelTitle;
                var entry = "<div class=\"section\" style=\" height: 745px;background-color:" +getRandomColor(i%7)+"\" id=\"data\"><div class=\"intro\" style=\"padding-top: 5%;padding-bottom: 5%;\"" +
                    "><iframe width=\"800\" height=\"515\" src=\"https://www.youtube.com/embed/"+videoId+ "\" frameborder=\"0\" allowfullscreen></iframe>\
                    <blockquote style=\"margin: 0 0 5% 25%;\">"+title+"<br> <h4 style=\"text-align: right;padding-right: 0px;\"> &mdash;" +channel+ "</h4></blockquote>\
            </div></div>";

                document.getElementById('response').innerHTML += entry ;
            }
        }

    }
