<?php
// require_once('config.php');
// require_once('db.php');

$message = '';

// Check for Submission
if (isset($_POST['save'])) {

    // Get form data
    $photo=$_POST['photo'];
    $mberEmail = $_POST['member_email'];
    $mberName = $_POST['member_name'];

    $sql = 'SELECT * FROM members WHERE email=?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mberEmail]);
    $row = $stmt->fetch();
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
        $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              The department already exist!!
          </div>      
  ';
    } else {
        try {
            $sql = "INSERT INTO members(email,username) VALUES(?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mberEmail,$mberName]);
            //insert photo into table profile
            $stmt = $pdo->prepare("INSERT INTO profile (photo)VALUES(?)");
            $stmt->execute([$photo]);
            $count = $stmt->rowCount();

            $lastInsertId = $pdo->lastInsertId();

            //  if($lastInsertId){
            //   $message .= '
            //         <div class="alert alert-success">
            //                   <h4><i class="icon fa fa-check"></i> Success!</h4>
            //                  Department <b>'.$email.'</b>  added succesfully
            //               </div>
            //               <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
            //       ';

            // }
        } catch (PDOException $e) {
            $message .= '
    <div class="alert alert-danger">
              <h4><i class="icon fa fa-warning"></i> Error!</h4>
              ' . $e->getMessage() . '
          </div>
          <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
  ';
        }

    }

}



// Photo edit
if (isset($_POST['edit_photo'])){
    $photo=$_POST['photo'];
    $id=$_COOKIE['ids'];
    $stmt = $pdo->prepare("UPDATE profile SET photo=? WHERE id=?");
    $stmt->execute([$photo,$id]);
    ?>
    <script>
        document.querySelector('input[name=edit_photo]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}

// delete
if (isset($_POST['delete'])){
  
    $id=$_COOKIE['ids'];
    $stmt = $pdo->prepare("DELETE FROM members WHERE id=?");
    $stmt->execute([$id]);
    ?>
    <script>
        document.querySelector('input[name=delete]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}

// block
if (isset($_POST['block'])){
   
    $id=$_COOKIE['ids']; 
        $status= '1';
        $stmt = $pdo->prepare("UPDATE members SET status=? WHERE id=?");
        $stmt->execute([$status,$id]);   
    ?>
    <script>
        document.querySelector('input[name=block]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}

// Unblock
if (isset($_POST['ublock'])){
   
    $id=$_COOKIE['ids']; 

    $status= '0';

    // $sql = "INSERT INTO members(status) VALUES(?)";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$dptmtName,$logo]);


    $stmt = $pdo->prepare("UPDATE members SET status=? WHERE id=?");
    $stmt->execute([$status,$id]);   

    ?>
    <script>
        document.querySelector('input[name=unblock]').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
    </script>
<?php
}
?>



<!-- Add Member -->
<div class="modal fade" id="add_member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Member</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                
                <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Photo</label>
                        <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" id="name" name="member_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="member_name" class="form-control" required>
                    </div>
                 

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close
                </button>
                <button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save
                </button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- DELETE MODAL -->
<div class="modal modal-danger fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                <h2>Are you sure you want to delete this user?</h2>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="delete"><i class="fa fa-check"></i> Yes
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Block Member -->
<div class="modal modal-danger fade" id="block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Block user</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                <h2>Are you sure you want to Block this user? </h2>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="block"><i class="fa fa-check"></i> Yes
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- Unlock MODAL -->
<div class="modal modal-info  fade" id="unblock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Unblock user</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                <h2>Are you sure you want to Unblock this user?</h2>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="unblock"><i class="fa fa-check"></i> Yes
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- EDIT logo  -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eedit Department</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Logo</label>
                        <input type="file" id="exampleFormControlFile1" name="photo" class="form-control-file"  >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" name="edit_photo"><i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
