<div class="container mt-4">
    <div class="row">
        <div class="col-3">
            <a href="#" class="btn">โต๊ะ <strong><?php echo $tableDetail['table_name'];?></strong></a>
        </div>
        <div class="col-3 text-right">
            <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#changeTableModal" id="changeTable">ย้ายโต๊ะ</a>
        </div>
        <div class="col-6 text-right">
            <a href="#" class="btn btn-primary btn-block" id="confirmCheckout">พิมพ์</a>
        </div> 
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $i=0;foreach($category as $val){ ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($i==0?'active':'');?>" id="tab-<?php echo $i;?>" data-toggle="tab" href="#panel-<?php echo $i;?>" role="tab" aria-controls="home" aria-selected="true"><?php echo $val['cate_name'];?></a>
                </li>
                <?php $i++;} ?>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
            <?php $i=0;foreach($category as $val){ ?>
                <div class="tab-pane fade <?php echo ($i==0?' show active':'');?>" id="panel-<?php echo $i;?>" role="tabpanel" aria-labelledby="tab-<?php echo $i;?>">
                    <div class="row">
                    <?php foreach($val['result_menu'] as $menu) { ?>
                        <div class="col-6">
                            <?php if($menu['image']){ ?>
                                <img src="uploads/<?php echo $menu['image'];?>" height="100" width="auto" alt="">
                            <?php } ?>
                            <a href="#" class="btn btn-primary btn-block mb-2 add-menu" data-toggle="modal" data-target="#addModal" menu-id="<?php echo $menu['id'];?>">
                                <?php echo $menu['name'];?>
                            </a>
                        </div>    
                    <?php } ?>
                    </div>
                </div>
            <?php $i++;} ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="#" id="submitOrder">
                <table class="table" id="tableList">
                    <tbody></tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div id="checkBill-btn">
    เช็คบิล
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="addModalLabel" id="addModalLabel">เพิ่มเมนูอาหาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- <img src="food-image.jpg" class="img-fluid"> -->
                    </div>
                    <div class="col-md-8">
                        <h5 class="modal-title" menu-id=""></h5>
                        <p class="price"></p>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle options" data-toggle="buttons"></div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control comment mb-4" id="comment" rows="3"></textarea>
                            <div id="panelAddTags"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary add-order">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header bg-success text-white">
        <strong class="mr-auto">Success</strong>
        <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        This item has been added to your order: <span class="toast-text"></span>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item <span id="showOrderID">-</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to checkout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไข</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- <img src="food-image.jpg" class="img-fluid"> -->
                    </div>
                    <div class="col-md-8">
                        <h5 class="modal-title"  menu-id="" id="editFoodName">Food Name</h5>
                        <p class="price"></p>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle options" data-toggle="buttons"></div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control comment mb-4" id="comment" rows="3"></textarea>
                            <div id="panelEditTags"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:block;">
                <button type="button" class="btn btn-danger float-left delete-btn">ลบ</button>
                <button type="button" class="btn btn-primary edit-order" style="float: right;">บันทึก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changeTableModal" tabindex="-1" role="dialog" aria-labelledby="changeTableModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeTableModalLabel">ย้ายโต๊ะ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ย้ายที่โต๊ะ
                <select class="form-control" id="changeToTable">
                <?php foreach($tables as $table){?>
                    <option value="<?php echo $table['id'];?>"><?php echo $table['table_name'];?></option>
                <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmChangeTable">ย้ายเลย</button>
            </div>
        </div>
    </div>
</div>
<style>
    .comment-btn {
        margin-bottom:10px;
        margin-right:10px;
    }
    .toast {
        display:none;
    }
    .delete-btn:hover { 
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    #checkBill-btn {
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
    #checkout-btn:hover {
        background-color: #0069d9;
        cursor: pointer;
    }

    /* Styles for the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table td, table th {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    /* Hide everything except for the table when printing */
    @media print {
        /* body * {
            display: none !important;
        } */
        .modal,.toast,.modal-backdrop,a,li {
            display: none !important;
        }
        table {
            display: block !important;
            width: auto !important;
        }
        table td, table th {
            border: none;
        }
        #checkout-btn {
            display: none;
        }
    }
    /* Custom CSS */
    .toast-container {
    z-index: 9999;
    }

    .toast {
    width: 400px;
    position: relative;
    margin-top: 80px;
    margin-left: auto;
    margin-right: auto;
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
    }

    .toast-text {
    font-weight: bold;
    }

    @media (max-width: 576px) {
    .toast {
        width: 100%;
        margin-top: 0;
        border-radius: 0;
    }
    }

