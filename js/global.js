$( document ).ready(function() {

    $('.class-delete').on( "click", function() {
        var classid = $(this).parent().parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_edit.php',
            data: {op: "delete", id: classid}
        }).done(function( msg ) {
            alert( "Data Get: " + msg );
        });
        location.reload();
    });

    $('.class-duplicate').on( "click", function() {
        var classid = $(this).parent().parent().attr('id');
        $('html').load("teacher_classes_edit_page.php", {
            classid: "2"
        });
    });

});