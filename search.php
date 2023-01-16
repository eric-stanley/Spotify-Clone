<?php

include("includes/includedFiles.php");

if (isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
} else {
	$term = "";
}

?>

<div class="searchContainer">

	<h4>Search for an artist, album or song</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." 
		onfocus="moveCursorToEnd(this);">
	
</div>

<script>

	$(".searchInput").focus();
	
	$(function() {
		$(".searchInput").keyup(function() {
			clearTimeout(timer);

			timer = setTimeout(function() {
				var val = $(".searchInput").val();
				openPage("search.php?term=" + val);
			}, 2000);
		});
	});

	function moveCursorToEnd(el) {
	    if (typeof el.selectionStart == "number") {
	        el.selectionStart = el.selectionEnd = el.value.length;
	    } else if (typeof el.createTextRange != "undefined") {
	        el.focus();
	        var range = el.createTextRange();
	        range.collapse(false);
	        range.select();
	    }
	}

</script>

<?php if ($term == "") { exit(); } ?>

<div class="trackListContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="trackList">
		<?php

			$songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%' LIMIT 10");

			if (mysqli_num_rows($songsQuery) == 0) {
				echo "<span class='noResults'>No songs found matching " . $term . "</span>";
			}

			$songIdArray = array();
			$i = 1;
			while ($row = mysqli_fetch_array($songsQuery)) {

				if ($i > 15) {
					break;
				}

				array_push($songIdArray, $row['id']);

				$albumSong = new Song($con, $row['id']);
				$albumArtist = $albumSong->getArtist();

				echo "<li class='trackListRow'>
						<div class='trackCount'>
							<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
							<span class='trackNumber'>$i</span>
						</div>

						<div class='trackInfo'>
							<span class='trackName'>" . $albumSong->getTitle() . "</span>
							<span class'artistName'>" . $albumArtist->getName() . "</span>
						</div>

						<div class='trackOptions'>
							<input type='hidden' class='songId' value='" . $albumSong->getId() . "'/>
							<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
						</div>

						<div class='trackDuration'>
							<span class='duration'>" . $albumSong->getDuration() . "</span>
						</div>

					</li>";

				$i++;

			}

		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>


<div class="artistContainer borderBottom">
	
	<h2>ARTISTS</h2>

	<?php

	$artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");

	if (mysqli_num_rows($artistQuery) == 0) {
		echo "<span class='noResults'>No artists found matching " . $term . "</span>";
	}

	while ($row = mysqli_fetch_array($artistQuery)) {
		$artistFound = new Artist($con, $row['id']);

		echo "<div class='searchResultRow'>
				<div class='artistName'>
					<span role='link' tabIndex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>"
						. $artistFound->getName() .
					"</span>
				</div>
			</div>";
	}


	?>

</div>

<div class="gridViewContainer">

	<h2>ALBUMS</h2>

	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '%$term%' LIMIT 10");

		if (mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No albums found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='" .  $row['artworkPath'] . "'>
						<div class='gridViewInfo'>"
							. $row['title'] .
						"</div>
					</span>
				</div>";
		}
	?>
	
</div>


<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>


