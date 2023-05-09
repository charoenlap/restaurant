<div class="container mb-4 pb-4">
    <div class="row mt-4">
        <div class="col-6">
            <p class="text-danger text-center" id="txtShowError"></p>
            <table class="table" id="tableList">
                <tbody></tbody>
            </table>
        </div>
        <div class="col-6">
            <p></p>
            <table class="table" id="tableSum">
                <tbody>
                    <tr>
                        <td>ยอดรวม</td>
                        <td><label for="" id="total"></label></td>
                    </tr>
                    <tr>
                        <td>ส่วนลด</td>
                        <td><label for="" id="discount"></label></td>
                    </tr>
                    <tr>
                        <td>ยอดที่จะต้องจ่าย</td>
                        <td><label for="" id="nettotal"></label></td>
                    </tr>
                    <tr>
                        <td>รับมา</td>
                        <td><label for="" id="money"></label></td>
                    </tr>
                    <tr>
                        <td>เงินทอน</td>
                        <td><label for="" id="change"></label></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <label for="num-pad-input">รับเข้า:</label>
        <input id="num-pad-input" type="text" class="form-control" value="">
        </div>
    </div>
    <div class="row d-none">
        <div class="col-12">
            <label for="num-pad-input">ส่วนลด:</label>
            <input id="text-discount" type="text" class="form-control" value="">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="num-pad2">
                <button class="btn-calculate num-pad-button">C</button>
                <button class="btn-calculate " id="checkoutall">ชำระทั้งหมด</button>
                <button class="btn-calculate " id="QRcode" data-toggle="modal" data-target="#qrModal">QR Code</button>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="num-pad"></div>
      </div>
    </div>
    
</div>
<div id="clearOrderByMoney">
    บันทึกชำระด้วยเงินสด
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="modal-title">Food Name</h5>
                        <p>Description of the food goes here.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger float-left delete-btn">ลบ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">QR Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="qrTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="qrCodeTab" data-toggle="tab" href="#qrCode" role="tab" aria-controls="qrCode" aria-selected="true">กรุงเทพ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="qrImageTab" data-toggle="tab" href="#qrImage" role="tab" aria-controls="qrImage" aria-selected="false">กรุงไทย</a>
                    </li>
                </ul>
                <div class="tab-content" id="qrTabContent">
                    <div class="tab-pane fade show active" id="qrCode" role="tabpanel" aria-labelledby="qrCodeTab">
                        <img src="images/qr.jpg" class="img-fluid">
                        <label for=""></label>
                    </div>
                    <div class="tab-pane fade" id="qrImage" role="tabpanel" aria-labelledby="qrImageTab">
                        <img src="images/qr2.jpg" class="img-fluid">
                        <label for=""></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center"><span  id="txttotalprice"></span> บาท</h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block" id="clearOrderByQR">บันทึกชำระโดย QR Code</button>
            </div>
        </div>
    </div>
</div>

<style>
    #clearOrderByMoney {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        border-top: 1px solid #ddd;
    }
    .num-pad,.num-pad2 {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .btn-calculate {
        width: 30%;
        margin-bottom: 5px;
        font-size: 16px;
        padding: 10px;
        border-radius: 5px;
        border: none;
        background-color: #eeeeee;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-calculate:hover {
    background-color: #dddddd;
    }

    #num-pad-delete {
        width: 30%;
    margin-bottom: 10px;
    font-size: 16px;
    padding: 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    background-color: #f44336;
    }

    #num-pad-delete:hover {
    background-color: #f44336;
    }

</style>
<script>
    $(document).on('click','#QRcode',function(e){
        $('#txttotalprice').text(parseFloat($('#total').text()));
        $('#num-pad-input').val(parseFloat($('#total').text()));
        // $('#num-pad-input').change();
        var value = $('#num-pad-input').val();
        if ($(this).data('value') !== undefined) {
            value += $(this).data('value');
        }else {
            value = 0;
        }
        // $('#num-pad-input').val(value);
        // Calculate the new values
        var total = 0;
        $('input[name="price[]"]').each(function() {
        total += parseFloat($(this).val());
        });
        $('#total').text(total.toFixed(2));
        var discount = parseFloat($('#text-discount').val()) || 0;
        $('#discount').text(discount.toFixed(2));
        var netTotal = total - discount;
        $('#nettotal').text(netTotal.toFixed(2));
        var money = parseFloat($('#num-pad-input').val()) || 0;
        $('#money').text(money.toFixed(2));
        var change = money - netTotal;
        $('#change').text(change.toFixed(2));
    });
