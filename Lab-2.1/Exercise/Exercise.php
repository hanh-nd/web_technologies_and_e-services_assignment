<?php 
	$name = $_POST["name"];
	$class = $_POST["class"];
	$university = $_POST["university"];
	$hobbies = array();

	$cat = $_POST["anime"];
	if($cat == "Yes") array_push($hobbies,"Anime");

	$cooking = $_POST["manga"];
	if($cooking == "Yes") array_push($hobbies,"manga");

	$dog = $_POST["game"];
	if($dog == "Yes") array_push($hobbies,"Game");

	$math = $_POST["sleep"];
	if($math == "Yes") array_push($hobbies,"Sleep");

	$web = $_POST["football"];
	if($web == "Yes") array_push($hobbies,"Football");

	$facebook = $_POST["facebook"];
	if($facebook == "Yes") array_push($hobbies,"Facebook");

	$youtube = $_POST["youtube"];
	if($youtube == "Yes") array_push($hobbies,"Youtube");

	print "Hello, $name <br />";
	print "You are studing at $class, $university <br />";
	print "Your hobby is :  <br />";
    $stt = 1;
	foreach ($hobbies as $i) {
		print "$stt. $i <br />";
        $stt++;
	}
 ?>