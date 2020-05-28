<?php
error_reporting(E_PARSE | E_ERROR);

include_once 'design/top.php';
include_once 'connection.php';
?>

<?php
$getsearchresult = $_GET['svalue'];
$getsearchresult = trim($getsearchresult);
if ($getsearchresult == "") {
    ?>
    <h3 class="problemcounte">Your Search Field is Empty</h3> 
    <?php
} else {
    $searchresult_count = '';
    $searchresult_sql = mysql_query("SELECT * FROM users, problems WHERE users.uid = problems.uid AND pname LIKE  '%" . $getsearchresult . "%' ORDER BY pname;") or die("Can not search Please Check Your Search String...");
    $searchresult_count = mysql_num_rows($searchresult_sql);
    if ($searchresult_count == 0) {
        ?>  
        <h3 class="problemcounte">This Problem Not Posted</h3>   
        <?php
    } else {
        ?>
        <h3 class="problemcounte">Total Problem: <?php echo "$searchresult_count"; ?></h3>

        <div id="search_list">


            <?php
            while ($searchresult_rows = mysql_fetch_array($searchresult_sql)) {
                $searchresult_uname = $searchresult_rows['uname'];
                $searchresult_pname = $searchresult_rows['pname'];
                $searchresult_pid = $searchresult_rows['pid'];
                $searchresult_postdate = $searchresult_rows['postdate'];
                ?>  
                <h2><a id="problemnamehover" href="problemanswer.php?ppid=<?php echo "$searchresult_pid"; ?>" title="click to get answear"><?php echo "$searchresult_pname"; ?></a></h2>
                <h4>Posted By: <?php echo "$searchresult_uname"; ?></h4>
                <h4>Post Date: <?php echo "$searchresult_postdate"; ?></h4>
                <?php
            }
        }
    }
    ?>
</div>




<?php
include_once 'design/buttom.php';
?>