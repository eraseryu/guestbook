<div id="post-detail">

    <?php if ($this->error) : ?>
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-warning-sign"></span>
            <?php echo $this->error; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" role="form" class="form-horizontal">
        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>"/>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input name="title" class="form-control" type="text" value="<?php echo $post['title']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Message</label>
            <div class="col-lg-10">
                <textarea name="message" class="form-control" rows="10"><?php echo $post['message']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Image</label>
            <div class="col-lg-10">
            <?php if(!empty($post['image_name'])): ?>
                <p>
                    <img src="<?php echo UPLOAD_PATH . $post['image_name']; ?>" alt="guestbook image not available">
                </p>
            <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Status</label>
            <label class="checkbox-inline">
                <input type="checkbox" name="status" value="active"
                    <?php if ($post['status'] == 'active') : ?> checked <?php endif; ?>
                >Active
            </label>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                Post created by: <?php echo $post['name'] . '(' . $post['mail'] . ') on ' . $post['created_at']; ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name="edit" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-pencil"></span> Update
                </button>
            </div>
        </div>
    </form>

</div>