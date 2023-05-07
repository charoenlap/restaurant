<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <select name="" id="selectMonth" class="form-control">
               <?php 
                foreach($months as $key=>$val){?>
                <option value="<?php echo $key;?>" <?php echo ($key==$now_month?'selected':'')?>><?php echo $val;?></option>
               <?php }?>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div id="chart_div"></div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <ul id="orders-list">
                <?php foreach($date_lists as $val){ ?>
                <li>
                    <a href="#" class="order_date_detail" data-id="<?php echo $val['id'];?>" data-toggle="modal" data-target="#detailModal">
                        <?php echo $val['order_date'].' - '.$val['total_amount'];?>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).on('click','.order_date_detail',function(e){
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: '<?php echo date('Y-m-d');?>' },
            success: function(response) {
                console.log(response);
                $('#list-order-detail').html('');
                $.each(response, function(index, value) {
                    $('#list-order-detail').append('<li>'+value.category_name+': '+value.sum_price+'</li>');
                })
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(xhr,error);
            }
        });
    });
    $(document).on('change','#selectMonth',function(e){
        window.location = 'index.php?route=report&month='+$(this).val();
    });
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([    ["Order Date", "Total Amount"],
    <?php foreach($date_lists as $val){ ?>
        ["<?php echo $val['order_date'];?>", <?php echo $val['total_amount'];?>],
    <?php } ?>
    ]);

    var options = {
        chart: {
        title: 'Order Amounts by Date',
        subtitle: 'in baht'
        },
        bars: 'vertical'
    };

    var chart = new google.charts.Bar(document.getElementById('chart_div'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
    }

</script>