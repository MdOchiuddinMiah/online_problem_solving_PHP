<?php
error_reporting(E_PARSE | E_ERROR);
include_once 'design/top.php';
include_once 'connection.php';
?>

<?php
$from_postproblem_check = "";
$from_postproblem_check = $_GET['postp'];
if ($from_postproblem_check != "") {
    echo '<script>
 
             alert("You post the problem that is already exist.The answer is below.You can give answer for this problem!");
                    </script>';
}


$problem_id = $_GET['ppid'];

$from_message = $_GET['message'];
if ($from_message != "") {

    mysql_query("update answears set seen='yes' where answears.pid='$problem_id';");
}


$panswer_sql_pname = mysql_query("select * from problems where pid='$problem_id';") or die("Can not found problem name");
$panswer_sql_pname_count = mysql_num_rows($panswer_sql_pname);
if ($panswer_sql_pname_count == 0) {
    ?>
    <h3 class="problemcounte">Problem Name Not Exist</h3>
    <?php
} else {

    while ($pname_row = mysql_fetch_array($panswer_sql_pname)) {
        $problem_name = $pname_row['pname'];
    }
    ?>
    <h3 class="problemcounte">Problem Name: <?php echo "$problem_name"; ?></h3>
    <br>
    <hr>

    <?php
}
?>

<div class="problemsanswear">
    <?php
    session_start();
    $panswer_uid = $_SESSION['loginid'];
    if (isset($_GET['ppid']) && isset($_GET['ansid']) && isset($_GET['lcount']) && !isset($_POST['logout']) && !isset($_POST['logout']) && !isset($_POST['postanswer'])) {
        $panswer_ansid_like = $_GET['ansid'];
        $panswer_like_increase = $_GET['lcount'];
        $panswer_likecheck_sql = mysql_query("select * from likecheck where uid='$panswer_uid' and ansid='$panswer_ansid_like' and likeorliked='liked';");
        $panswer_likecheck_sql_count = mysql_num_rows($panswer_likecheck_sql);


        $panswer_unlikecheck_sql1 = mysql_query("select * from unlikecheck where uid='$panswer_uid' and ansid='$panswer_ansid_like' and unlikeorunliked='unliked';");
        $panswer_unlikecheck_sql_count1 = mysql_num_rows($panswer_unlikecheck_sql1);


        if ($panswer_likecheck_sql_count == 0 && $panswer_unlikecheck_sql_count1 == 0) {


            $like_insert_sql = "insert into likecheck(uid,ansid,likeorliked) values"
                    . "('$panswer_uid','$panswer_ansid_like','liked');";
            mysql_query($like_insert_sql);

            $panswer_like_increase = $panswer_like_increase + 1;
            mysql_query("update answears set likecount='$panswer_like_increase' where ansid='$panswer_ansid_like';");
        } else {

            echo '<script>
 
             alert("You already clicked!!!!");
                    </script>';
        }
    }