</style>
<script>
    $(document).on('click','#confirmChangeTable',function(e){
        $.ajax({
            url: 'index.php?route=order/changeTable',
            type: 'POST',
            data: {
                old_table_id: '<?php echo get('table_id');?>',
                new_table_id: $('#changeToTable').val(),
            },
            success: function(response) {
                console.log(response);
                // elementEdit.remove();
                window.location='<?php echo route('home');?>';
            },
            error: function() {
                // 
            }
        });
    });
</script>
<script>

    var elementEdit = '';
    var order_id = '';
    $('.delete-btn').click(function() {
        $('#editModal').modal('hide');
        $('#confirmModal').modal('show');
        // $('#showOrderID').text(order_id);
    }); 
    $('#confirmDelete').click(function() {
        // Code to handle delete button click goes here
        $('#confirmModal').modal('hide');
        $('#editModal').modal('hide');
        order_id = parseInt($('#showOrderID').text());
        $.ajax({
            url: 'index.php?route=order/deleteOrder',
            type: 'POST',
            data: { 
                order_id: order_id
            },
            success: function(response) {
                // console.log(response);
                
                elementEdit.remove();
            },
            error: function() {
                // 
            }
        });
    });
    $(document).on('click','#tableList tr',function() {
        elementEdit = $(this);
        var foodName = $(this).find('td .foodName').text().trim();
        var optionText = $(this).find('td .optionText').text();
        var comment = $(this).find('td .comment').text().trim();
        order_id = elementEdit.attr('order-id');// order-id
        $('#showOrderID').text(order_id);
        var price = $(this).find('td .price').text().trim();
        $('#editModal #comment').val(comment);
        $('#editModal #editFoodName').text(foodName);
        var menuId = $(this).find('input[name="menu_id[]"]').val();
        // alert(menuId);
        // console.log('option>',option);
        // console.log(menuId);
        $.ajax({
            url: 'index.php?route=order/getMenu',
            method: 'GET',
            data: { menuId: menuId },
            success: function(response) {
                console.log(response);
                var menu = response;
                var optionsHtml = '';
                var i = 0;
                $.each(menu.option, function(index, option) {
                    // console.log(option.option_name,option)
                    if(option.option_name==optionText){
                    optionsHtml += `
                        <label class="btn btn-outline-primary active">
                            <input type="radio" checked name="option" value="${option.id}" data-id="${option.id}" data-price="${option.price}" data-name="${option.option_name}">
                            ${option.option_name} ${option.price}
                        </label>
                        `;
                    }else{
                        optionsHtml += `
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="option" value="${option.id}" data-id="${option.id}" data-price="${option.price}" data-name="${option.option_name}">
                            ${option.option_name} ${option.price}
                        </label>
                        `;
                    }
                    i++;
                })
                // alert(price);
                $('#editModal .modal-title').attr('menu-id',menuId);
                $('#editModal .price').text(price);
                $('#editModal .options').html(optionsHtml);
                $('#editModal .options input:eq(0)').prop('checked', true);
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(error);
            }
        });
    });
    $(document).on('click','.edit-order',function(e){
        var id          = $('#editModal .modal-title').attr('menu-id');
        var name        = $('#editModal #editFoodName').text();
        var price       = $('#editModal .price').text();
        // alert(price);
        var option_id   = $('#editModal input[name="option"]:checked').attr('data-id');
        var option_price = $('#editModal input[name="option"]:checked').attr('data-price');
        var option      = $('#editModal input[name="option"]:checked').attr('data-name');
        var comment     = $('#editModal #comment').val();
        
        elementEdit.find('td:eq(0)').empty();
        elementEdit.find('td:eq(0)').html('<a href="#" class="text-danger"><i class="fas fa-print"></i></a>');

        elementEdit.find('td:eq(1)').empty();
        elementEdit.find('td:eq(1)').html('<div class="foodName">' + name + '</div>  <div class="comment">' + comment + '</div>');

        elementEdit.find('td:eq(2)').empty();
        elementEdit.find('td:eq(2)').html('<div class="optionText">' + (option ? option : '') + '</div>');

        elementEdit.find('td:eq(3)').empty();
        var newPrice = (parseFloat(price) + parseFloat(option_price));
        var html = '<div class="price">'+price+'</div><input type="hidden" name="menu_id[]" value="'+id+'">'+
        '<input type="hidden" name="table_id[]" value="<?php echo get('table_id'); ?>">'+
        '<input type="hidden" name="price[]" value="'+ newPrice +'">'+
        '<input type="hidden" name="comment[]" value="'+ comment +'">'+
        '<input type="hidden" name="option_id[]" value="'+ option_id +'">';
        elementEdit.find('td:eq(3)').html(html);
    
        $.ajax({
            url: 'index.php?route=order/submitSingleOrderEdit',
            type: 'POST',
            data: {
                menu_id: id,
                table_id: '<?php echo get('table_id'); ?>',
                price: newPrice,
                comment: comment,
                option_id: option_id,
                order_id: order_id
            },
            success: function(response) {
                console.log(response);
            },
            error: function() {
                // Handle errors
            }
        });
        $('#editModal').modal('hide');
    });
    $('.add-order').click(function() {
    
        var text = $(this).data('toast-text');
        // $('.toast-text').text(text);
        // $('.toast').toast('show');
        $('#addModal').modal('hide');

        var id = $('#addModal .modal-title').attr('menu-id');
        var name = $('#addModal .modal-title').text();
        var price = $('#addModal .price').text();
        var option_id = $('#addModal input[name="option"]:checked').attr('data-id');
        var option_price = $('#addModal input[name="option"]:checked').attr('data-price');
        // alert(option_price);
        // console.log(option_price);
        var option = $('#addModal input[name="option"]:checked').attr('data-name');
        var comment = $('#addModal #comment').val();
        var print = '<a href="#" class="text-danger"><i class="fas fa-print"></i></a>';
        var newPrice = (parseFloat(price) + parseFloat(option_price));
        
        $.ajax({
        url: 'index.php?route=order/submitSingleOrder',
        type: 'POST',
        data: {
            menu_id: id,
            table_id: '<?php echo get('table_id'); ?>',
            price: newPrice,
            comment: comment,
            option_id: option_id
        },
        success: function(response) {
            
            var newRow = '<tr data-toggle="modal" data-target="#editModal" menu-id="'+id+'" order-id="'+response+'" flag-confirm="0">' +
                        '<td>'+print+'</td>'+
                        '<td><div class="foodName">' + name + '</div>  <div class="comment">' + comment + '</div></td>' +
                        '<td><div class="optionText">' + (option ? option : '') + '</div></td>' +
                        '<td><div class="price">' + newPrice + '</div>'+
                        '<input type="hidden" name="menu_id[]" value="'+id+'">' +
                        '<input type="hidden" name="table_id[]" value="<?php echo get('table_id'); ?>">' +
                        '<input type="hidden" name="price[]" value="'+ newPrice +'">' +
                        '<input type="hidden" name="comment[]" value="'+ comment +'">' +
                        '<input type="hidden" name="option_id[]" value="'+ option_id +'">' +
                        '</td>' +
                        '</tr>';
            $('#tableList tbody').append(newRow);
            // Increment the counter variable
            // numRequests++;
            
            // // Check if all requests have completed
            // if (numRequests == $('tbody tr[flag-confirm="0"]').length) {
            // // All requests have completed successfully, so redirect the user
            // window.location = 'index.php?route=checkout&table_id=<?php echo get('table_id');?>';
            // }
        },
        error: function() {
            // Handle errors
        }
        });
        var sum = 0;
        $('tbody tr').each(function() {
            var price = parseFloat($(this).find('td:nth-child(3)').text());
            sum += price;
        });
        // $('#total-sum').text(sum);
        $('#addModal #comment').val('');
    });
