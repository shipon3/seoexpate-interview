function submitFormWithUrl(url) {
    var form = $("#dataFrom")[0];
    var formData = new FormData(form);
    $.ajax({
      url: url,
      method: 'POST',
      processData: false,
      contentType: false,
      data: formData,
      success: function(response) {
        form.reset();
        $('#dataTable').DataTable().ajax.reload();
        $("#submitBtn").attr('disabled', false);
        toastr[response.status](response.message);
        table.draw();
        resetRequire();
      },
      error: function(error) {
        if (error) {
          setRequire(error);
        }
      }
    });
  }