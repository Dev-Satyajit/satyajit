<?php
session_start();
$page = 'services';
$next = 'http%3A%2F%2Flocalhost%2Fsatyajit%2Fservices.php';
include 'session.php';
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
    <link rel="stylesheet" href="resources/style_services.css">
</head>

<body>
    <?php include 'partials/_nav.php' ?>
    <div class="content">
        <div class="header">
            <div class="operation">
                <button class="btn1 addbtn" value="<?php echo $_SESSION['username']; ?>">Add new</button>
                <button class="btn1 delbtn">Delete</button>
                <button class="btn1 cancelbtn">Cancel</button>
            </div>
        </div>
        <div class="container1">
            <div class="table-box">
                <table border="1" cellspacing="5">
                    <thead>
                        <tr>
                            <td>Links</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $x = 1;
                        include 'partials/_db_con.php';
                        $email_search = "SELECT * FROM user_services WHERE `username`='$_SESSION[username]'";
                        $query = mysqli_query($con, $email_search);
                        while ($data = mysqli_fetch_assoc($query)) {
                            if ($data['username'] == $_SESSION['username']) {
                                $disabled = "disabled";
                            } else {
                                $disabled = "";
                            }
                        ?>
                            <tr>
                                <td data-label="Date of Birth" class="center"><a href="<?php echo $data['link']; ?>" target="_blank" rel="noopener noreferrer"><?php echo $data['linkname']; ?></a>
                                <button class="delete-button del-btn" value="<?php echo $data['id']; ?>"><i class="fas fa-times"></i></button></td>
                            </tr>
                        <?php
                            $x++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="add_m" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="add_services.php" method="POST">
                    <div class="modal-body">
                        <div class="input-box">
                            <input type="text" name="linkname" placeholder="URL Name" >
                            <input type="text" name="link" placeholder="URL" value="https://">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="add-id" name="del_id">
                        <button type="submit" class="btn btn-primary" name="submit">Add</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="del_m" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Permanently?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="delete_services.php" method="POST">
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="del-id" name="del_id">
                        <button type="submit" class="btn btn-primary" name="submit">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include 'partials/foot.php' ?>
    <script>
        $(document).ready(function() {
            $('.addbtn').click(function(e) {
                e.preventDefault();
                var uid = $(this).val();
                $('.add-id').val(uid);
                $('#add_m').modal('show');
            });
            $('.delbtn').click(function(e){
                e.preventDefault();
                $('.delete-button').css("display","table-cell");
                $(this).css("display","none");
                $('.cancelbtn').css("display","inline-block");
            });
            $('.cancelbtn').click(function(e){
                e.preventDefault();
                $('.delete-button').css("display","none");
                $(this).css("display","none");
                $('.delbtn').css("display","inline-block");
            });
            $('.del-btn').click(function(e){
                e.preventDefault();
                var uid = $(this).val();
                $('.del-id').val(uid);
                $('#del_m').modal('show');
            });
        });
    </script>
</body>

</html>