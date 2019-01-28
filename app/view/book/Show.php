<?php if ($this->success) : ?>
<div class="alert alert-success">
    <?php echo $this->success; ?>
</div>
<?php endif; ?>

<?php if ($this->errorMsg) : ?>
    <div class="alert alert-danger">
        <?php echo $this->errorMsg; ?>
    </div>
<?php endif; ?>

<?php foreach ($this->posts as $post) : ?>
<section class="post post-<?php echo $post['post_id']; ?>">

    <h2><?php echo $post['title']; ?></h2>
    <p>
        <?php echo $post['message']; ?>
    </p>
    <?php if(!empty($post['image_name'])): ?>
        <p>
            <img src="<?php echo UPLOAD_PATH . $post['image_name']; ?>" alt="guestbook image">
        </p>
    <?php endif; ?>
    <?php if($this->isAdmin): ?>
        <a href="?controller=Book&method=edit&id=<?php echo $post['post_id']; ?>">
            <span class="glyphicon glyphicon-align-justify"></span> Edit post
        </a><br />

        <a href="?controller=Book&method=delete&id=<?php echo $post['post_id']; ?>">
            <span class="glyphicon glyphicon-trash"></span> Delete post
        </a>
    <?php endif; ?>
</section>
<?php endforeach; ?>

<div id="pagination">

    <?php if ($this->page > 1) : ?>
    <a href="?controller=Book&method=show&page=<?php echo $page - 1; ?>">
        <span class="glyphicon glyphicon-chevron-left"></span> Back
    </a>
    <?php endif; ?>

    <span>Page <strong><?php echo $page; ?></strong> of <strong><?php echo $this->maxPage; ?></strong></span>

    <?php if ($this->page < $this->maxPage) : ?>
    <a href="?controller=Book&method=show&page=<?php echo $page + 1; ?>">
        Next <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
    <?php endif; ?>

</div>