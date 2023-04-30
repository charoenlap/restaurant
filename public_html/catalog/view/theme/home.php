<div class="container mt-4">
    <div class="row">
    <?php foreach ($tables->rows as $table) { ?>
        <div class="col-4">
            <a href="<?php echo route('order&table_id='.$table['id']);?>" class="btn btn-<?php echo ((int)$table['table_status']==0?'primary':'warning')?> btn-block mb-4"><?php echo $table['table_name'];?></a>
        </div>    
    <?php } ?>
    </div>
</div>