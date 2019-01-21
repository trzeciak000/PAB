<div>
<?php if(isset($_SESSION['is_logged_in']) && ($_SESSION['user_data']['role_id'] == 1 || $_SESSION['user_data']['role_id'] == 2)) : ?>
    <br />
    <a class="btn btn-secondary" href="<?php echo ROOT_URL; ?>Admin">Back</a>
    <br /><br />
<h3>Note: You don't see super admins! To make super admin priviliges contact with developer!</h3>
<h3>Note2: If You delete user, You will automaticcly delete his shares!</h3>
<h3>Note 3: You dont't see super admins and your own account!</h3>
<?php foreach ($viewmodel as $user) : ?>
    <?php
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(array_key_exists("M".$user['id'],$_POST)){
            $sql = "UPDATE users SET role_id='2' WHERE id=" . $user['id'];
            $conn->query($sql);
            header('Location: '.ROOT_PATH."admin/manageusers");
        }
        if(array_key_exists("U".$user['id'],$_POST)){
            $sql = "UPDATE users SET role_id='3' WHERE id=" . $user['id'];
            $conn->query($sql);
            header('Location: '.ROOT_PATH."admin/manageusers");
        }
        if(array_key_exists("D".$user['id'],$_POST)){
            $sql = "DELETE FROM users WHERE id=" . $user['id'];
            $conn->query($sql);
            $sql = "DELETE FROM shares WHERE user_id=" . $user['id'];
            $conn->query($sql);
            header('Location: '.ROOT_PATH."admin/manageusers");
            header('Location: '.ROOT_PATH."admin/manageusers");
        }
    ?>
    <?php if ($user['role_id'] == 2) : ?>
    <br /><br />
    <div class="well">
        <b>Name:</b> <?php echo $user['name'];?> <b>Email:</b> <?php echo $user['email'];?> <b>Register date:</b> <?php echo $user['register_date'];?> <b>Role:</b> <?php $sql = "SELECT role FROM roles WHERE id=" . $user['role_id']; $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {echo $row["role"];}
    ?><form method="post">
            <input type="submit" name="U<?php echo $user['id']; ?>" value="Unmake admin" class="btn btn-warning">   <input type="submit" name="D<?php echo $user['id']; ?>" value="Delete" class="btn btn-danger">
        </form>
    </div>
    <?php else : ?>
    <br /><br />
    <div class="well">
        <b>Name:</b> <?php echo $user['name'];?> <b>Email:</b> <?php echo $user['email'];?> <b>Register date:</b> <?php echo $user['register_date'];?> <b>Role:</b> <?php $sql = "SELECT role FROM roles WHERE id=" . $user['role_id']; $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {echo $row["role"];}
        ?><form method="post">
            <input type="submit" name="M<?php echo $user['id']; ?>" value="Make admin" class="btn btn-success">   <input type="submit" name="D<?php echo $user['id']; ?>" value="Delete" class="btn btn-danger">
        </form>
    </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php else : ?>
<h3>You have no permission to be here. Log in as admin.</h3>
<?php endif; ?>
</div>