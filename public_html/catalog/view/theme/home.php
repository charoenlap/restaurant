<div class="container mt-4">
    <div class="row">
    <?php for ($i = 1; $i <= 15; $i++) { ?>
        <div class="col-2">
            <a href="<?php echo route('order');?>" class="btn btn-primary btn-block mb-4"><?php echo $i;?></a>
        </div>    
    <?php } ?>
    </div>
</div>