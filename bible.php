<?php
include_once('config.php');
include_once('BibleDAO.php');

$books = BibleDAO::getBooks();
$defaultChapters = BibleDAO::getChapterNumbers(1);
$defaultVerses = BibleDAO::getVerseNumbers(1, 1);
$defaultVerseText = BibleDAO::getVerseText(1, 1, 1);
?>

<html>
<head>
	<title>Bible Aapplication</title>
	 <link rel="stylesheet" type="text/css" href="style.css">
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style = "background:url('Best-Wallpaper-For-Laptop.jpg')">
<div id = "wrapper">
	<hr width="100%">
	<center><font face="Century Gothic" size="14" color="white">King James Version</font></center>
	<hr width="100%">
	<br><br>
	<font face="Century Gothic" color="white">
		<div class = "span12">
			<div class="span8 pull-left">
				Books:
				<select name="books" id="books">
					<?php foreach($books as $id => $book): ?>
						<option value="<?= $id ?>"><?= $book ?></option>
					<?php endforeach ?>
				</select>

				Chapters:
				<select name="chapters" id="chapters">
					<?php for($i = 1; $i <= $defaultChapters; $i++): ?>
						<option value="<?= $i ?>"><?= $i ?></option>
					<?php endfor ?>
				</select>

				Verses:
				<select name="verses" id="verses">
					<?php for($i = 1; $i <= $defaultVerses; $i++): ?>
						<option value="<?= $i ?>"><?= $i ?></option>
					<?php endfor ?>
				</select>
				<div id="verse_text">
					<b>Results Found :</b><br><br>
					<?= $defaultVerseText ?>
				</div>
			</div>
			<div class="span3 pull-left">
				<form>
					<input placeholder="Search Word(s)" class="input-large search-query font6 pull-right" style="margin-left:-80;margin-right:25px" type="search" id="key">
				</form>
				<br><br>
				<div class="thumbnail" style = "margin-left:0px;margin-right:20px;height:300px">
					<div class="result">
					</div>
				</div>
			</div>
		</div>
	</font>
</div>
</body>
</html>
<script type="text/javascript" src="jquery.1.10.2.js"></script>
<script type="text/javascript">
$(document).ready( function() {
			$(".result").hide();

			function load_show(){
				$("#result").html("Loading ....");
			}

	$("#key").keyup( function(event){
		var key = $("#key").val();

		if( key != 0){
			load_show();
			$.ajax({
			type: "POST",
			data: ({key: key}),
			url:"search.php",
			success: function(response) {
			$(".result").slideDown().html(response); 
			}
			})
			
			}else{
			
			$(".result").slideUp();
			$(".result").val("");
			}
	});
}); 

</script>

<script type="text/javascript">
$(document).ready(function() {
	function getVerseText(bid, cid, vid) {
		$.ajax({
			url: 'versetext.php',
			data: {book_id: bid, chapter_id: cid, verse_id: vid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				$('#verse_text').html(response.verse_text);
			}
		});
	}

	$('#books').on('change', function() {
		var bid = $(this).val();
		$.ajax({
			url: 'chapters.php',
			data: {book_id: bid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				var str = '';
				for(i = 1; i <= response.chapters; i++) {
					str += '<option value=' + i + '>' + i + '</option>';
				}
				$('#chapters').html(str);
				getVerseText(bid, 1, 1);
			},
			error: function(err) {
				alert('NONO');
			}
		});
	});

	$('#chapters').on('change', function() {
		var bid = $('#books').val();
		var cid = $(this).val();
		$.ajax({
			url: 'verses.php',
			data: {book_id: bid, chapter_id: cid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				var str = '';
				for(i = 1; i <= response.verses; i++) {
					str += '<option value=' + i + '>' + i + '</option>';
				}
				$('#verses').html(str);
				getVerseText(bid, cid, 1);
			},
			error: function(err) {
				alert('NONO');
			}
		});
	});

	$('#verses').on('change', function() {
		var bid = $('#books').val();
		var cid = $('#chapters').val();
		var vid = $(this).val();
		getVerseText(bid, cid, vid);
	});
});
</script>