jQuery(document).ready(function () {
	//document.write("Haha");
	$("table").each(function() {
		var spotify_id = $(this).find(".spotify.id").text();
		var spotify_img = $(this).find(".spotify.thumb img");
		var spotify_title = $(this).find(".spotify.title");
		var spotify_artist = $(this).find(".spotify.artist");
		var spotify_album = $(this).find(".spotify.album");
		
		$.getJSON("https://api.spotify.com/v1/tracks/"+spotify_id, function (data, textStatus, req) {
			//console.log(data);
			//console.log(data['album']['images'][1]['url']);
			spotify_img.attr('src', data['album']['images'][1]['url']);
			spotify_album.text(data['album']['name']);
			spotify_artist.text(data['artists'][0]['name']);
			spotify_title.text(data['name']);
		});
		
		var itunes_id = $(this).find(".itunes.id").text();
		var itunes_img = $(this).find(".itunes.thumb img");
		var itunes_title = $(this).find(".itunes.title");
		var itunes_artist = $(this).find(".itunes.artist");
		var itunes_album = $(this).find(".itunes.album");
		
		$.ajax({
			url: "https://itunes.apple.com/lookup",
			data: {id: itunes_id},
			dataType: 'JSONP',
		}).done(function (data) {
			//console.log(data);
			itunes_img.attr('src', data['results'][0]['artworkUrl100']);
			itunes_album.text(data['results'][0]['collectionName']);
			itunes_artist.text(data['results'][0]['artistName']);
			itunes_title.text(data['results'][0]['trackName']);
		})
	});
	
	function SpotifySearch(that, id) {
		//console.log(term);
		var spotify_id = that.parentsUntil("table").find(".spotify.id");
		//console.log(spotify_id);
		var spotify_img = that.parentsUntil("table").find(".spotify.thumb img");
		var spotify_title = that.parentsUntil("table").find(".spotify.title");
		var spotify_artist = that.parentsUntil("table").find(".spotify.artist");
		var spotify_album = that.parentsUntil("table").find(".spotify.album");	
		
		$.getJSON("https://api.spotify.com/v1/search", {
			q: that.parentsUntil("table").find(".spotify.query input").val(),
			type: 'track',
			market: 'NL'
		}, function (data, textStatus, req) {
			//console.log(data);
			spotify_img.attr('src', data['tracks']['items'][id]['album']['images'][1]['url']);
			spotify_album.text(data['tracks']['items'][id]['album']['name']);
			spotify_artist.text(data['tracks']['items'][id]['artists'][0]['name']);
			spotify_title.text(data['tracks']['items'][id]['name']);
			spotify_id.text(data['tracks']['items'][id]['id']);
			spotify_id.attr('data-results', id);
		});
	}

	$(".spotify.query input").keyup(function (event) {
		//console.log($(this).val());
		if (!$(this).val()) {
			$(this).parentsUntil("table").find(".spotify.id").text("");
		} else {
			SpotifySearch($(this), 0);
		}
	});
	
	$(".spotify.id").click(function () {
		var currentID = parseInt($(this).attr('data-results'));
		SpotifySearch($(this), currentID + 1);
	});
	
	function iTunesSearch(that, id) {
		var itunes_id = that.parentsUntil("table").find(".itunes.id");
		var itunes_img = that.parentsUntil("table").find(".itunes.thumb img");
		var itunes_title = that.parentsUntil("table").find(".itunes.title");
		var itunes_artist = that.parentsUntil("table").find(".itunes.artist");
		var itunes_album = that.parentsUntil("table").find(".itunes.album");

		$.ajax({
			url: "https://itunes.apple.com/search",
			data: {	term: that.parentsUntil("table").find(".itunes.query input").val(),
					media: 'music' },
			dataType: 'JSONP',
		}).done(function (data) {
			//console.log(data['results']);
			if (!data['results'][id]) {
				alert("Niet meer resultaten");
			}
			itunes_img.attr('src', data['results'][id]['artworkUrl100']);
			itunes_album.text(data['results'][id]['collectionName']);
			itunes_artist.text(data['results'][id]['artistName']);
			itunes_title.text(data['results'][id]['trackName']);
			itunes_id.text(data['results'][id]['trackId']);
			itunes_id.attr('data-results', id);
		}).fail(function (callback) {
			alert("Mislukt");
			console.log(callback);
		})
	}
	
	$(".itunes.query input").change(function (event) {
		//console.log($(this).val());
		if (!$(this).val()) {
			$(this).parentsUntil("table").find(".itunes.id").text("");
		} else {
			iTunesSearch($(this), 0);
		}
	});
	
	$(".itunes.id").click(function () {
		var currentID = parseInt($(this).attr('data-results'));
		iTunesSearch($(this), currentID + 1);
	});
	
	$("input#doorvoeren").on('click', function () {
		var spotify_id = $(this).parent().find(".spotify.id").text();
		var itunes_id = $(this).parent().find(".itunes.id").text();
		var db_title = $(this).parent().find(".db.title input").val();
		var db_artist = $(this).parent().find(".db.artist input").val();
		var db_album = $(this).parent().find(".db.album input").val();
		var total = $(this).parent().find("h1").text();
		var div = $(this).parent();
		console.log(db_title);
		
		$.post("update.php", {
			total: total,
			spotify_id: spotify_id,
			itunes_id: itunes_id,
			db_title: db_title,
			db_artist: db_artist,
			db_album: db_album
		}, function (data) {
			console.log(data);
			div.hide();
		})
	})


})