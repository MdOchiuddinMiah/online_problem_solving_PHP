<?php
error_reporting(E_PARSE | E_ERROR);

include_once 'design/top.php';
include_once 'connection.php';
?>

<?php
$easyproblem_count = '';
$easyproblem_sql = mysql_query("select * from users,problems where users.uid=problems.uid and ptype='Easy' order by pname;") or die("Can not search...");
$easyproblem_count = mysql_num_rows($easyproblem_sql);
if ($easyproblem_count == 0) {
    ?>  
    <h3 class="problemcounte">No Easy Problem Posted</h3>   
    <?php
} else {
    ?>
    <h3 class="problemcounte">Total Easy Problem: <?php echo "$easyproblem_count"; ?></h3>

    <div id="easyproblem_list">


    <?php
    while ($easyproblem_rows = mysql_fetch_array($easyproblem_sql)) {
        $easyproblem_uname = $easyproblem_rows['uname'];
        $easyproblem_pname = $easyproblem_rows['pname'];
        $easyproblem_pid = $easyproblem_rows['pid'];
        $easyproblem_postdate = $easyproblem_rows['postdate'];
        ?>  
        <h2><a id="problemnamehover" href="problemanswer.php?ppid=<?php echo "$easyproblem_pid"; ?>" title="click to get answear"><?php echo "$easyproblem_pname"; ?></a></h2>
            <h4>Posted By: <?php echo "$easyproblem_uname"; ?></h4>
            <h4>Post Date: <?php echo "$easyproblem_postdate"; ?></h4>
        <?php
    }
}
?>
</div>

    <?php
    include_once 'design/buttom.php';
    ?>