</script>
<script>
    $(document).on('click','.comment-btn',function() {
        var text = $(this).data('text');
        var comment = $('#addModal .comment').val();
        comment += ' ' + text;
        $('#addModal .comment').val(comment);
    });
    $(document).on('click','.comment-btn-edit',function() {
        var text = $(this).data('text');
        var comment = $('#editModal .comment').val();
        comment += ' ' + text;
        $('#editModal .comment').val(comment);
    });
</script>
<script>
    // Calculate total sum and update checkout button
    // var sum = 0;
    // $('tbody tr').each(function() {
    //     var price = parseInt($(this).find('td:nth-child(3)').text());
    //     sum += price;
    // });
    // $('#total-sum').text(sum);

    // Add click event listener to checkout button
    $('#checkout-btn').click(function() {
        // Code to handle checkout button click goes here
    });
    $('#confirmCheckout').click(function(e) {
        e.preventDefault();
        // window.print();
        // 
        // alert(1);
        $.ajax({
            url: 'index.php?route=order/submitPrintOrder',
            method: 'POST',
            data: { table_id: '<?php echo get('table_id');?>' },//$('#submitOrder').serialize(),
            success: function(response) {
                console.log(response);
                // window.location.href = 'index.php?route=home';
                $('tbody tr').each(function() {
                    // Change the "flag-confirm" attribute to "1"
                    $(this).attr('flag-confirm', '1');
                    var ele = $(this).find('.text-danger');
                    ele.removeClass('text-danger');
                    ele.addClass('text-success');
                });
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(error);
            }
        });
    });
