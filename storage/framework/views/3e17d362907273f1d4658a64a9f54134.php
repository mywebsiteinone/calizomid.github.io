

<?php $__env->startSection('content'); ?>
    <h1>Add School Year</h1>
    <form action="<?php echo e(route('school_years.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="school_year">School Year:</label>
        <input type="text" name="school_year" required>
        <button type="submit">Add</button>
    </form>
    <div class="mb-3">
        <a href="<?php echo e(route('school_years.index')); ?>" class="btn btn-success">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christianschool_year_create.blade.php ENDPATH**/ ?>