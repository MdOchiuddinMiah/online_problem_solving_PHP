<?php
error_reporting(E_PARSE | E_ERROR);
include_once 'design/top.php';
include_once 'connection.php';
?>

<?php
$hardproblem_count = '';
$hardproblem_sql = mysql_query("select * from users,problems where users.uid=problems.uid and ptype='Hard' order by pname;") or die("Can not search...");
$hardproblem_count = mysql_num_rows($hardproblem_sql);
if ($hardproblem_count == 0) {
    ?>  
    <h3 class="problemcounte">No Hard Problem Posted</h3>   
    <?php
} else {
    ?>
    <h3 class="problemcounte">Total Hard Problem: <?php echo "$hardproblem_count"; ?></h3>

    <div id="easyproblem_list">


        <?php
        while ($hardproblem_rows = mysql_fetch_array($hardproblem_sql)) {
            $hardproblem_uname = $hardproblem_rows['uname'];
            $hardproblem_pname = $hardproblem_rows['pname'];
            $hardproblem_pid = $hardproblem_rows['pid'];
            $hardproblem_postdate = $hardproblem_rows['postdate'];
            ?>  
            <h2><a id="problemnamehover" href="problemanswer.php?ppid=<?php echo "$hardproblem_pid"; ?>" title="click to get answear"><?php echo "$hardproblem_pname"; ?></a></h2>
            <h4>Posted By: <?php echo "$hardproblem_uname"; ?></h4>
            <h4>Post Date: <?php echo "$hardproblem_postdate"; ?></h4>
            <?php
        }
    }
    ?>
</div>




<?php
include_once 'design/buttom.php';
?>