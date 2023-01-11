$(document).ready(function(){
    // console.log("Ready");
    $.ajax({
        type: "GET",
        url : "get_data.php",
        success: function(resp){
            console.log("Resp Good");
            //console.log( (resp) );
        }
    });
});