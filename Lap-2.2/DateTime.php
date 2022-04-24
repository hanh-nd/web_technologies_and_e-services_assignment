<html>
    <head><title>Date Time Validation</title></head>
    <body>
        <p>Enter your name and select date and time for the appointment</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <?php
            if (array_key_exists("name", $_GET)) {
                $name = $_GET["name"];
                $day = $_GET["day"];
                $month = $_GET["month"];
                $year = $_GET["year"];
                $sec = $_GET["sec"];
                $min = $_GET["min"];
                $hour = $_GET["hour"];
            } else {
                $name = "";
                $day = 1;
                $month = 1;
                $year = 1990;
                $sec = 0;
                $min = 0;
                $hour = 0;
            }
            ?>
            <table>
                <tr>
                    <td>Your name:</td>
                    <?php
                        print "<td><input type=\"text\" name=\"name\" value=\"$name\"></td>";
                    ?>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>
                        <select name="day">
                            <?php
                            for ($i = 1; $i <= 30; $i++) {
                                if ($day == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            }
                            ?>
                        </select>
                        <select name="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++)
                                if ($month == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            ?>
                        </select>
                        <select name="year">
                            <?php
                            for ($i = 1900; $i <= 2030; $i++)
                                if ($year == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Time:</td>
                    <td>
                        <select name="hour">
                            <?php
                            for ($i = 0; $i < 24; $i++)
                                if ($hour == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            ?>
                        </select>
                        <select name="min">
                            <?php
                            for ($i = 0; $i <= 59; $i++)
                                if ($min == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            ?>
                        </select>
                        <select name="sec">
                            <?php
                            for ($i = 0; $i <= 59; $i++)
                                if ($sec == $i)
                                    print "<option selected>$i</option>";
                                else
                                    print "<option>$i</option>";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right"> <input type="submit" value="Submit"></td>
                    <td align="left"> <input type="reset" value="Reset"></td>
                </tr>
            </table>
        </form>
        <?php
        if (array_key_exists("name", $_GET)) {
            $name = $_GET["name"];
            $day = $_GET["day"];
            $month = $_GET["month"];
            $year = $_GET["year"];
            $sec = $_GET["sec"];
            $min = $_GET["min"];
            $hour = $_GET["hour"];

            print "Hi $name!<br>";
            print "You have choose to have an appointment on $hour:$min:$sec, $day/$month/$year<br><br>";
            print "More information <br><br>";
            if($hour < 12)
                print "In 12 hours, the time and date is $hour:$min:$sec AM, $day/$month/$year<br><br>";
            else{
                $hour -= 12;
                print "In 12 hours, the time and date is $hour:$min:$sec PM, $day/$month/$year<br><br>";
            }
            if($month != 2) {
                if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
                    print "This month has 31 days!";
                else
                    print "This month has 30 days!";
            } else {
                if ($year % 4 != 0) {
                    print "This month has 28 days!";
                } else {
                    if($year % 100 != 0)
                        print "This month has 29 days!";
                    else {
                        if($year % 400 == 0)
                            print "This month has 29 days!";
                        else
                            print "This month has 28 days!";
                    }
                }
            }
        }
        ?>
    </body>

</html>