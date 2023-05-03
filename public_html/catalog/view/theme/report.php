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
                <li><?php echo $val['order_date'].' - '.$val['total_amount'];?></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).on('change','#selectMonth',function(e){
        window.location = 'index.php?route=report&month='+$(this).val();
    });
</script>
<script>
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