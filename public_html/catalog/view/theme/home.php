<div class="container mt-4">
    <div class="row">
    <?php foreach ($tables->rows as $table) { ?>
        <div class="col-3">
            <?php if($table['hide']==1){?>
                
            <?php }else{?>
                <a href="<?php echo route('order&table_id='.$table['id']);?>" class="btn btn-<?php echo ((int)$table['table_status']==0?'secondary':'primary')?> btn-block mb-4"><?php echo $table['table_name'];?></a>    
            <?php }?>
        </div>    
    <?php } ?>
    </div>
</div>