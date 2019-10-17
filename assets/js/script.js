var currentPlaylist = new Array();
var shufflePlaylist = new Array();
var tempPlaylist = new Array();
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

function openPage(url) {

	if (timer != null) {
		clearTimeout(timer);
	}

	if (url.indexOf("?") == -1) {
		url = url + "?";
	}

	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	$("#mainContent").load(encodedUrl);
	$("body").scrollTop(0);
	history.pushState(null, null, url);
}

function createPlaylist() {
	var playlistName = prompt("Please enter the name of your playlist");

	if (playlistName != null) {
		$.post("includes/handlers/ajax/createPlaylist.php", {name: playlistName, username: userLoggedIn})
			.done(function(error) {
			//do something when ajax returns
			if (error != "") {
				alert(error);
				return;
			}
			openPage("yourMusic.php");
		});
	}
}

function deletePlaylist(playlistId) {
	var prompt = confirm("Are you sure you want to delete this playlist?");

	if (prompt) {
		$.post("includes/handlers/ajax/deletePlaylist.php", { playlistId: playlistId })
			.done(function(error) {
			//do something when ajax returns
			if (error != "") {
				alert(error);
				return;
			}
			openPage("yourMusic.php");
		});
	}
}

function formatTime(seconds) {
	var time = Math.round(seconds);
	var minutes = Math.floor(time / 60);
	var seconds = time - (minutes * 60);

	var extraZero = (seconds < 10) ? "0" : "";

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio) {
	$(".progressTime.current").text(formatTime(audio.currentTime));
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	var progress = audio.currentTime / audio.duration * 100;
	$(".playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio) {
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}

function playFirstSong() {
	setTrack(tempPlaylist[0], tempPlaylist, true);
}

function Audio() {

	this.currentlyPlaying;
	this.audio = document.createElement('audio');
	$(this.audio).prop("muted", false);

	this.audio.addEventListener("ended", function() {
		nextSong();
	});

	this.audio.addEventListener("canplay", function() {
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

	this.audio.addEventListener("timeupdate", function() {
		if (this.duration) {
			updateTimeProgressBar(this);
		}
	});

	this.audio.addEventListener("volumechange", function() {
		updateVolumeProgressBar(this);
	});

	this.setTrack = function(track) {
		this.currentlyPlaying = track;
		this.audio.src = track.path;
	}

	this.play = function playAudio() {
		var playPromise = this.audio.play();

		if (playPromise !== undefined) {
			playPromise.then(_ => {
			  // Automatic playback started!
			  // Show playing UI.
			})
			.catch(error => {
			  // Auto-play was prevented
			  // Show paused UI.
			  pauseSong();
			});
		}
	}

	this.pause = function() {
		this.audio.pause();
	}

	this.setTime = function(seconds) {
		this.audio.currentTime = seconds;
	}
}
