<?php
include_once 'database.php';
session_start();
if (!(isset($_SESSION['email']))) {
    echo '<script>alert("redirecting to login");</script>';
    header("location:login.php");
} else {
    if(isset($_SESSION["loginonce"]))
    if($_SESSION["loginonce"]){
        $_SESSION["loginonce"] = false;
        echo '<script>alert("successfully logged in");</script>';
    }
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
    
    include_once 'database.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Online Quiz System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>Online Quiz System</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="welcome.php?q=1"><span
                                class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span
                                class="sr-only">(current)</span></a></li>
                    <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>> <a href="welcome.php?q=2"><span
                                class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
                    <!-- <li <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>> <a href="welcome.php?q=3"><span
                                class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li> -->

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo ''; ?>> <a href="logout.php?q=welcome.php"><span class="glyphicon glyphicon-log-out"
                                aria-hidden="true"></span>&nbsp;Log out</a></li>
                </ul>




            </div>
        </div>
    </nav>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (@$_GET['q'] == 1) {
                    $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
                    echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
                    <tr><td><center><b>S.N.</b></center></td><td><center><b>Topic</b></center></td><td><center><b>Total question</b></center></td><td><center><b>Plus Points</center></b></td><td><b><center>Minus Points</center></b></td><td><center><b>Action</b></center></td></tr>';
                    $c = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $title = $row['title'];
                        $total = $row['total'];
                        $plusPoints = $row['pluspoints'];
                        $minusPoints = $row['minuspoints'];
                        $eid = $row['quizid'];
                        
                        // $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
                        // $rowcount = mysqli_num_rows($q12);
                        // echo $email;
                        $query = "SELECT * FROM attempt WHERE quizid='$eid' AND email='$email'";
                        // echo $query;
                        $rs = mysqli_query($con,$query);
                        if(!$rs) die(mysqli_error($con));
                        if (mysqli_num_rows($rs) == 0) {
                            echo '<tr><td><center>' . $c++ . '</center></td><td><center>' . $title . '</center></td><td><center>' . $total . '</center></td><td><center>' . $plusPoints . '</center></td><td><center>' . $minusPoints . '</center></td><td><center><b><a href="welcome.php?q=quiz&step=2&eid=' . $eid . '&n=1" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></center></td></tr>';
                        } else {
                            echo '<tr style="color:#99cc32"><td><center>' . $c++ . '</center></td><td><center>' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></center></td><td><center>' . $total . '</center></td><td><center>' . $plusPoints . '</center></td><td><center>' . $minusPoints . '</center></td><td><center><b><a href="#" class="pull-right btn disabled sub1" style="color:black;margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></center></td></tr>';
                        }
                    }
                    $c = 0;
                    echo '</table></div></div>';
                } ?>

                <?php
                if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
                    $eid = @$_GET['eid'];
                    $sn = @$_GET['n'];
                    if($sn==1){
                        $newAttemptId = uniqid();
                        $useremail = $_SESSION["email"];
                        $query = "INSERT INTO attempt VALUES('$newAttemptId','$useremail','$eid',0,0,0);";
                        // echo "here";
                        mysqli_query($con, $query) or die("Error");
                        $_SESSION['attemptid'] = $newAttemptId;
                    }
                    $total = @$_GET['t'];
                    $query = "SELECT * FROM questions WHERE quizid='$eid' AND srn='$sn' ";
                    // echo $query;
                    $q = mysqli_query($con, $query);
                    echo '<div class="panel" style="margin:5%">';
                    // echo "here";
                    while ($row = mysqli_fetch_array($q)) {
                        $qns = $row['questiontext'];
                        $qid = $row['questionid'];
                        $a = $row['optiona'];
                        $b = $row['optionb'];
                        $c = $row['optionc'];
                        $d = $row['optiond'];
                        // echo "Question";
                        echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br /><br />' . $qns . '</b><br /><br />';
                        echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
                        <br />';
                        echo '<input type="radio" name="ans" value="' . $a . '">&nbsp;' . $a . '<br /><br />';
                        echo '<input type="radio" name="ans" value="' . $b . '">&nbsp;' . $b . '<br /><br />';
                        echo '<input type="radio" name="ans" value="' . $c . '">&nbsp;' . $c . '<br /><br />';
                        echo '<input type="radio" name="ans" value="' . $d . '">&nbsp;' . $d . '<br /><br />';
                        echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                    }
                    // $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");
                    // echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
                    //     <br />';

                    // while ($row = mysqli_fetch_array($q)) {
                    //     $option = $row['option'];
                    //     $optionid = $row['optionid'];
                    //     // echo '<input type="radio" name="ans" value="' . $optionid . '">&nbsp;' . $option . '<br /><br />';
                    // }
                    // echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
                }

                if (@$_GET['q'] == 'result') {
                    $eid = @$_GET['eid'];
                    // $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
                    $attemptid = $_SESSION['attemptid'];
                    $_SESSION['attemptid'] = 'No attempt going on. Error (welcome.php:140)';
                    $result = mysqli_query($con, "SELECT * FROM attempt WHERE attemptid='$attemptid'");
                    echo  '<div class="panel">
                        <center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';
                    // echo $attemptid." ";
                    while ($row = mysqli_fetch_array($result)) {
                        // echo $attemptid." ";
                        $result = mysqli_query($con,"SELECT quizid FROM attempt WHERE attemptid='$attemptid'");
                        $quizid = mysqli_fetch_assoc($result)['quizid'];
                        // print_r($result);
                        // $s = $row['score'];
                        $totalQuestions = mysqli_fetch_assoc(mysqli_query($con, "SELECT total FROM quiz WHERE quizid='$quizid'"))['total'];
                        $rightAnswers = $row['correct'];
                        $wrongAnswers = $row["wrong"];
                        $quizInfo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM quiz WHERE quizid='$quizid'"));
                        $score = ($quizInfo['pluspoints'] * $rightAnswers ) - ($quizInfo['minuspoints'] * $wrongAnswers);

                        mysqli_query($con,"UPDATE attempt SET score=$score WHERE attemptid='$attemptid'") or die("error");
                        
                        echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>' . $totalQuestions . '</td></tr>
                                <tr style="color:#99cc32"><td>Correct Answers&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $rightAnswers . '</td></tr> 
                                <tr style="color:red"><td>Wrong Answers&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $wrongAnswers . '</td></tr>
                                <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $score . '</td></tr>';
                    }
                    // $q = mysqli_query($con, "SELECT * FROM rank WHERE  email='$email' ") or die('Error157');
                    // while ($row = mysqli_fetch_array($q)) {
                    //     $s = $row['score'];
                    //     echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
                    // }
                    echo '</table></div>';
                }
                ?>

                <?php
                if (@$_GET['q'] == 2) {
                    $query = "SELECT * FROM attempt WHERE email='$email'";
                    $result = mysqli_query($con,$query);
                    // $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
                    echo  '<div class="panel title">
                        <table class="table table-striped title1" >
                        <tr style="color:black;"><td><center><b>S.N.</b></center></td><td><center><b>Quiz</b></center></td><td><center><b>Correct Answers</b></center></td><td><center><b>Wrong Answers<b></center></td><td><center><b>Score</b></center></td>';
                    $c = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $quizId = $row["quizid"];
                        $quizTitle = mysqli_fetch_assoc(mysqli_query($con,"SELECT title FROM quiz WHERE quizid='$quizId'"))['title'];
                        $rightAnswers = $row['correct'];
                        $wrongAnswers = $row['wrong'];
                        $score = $row['score'];

                        
                        // $eid = $row['eid'];
                        // $s = $row['score'];
                        // $w = $row['wrong'];
                        // $r = $row['sahi'];
                        // $qa = $row['level'];
                        // $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');

                        // while ($row = mysqli_fetch_array($q23)) {
                        //     $title = $row['title'];
                        // }
                        $c++;
                        echo '<tr><td><center>' . $c . '</center></td><td><center>' . $quizTitle . '</center></td><td><center>' . $rightAnswers . '</center></td><td><center>' . $wrongAnswers . '</center></td><td><center>' . $score . '</center></td></tr>';
                    }
                    echo '</table></div>';
                }

                if (@$_GET['q'] == 3) {
                    $q = mysqli_query($con, "SELECT * FROM rank ORDER BY score DESC ") or die('Error223');
                    echo  '<div class="panel title"><div class="table-responsive">
                        <table class="table table-striped title1" >
                        <tr style="color:red"><td><center><b>Rank</b></center></td><td><center><b>Name</b></center></td><td><center><b>Email</b></center></td><td><center><b>Score</b></center></td></tr>';
                    $c = 0;

                    while ($row = mysqli_fetch_array($q)) {
                        $e = $row['email'];
                        $s = $row['score'];
                        $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' ") or die('Error231');
                        while ($row = mysqli_fetch_array($q12)) {
                            $name = $row['name'];
                        }
                        $c++;
                        echo '<tr><td style="color:black"><center><b>' . $c . '</b></center></td><td><center>' . $name . '</center></td><td><center>' . $e . '</center></td><td><center>' . $s . '</center></td></tr>';
                    }
                    echo '</table></div></div>';
                }
                ?>
</body>

</html>