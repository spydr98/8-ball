
<?php
$typepath = 'type/';
$textcolor = '<a name="adlib" style="color:#ff0000;">';
$end = '</a>';

if (isset($_POST['question'])) {
	$question = $textcolor.preg_replace('/[^\w]+\s/i', '', $_POST['question']).$end;
}

//  file with answers, one anwser per line
//	$quote = file ("8-Ball\\8-Ball.txt");
//	$num = rand(0,count($quote)-1);
//	echo $quote[$num];

if (isset($_POST['type'])) {
	$type = preg_replace('/[^\w.]+/i', '', $_POST['type']);
	include $typepath.$type;
}

?>
