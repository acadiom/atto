<?php $__env->startSection('content'); ?>

    <!-- Create code modal form component -->
    <?php echo $__env->make('components.create-code', $__env->array_except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Search form component -->
    <?php echo $__env->make('components.search-form', $__env->array_except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Acronym</th>
                <th>Code</th>
                <th>Concatenated</th>
                <th>Language</th>		
                <th>Description</th>			
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="#">TARSAN</a></td>
                <td>00001</td>
                <td>TARSAN_00001</td>
                <td> es-ES</td>
                <td>El usuario no tiene permisos para ejecutar la operaci&oacuten.</td>
            </tr>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', $__env->array_except(get_defined_vars(), ['__data', '__path']))->render(); ?>