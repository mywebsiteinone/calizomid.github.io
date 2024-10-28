

<?php $__env->startSection('content'); ?>
    <div>
        <form action="<?php echo e(route('otp.verify.post')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="otp">Enter the OTP sent to your email:</label>
            <input type="text" name="otp" id="otp" required>
            <?php $__errorArgs = ['otp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <button type="submit">Verify OTP</button>
        </form>

        <div id="timer" style="margin-top: 20px;">
            Time remaining: <span id="countdown"></span>
        </div>
    </div>

    <script>
        // Set the time limit (in seconds)
        let timeLimit = 60; // Example: 5 minutes
        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            const minutes = Math.floor(timeLimit / 60);
            const seconds = timeLimit % 60;

            countdownElement.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timeLimit > 0) {
                timeLimit--;
            } else {
                // Redirect to registration form
                window.location.href = "<?php echo e(route('register')); ?>";
            }
        }

        // Update the countdown every second
        setInterval(updateCountdown, 1000);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\chris\midtermact1\resources\views/auth/otp.blade.php ENDPATH**/ ?>