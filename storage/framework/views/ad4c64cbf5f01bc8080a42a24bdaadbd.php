

<?php $__env->startSection('content'); ?>
    <h1>Add Course</h1>
    <form action="<?php echo e(route('courses.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" required>
        <button type="submit">Add</button>
    </form>
    <div class="mb-3">
        <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-success">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christiancourse_create.blade.php ENDPATH**/ ?>