<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <div class="col-xs-4">
                            <a href="<?php echo route('order');?>" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#exampleModal">ชื่ออาหาร <?php echo $i;?></a>
                        </div>    
                    <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <div class="col-xs-4">
                            <a href="<?php echo route('order');?>" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#exampleModal">ชื่ออาหาร <?php echo $i;?></a>
                        </div>    
                    <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                    <?php for ($i = 1; $i <= 8; $i++) { ?>
                        <div class="col-xs-4">
                            <a href="<?php echo route('order');?>" class="btn btn-primary btn-block mb-2" data-toggle="modal" data-target="#exampleModal">ชื่ออาหาร <?php echo $i;?></a>
                        </div>    
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table" >
                <tbody>
                    <tr data-toggle="modal" data-target="#exampleModal">
                        <td>
                            ต้มเลือดหมู
                            <div>- ไม่ผัก</div>
                        </td>
                        <td>ธรรมดา</td>
                        <td>80</td>
                    </tr>
                    <tr data-toggle="modal" data-target="#exampleModal">
                        <td>ต้มเลือดหมู</td>
                        <td>พิเศษ</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="checkout-btn" data-toggle="modal" data-target="#confirmCheckoutModal">
    ยืนยัน - ยอดรวม: <span id="total-sum"></span>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                <button type="button" class="btn btn-primary" id="confirmCheckout">Yes</button>
            </div>
        </div>
    </div>
</div>
<style>
    .delete-btn:hover { 
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
    #checkout-btn {
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
</style>
<script>
    $('.add-order').click(function() {
        var text = $(this).data('toast-text');
        $('.toast-text').text(text);
        $('.toast').toast('show');
        $('#exampleModal').modal('hide');
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
        $('#exampleModal').modal('hide');
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
    $('#confirmCheckout').click(function() {
        window.print();
        window.location.href = 'index.php?route=home';
    });
</script>