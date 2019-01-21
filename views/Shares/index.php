<?php
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME)
?>
<div><br />
  <?php if(isset($_SESSION['is_logged_in'])) : ?>
  <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>shares/add">Share</a>
  <?php else : ?>
  <h3><a href="<?php echo ROOT_PATH; ?>users/login">Log in</a> to share something</h3>
  <?php endif; ?>
  <br />
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
    <?php if($item['visible'] == 1) : ?>
        <div class="well">
            <h3><?php echo $item['title'].'<br />'; ?></h3>
            <small>Category: <?php $sql = "SELECT category FROM categories WHERE id=" . $item['category_id']; $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo $row["category"];
                }
                ?></small><br />
            <small><?php echo $item['create_date'];?> Author: <?php $sql = "SELECT name FROM users WHERE id=" . $item['user_id']; $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo $row["name"];
                }
            ?></small>
            <br />
            <p><?php echo $item['body']; ?></p>
            <br />
            <a class="btn btn-outline-primary" href="<?php echo $item['link']; ?>" target="_blank">Go to Website</a>
            <br /><br />
        </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
