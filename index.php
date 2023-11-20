<?php
$time=microtime(1);
$typepath = "type/";
$textcolor = "style=\"color:#ff0000;\"";
$rnd_num_4 = mt_rand(0,4);
$bad_words = file("bad_words.txt");


//  file with answers, one anwser per line
if (isset($_POST['type'])) {
	$type = preg_replace('/[^\w]+/i', '', $_POST['type']);
	$file = file ($typepath.$type);
} else {
	$file = file ($typepath.'Normal');
}

$answer = $file[mt_rand(0,count($file)-1)];

if (isset($_POST['question'])) {
	$q = preg_replace('/[^\w\s]*/', '', $_POST['question']);
	$question = preg_replace('/\s\s+/', ' ', $q);
} else {
	$question = '';
}

function bad_words($question, $bad_words) {
	foreach($bad_words as $words) {
		$str = str_ireplace(preg_replace('/\n|\r/', '', $words), "", $question, $count);
		if ($count >= 1) {
			return TRUE;
		}
	}
}

$result = bad_words($question, $bad_words);
$search_john = stristr($question, 'john');
$search_rachel = stristr($question, 'rachel');
$search_lizzy = stristr($question, 'lizzy');
$search_golda = stristr($question, 'golda');

if ($result == TRUE) {
	$question = "";
	$answer = "Not very nice!";
} elseif ($search_john == TRUE) {
	$answer = "I have nothing to say. You know he created me, right?";
} elseif (($search_lizzy == TRUE) && ($rnd_num_4 == 1)) {
	$answer = "That's like trying to predict where lightening will strike!";
} elseif (($search_lizzy == TRUE) && ($rnd_num_4 == 3)) {
	$answer = "The self-rescuing princess!";
} elseif (($search_rachel == TRUE) && ($rnd_num_4 == 1)) {
	$answer = "Did you have any doubts about the answer?";
} elseif (($search_rachel == TRUE) && ($rnd_num_4 == 3)) {
	$answer = "Monkey?, Monkey?";
} elseif (($search_golda == TRUE) && ($rnd_num_4 == 1)) {
	$answer = "I can't tell you anything on pain of death!";
} elseif (($search_golda == TRUE) && ($rnd_num_4 == 3)) {
	$answer = "As you wiissshhhh!";
} elseif ($question == "") {
	$answer = 'Well ask something!';
} elseif ($question == " ") {
	$answer = 'Nothing to ask?';
} else {
	$answer;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title> Mistical 8 Ball </title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="robots" content="index,follow,noarchive" />
<link rel="stylesheet" title="The Tethered" type="text/css" href="default.css" media="screen" />

</head>

<body>

<div>
	<b class="ccorner">
		<b class="ccorner1">&nbsp;</b>
		<b class="ccorner2">&nbsp;</b>
		<b class="ccorner3">&nbsp;</b>
		<b class="ccorner4">&nbsp;</b>
		<b class="ccorner5">&nbsp;</b>
	</b>
	<div class="ccornerfg" style="color:#000066;">
		<table width="250px" class="header">
		<tbody>
			<tr>
				<td>

<?php
if (isset($_POST['question'])) {
echo "
<textarea rows=\"3\" cols=\"50\" readonly=\"readonly\">You asked:\n$question</textarea>
<p $textcolor>$answer</p><br /><br />";
} 
print'
					<div class="quote">
						<form method="post" action="'.$_SERVER['PHP_SELF'].'">
							<ul style="list-style-type:none; padding:10px;"> 
								<li style="padding:10px;">
									<label>Ask a yes or no question. (Keep it short)</label><br />
									<input name="question" type="text" maxlength="60" size="62" value="" /><br />
								</li>
								<li style="padding:10px;">
									<select name="type">';
if ($fh = opendir ($typepath)) {
	$numof = 0;
	while (false !== ($file = readdir($fh))) {
		if ($file != "." && $file != "..") {
			$numof++;
			print'<option value="'.$file.'">'.ucwords(str_replace("_", " ", $file)).'</option>'."\n";
		}
	}
	closedir($fh);
}

print'									</select><br />
								Select 1 of the '.$numof.' types of Mistical 8 Balls to use.<br />
									</li>
								<li style="padding:10px;"><input type="submit" name="submit" value="Shake the 8 Ball !" /></li>
							</ul>
						</form>
						<img src="8ball2.gif" alt="8-Ball" /><br />
						<p>Back to the home of <a href="http://www.__replace_me__.com/">Home</a></p>
';

?>
					</div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
	<b class="ccorner">
		<b class="ccorner5">&nbsp;</b>
		<b class="ccorner4">&nbsp;</b>
		<b class="ccorner3">&nbsp;</b>
		<b class="ccorner2">&nbsp;</b>
		<b class="ccorner1">&nbsp;</b>
	</b>
</div>
<p style="font-size:7px; color:#dedede;">Page Generated in
<?php echo round ( microtime(1)-$time, 3 ); ?>
 seconds<br /></p>
</body>

</html>
