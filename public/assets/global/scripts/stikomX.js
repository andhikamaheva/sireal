function deleteUser(id, name) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "Delete " + name + "'s ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                success: function (response) {
                    swal({
                        title: "Delete Success!",
                        type: "success",
                        text: name + "'s has been deleted.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $("#content").html(response);
                },
                error: function (response) {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: "Oopps..there is something went wrong, please contact andhika@stikom.edu",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        else {
            swal.close();
        }
        /*else {
         swal("Cancelled", "Your tag status is safe :)", "error");   }*/
    });
}


function deleteRole(id, name) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "Delete " + name + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                success: function (response) {
                    swal({
                        title: "Delete Success!",
                        type: "success",
                        text: name + "'s has been deleted.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $("#content").html(response);
                },
                error: function (response) {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: "Oopps..there is something went wrong, please contact andhika@stikom.edu",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        else {
            swal.close();
        }
        /*else {
         swal("Cancelled", "Your tag status is safe :)", "error");   }*/
    });
}


function deleteSubject(id, name) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "Delete " + name + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                success: function (response) {
                    swal({
                        title: "Delete Success!",
                        type: "success",
                        text: name + "'s has been deleted.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $("#content").html(response);
                },
                error: function (response) {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: "Oopps..there is something went wrong, please contact andhika@stikom.edu",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        else {
            swal.close();
        }
        /*else {
         swal("Cancelled", "Your tag status is safe :)", "error");   }*/
    });
}

function deleteSemester(id, name) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "Delete " + name + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                success: function (response) {
                    swal({
                        title: "Delete Success!",
                        type: "success",
                        text: name + "'s has been deleted.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $("#content").html(response);
                },
                error: function (response) {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: response.responseJSON.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        else {
            swal.close();
        }
        /*else {
         swal("Cancelled", "Your tag status is safe :)", "error");   }*/
    });
}

function deleteBatch(id, name) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "Delete " + name + " ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete",
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "DELETE",
                url: window.location.href + "/" + id,
                success: function (response) {
                    swal({
                        title: "Delete Success!",
                        type: "success",
                        text: name + "'s has been deleted.",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $("#content").html(response);
                },
                error: function (response) {
                    swal({
                        title: "Error!",
                        type: "error",
                        text: response.responseJSON.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        else {
            swal.close();
        }
        /*else {
         swal("Cancelled", "Your tag status is safe :)", "error");   }*/
    });
}

function createUser() {
    var roles = $('#roles').find("select[name='roles']").val();

    console.log(roles);
}


function loadDeleteCategory(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "You will change status of this category ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, change it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: baseURL + "/categories/delete",
                dataType: "JSON",
                data: {'id': id},
                success: function (response) {
                    swal("Changed!", "Your category status has been changed.", "success");
                    location.reload();
                }
            });
        }
        else {
            swal("Cancelled", "Your category status is safe :)", "error");
        }
    });
}


function loadDeleteSubCategory(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal({
        title: "Are you sure?",
        text: "You will change status of this sub category ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, change it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url: baseURL + "/subcategories/delete",
                dataType: "JSON",
                data: {'id': id},
                success: function (response) {
                    swal("Changed!", "Your sub category status has been changed.", "success");
                    location.reload();
                }
            });
        }
        else {
            swal("Cancelled", "Your sub category status is safe :)", "error");
        }
    });
}
