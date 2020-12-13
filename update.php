<?php
include_once 'database.php';
session_start();
$email = $_SESSION['email'];

if ($_SESSION['isadmin']) {
  echo "in here";
  if (@$_GET['demail']) {
    $demail = @$_GET['demail'];
    // $r1 = mysqli_query($con, "DELETE FROM rank WHERE email='$demail' ") or die(mysqli_error($con));
    // $r2 = mysqli_query($con, "DELETE FROM history WHERE email='$demail' ") or die(mysqli_error($con));
    $result = mysqli_query($con, "DELETE FROM user WHERE email='$demail' ") or die(mysqli_error($con));
    header("location:dashboard.php?q=1");
  }


  if (@$_GET['q'] == 'rmquiz') {
    $eid = @$_GET['eid'];
    // $result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
    mysqli_query($con, "DELETE FROM questions WHERE quizid='$eid'");
    mysqli_query($con, "DELETE FROM quiz WHERE quizid='$eid'");
    // while($row = mysqli_fetch_array($result)) 
    // {
    //   $qid = $row['qid'];
    //   $r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
    //   $r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
    // }
    // $r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
    // $r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
    // $r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
    header("location:dashboard.php?q=5");
  }


  if (@$_GET['q'] == 'addquiz') {
    $name = $_POST['name'];
    $name = ucwords(strtolower($name));
    $total = $_POST['total'];
    $right = $_POST['right'];
    $wrong = $_POST['wrong'];
    $id = uniqid();
    $q3 = mysqli_query($con, "INSERT INTO quiz VALUES  ('$id','$name' , '$right' , '$wrong','$total', NOW())");
    header("location:dashboard.php?q=4&step=2&eid=$id&n=$total");
  }


  if (@$_GET['q'] == 'addqns') {
    $n = @$_GET['n'];
    $eid = @$_GET['eid'];
    $ch = @$_GET['ch'];
    for ($i = 1; $i <= $n; $i++) {
      $qid = uniqid();
      $qns = $_POST['qns' . $i];
      // $q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
      $a = $_POST[$i . '1'];
      $b = $_POST[$i . '2'];
      $c = $_POST[$i . '3'];
      $d = $_POST[$i . '4'];
      $answer = '';
      $e = $_POST['ans' . $i];
      // echo $e;
      switch ($e) {
        case 'a':
          $answer = $a;
          break;
        case 'b':
          $answer = $b;
          break;
        case 'c':
          $answer = $c;
          break;
        case 'd':
          $answer = $d;
          break;
        default:
          $answer = 'null';
      }
      // echo $answer;
      $query = "INSERT INTO questions VALUES('$eid', '$qid',$i,'$qns','$ch','$a','$b','$c','$d','$answer');";
      echo $query;
      // echo "<br>";
      // echo $query;
      mysqli_query($con, $query);
      // $qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
      // $qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
      // $qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
      // $qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');

      // $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
    }
    header("location:dashboard.php?q=0");
  }
}

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
  $eid = @$_GET['eid'];
  $sn = @$_GET['n'];
  $total = @$_GET['t'];
  $ans = $_POST['ans'];
  $qid = @$_GET['qid'];
  // $q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
  $q = mysqli_query($con, "SELECT solution FROM questions WHERE questionid='$qid' ");

  while ($row = mysqli_fetch_array($q)) {
    $ansid = $row['solution'];
  }
  if ($ans == $ansid) {
    $attemptid = $_SESSION['attemptid'];
    $query = "SELECT * FROM attempt WHERE attemptid = '$attemptid'";
    $correctsTillNow = mysqli_fetch_assoc(mysqli_query($con, $query))['correct'];
    $correctsTillNow++;
    $query = "UPDATE attempt SET correct='$correctsTillNow' WHERE attemptid='" . $_SESSION['attemptid'] . "'";
    mysqli_query($con, $query);

    // $q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
    // while($row=mysqli_fetch_array($q) )
    // {
    //   $sahi=$row['sahi'];
    // }
    // if($sn == 1)
    // {
    //   $q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
    // }
    // $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
    // while($row=mysqli_fetch_array($q) )
    // {
    //   $s=$row['score'];
    //   $r=$row['sahi'];
    // }
    // $r++;
    // $s=$s+$sahi;
    // $q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
  } else {
    echo "updating wrongs ";
    $attemptid = $_SESSION['attemptid'];
    $query = "SELECT * FROM attempt WHERE attemptid = '$attemptid'";
    $wrongsTillNow = mysqli_fetch_assoc(mysqli_query($con, $query))['wrong'];
    $wrongsTillNow++;
    $query = "UPDATE attempt SET wrong='$wrongsTillNow' WHERE attemptid='" . $_SESSION['attemptid'] . "'";
    mysqli_query($con, $query);


    // $q = mysqli_query($con, "SELECT * FROM quiz WHERE eid='$eid' ") or die('Error129');
    // while ($row = mysqli_fetch_array($q)) {
    //   $wrong = $row['wrong'];
    // }
    // if ($sn == 1) {
    //   $q = mysqli_query($con, "INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )") or die('Error137');
    // }
    // $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error139');
    // while ($row = mysqli_fetch_array($q)) {
    //   $s = $row['score'];
    //   $w = $row['wrong'];
    // }
    // $w++;
    // $s = $s - $wrong;
    // $q = mysqli_query($con, "UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'") or die('Error147');
  }
  $attemptid = $_SESSION['attemptid'];
  // $query = "SELECT total FROM quiz WHERE quizid=SELECT quizid FROM attempt WHERE attemptid='".$_SESSION["attemptid"]."'";
  $quizid = mysqli_fetch_assoc(mysqli_query($con,"SELECT quizid FROM attempt WHERE attemptid='$attemptid'"))['quizid'];
  echo $quizid." ";

  $query = "SELECT total  FROM quiz WHERE quizid='$quizid'";
  $total = mysqli_fetch_assoc(mysqli_query($con, $query))['total'];
  echo $total." ";
  // echo "total-".$total."-total";
  if ($sn != $total) {
    $sn++;
    // if($sn != 3)
      header("location:welcome.php?q=quiz&step=2&eid=$eid&n=$sn") or die('Error152');
  }
  //  else if ($_SESSION['key'] != 'suryapinky') {
  //   $q = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error156');
  //   while ($row = mysqli_fetch_array($q)) {
  //     $s = $row['score'];
  //   }
  //   $q = mysqli_query($con, "SELECT * FROM rank WHERE email='$email'") or die('Error161');
  //   $rowcount = mysqli_num_rows($q);
  //   if ($rowcount == 0) {
  //     $q2 = mysqli_query($con, "INSERT INTO rank VALUES('$email','$s',NOW())") or die('Error165');
  //   } else {
  //     while ($row = mysqli_fetch_array($q)) {
  //       $sun = $row['score'];
  //     }
  //     $sun = $s + $sun;
  //     $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'") or die('Error174');
  //   }
  //   header("location:welcome.php?q=result&eid=$eid");
  // } else {
  //   header("location:welcome.php?q=result&eid=$eid");
  // }
  else{
    // if($sn != 2)
      header("location:welcome.php?q=result");
  }
}

if (@$_GET['q'] == 'quizre' && @$_GET['step'] == 25) {
  $eid = @$_GET['eid'];
  $n = @$_GET['n'];
  $t = @$_GET['t'];
  $q = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error156');
  while ($row = mysqli_fetch_array($q)) {
    $s = $row['score'];
  }
  $q = mysqli_query($con, "DELETE FROM `history` WHERE eid='$eid' AND email='$email' ") or die('Error184');
  $q = mysqli_query($con, "SELECT * FROM rank WHERE email='$email'") or die('Error161');
  while ($row = mysqli_fetch_array($q)) {
    $sun = $row['score'];
  }
  $sun = $sun - $s;
  $q = mysqli_query($con, "UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'") or die('Error174');
  header("location:welcome.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}