//unlike check
    if (isset($_GET['ppid']) && isset($_GET['ansid']) && isset($_GET['ulcount']) && !isset($_POST['logout']) && !isset($_POST['postanswer'])) {
        $panswer_ansid_like = $_GET['ansid'];
        $panswer_unlike_increase = $_GET['ulcount'];

        $panswer_unlikecheck_sql = mysql_query("select * from unlikecheck where uid='$panswer_uid' and ansid='$panswer_ansid_like' and unlikeorunliked='unliked';");
        $panswer_unlikecheck_sql_count = mysql_num_rows($panswer_unlikecheck_sql);

        $panswer_likecheck_sql1 = mysql_query("select * from likecheck where uid='$panswer_uid' and ansid='$panswer_ansid_like' and likeorliked='liked';");
        $panswer_likecheck_sql_count1 = mysql_num_rows($panswer_likecheck_sql1);


        if ($panswer_unlikecheck_sql_count == 0 && $panswer_likecheck_sql_count1 == 0) {


            $unlike_insert_sql = "insert into unlikecheck(uid,ansid,unlikeorunliked) values"
                    . "('$panswer_uid','$panswer_ansid_like','unliked');";
            mysql_query($unlike_insert_sql);

            $panswer_unlike_increase = $panswer_unlike_increase + 1;
            mysql_query("update answears set unlikecount='$panswer_unlike_increase' where ansid='$panswer_ansid_like';");
        } else {

            echo '<script>
 
             alert("You already clicked!!!!");
                    </script>';
        }
    }






    $answer_show_sql = mysql_query("select * from answears,users where users.uid=answears.uid and pname='$problem_name' order by likecount desc;");
    $answer_show_count = mysql_num_rows($answer_show_sql);
    if ($answer_show_count == 0) {
        ?>
        <h3 id="problemsanswearh3">No Answer Post For This Problem</h3>
        <?php
    } else {
        while ($show_ans_rows = mysql_fetch_array($answer_show_sql)) {
            $panswer_ansid = $show_ans_rows['ansid'];
            $panswer_uname = $show_ans_rows['uname'];
            $panswer_qsnans = $show_ans_rows['qsnans'];
            $panswer_likecount = $show_ans_rows['likecount'];
            $panswer_unlikecount = $show_ans_rows['unlikecount'];
            $panswer_answertime = $show_ans_rows['atime'];

            $panswer_likecheck_sql_show = mysql_query("select * from likecheck where uid='$panswer_uid' and ansid='$panswer_ansid' and likeorliked='liked';");
            $panswer_likecheck_sql_count_show = mysql_num_rows($panswer_likecheck_sql_show);
            $like_status = "";
            if ($panswer_likecheck_sql_count_show == 0) {
                $like_status = "Like";
            } else {
                $like_status = "Liked";
            }


            $panswer_unlikecheck_sql_show = mysql_query("select * from unlikecheck where uid='$panswer_uid' and ansid='$panswer_ansid' and unlikeorunliked='unliked';");
            $panswer_unlikecheck_sql_count_show = mysql_num_rows($panswer_unlikecheck_sql_show);
            $unlike_status = "";
            if ($panswer_unlikecheck_sql_count_show == 0) {
                $unlike_status = "Unlike";
            } else {
                $unlike_status = "Unliked";
            }
            ?>
            <h2>Answer:</h2>
            <p><pre id="answershow"><?php echo "$panswer_qsnans"; ?></pre></p>
        <br>
        <br>
        <h4 class="likeunlike"><a class="likeunlike1" title="click to like" href="problemanswer.php?ppid=<?php echo "$problem_id"; ?>&ansid=<?php echo "$panswer_ansid"; ?>&lcount=<?php echo "$panswer_likecount"; ?>"><?php echo "$like_status"; ?></a> <?php echo "$panswer_likecount"; ?></h4>

        <h4 class="likeunlike"><a class="likeunlike1" title="click to unlike" href="problemanswer.php?ppid=<?php echo "$problem_id"; ?>&ansid=<?php echo "$panswer_ansid"; ?>&ulcount=<?php echo "$panswer_unlikecount"; ?>"><?php echo "$unlike_status"; ?></a> <?php echo "$panswer_unlikecount"; ?></h4>

        <h4 class="answernamedate">Answered By: <?php echo "$panswer_uname"; ?></h4>
        <h4 class="answernamedate">Answer Date: <?php echo "$panswer_answertime"; ?></h4>

        <hr>         
        <?php
    }
}
?>



</div>


<?php
if (isset($_POST['postanswer'])) {
    $ans = trim($_POST['answer']);
    $answer_date = date("Y-m-d");
    $answer_pid = $problem_id;
    $answer_pname = $problem_name;
    $answer_uid = $panswer_uid;

    //email sending
    /*
      $email_sql=  mysql_query("select uemail from users,problems where problems.uid=users.uid and pid='$answer_pid';");
      while ($email_sql_row = mysql_fetch_array($email_sql)) {
      $user_email=$email_sql_row['uemail'];
      }

      $to = $user_email;
      $subject = "Online Problem Solving";
      $txt = "You have an answear for problem".' '.$answer_pname;
      $headers = "From: omisayeduiu@gmail.com" . "\r\n" .
      "CC: omisayed1uiu@gmail.com";

      mail($to,$subject,$txt,$headers);


     */
    if ($ans != "") {
        $ans_post_sql = "insert into answears(pid,uid,pname,qsnans,atime)values"
                . "('$answer_pid','$answer_uid','$answer_pname','$ans','$answer_date')";


        if (!mysql_query($ans_post_sql)) {
            echo '<script>
 
             alert("Not Posted Check Your Answer Syntax!!!!!!");
                    </script>';
        } else {
            echo '<script>
 
             alert("Successfully Posted!!!!!!");
                    </script>';
        }
    } else {
        echo '<script>
 
             alert("Text Can Not Be Empty!!!!!!");
                    </script>';
    }
}
?>


<form id="postanswear" action="problemanswer.php?ppid=<?php echo "$problem_id"; ?>" method="post">

    <textarea id="textanswer" name="answer" placeholder="Write your answer here.."></textarea>
    <br>
    <input class="postproblemsubmit" type="submit" value="Post" name="postanswer">


</form>

<?php
include_once 'design/buttom.php';
?>