</script>
<script>
$(document).on('click','.add-menu',function(event) {
    event.preventDefault();
    var menuId = $(this).attr('menu-id');
    $.ajax({
      url: 'index.php?route=order/getMenu',
      method: 'GET',
      data: { menuId: menuId },
      success: function(response) {
        console.log(response.option);
        var menu = response;
        var optionsHtml = '';
        var i = 0;
        $.each(menu.option, function(index, option) {
            if(i==0){
                optionsHtml += `
                <label class="btn btn-outline-primary active">
                    <input type="radio" checked name="option" value="${option.id}" data-id="${option.id}" data-price="${option.price}" data-name="${option.option_name}">
                    ${option.option_name} ${parseInt(option.price)}
                </label>
                `;
            }else{
                optionsHtml += `
                <label class="btn btn-outline-primary">
                    <input type="radio" name="option" value="${option.id}" data-id="${option.id}" data-price="${option.price}" data-name="${option.option_name}">
                    ${option.option_name} ${option.price}
                </label>
                `;
            }
            i++;
        })
        // Set the title and options HTML in the modal
        $('#addModal .modal-title').text(menu.name);
        $('#addModal .modal-title').attr('menu-id',menu.id);
        $('#addModal .price').text(menu.price);
        $('#addModal .options').html(optionsHtml);
      },
      error: function(xhr, status, error) {
        // Handle the error here
        console.log(error);
      }
    });
    
    $.ajax({
      url: 'index.php?route=order/getListTagsMenuID',
      method: 'GET',
      data: { menuId: menuId },
      success: function(response) {
        $.each(response, function(index, value) { 
            var html = '<a href="#" class="btn btn-primary comment-btn" data-text="'+value.tag_name+'">'+value.tag_name+'</a>';
            $('#panelEditTags').append(html);
            $('#panelAddTags').append(html);
        })
      },
      error: function(xhr, status, error) {
        // Handle the error here
        console.log(xhr, status, error);
      }
    });
});

