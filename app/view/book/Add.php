<div id="add-post">

    <h2 class="well">
        <span class="glyphicon glyphicon-plus-sign"></span> Add new guestbook entry
    </h2>

    <?php if ($this->error) : ?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-warning-sign"></span>
        <?php echo $this->error; ?>
    </div>
    <?php endif; ?>

    <form action="" method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Title</label>
            <div class="col-lg-10">
                <input name="title" class="form-control" type="text" value="<?php echo $this->data['title']; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Message</label>
            <div class="col-lg-10">
                <textarea name="message" class="form-control" rows="10"><?php echo $this->data['message']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="col-lg-2 control-label">Select image</label>
            <div class="col-lg-10">
                <label class="btn btn-default">
                    Browse <input type="file" name="name" hidden>
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" name="add" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-pencil"></span> Add
                </button>
            </div>
        </div>
    </form>

</div>