<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Welcome, <?php echo e(Auth::user()->name); ?> (User)</h1>
    <p>This is your user dashboard.</p>
    <a href="<?php echo e(route('logout')); ?>" class="btn btn-warning">Logout</a>
</body>
</html>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Register Student</h1>
    
    <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="btn btn-success">Manage Students</a>
    </div>

    <!-- Additional content can go here -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/user/dashboard.blade.php ENDPATH**/ ?>