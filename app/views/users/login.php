<?php 
/*
this blog platform build by msustaf naseer for zainiq tasks 
its opensource code any one can access it in my github accounts
*/

require __DIR__ . '/../layouts/header.php'; 
?>

<h2>Login</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="/login" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
