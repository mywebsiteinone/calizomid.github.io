

<?php $__env->startSection('content'); ?>
    <h1>Edit Student</h1>
    <form action="<?php echo e(route('students.update', $student)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <label for="student_fname">First Name:</label>
        <input type="text" name="student_fname" value="<?php echo e($student->student_fname); ?>" required>
        <label for="student_mname">Middle Name:</label>
        <input type="text" name="student_mname" value="<?php echo e($student->student_mname); ?>" required>
        <label for="student_sname">Last Name:</label>
        <input type="text" name="student_sname" value="<?php echo e($student->student_sname); ?>" required>
        <label for="student_exname">Extension Name:</label>
        <input type="text" name="student_exname" value="<?php echo e($student->student_exname); ?>" required>
        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?php echo e($student->gender); ?>" required>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo e($student->age); ?>" required>
        <label for="civil_status">Civil Status:</label>
        <input type="text" name="civil_status" value="<?php echo e($student->civil_status); ?>" required>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo e($student->address); ?>" required>
        <label for="student_email">Email:</label>
        <input type="email" name="student_email" value="<?php echo e($student->student_email); ?>" required>
        <label for="student_contact">Contact:</label>
        <input type="text" name="student_contact" value="<?php echo e($student->student_contact); ?>" required>
        <label for="school_year_id">School Year:</label>
        <select name="school_year_id">
            <?php $__currentLoopData = $schoolYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($year->id); ?>" <?php echo e($year->id == $student->school_year_id ? 'selected' : ''); ?>><?php echo e($year->school_year); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <label for="course_id">Course:</label>
        <select name="course_id">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($course->id); ?>" <?php echo e($course->id == $student->course_id ? 'selected' : ''); ?>><?php echo e($course->course_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit">Update</button>
        <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="btn btn-success">Back</a>
    </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/christianstudent_edit.blade.php ENDPATH**/ ?>