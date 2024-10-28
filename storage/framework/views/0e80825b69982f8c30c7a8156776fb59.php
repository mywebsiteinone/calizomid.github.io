<!DOCTYPE html>
<html>
<head>
    <title>Post Status Update</title>
</head>
<body>
    <h1>Important Notification</h1>
    <p>Im here to inform you that your post
        titled <U><?php echo e($title); ?></U>
        <?php if(is_string($message)): ?>
            <?php echo e($message); ?>

        <?php else: ?>
            <?php echo e(json_encode($content)); ?>

        <?php endif; ?>
    </p>
</body>
</html>
<?php /**PATH C:\Users\abalo\midact3\resources\views/post_status_updated.blade.php ENDPATH**/ ?>