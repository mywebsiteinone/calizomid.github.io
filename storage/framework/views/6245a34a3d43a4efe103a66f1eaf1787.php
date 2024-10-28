<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<?php $__env->startSection('content'); ?>
    <h1>Student List</h1>
    <a href="<?php echo e(route('students.create')); ?>">Add Student</a>
    <ul>
        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($student->student_fname); ?> <?php echo e($student->student_sname); ?>

                <a href="<?php echo e(route('students.edit', $student)); ?>">Edit</a>
                <form action="<?php echo e(route('students.destroy', $student)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <a href="<?php echo e(route('students.genderChart')); ?>">View Gender Chart</a>
    <div class="mb-3">
        <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-warning">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christianstudent.blade.php ENDPATH**/ ?>