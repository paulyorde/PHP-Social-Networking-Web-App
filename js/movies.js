$(function(){

    var apikey = "fyj7sad29c25w5f638av47td";
    var baseUrl = "http://api.rottentomatoes.com/api/public/v1.0";
    var moviesSearchUrl = baseUrl + '/lists/movies/in_theaters.json?apikey=' + apikey;

    $(document).ready(function() {

        $.ajax({

            url: moviesSearchUrl,
            dataType: "jsonp",
            success: searchCallback
        });
    });


    function searchCallback(data) {

        var movies = data.movies;
        var movieData = '<ul>';

        $.each(movies, function(index, movie) {

            movieData += '<li class="movie-list">';
            movieData += '<img src="' + movie.posters.thumbnail + '" class="movie-list-img">';
            movieData +=  '<b>' + movie.title + '<b>';
            movieData += '<br><br><b><i><span class="movieData">Description:</span></i></b> ' + movie.synopsis;
            movieData += '<br><br><b><i><span class="movieData">Show Date:</span></i></b> ' + movie.release_dates.theater;
            movieData += '</li>';
        });

        movieData += '</ul>';
        $('#movie-title').html(movieData);
    }
});




