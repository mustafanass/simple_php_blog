<?php 
/*
this blog platform build by msustaf naseer for zainiq tasks 
its opensource code any one can access it in my github accounts
*/

require __DIR__ . '/../layouts/header.php'; 
?>

<div class="container my-4">
    <h2 class="mb-4">Recent Posts</h2>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                <?php if ($post['image']): ?>
                    <img src="<?php echo ($post['image']); ?>" class="custom-img" alt="Post Image">
                <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/post/<?php echo $post['id']; ?>" class="text-decoration-none"><?php echo ($post['title']); ?></a>
                        </h5>
                        <p class="card-text">
                            <?php
                            // make post in index page show only 30 words of post and to see more press read more
                            // removes all HTML tags from description string so make it plain text
                            // using explode function to splits a string into an array of words based on spaces 
                            $words = explode(' ', strip_tags($post['description']));
                            // using array_slice function to get only first 30 elemnts from array which is (30 words)
                            $words_allow = array_slice($words, 0, 30);
                            // using implode to join the elements of the above  array into a single string separated by a space
                            $short_description = implode(' ', $words_allow);
                            echo ($short_description);
                            ?>
                        </p>
                        <p class="card-text">
                        <small class="text">
                                <i class="fas fa-user icon-spacing-left"></i> <i><?php echo ($post['username']); ?></i>
                                <i class="fas fa-calendar-alt icon-spacing-left"></i> <?php echo $post['created_at']; ?>
                                <i class="fas fa-comments icon-spacing-left"></i> <?php echo $this->postModel->getCommentCount($post['id']); ?>
                            </small>
                        </p>
                        <a href="/post/<?php echo $post['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
