<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Home</h1>
    <p>Bienvenido <?php echo e($nombre ?? 'Invitado'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jhord\Documents\mipymes\examen-grupal\resources\views/home.blade.php ENDPATH**/ ?>