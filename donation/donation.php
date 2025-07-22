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
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="bg-success white">
                                        <tr>
                                            <th width="7%;">No</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th width="10%;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showtable">
                                    </tbody>

                                </table>
                                <br><br>
                                <form id="frmdonate" method="POST">
                                    <input type="hidden" name="action" value="donate" />
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">အလှူရှင်အမည်</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" class="form-control border-primary"
                                                    placeholder="အလှူရှင်အမည်" name="donatorname">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control"
                                                for="projectinput9">အကြောင်းအရာ</label>
                                            <div class="col-md-9 mx-auto">
                                                <textarea id="projectinput9" rows="5"
                                                    class="form-control border-primary" name="description"
                                                    placeholder="အကြောင်းအရာ"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="userinput1">နေရပ်လိပ်စာ</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" class="form-control border-primary"
                                                    placeholder="နေရပ်လိပ်စာ" name="address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control">အလှူငွေ</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="number" class="form-control border-primary"
                                                    placeholder="အလှူငွေ" name="donationamount">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="timesheetinput3">ရက်စွဲ</label>
                                            <div class="col-md-9 mx-auto">
                                                <div class="position-relative has-icon-left">
                                                    <input type="date" id="timesheetinput3"
                                                        class="form-control border-primary" name="donationdate"
                                                        value="<?= date("Y-m-d")?>">
                                                    <div class="form-control-position">
                                                        <i class="ft-message-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-primary"><i
                                                class="la la-save"></i>လှူဒါန်းမည်</button>
                                    </div>
                                </form>
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
                load_table();
            }
        });
    });

    function load_table() {
        $.ajax({
            type: "post",
            url: donation_url,
            data: {
                action: 'showtable'
            },
            success: function(data) {
                $("#showtable").html(data);
            }
        });
    }
    load_table();

    $(document).on("click", "#btndeletetemp", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        $.ajax({
            type: "POST",
            url: donation_url,
            data: {
                action: 'deletetemp',
                aid: aid
            },
            success: function(data) {
                if (data == 1) {
                    load_table();
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
    });

    $("#frmdonate").on("submit", function(e) {
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
                    load_page();
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