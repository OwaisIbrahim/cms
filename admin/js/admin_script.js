
$(document).ready(function() {

    //EDITOR CKEDITOR
    ClassicEditor
        .create( document.querySelector( '#postContentBody' ) )
        .catch( error => {
            console.error( error );
        } );
});

$(document).ready( function() {
    $('#selectAllBoxes').click( function(event){
        if(this.checked) {
            $('.checkBox').each(function() {
                this.checked = true;
            })
        } else {
            $('.checkBox').each(function() {
                this.checked = false;
            });
        }
    } );


    var div_box = "<div id='load-screen'><div id='loading'></div></div>"
    $("body").prepend(div_box);
    
    $('#load-screen').delay(700).fadeOut(600, function() {
        $(this).remove();
    });

    function loadUsersOnline() {
        $.get("functions.php?onlineusers=result", function(data){
             $(".usersonlinespan").text(data);
        });
    }

    setInterval(function() {
        loadUsersOnline();
    }, 500);


});
