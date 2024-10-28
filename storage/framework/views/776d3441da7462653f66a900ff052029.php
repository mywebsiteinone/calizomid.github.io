<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="text-3xl mb-4">Manage Your Posts</h1>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white shadow-md rounded-lg p-6 mb-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold"><?php echo e($post->title); ?></h2>
                <p class="text-gray-600"><?php echo e($post->content); ?></p>
            </div>
            <div class="flex space-x-2">
                <a href="<?php echo e(route('posts.edit', $post)); ?>" class="bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="<?php echo e(route('posts.destroy', $post)); ?>" method="POST" onsubmit="return confirm('Are you sure?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-red-500 text-white p-2 rounded hover:bg-red-600">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('posts.create')); ?>" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Create New Post</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\abalo\midact3\resources\views/posts/index.blade.php ENDPATH**/ ?>