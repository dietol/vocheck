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

    $('.student-add').on( "click", function() {
        var id = $(this).parent().attr('id');
        var studentid = id.split("-")[1];
        var classid = id.split("-")[2];
        $.ajax({
            method: 'POST',
            url: 'teacher_classes_add_students.php',
            data: {op: "add", studentid: studentid, classid: classid}
        }).done(function() {
            location.reload();
        });
    });

    $('.list-delete').on( "click", function() {
        var listid = $(this).parent().parent().attr('id');
        listid = listid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_vocabulary_edit.php',
            data: {op: "remove", id: listid}
        }).done(function() {
            location.reload();
        });
    });

    $('a[href="toListDetails"]').on( "click", function(e) {
        e.preventDefault();
        var listid = $(this).parent().attr('id');
        listid = listid.split("-")[1];
        $.ajax({
            method: 'POST',
            url: 'teacher_vocabulary_edit.php',
            data: {op: "edit", id: listid}
        }).done(function( msg ) {
            document.write(msg);
            document.close();
        });
    });

    $('.vocab-edit').on( "click", function() {
        var vocabid = $(this).parent().parent().attr('id');
        var first = "#vocabulary_first-" + vocabid.split("-")[1];
        var second = "#vocabulary_second-" + vocabid.split("-")[1];
        var button = "#vocabulary_entry_save-" + vocabid.split("-")[1];
        $(first).prop("readonly", false);
        $(second).prop("readonly", false);
        $(button).prop("hidden", false);
    });

    $('.vocab-delete').on( "click", function() {
        alert("Hello");
        var id = $(this).parent().parent().attr('id');
        var vocid = id.split("-")[1];
        var listid = id.split("-")[2];
        $.ajax({
            method: 'POST',
            url: 'teacher_vocabulary_edit_vocab.php',
            data: {op: "delete", vocid: vocid, listid: listid}
        }).done(function() {
            $.ajax({
                method: 'POST',
                url: 'teacher_vocabulary_edit.php',
                data: {op: "edit", id: listid}
            }).done(function( msg ) {
                document.write(msg);
                document.close();
            });
        });
    });

});

