<?php
class BibleDAO {
	public static function getChapterNumbers($book_id) {
		global $db;
		$sql = "SELECT MAX(chapter_number) AS chapter_numbers
				FROM kjv_english
				WHERE book_id = {$book_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['chapter_numbers'];
		} else {
			return false;
		}
	}

	public static function getVerseNumbers($book_id, $chapter_id) {
		global $db;
		$sql = "SELECT MAX(verse_number) AS verse_numbers
				FROM kjv_english
				WHERE book_id = {$book_id}
					AND chapter_number = {$chapter_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['verse_numbers'];
		} else {
			return false;
		}
	}

	public static function getVerseText($book_id, $chapter_id, $verse_id) {
		global $db;
		$sql = "SELECT verse_text
				FROM kjv_english
				WHERE book_id = {$book_id}
					AND chapter_number = {$chapter_id}
					AND verse_number = {$verse_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['verse_text'];
		} else {
			return false;
		}
	}

	public static function getChapterText($book_id, $chapter_id) {
		global $db;
		$sql = "SELECT chapter_text
				FROM kjv_english
				WHERE book_id = {book_id}";
	}

	public static function search($keyword) {
		global $db;
		$sql = "SELECT book_name, chapter_number, verse_number, verse_text FROM kjv_english c INNER JOIN book_name s ON c.book_id = s.boo_id WHERE verse_text LIKE '%&keyword%'";
		$result = $db->query($sql);

		if ($result) {
			$row = $result->fetch_assoc();
			return $row['book_name'] . " " . $row['chapter_number'] . " : " . $row['verse_number'] . "\n" . $row['verse_text'] . "\n\n";
		} else {
			return false;
		}
	}
	public static function getBooks() {
		global $db;
		$sql = "SELECT book_id, book_name FROM book_name ORDER BY book_id";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			$books = array();
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$books[$row['book_id']] = $row['book_name'];
			}
			$result->free();
			return $books;
		} else {
			return false;
		}
	}
}