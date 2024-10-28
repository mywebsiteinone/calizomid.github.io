<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<?php $__env->startSection('content'); ?>
    <h1>School Year List</h1>
    <a href="<?php echo e(route('school_years.create')); ?>">Add School Year</a>
    <ul>
        <?php $__currentLoopData = $schoolYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schoolYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($schoolYear->school_year); ?> 
                <a href="<?php echo e(route('school_years.edit', $schoolYear)); ?>">Edit</a>
                <form action="<?php echo e(route('school_years.destroy', $schoolYear)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="mb-3">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-warning">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christianschool_year.blade.php ENDPATH**/ ?>