<html>
<head>
    <title>Shareboard</title>
    <link rel="stylesheet" href="/php_shareboard_project/assests/css/bootstrap.css">
    <link rel="stylesheet" href="/php_shareboard_project/assests/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Shareboard</a>
  <div class="navbar panel" id="navbarText">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home<span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>Shares">Shares</a>
      </li>
    <?php if(isset($_SESSION['is_logged_in']) && ($_SESSION['user_data']['role_id'] == 1 || $_SESSION['user_data']['role_id'] == 2)) : ?>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo ROOT_URL; ?>Admin">Admin panel</a>
        </li>
    <?php endif; ?>
    </ul>
    <span class="navbar-text justify-content-end">
      <ul class="nav">
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <li><a class="nav-link" href="<?php echo ROOT_URL; ?>">Welcome <?php echo $_SESSION['user_data']['name']; ?></a></li>
        <li><a class="nav-link" href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
        <?php else : ?>
        <li><a class="nav-link" href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
        <li><a class="nav-link" href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
      <?php endif; ?>
      </ul>
    </span>
  </div>
</nav>

  <div class="container">
    <div class="row">
<!--        --><?php //var_dump($_GET); ?>
      <?php Messages::display(); ?>
      <?php require($view); ?>
    </div>

  </div><!-- /.container -->
</body>
</html>
