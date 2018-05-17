$( document ).ready(function() {

    $('.class-delete').on( "click", function() {
        var classid = $(this).parent().parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_edit.php',
            data: {op: "delete", id: classid}
        });
        location.reload();
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
        });
    });

    $('a[href="toClassDetails"]').on( "click", function(e) {
        e.preventDefault();
        var classid = $(this).parent().attr('id');
        classid = classid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_detail.php',
            data: {op: "show", classid: classid}
        }).done(function( msg ) {
            document.write(msg);
        });
    });

    $('.student-delete').on( "click", function() {
        alert('Hello');
        var studentid = $(this).parent().attr('id');
        studentid = studentid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_detail.php',
            data: {op: "remove", id: studentid}
        });
        location.reload();
    });

});

