<?php 
/*
this blog platform build by msustaf naseer for zainiq tasks 
its opensource code any one can access it in my github accounts
*/

require __DIR__ . '/../layouts/header.php'; 
?>

<div class="container my-4">
    <h2><?php echo ($post['title']); ?></h2>
    <hr />
    <?php if (!empty($post['image'])): ?>
        <img src="/<?php echo ($post['image']); ?>" alt="Post Image" class="img-fluid mb-2">
    <?php endif; ?>

    <p><?php echo ($post['description']); ?></p>
    <p class="card-text">
        <small class="text">
            <i class="fas fa-calendar-alt icon-spacing-left"></i> <?php echo $post['created_at']; ?>
            <i class="fas fa-comments icon-spacing-left"></i> <?php echo $this->postModel->getCommentCount($post['id']); ?>
        </small>
    </p>
    <?php if (isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>
        <a href="/post/edit/<?php echo ($post['id']); ?>" class="btn btn-secondary mb-2">Edit</a>
        <a href="/post/delete/<?php echo ($post['id']); ?>" class="btn btn-danger mb-2">Delete</a>
    <?php endif; ?>

    <h3>Comments</h3>
    <div class="list-group">
        <?php foreach ($comments as $comment): ?>
            <div class="list-group-item">
                <p><?php echo ($comment['comment']); ?></p>
                    <small class="text">
                        <i class="fas fa-user icon-spacing-left"></i> <i><?php echo ($comment['username']); ?></i>
                        <i class="fas fa-calendar-alt icon-spacing-left"></i> <?php echo $comment['created_at']; ?>
                    </small>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <h3 class="mt-4">Add a Comment</h3>
        <form method="POST" action="/post/create_comment/<?php echo ($post['id']); ?>" class="mt-3">
            <input type="hidden" name="post_id" value="<?php echo ($post['id']); ?>">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Add Comment</button>
        </form>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
