<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <label>เลือกโต๊ะ</label>
            <select name="table_id" id="table_id" class="form-control">
                <option name="">-</option>
                <?php foreach($tables as $table){?>
                    <option value="<?php echo $table['id'];?>"><?php echo $table['table_name'];?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <ul id="orders-list"></ul>
        </div>
    </div>
</div>
<div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="order-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="order-modal-label">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul id="order-details"></ul>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){

        $('#table_id').on('change', function(){
            var table_id = $(this).val();
            $.ajax({
                url: 'index.php?route=report/getHistory',
                type: 'GET',
                data: {table_id: table_id},
                dataType: 'json', // set the expected response data type
                success: function(data){
                    var orders = '';
                    $.each(data, function(index, value){
                        orders += '<li data-payment-id="'+value.id+'">'+value.date_create + ' - '+ value.amount +'</a></li>';
                    });
                    $('#orders-list').html(orders);
                },
                error: function(a,b,c){
                    console.log(a,b,c);
                }
            });
        });
    });
    $('#orders-list').on('click', 'li', function(){
        var payment_id = $(this).attr('data-payment-id');
        console.log(payment_id+'<');
        $.ajax({
            url: 'index.php?route=report/getHistoryOrder',
            type: 'GET',
            data: {payment_id: payment_id},
            dataType: 'json', // set the expected response data type
            success: function(data){
                console.log(data);
                var total = 0;
                var order_details = '';
                $.each(data, function(index, value){
                    total += parseFloat(value.price);
                    order_details += '<li><strong>Name:</strong> ' + value.name + '<br>' +
                                    '<strong>Price:</strong> ' + value.price + '<br>'+ 
                                    '<strong>Comment:</strong> ' + value.comment + 
                                    '</li>';
                });
                order_details += '<div>---------</div><div><strong>Total: '+total+'</strong></div>';
                $('#order-details').html(order_details);
                $('#order-modal').modal('show');
            },
            error: function(a,b,c){
                console.log(a,b,c);
            }
        });
    });
</script>