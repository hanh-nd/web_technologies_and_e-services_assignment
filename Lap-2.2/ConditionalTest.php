<html>
    <head> <title>Conditional Test</title></head>
    <body>
        <?php
            $first = $_GET["firstName"];
            $middle = $_GET["middleName"];
            $last = $_GET["lastName"];
            print "Hi $first! Your full name is $last $middle $first. <br></nbr>";
            if($first == $last)
                print "$first and $last are equal";
            if($first < $last)
                print "$first is less than $last";
            if($first > $last)
                print "$first is greater than $last";
            print "<br>";

            $gradel1 = $_GET["grade1"];
            $gradel2 = $_GET["grade2"];
            $final = (2 * $gradel1 + 3 * $gradel2) / 5;
            if($final > 89){
                print "Your final grade is $final. You got an A. Congratulation";
                $rate = "A";
            }
            elseif ($final > 79){
                print "Your final grade is $final. You got an B.";
                $rate = "B";
            }
            elseif ($final > 69){
                print "Your final grade is $final. You got an C.";
                $rate = "C";

            }
            elseif ($final > 59){
                print "Your final grade is $final. You got an D.";
                $rate = "D";
            }
            elseif ($final > 39){
                print "Your final grade is $final. You got an E.";
                $rate = "E";
            }
            elseif ($final >= 0){
                print "Your final grade is $final. You got an F.";
                $rate = "F";
            }
            else{
                print "Illegal grade less than 0. Final grade = $final";
                $rate = "Illegal";
            }
            print "<br>";
            switch ($rate){
                case "A": print "Excellent!"; break;
                case "B": print "Good!"; break;
                case "C": print "Not bad!"; break;
                case "D": print "Normal!"; break;
                case "E": print "Bad!"; break;
                case "F": print "You have to try again!"; break;
                default: print "Illegal grade!";
            }
        ?>
    </body>
</html>

