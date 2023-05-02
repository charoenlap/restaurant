<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <ul id="orders-list">
                <?php foreach($date_lists as $val){ ?>
                <li><?php echo $val['order_date'].' - '.$val['total_amount'];?></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>