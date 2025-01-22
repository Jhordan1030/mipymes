<?php $__env->startSection('content'); ?>
    <div class="container">
        <h3>Lista de Tipos de Estados</h3>
        <a href="<?php echo e(route('tipo_estado.create')); ?>" class="btn btn-primary mb-3">Añadir Tipo de Estado</a>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tipoEstados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoEstado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($tipoEstado->nombre_estado); ?></td>
                        <td><?php echo e($tipoEstado->descripcion_estado); ?></td>
                        <td>
                            <a href="<?php echo e(route('tipo_estado.edit', $tipoEstado->id_estado)); ?>"
                                class="btn btn-warning btn-sm">Editar</a>
                            <form action="<?php echo e(route('tipo_estado.destroy', $tipoEstado->id_estado)); ?>" method="POST"
                                class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4">No hay registros.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="footer">
            <p>Creado por: Marcelo Chiriboga</p>
        </div>
        <?php echo e($tipoEstados->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jhord\Documents\mipymes\examen-grupal\resources\views/tipo_estado/index.blade.php ENDPATH**/ ?>