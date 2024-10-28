

<?php $__env->startSection('content'); ?>
    <h1>Edit Course</h1>
    <form action="<?php echo e(route('courses.update', $course)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" value="<?php echo e($course->course_name); ?>" required>
        <button type="submit">Update</button>
    </form>
    <div class="mb-3">
        <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-success">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christiancourse_edit.blade.php ENDPATH**/ ?>