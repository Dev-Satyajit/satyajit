<?php
session_start();
$page = 'users';
$next = 'http%3A%2F%2Flocalhost%2Fsatyajit%2Fusers.php';
include 'session.php';
if ($_SESSION['role'] != 1) {
    header('location: home.php');
    exit;
}
include 'partials/_db_con.php';
$email_s = "SELECT * FROM user_data";
$equery = mysqli_query($con, $email_s);
$num = mysqli_num_rows($equery);
$status_s = "SELECT `status` FROM `user_data` WHERE `status`=1";
$squery = mysqli_query($con, $status_s);
$num_active = mysqli_num_rows($squery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_users.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class="hero">
        <?php include 'partials/_nav.php' ?>
        <div class="mobile">This page is not compatible on this device</div>
        <div class="user_status">
            <div class="info">
                <span>Total users: <?php echo $num; ?></span><br>
                <span>Total active users: <?php echo $num_active; ?></span><br>
                <span>Total inactive users: <?php echo $num - $num_active; ?></span>
            </div>
            <div id="txt"></div>
            <a href="user_status.php">Add new user</a>
        </div>
        <div class="content">
            <div class="table-box">
                <table border="1" cellspacing="5">
                    <thead>
                        <tr>
                            <td>Sl No</td>
                            <td>Id</td>
                            <td>Full Name</td>
                            <td>Email Id</td>
                            <td>Date of Birth</td>
                            <td>Mobile Number</td>
                            <td>User Type</td>
                            <td>Status</td>
                            <td colspan="2" align="center">Operation</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        $email_search = "SELECT * FROM user_data";
                        $query = mysqli_query($con, $email_search);
                        while ($data = mysqli_fetch_assoc($query)) {
                            if ($data['username'] == $_SESSION['username']) {
                                $disabled = "disabled";
                            } else {
                                $disabled = "";
                            }
                        ?>
                            <tr>
                                <td data-label="Sl No" class="center"><?php echo $x; ?></td>
                                <td data-label="Id" class="center"><?php echo $data['id']; ?></td>
                                <td data-label="Full Name"><?php echo $data['fname'] . ' ' . $data['lname']; ?></td>
                                <td data-label="Email Id"><?php echo $data['email']; ?></td>
                                <td data-label="Date of Birth" class="center"><?php echo $data['dob']; ?></td>
                                <td data-label="Mobile Number" class="center"><?php echo $data['prefix'] . ' ' . $data['number']; ?></td>
                                <td data-label="User Type" class="center"><?php if ($data['role'] == 1) {
                                                                                echo 'Admin';
                                                                            } else {
                                                                                echo 'User';
                                                                            } ?></td>
                                <td data-label="Status" class="center"><i class="fas fa-circle <?php if ($data['status'] == 1) {
                                                                                                    echo 'online';
                                                                                                } ?>"></i></td>
                                <td class="button center"><a class="update updatebtn <?php echo $disabled ?>" href="update_user_details.php?id=<?php echo $data['id']; ?>">Update</a></td>
                                <td class="button center"><button class="delete_btn deletebtn <?php echo $disabled ?>" value="<?php echo $data['id']; ?>">Delete</button></td>
                            </tr>
                        <?php
                            $x++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="del_m" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-heding">
                        <i class="fas fa-exclamation-triangle"></i><br>
                        Permanently delete?
                    </div>
                    <form action="delete.php" method="POST">
                        <div class="modal-body1">
                            Once you permanently delete this, you won't be able to restore it.
                        </div>
                        <div class="confirmation">
                            <input type="hidden" class="del-id" name="del_id">
                            <button type="submit" class="btn1 btn-confirm" name="submit">Delete</button>
                            <button type="button" class="btn1 btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
        </div>
    </section>
    <?php include 'partials/foot.php' ?>
    <script>
        $(document).ready(function() {
            $('.deletebtn').click(function(e) {
                e.preventDefault();
                var uid = $(this).val();
                $('.del-id').val(uid);
                $('#del_m').modal('show');
            });
        });
    </script>
</body>

</html>