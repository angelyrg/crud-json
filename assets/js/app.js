
$(document).ready(function () {
    //Get all data
    $.ajax({
      type: "GET",
      url: "./dataFolder/data.json",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
        window.all_data = data;
      },
      failure: function (data) {
        alert(data.responseText);
      },
      error: function (data) {
        alert(data.responseText);
      },
    });
});

// Search item to display info
function searchItem(full_id, data){
    let ids = full_id.split('_');
    data.forEach(values => {
        if ( values.id == ids[0] ){
            const arr = Array.from( values.items );

            arr.forEach(values2 => {
                if ( values2.id == ( ids[0]+"_"+ids[1] ) ){
                    const arr2 = Array.from( values2.items );

                    arr2.forEach(values3 => {                        
                        if ( values3.id == (ids[0]+"_"+ids[1]+"_"+ids[2]) ){
                            $("#process_title").text( values3.text );
                            $("#process_id").val( values3.id );
                            if (values3.pdf_file != null && values3.pdf_file != ""){
                              $("#pdf_viewer").attr('src', "testupload/"+values3.pdf_file ).removeClass("d-none");
                              $("#no_pdf_viewer").addClass("d-none");
                              $("#btn_update_pdf").removeClass("d-none");

                            }else{
                              $("#pdf_viewer").attr('src', "").addClass("d-none");
                              $("#no_pdf_viewer").removeClass("d-none");
                              $("#btn_update_pdf").addClass("d-none");

                            }

                        }                
                    });
                }                
            });
        }
    });
}

//Update excel link
function updateExcel(new_link){
  // Validate if the link is correct
  if (new_link.startsWith("https://docs.google.com/spreadsheets/") && new_link.endsWith("/pubhtml")) {
    $("#excel_viewer").attr("src", new_link);
    $("#modal_success_message").html("Excel link updated successfully");
    $("#modal_success").modal("show");
  } else {
    $("#modal_error_message").html("The link is wrong. Please make sure the link is correct");
    $("#modal_error").modal("show");
  }
}

// Update main content with selected process info
$(".item_clickeable").on("click", function () {
    $("#processes_excel").addClass("d-none");
    $("#process_info").removeClass("d-none");

    let item_id = $(this).attr("id");
    console.log(item_id)
    searchItem(item_id, window.all_data);
});

// Show Excel with processes list
$("#btn_processes_list").on('click', () => {
    $("#process_info").addClass("d-none");
    $("#processes_excel").removeClass("d-none");
});

$("#excel_form").on("submit", function(e){
    e.preventDefault();
    link = $("#excel_link").val();
    updateExcel(link);
    $("#excel_form")[0].reset();
    $('#modal_new_excel_link').modal('hide');
});