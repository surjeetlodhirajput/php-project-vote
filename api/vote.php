<?php
    session_start();
    include("connection.php");

    $votes = $_POST['gvotes'];
    $total_votes= $votes+1;
    $gid = $_POST['gid'];
    $uid = $_SESSION['id'];
	if($_SESSION['data']['role'] ==2){
	echo '<script>
                    alert("You are Not Eligible");
                    window.location = "../routes/dashboard.php";
                </script>';
exit;
	}
    $update_votes = mysqli_query($connect, "update user set votes='$total_votes' where id='$gid'");
    $update_status = mysqli_query($connect, "update user set status=1 where id='$uid'");

    if($update_status and $update_votes){
        $getGroups = mysqli_query($connect, "select name, photo, votes, id from user where role=2 ");
        $groups = mysqli_fetch_all($getGroups, MYSQLI_ASSOC);
        $_SESSION['groups'] = $groups;
        $_SESSION['status'] = 1;
        echo '<script>
                    alert("Voting successfull!");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    else{
        echo '<script>
                    alert("Voting failed!.. Try again.");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    
?>