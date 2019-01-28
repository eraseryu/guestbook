<div id="add-post">

    <h2 class="well">
        <span class="glyphicon glyphicon-user"></span> Login
    </h2>

    <?php if ($this->error) : ?>
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <?php echo $this->error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" role="form" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Username</label>
            <div class="col-lg-5">
                <input name="username" class="form-control" type="text" value="<?php echo $this->data['username']; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="mail" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-5">
                <input name="password" class="form-control" type="password" value="<?php echo $this->data['password']; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name="login" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-ok-circle"></span> Login
                </button>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-10">For test please use (user/pass): admin/admin or guest/guest</div>
    </form>
</div>