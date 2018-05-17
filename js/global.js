$( document ).ready(function() {

    $('.class-delete').on( "click", function() {
        var classid = $(this).parent().parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_edit.php',
            data: {op: "delete", id: classid}
        }).done(function() {
            location.reload();
        });
    });

    $('.class-edit').on( "click", function() {
        var classid = $(this).parent().parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_edit.php',
            data: {op: "edit", id: classid}
        }).done(function( msg ) {
            document.write(msg);
            document.close();
        });
    });

    $('a[href="toClassDetails"]').on( "click", function(e) {
        e.preventDefault();
        var classid = $(this).parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_detail.php',
            data: {op: "show", id: classid}
        }).done(function( msg ) {
            document.write(msg);
            document.close();
        });
    });

    $('.student-delete').on( "click", function() {
        var studentid = $(this).parent().attr('id');
        studentid = studentid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_detail.php',
            data: {op: "remove", id: studentid}
        }).done(function() {
            location.reload();
        });
    });

});

