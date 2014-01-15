<?php
include('dbconfig.php');
include_once('config.php');
include_once('BibleDAO.php');

$defaultVerseText = BibleDAO::getVerseText(1, 1, 1);

$count = 0;
$key = $_POST['key'];
$key = addslashes($key);
$sql = mysql_query("SELECT book_name, chapter_number,verse_number,verse_text FROM kjv_english c INNER JOIN book_name s ON c.book_id = s.book_id WHERE verse_text LIKE '%$key%'") or die(mysql_error());

while($row = mysql_fetch_array($sql)){
	$count++;
	$bookname = $row['book_name'];
	$chapter = $row['chapter_number'];
	$verse = $row['verse_number'];
	$text = $row['verse_text'];
	
	if($count <= 30){
	?>
		<div class="show<?php echo $book_id; ?> font8" style = "margin-left:0px">
			<div class="table span2">
				<tr>
					<td><i class = "icon-book"></i>&nbsp;<a onclick="getVerseText(1, 1, 1)"><b><?php echo $bookname; ?></b></a></td>
					<td><a><?php echo $chapter; ?></a></td>
					<td>:</td>
					<td><a><?php echo $verse; ?></a></td>
		    		<td><?php echo "<p class = 'col'>".$text."</p>"; ?></td>
		    	</tr>
		    </div>
		</div>
	<?php }}
		if($count==""){
			echo "<p class = 'Error'>No Word/s or Phrase/s Found!</p>";
		}else{
		
		}