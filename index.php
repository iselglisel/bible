<?php
include('bible.php');
include('BibleDAO.php');
?>

<html>
<head>
	<title>Bible Application</title>
</head>
<body>

<font face="Century Gothic">
Books:
<select name="books" id="books">
	<?php foreach($books as $id => $book): ?>
		<option value="<?= $id ?>"><?= $book ?></option>
	<?php endforeach ?>
</select>

Chapters:
<select name="chapters" width="20%" id="chapters">
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
	<?= $defaultVerseText ?>
</div>
</font>
<script type="text/javascript" src="jquery.1.10.2.js"></script>

</body>
</html>