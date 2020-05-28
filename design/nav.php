<ul>
    <li><a href="home.php"><h3>Home</h3></a></li>

    <li><a href="postproblem.php"><h3>Post Problem</h3></a></li>
    <li><a href="easyproblems.php"><h3>Easy Problem</h3></a></li>
    <li><a href="mediumproblems.php"><h3>Medium Problem</h3></a></li>
    <li><a href="hardproblems.php"><h3>Hard Problem</h3></a></li>
    <li><a href="messages.php"><h3>Message(
                <?php
                include_once 'connection.php';
                session_start();
                $message_uid = $_SESSION['loginid'];
                $message_count_sql = mysql_query("select answears.ansid from users,problems,answears where users.uid=problems.uid and problems.pid=answears.pid and users.uid='$message_uid' and answears.seen='no';");
                $message_count_sql_count = mysql_num_rows($message_count_sql);
                echo "$message_count_sql_count";
                ?>
                )</h3></a></li>
</ul>