<div>
    <?php if(isset($_SESSION['is_logged_in']) && ($_SESSION['user_data']['role_id'] == 1 || $_SESSION['user_data']['role_id'] == 2)) : ?>
    <br />
    <a class="btn btn-secondary" href="<?php echo ROOT_URL; ?>Admin">Back</a>
    <br /><br />
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label>View by category: </label>
        <select name="category">
            <option value="0">all</option>
            <?php foreach ($viewmodel[1] as $cat) : ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['category']; ?></option>
            <?php endforeach; ?>
        </select>
        <input class="btn btn-primary" type="submit" name="submit" value="view">
    </form>
    <?php foreach($viewmodel[0] as $item) : ?>
    <?php
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(array_key_exists("A".$item['id'],$_POST)){
        $sql = "UPDATE shares SET visible='1' WHERE id=" . $item['id'];
        $conn->query($sql);
        header('Location: '.ROOT_PATH."admin/manageshares");
    }
    if(array_key_exists("U".$item['id'],$_POST)){
        $sql = "UPDATE shares SET visible='0' WHERE id=" . $item['id'];
        $conn->query($sql);
        header('Location: '.ROOT_PATH."admin/manageshares");
    }
    if(array_key_exists("D".$item['id'],$_POST)){
        $sql = "DELETE FROM shares WHERE id=" . $item['id'];
        $conn->query($sql);
        header('Location: '.ROOT_PATH."admin/manageshares");
    }
    ?>

        <div class="well">
            <h3><?php echo $item['title'].'<br />'; ?></h3>
            <small>Category: <?php $sql = "SELECT category FROM categories WHERE id=" . $item['category_id']; $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo $row["category"];
                }
                ?></small><br />
            <small><?php echo $item['create_date']; ?> Author: <?php $sql = "SELECT name FROM users WHERE id=" . $item['user_id']; $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo $row["name"];
                }
                ?></small>
            <br />
            <p><?php echo $item['body']; ?></p>
            <p>Link: <?php echo $item['link']; ?></p>
        <?php if($item['visible'] == 0) : ?>
            <form method="post">
                <input type="submit" name="A<?php echo $item['id']; ?>" value="Accept" class="btn btn-success">   <input type="submit" name="D<?php echo $item['id']; ?>" value="Delete" class="btn btn-danger">
            </form>
        <?php else : ?>
            <form method="post">
                <input type="submit" name="U<?php echo $item['id']; ?>" value="Unaccept" class="btn btn-warning">   <input type="submit" name="D<?php echo $item['id']; ?>" value="Delete" class="btn btn-danger">
            </form>
        <?php endif; ?>
            <br /><br />
        </div>
<?php endforeach; ?>
<?php else : ?>
    <h3>You have no permission to be here. Log in as admin.</h3>
<?php endif; ?>
</div>
