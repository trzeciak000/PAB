<div><br />
    <?php if(isset($_SESSION['is_logged_in']) && ($_SESSION['user_data']['role_id'] == 1 || $_SESSION['user_data']['role_id'] == 2)) : ?>
        <h3>Options: </h3>
        <br />  <a class="btn btn-warning" href="<?php echo ROOT_PATH; ?>admin/manageshares">Manage shares</a>
        <br /><br /><a class="btn btn-warning" href="<?php echo ROOT_PATH; ?>admin/manageusers">Manage users</a>
    <?php else : ?>
        <h3>You have no permission to be here. Log in as admin.</h3>
    <?php endif; ?>
</div>