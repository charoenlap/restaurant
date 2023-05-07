<div class="container mt-4">
    <div class="row">
    <?php foreach ($tables->rows as $table) { ?>
        <div class="col-3">
            <?php if($table['hide']==1){?>
                
            <?php }else{?>
                <a href="<?php echo route('order&table_id='.$table['id']);?>" id="table_id_<?php echo $table['id'];?>" class="btn btn-<?php echo ((int)$table['table_status']==0?'secondary':'primary')?> btn-block mb-4"><?php echo $table['table_name'];?></a>    
            <?php }?>
        </div>    
    <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function() { 
        setInterval(function() { 
            $.ajax({
            url: 'index.php?route=home/getTable',
            method: 'GET',
            success: function(response) {
                console.log(response);
                $.each(response, function(key, value) {
                    if(parseInt(value.table_status)==1){ 
                        $('#table_id_'+value.id).removeClass('btn-secondary');
                        $('#table_id_'+value.id).removeClass('btn-primary');
                        $('#table_id_'+value.id).addClass('btn-primary');
                    }else{
                        $('#table_id_'+value.id).removeClass('btn-secondary');
                        $('#table_id_'+value.id).removeClass('btn-primary');
                        $('#table_id_'+value.id).addClass('btn-secondary');
                        
                    }
                })
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
            });
        }, 1000); // 2000 milliseconds = 2 seconds
    });
</script>