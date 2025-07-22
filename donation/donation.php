<?php
    include('../config.php');
    include(root.'master/header.php');
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">ဖြတ်ပိုင်းဖြတ်ရန်</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'home/home.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active">ဖြတ်ပိုင်းဖြတ်ရန်
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="product-detail">
                <div class="row mb-5">
                    <div id="recent-transactions" class="col-sm-6">
                        <div class="card">
                            <div class="card-content p-2">
                                <table width="100%">
                                    <tr>
                                        <td width="100%" class="float-right">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="ser">
                                                    <input type="search" class="form-control" id="searching"
                                                        placeholder="Searching . . . . . ">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row" id="showcard">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="recent-transactions" class="col-sm-6">
                        <div class="card">
                            <div class="card-content p-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- new Modal -->
<div class="modal fade text-left" id="btnnewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Add User Control</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmsave" method="POST">
                <input type="hidden" name="action" value="save" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Category Name</label>
                        <input type="text" required class="form-control" name="categoryname"
                            placeholder="Enter CategoryName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-save"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade text-left" id="btneditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Edit Category</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmedit" method="POST">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="eaid" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Category Name</label>
                        <input type="text" required class="form-control" name="ecategoryname"
                            placeholder="Enter CategoryName">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-edit"></i>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include(root.'master/footer.php');
?>

<script>
var donation_url = "<?php echo roothtml.'donation/donation_action.php'; ?>";

$(document).ready(function() {
    function load_card() {
        var search = $("[name='ser']").val();
        $.ajax({
            type: "post",
            url: donation_url,
            data: {
                action: 'showcard',
                search: search
            },
            success: function(data) {
                $("#showcard").html(data);
            }
        });
    }
    load_card();

    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser']").val(serdata);
        load_card();
    });

    $(document).on("click", "#addcard", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var name = $(this).data("name");
        var price = $(this).data("price");
        $.ajax({
            type: "post",
            url: donation_url,
            data: {
                action: 'addcard',
                aid: aid,
                name: name,
                price: price,
            },
            success: function(data) {
                if (data == 1) {
                    load_session();
                } else if (data == 2) {
                    swal("Warning", "Item qty is not enough.", "warning");
                } else {
                    swal("Error", "error", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnnew", function() {
        $("#btnnewmodal").modal("show");
    });

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#btnnewmodal").modal("hide");
        $.ajax({
            type: "post",
            url: donation_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Save data is successful.',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    });
                    load_card();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Save data is error.',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    });
                }
            }
        });
    });

    $(document).on("click", "#btnedit", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var categoryname = $(this).data("categoryname");
        $("[name='eaid']").val(aid);
        $("[name='ecategoryname']").val(categoryname);
        $("#btneditmodal").modal("show");
    });

    $("#frmedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#btneditmodal").modal("hide");
        $.ajax({
            type: "post",
            url: donation_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Edit data is successful.',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    });
                    load_card();
                } else if (data == 2) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'For Agent, Please choose agent.',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Edit data is error.',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    });
                }
            }
        });
    });

    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var categoryname = $(this).data("categoryname");
        Swal.fire({
            title: 'Delete?',
            text: "Are you sure delete!",
            icon: 'error',
            showCancelButton: true,
            showCloseButton: false,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            allowOutsideClick: false,
            allowEscapeKey: false,
            focusConfirm: false,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: donation_url,
                    data: {
                        action: 'delete',
                        aid: aid,
                        categoryname: categoryname
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete data is successful.',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true
                            });
                            load_card();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Delete data is failed.',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true
                            });
                        }
                    }
                });
            }
        });
    });

});
</script>/script>