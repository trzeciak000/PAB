<div class="panel2">
  <div class="panel-heading">
    <h3 class="panel-title">Register new account</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="name" class="form-control" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group">
            <label>Repeat password</label>
            <input type="password" name="password2" class="form-control" />
        </div>
        <input class="btn btn-primary" name="submit" type="submit" value="Submit">
    </form>
  </div>
</div>
