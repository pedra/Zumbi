var editor = new MediumEditor('.editable', {
    buttons: ['bold',
        'italic',
        'underline',
        'anchor',
        'header1',
        'header2',
        'h3',
        'quote',
        'strikethrough',
        'unorderedlist',
        'orderedlist',
        'pre',
        'image',
        'youtube'
    ],
    firstHeader: 'h1',
    secondHeader: 'h2'
});

function serialize() {
    //address for all images
    var imgs = Array();
    //getting image links
    cont = 0;
    $('img').each(function() {
        imgs[cont] = $(this).attr('src');
        cont++;
    })
    //Send data for save
    $.ajax({
        type: "POST",
        url: URL + "ajax/",
        data: {
            name: editor.serialize(),
            imgs: imgs
        }
    }).done(function(msg) {
        alert('Salvo!');
        //if(msg) document.location.href = msg;
    });
}

function goDir(dir) {
    document.location.href = URL + 'post/?dir=' + dir;
}

function viewFile(id, file) {
    document.location.href = URL + 'post/?file=' + file;
}