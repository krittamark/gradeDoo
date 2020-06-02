<?php
	require 'classes/grade.class.php';
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['pass'])) {
		$grade = new Grade($_POST['id'], urldecode($_POST['pass']));

		include __DIR__ . '/view/header.inc.php';
		echo $grade->getGrade('60_1');
		echo $grade->getGrade('60_2');
		echo $grade->getGrade('61_1');
		echo $grade->getGrade('61_2');
		echo $grade->getGrade('62_1');
		echo $grade->getGrade('62_2');
		include __DIR__ . '/view/footer.inc.php';

	} else {

		include __DIR__ . '/view/header.inc.php';
		include __DIR__ . '/view/index.inc.php';
		include __DIR__ . '/view/footer.inc.php';

	}
?>