<?php
error_reporting(E_PARSE | E_ERROR);
?>
<?php
include_once 'design/top.php';
?>



<?php include_once 'connection.php'; ?>

<?php
$mediumproblem_count = '';
$mediumproblem_sql = mysql_query("select * from users,problems where users.uid=problems.uid and ptype='Medium' order by pname;") or die("Can not search...");
$mediumproblem_count = mysql_num_rows($mediumproblem_sql);
if ($mediumproblem_count == 0) {
    ?>  
    <h3 class="problemcounte">No Medium Problem Posted</h3>   
    <?php
} else {
    ?>
    <h3 class="problemcounte">Total Medium Problem: <?php echo "$mediumproblem_count"; ?></h3>
    <div id="easyproblem_list">


        <?php
        while ($mediumproblem_rows = mysql_fetch_array($mediumproblem_sql)) {
            $mediumproblem_uname = $mediumproblem_rows['uname'];
            $mediumproblem_pname = $mediumproblem_rows['pname'];
            $mediumproblem_pid = $mediumproblem_rows['pid'];
            $mediumproblem_postdate = $mediumproblem_rows['postdate'];
            ?>  
            <h2><a id="problemnamehover" href="problemanswer.php?ppid=<?php echo "$mediumproblem_pid"; ?>" title="click to get answear"><?php echo "$mediumproblem_pname"; ?></a></h2>
            <h4>Posted By: <?php echo "$mediumproblem_uname"; ?></h4>
            <h4>Post Date: <?php echo "$mediumproblem_postdate"; ?></h4>
            <?php
        }
    }
    ?>
</div>



<?php
include_once 'design/buttom.php';
?>