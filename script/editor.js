var editor = new MediumEditor('.editable', {
    buttons: ['bold', 'italic', 'underline', 'anchor', 'header1', 'header2', 'quote', 'orderedlist', 'pre'],
    firstHeader: 'h1',
    secondHeader: 'h2'
});

function serialize() {

    $.ajax({
        type: "POST",
        url: "http://localhost/custa/ajax/",
        data: {
            name: editor.serialize()
        }
    })
        .done(function(msg) {
            alert("Data Saved");
        });
}

$(function() {
    $('.editable').mediumInsert({
        editor: editor,
        imagesUploadScript: "http://localhost/custa/upload/",
        images: true
    });
});