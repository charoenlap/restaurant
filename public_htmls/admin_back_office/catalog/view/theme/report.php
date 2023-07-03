<pre>
<!--    --><?php //print_r($date_lists); ?>
</pre>
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

    <?php
    /*
    <div class="row">
        <div class="col-12">
<!--            <pre>--><?php //print_r($category); ?><!--</pre>-->
            <select name="" id="selecKanom" class="form-control">
                <option value="0" <?php echo ($kanom=='0'?'selected':'0')?>>ไม่รวมขนม</option>
                <option value="1" <?php echo ($kanom=='1'?'selected':'1')?>>รวมขนม</option>
            </select>
        </div>
    </div>
    */
    ?>
    <div class="row mt-4">
        <div class="col-12">
            <div id="chart_div"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php
            $sumTotal = 0;
            foreach($date_lists as $val) {
                $sumTotal += $val['total_amount'];
            }
            echo "ยอดรวมทั้งหมด: ".number_format($sumTotal);
            echo "\n เฉลี่ยต่อวัน: ". number_format(($sumTotal / count($date_lists)));
            ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <ul id="orders-list">
                <?php foreach($date_lists as $val){ ?>
                <li>
                    <a href="#" class="order_date_detail" data-id="<?php echo $val['id'];?>" data-date="<?php echo $val['order_date'];?>" data-toggle="modal" data-target="#detailModal">
                        <?php echo $val['order_date'].' - '.number_format($val['total_amount']);?>
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
                <h5 class="modal-title" id="detailModalLabel">รายละเอียด รวมที่ยังไม่เช็คบิลด้วย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>รวมทั้งหมด</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail"></ul>
                    </div>
                </div>
                เงินสด <text id="sum-total-cash"></text>
                เงินโอน <text id="sum-total-transfer"></text>
                <br>
                รวม <text id="sum-total"></text>
                <br>------------------------------------------
                <h4>หน้าร้าน</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail-font"></ul>
                    </div>
                </div>
                เงินสด <text id="sum-font-cash"></text>
                เงินโอน <text id="sum-font-transfer"></text>
                <br>
                รวม <text id="sum-font"></text>
                <br>------------------------------------------
                <h4>ไลน์แมน & โรบิน & แกร๊บ</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail-him-send"></ul>
                    </div>
                </div>
                รวม <text id="sum-him-send"></text>
                <br>------------------------------------------
                <h4>กลับบ้าน</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail-go-home"></ul>
                    </div>
                </div>
                รวม <text id="sum-go-home"></text>
                <br>------------------------------------------
                <h4>ส่งเอง</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="list-order-detail-tik-send"></ul>
                    </div>
                </div>
                รวม <text id="sum-tik-send"></text>
                <br>------------------------------------------

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>





<script>
    $(document).on('click','.order_date_detail',function(e){
        var date = $(this).attr('data-date');
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: date },
            success: function(response) {
                let sum = 0
                // console.log(response);
                $('#list-order-detail').html('');
                $.each(response, function(index, value) {
                    $('#list-order-detail').append('<li>'+value.category_name+': '+(parseInt(value.sum_price)).toLocaleString()+'</li>');
                    sum += parseInt(value.sum_price)
                })
                $('#sum-total').text(sum.toLocaleString())
                $.ajax({
                    url: 'index.php?route=report/getSumPayment_by_type_payment',
                    method: 'GET',
                    data: { date: date },
                    success: function(response) {
                        console.log(response);
                        if (response.length) {
                            $('#sum-total-cash').text(JSON.parse(response[0]['total_amount']).toLocaleString())
                            $('#sum-total-transfer').text(JSON.parse(response[1]['total_amount']).toLocaleString())
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error here
                        console.log(xhr,error);
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(xhr,error);
            }
        });
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: date, table_arr_id: '31,32,33,35' },
            success: function(response) {
                let sum = 0
                // console.log(response);
                $('#list-order-detail-font').html('');
                $.each(response, function(index, value) {
                    $('#list-order-detail-font').append('<li>'+value.category_name+': '+(parseInt(value.sum_price)).toLocaleString()+'</li>');
                    sum += parseInt(value.sum_price)
                })
                $('#sum-font').text(sum.toLocaleString())
                $.ajax({
                    url: 'index.php?route=report/getSumPayment_by_type_payment',
                    method: 'GET',
                    data: { date: date, table_arr_id: '31,32,33,35' },
                    success: function(response) {
                        console.log(response);
                        if (response.length) {
                            $('#sum-font-cash').text(JSON.parse(response[0]['total_amount']).toLocaleString())
                            $('#sum-font-transfer').text(JSON.parse(response[1]['total_amount']).toLocaleString())
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error here
                        console.log(xhr,error);
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(xhr,error);
            }
        });
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: date, table_arr_id: '16,17,18,19,20,21' },
                success: function(response) {
                    let sum = 0
                    // console.log(response);
                    $('#list-order-detail-him-send').html('');
                    $.each(response, function(index, value) {
                        $('#list-order-detail-him-send').append('<li>'+value.category_name+': '+(parseInt(value.sum_price)).toLocaleString()+'</li>');
                        sum += parseInt(value.sum_price)
                    })
                    $('#sum-him-send').text(sum.toLocaleString())
                },
                error: function(xhr, status, error) {
                    // Handle the error here
                    console.log(xhr,error);
                }
            });
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: date, table_arr_id: '27,28,29,34' },
            success: function(response) {
                let sum = 0
                // console.log(response);
                $('#list-order-detail-go-home').html('');
                $.each(response, function(index, value) {
                    $('#list-order-detail-go-home').append('<li>'+value.category_name+': '+(parseInt(value.sum_price)).toLocaleString()+'</li>');
                    sum += parseInt(value.sum_price)
                })
                $('#sum-go-home').text(sum.toLocaleString())
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(xhr,error);
            }
        });
        $.ajax({
            url: 'index.php?route=report/getOrderListCategory',
            method: 'GET',
            data: { date: date, table_arr_id: '47,39,40' },
            success: function(response) {
                let sum = 0
                // console.log(response);
                $('#list-order-detail-tik-send').html('');
                $.each(response, function(index, value) {
                    $('#list-order-detail-tik-send').append('<li>'+value.category_name+': '+(parseInt(value.sum_price)).toLocaleString()+'</li>');
                    sum += parseInt(value.sum_price)
                })
                $('#sum-tik-send').text(sum.toLocaleString())
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
        $(document).on('change','#selecKanom',function(e){
            var month = $('#selectMonth').find(":selected").val();
            window.location = 'index.php?route=report&month='+ month + '&kanom='+$(this).val();
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
