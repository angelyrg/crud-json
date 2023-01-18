
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
                        }                
                    });

                }                
            });

        }
    });


    //console.log(data);


}



$(".item_clickeable").on("click", function () {
    let item_id = $(this).attr("id");
    searchItem(item_id, window.all_data);
});