</script>
<script>
    var countCategory = 0;
    $(document).ready(function() {
        $.ajax({
        url: 'index.php?route=order/getOrder',
        method: 'GET',
        data: { table_id: <?php echo get('table_id');?> },
        success: function(response) {
            console.log(response);
            $.each(response, function(key, value) {
                var newRow = '<tr data-toggle="modal" data-target="#editModal" menu-id="'+value.menu_id+'" flag-confirm="'+value.flag_confirm+'">' +
                        '<td>' + value.name + '  <div>' + value.comment + '</div></td>' +
                        '<td>' + value.option_name + '</td>' +
                        '<td>' + parseInt(value.price) +
                        '<input type="hidden" name="menu_id[]" value="'+value.id+'">' +
                        '<input type="hidden" name="table_id[]" value="<?php echo get('table_id'); ?>">' +
                        '<input type="hidden" name="price[]" value="'+ parseInt(value.price) +'">' +
                        '<input type="hidden" name="comment[]" value="'+ value.comment +'">' +
                        '<input type="hidden" name="option_id[]" value="'+ value.option_id +'">' +
                        '</td>' +
                        '</tr>';
                if(value.category_id=='4'){
                    countCategory++;
                }
                $('#tableList tbody').append(newRow);
                var total = 0;
                $('input[name="price[]"]').each(function() {
                    total += parseFloat($(this).val());
                });
                $('#total').text(total.toFixed(2));
            })
            if(countCategory==0){
                $('#txtShowError').text('บิลนี้ไม่มีน้ำ');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
        });
    });
    $(document).ready(function() {
        // Create the number pad buttons
        for (var i = 1; i <= 9; i++) {
            var button = $('<button></button>', {
            class: 'num-pad-button btn-calculate',
            text: i,
            data: {
                value: i
            }
            });
            
            $('.num-pad').append(button);
        }
        var button = $('<button></button>', {
            class: 'num-pad-button btn-calculate',
            text: 0,
            data: {
                value: 0
            }
            });
        $('.num-pad').append(button);
        
        var button = $('<button></button>', {
            class: 'num-pad-button btn-calculate',
            text: 100,
            data: {
                value: 100
            }
            });
        $('.num-pad').append(button);
        var button = $('<button></button>', {
            class: 'num-pad-button btn-calculate',
            text: 500,
            data: {
                value: 500
            }
            });
        $('.num-pad').append(button);
        // var deleteButton = $('<button></button>', {
        //     id: 'num-pad-delete',
        //     class: 'btn btn-danger btn-block num-pad-button',
        //     text: '<'
        // });
        
        // $('.num-pad').append(deleteButton);
        
        
        // Add event listeners for the number pad buttons
        // $('.num-pad-button').click(function() {
        //     var value = $(this).data('value');
        //     $('#num-pad-input').val(function(i, text) {
        //     return text + value;
        //     });
        // });
        
        // Add event listener for the delete button
        // $('#num-pad-delete').click(function() {
        //     var value = $('#num-pad-input').val();
        //     if (value !== undefined) {
        //     $('#num-pad-input').val(value.slice(0, -1));
        //     }
        // });
        // var clearButton = $('<button></button>', {
        //     class: 'num-pad-button',
        //     text: 'C'
        // });
        // $('.num-pad').append(clearButton);

        // Handle number pad button clicks

        // <button class="num-pad-button" value="ชำระทั้งหมด">ชำระทั้งหมด</button>
        $('#checkoutall').click(function(){
            // console.log($('#total').text());
            var total = parseFloat($('#total').text());
            $('#num-pad-input').val(total);
            var total = 0;
            $('input[name="price[]"]').each(function() {
            total += parseFloat($(this).val());
            });
            $('#total').text(total.toFixed(2));
            var discount = parseFloat($('#text-discount').val()) || 0;
            $('#discount').text(discount.toFixed(2));
            var netTotal = total - discount;
            $('#nettotal').text(netTotal.toFixed(2));
            var money = parseFloat($('#num-pad-input').val()) || 0;
            $('#money').text(money.toFixed(2));
            var change = money - netTotal;
            $('#change').text(change.toFixed(2));
        });

        $('.num-pad-button').click(function() {
            var value = $('#num-pad-input').val();
            if ($(this).data('value') !== undefined) {
                value += $(this).data('value');
            }else {
                value = 0;
            }
            $('#num-pad-input').val(  parseInt(value)  );
            var total = 0;
            $('input[name="price[]"]').each(function() {
            total += parseFloat($(this).val());
            });
            $('#total').text(total.toFixed(2));
            var discount = parseFloat($('#text-discount').val()) || 0;
            $('#discount').text(discount.toFixed(2));
            var netTotal = total - discount;
            $('#nettotal').text(netTotal.toFixed(2));
            var money = parseFloat($('#num-pad-input').val()) || 0;
            $('#money').text(money.toFixed(2));
            var change = money - netTotal;
            $('#change').text(change.toFixed(2));
        });

        // Handle discount input changes
        $('#text-discount').on('input', function() {
            // Calculate the new values
            var total = 0;
            $('input[name="price[]"]').each(function() {
            total += parseFloat($(this).val());
            });
            $('#total').text(total.toFixed(2));
            var discount = parseFloat($('#text-discount').val()) || 0;
            $('#discount').text(discount.toFixed(2));
            var netTotal = total - discount;
            $('#nettotal').text(netTotal.toFixed(2));
            var money = parseFloat($('#num-pad-input').val()) || 0;
            $('#money').text(money.toFixed(2));
            var change = money - netTotal;
            $('#change').text(change.toFixed(2));
        });

        // Handle num pad input changes
        $('#num-pad-input').on('input', function() {
            // Calculate the new values
            var total = 0;
            $('input[name="price[]"]').each(function() {
            total += parseFloat($(this).val());
            });
            $('#total').text(total.toFixed(2));
            var discount = parseFloat($('#text-discount').val()) || 0;
            $('#discount').text(discount.toFixed(2));
            var netTotal = total - discount;
            $('#nettotal').text(netTotal.toFixed(2));
            var money = parseFloat($('#num-pad-input').val()) || 0;
            $('#money').text(money.toFixed(2));
            var change = money - netTotal;
            $('#change').text(change.toFixed(2));
        });

        
    });
    $(document).ready(function() {
        
        $('#clearOrderByQR').click(function() {
            // Get the total amount due and the amount received
            var total = parseFloat($('#total').text());
            
            var discount = parseFloat($('#discount').text());
            var netTotal = total - discount;
            var received = parseFloat($('#num-pad-input').val());
            
            // Calculate the change
            var change = received - netTotal;
            
            // Display the results
            $('#money').text(received.toFixed(2));
            $('#change').text(change.toFixed(2));
            if(parseFloat($('#change').text())>=0){
                console.log($('#nettotal').text());
                $.ajax({
                    url: 'index.php?route=checkout/submitCheckout',
                    type: 'POST',
                    data: { 
                        table_id: '<?php echo get('table_id');?>',
                        type_payment: '2',
                        amount: parseFloat($('#nettotal').text())
                    },
                    success: function(response) {
                        console.log(response);
                        // Handle successful response
                        window.location = 'index.php?route=home';
                    },
                    error: function() {
                    // Handle errors
                        console.log(response);
                    }
                });
            }else{
                alert('เงินทอนต้องเป็น 0 หรือมากกว่า')
            }
            // Clear the input field
            $('#num-pad-input').val('');
        });
        // Handle "บันทึกชำระด้วยเงินสด" button clicks
        $('#clearOrderByMoney').click(function() {
            // Get the total amount due and the amount received
            var total = parseFloat($('#total').text());
            var discount = parseFloat($('#discount').text());
            var netTotal = total - discount;
            var received = parseFloat($('#num-pad-input').val());
            
            // Calculate the change
            var change = received - netTotal;
            
            // Display the results
            $('#money').text(received.toFixed(2)); 
            $('#change').text(change.toFixed(2));
            if(parseFloat($('#change').text())>=0){
                console.log($('#nettotal').text());
                $.ajax({
                    url: 'index.php?route=checkout/submitCheckout',
                    type: 'POST',
                    data: { 
                        table_id: '<?php echo get('table_id');?>',
                        type_payment: '1',
                        amount: parseFloat($('#nettotal').text())
                    },
                    success: function(response) {
                        console.log(response);
                        // Handle successful response
                        window.location = 'index.php?route=home';
                    },
                    error: function() {
                    // Handle errors
                        console.log(response);
                    }
                });
            }else{
                alert('เงินทอนต้องเป็น 0 หรือมากกว่า')
            }
            // Clear the input field
            $('#num-pad-input').val('');
        });

    });
</script>

