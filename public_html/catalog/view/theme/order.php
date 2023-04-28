<div class="container mt-4">
    <div class="row">
        <div class="col-12 text-right">
            <a href="" class="btn btn-primary" id="confirmCheckout">พิมพ์</a>
        </div>
    </div>
    <div class="row">
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
                        <div class="col-xs-4">
                            <a href="#" class="btn btn-primary btn-block mb-2 add-menu" data-toggle="modal" data-target="#addModal" menu-id="<?php echo $menu['id'];?>"><?php echo $menu['name'];?></a>
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
    เช็คบิล : <span id="total-sum"></span>
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
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                            <a href="#" class="btn btn-primary comment-btn" data-text="ไม่ผัก">ไม่ผัก</a>
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
                    <div class="col-md-4">
                        <!-- <img src="food-image.jpg" class="img-fluid"> -->
                    </div>
                    <div class="col-md-8">
                        <h5 class="modal-title">Food Name</h5>
                        <p>Description of the food goes here.</p>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="option" id="normal" value="normal" checked> ธรรมดา 80
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="option" id="special" value="special"> พิเศษ 100
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                            <a href="#" class="btn btn-primary comment-btn" data-text="ไม่ผัก">ไม่ผัก</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger float-left delete-btn">ลบ</button>
                <button type="button" class="btn btn-primary edit-order">บันทึก</button>
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
                Are you sure you want to delete this item?
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
<style>
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
    $('.add-order').click(function() {
        var text = $(this).data('toast-text');
        $('.toast-text').text(text);
        $('.toast').toast('show');
        $('#addModal').modal('hide');

        var id = $('#addModal .modal-title').attr('menu-id');
        var name = $('#addModal .modal-title').text();
        var price = $('#addModal .price').text();
        var option_id = $('#addModal input[name="option"]:checked').attr('data-id');
        var option = $('#addModal input[name="option"]:checked').attr('data-name');
        var comment = $('#addModal #comment').val();

        // Create a new row in the table with the selected menu item information
        var newRow = '<tr data-toggle="modal" data-target="#editModal" menu-id="'+id+'" flag-confirm="0">' +
                    '<td>' + name + '  <div>' + comment + '</div></td>' +
                    '<td>' + option + '</td>' +
                    '<td>' + price +
                    '<input type="hidden" name="menu_id[]" value="'+id+'">' +
                    '<input type="hidden" name="table_id[]" value="<?php echo get('table_id'); ?>">' +
                    '<input type="hidden" name="price[]" value="'+ price +'">' +
                    '<input type="hidden" name="comment[]" value="'+ comment +'">' +
                    '<input type="hidden" name="option_id[]" value="'+ option_id +'">' +
                    '</td>' +
                    '</tr>';
        $('#tableList tbody').append(newRow);

        var sum = 0;
        $('tbody tr').each(function() {
            var price = parseFloat($(this).find('td:nth-child(3)').text());
            sum += price;
        });
        $('#total-sum').text(sum);
    });
</script>
<script>
    $('.comment-btn').click(function() {
        var text = $(this).data('text');
        var comment = $('#comment').val();
        comment += ' ' + text;
        $('#comment').val(comment);
    });
</script>
<script>
    $('.delete-btn').click(function() {
        $('#confirmModal').modal('show');
    });
    $('#confirmDelete').click(function() {
        // Code to handle delete button click goes here
        $('#confirmModal').modal('hide');
        $('#addModal').modal('hide');
    });
</script>
<script>
    // Calculate total sum and update checkout button
    var sum = 0;
    $('tbody tr').each(function() {
        var price = parseInt($(this).find('td:nth-child(3)').text());
        sum += price;
    });
    $('#total-sum').text(sum);

    // Add click event listener to checkout button
    $('#checkout-btn').click(function() {
        // Code to handle checkout button click goes here
    });
    $('#confirmCheckout').click(function(e) {
        e.preventDefault();
        // window.print();
        // 
        $.ajax({
            url: 'index.php?route=order/submitOrder',
            method: 'POST',
            data: $('#submitOrder').serialize(),
            success: function(response) {
                // console.log(response);
                // window.location.href = 'index.php?route=home';
            },
            error: function(xhr, status, error) {
                // Handle the error here
                console.log(error);
            }
        });
    });
</script>
<script>
$(document).ready(function() {
  $('.add-menu').click(function(event) {
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
        $.each(menu.option, function(index, option) {
            optionsHtml += `
            <label class="btn btn-outline-primary">
                <input type="radio" name="option" value="${option.id}" data-id="${option.id}" data-price="${option.price}" data-name="${option.option_name}">
                ${option.option_name} ${option.price}
            </label>
            `;
        })

        // Set the title and options HTML in the modal
        $('#addModal .modal-title').text(menu.name);
        $('#addModal .modal-title').attr('menu-id',menu.id);
        $('#addModal .price').text(menu.price);
        $('#addModal .options').html(optionsHtml);
        $('#addModal .options input:first').prop('checked', true);
      },
      error: function(xhr, status, error) {
        // Handle the error here
        console.log(error);
      }
    });
  });
});

$(document).ready(function() {
//   $('.add-menu').click(function(event) {
//     event.preventDefault();
    // var table_id = $(this).attr('menu-id');
    $.ajax({
      url: 'index.php?route=order/getOrder',
      method: 'GET',
      data: { table_id: <?php echo get('table_id');?> },
      success: function(response) {
        // console.log(response);
        $.each(response, function(key, value) {
            console.log(response);
            var newRow = '<tr data-toggle="modal" data-target="#editModal" menu-id="'+value.menu_id+'" flag-confirm="'+value.flag_confirm+'">' +
                    '<td>' + name + '  <div>' + value.comment + '</div></td>' +
                    '<td>' + value.option_name + '</td>' +
                    '<td>' + value.price +
                    '<input type="hidden" name="menu_id[]" value="'+value.id+'">' +
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
        // Handle the error here
        console.log(error);
      }
    // });
  });
});
</script>