$(document).ready(function() {
    $.ajax({
      url: 'index.php?route=order/getOrder',
      method: 'GET',
      data: { table_id: <?php echo get('table_id');?> },
      success: function(response) {
        console.log(response);
        $.each(response, function(key, value) {
            console.log(value);
            var print = '';
            if(value.flag_confirm==1){
                print = '<a href="#" class="text-success"><i class="fas fa-print"></i></a>';
            }else{
                print = '<a href="#" class="text-danger"><i class="fas fa-print"></i></a>';
            }
            var newRow = '<tr data-toggle="modal" data-target="#editModal" menu-id="'+value.menu_id+'" flag-confirm="'+value.flag_confirm+'" order-id="'+value.id+'">' +
                    '<td>'+print+'</td>'+
                    '<td><div class="foodName">' + value.name + '</div>  <div class="comment">' + value.comment + '</div></td>' +
                    '<td><div class="optionText">' + value.option_name + '</div></td>' +
                    '<td><div class="price">' + value.price + '</div>'+
                    '<input type="hidden" name="menu_id[]" value="'+value.menu_id+'">' +
                    '<input type="hidden" name="table_id[]" value="<?php echo get('table_id'); ?>">' +
                    '<input type="hidden" name="price[]" value="'+ value.price +'">' +
                    '<input type="hidden" name="comment[]" value="'+ value.comment +'">' +
                    '<input type="hidden" name="option_id[]" value="'+ value.option_id +'">' +
                    '</td>' +
                    '</tr>';
            $('#tableList tbody').append(newRow);
        })
        
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
});

$(document).ready(function() {
  $('#checkBill-btn').click(function(e) {
    e.preventDefault();
    window.location = 'index.php?route=checkout&table_id=<?php echo get('table_id');?>';
    // Check if there are any rows with flag-confirm=0
    if ($('tbody tr[flag-confirm="0"]').length == 0) {
      // There are no rows with flag-confirm=0, so redirect the user immediately
      window.location = 'index.php?route=checkout&table_id=<?php echo get('table_id');?>';
      return;
    }
    
    // // Initialize the counter variable
    // var numRequests = 0;
    
    // $('tbody tr').each(function() {
    //   if ($(this).attr('flag-confirm') == '0') {
    //     // Get the data for this row
    //     var menu_id = $(this).find('input[name="menu_id[]"]').val();
    //     var table_id = $(this).find('input[name="table_id[]"]').val();
    //     var price = $(this).find('input[name="price[]"]').val();
    //     var comment = $(this).find('input[name="comment[]"]').val();
    //     var option_id = $(this).find('input[name="option_id[]"]').val();
        
    //     // Send the data using AJAX
    //     $.ajax({
    //       url: 'index.php?route=order/submitSingleOrder',
    //       type: 'POST',
    //       data: {
    //         menu_id: menu_id,
    //         table_id: table_id,
    //         price: price,
    //         comment: comment,
    //         option_id: option_id
    //       },
    //       success: function(response) {
    //         console.log(response);
    //         // Increment the counter variable
    //         numRequests++;
            
    //         // Check if all requests have completed
    //         if (numRequests == $('tbody tr[flag-confirm="0"]').length) {
    //           // All requests have completed successfully, so redirect the user
    //           window.location = 'index.php?route=checkout&table_id=<?php echo get('table_id');?>';
    //         }
    //       },
    //       error: function() {
    //         // Handle errors
    //       }
    //     });
    //   }
    // });
  });
});
</script>