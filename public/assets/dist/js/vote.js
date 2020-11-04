function addLikes(idm, id) {
    var x = document.getElementById('totalLikes' + id).innerText;
    x = parseInt(x) + 1;
    document.getElementById('totalLikes' + id).innerText = x;
    runAjaxForLikes(idm, id);
}

function addDisLikes(idm, id) {
    var x = document.getElementById('totalDisLikes' + id).innerText;
    x = parseInt(x) + 1;
    document.getElementById('totalDisLikes' + id).innerText = x;
    runAjaxForDisLikes(idm, id);
}

function runAjaxForLikes(idm, id) {
    $.ajax({
        type: "GET",
        url: '/feed/likes/' + idm + '/' + id,
        data: {
            id_mahasiswa: idm,
            id_aspirasi: id,
            _token: '{{csrf_token()}}'
        }
    })
    // .done(function (msg) {
    //     alert('Likes Diterima');
    // })
    ;
}
function runAjaxForDisLikes(idm, id) {
    $.ajax({
        type: "GET",
        url: '/feed/dislikes/' + idm + '/' + id,
        data: {
            id_mahasiswa: idm,
            id_aspirasi: id,
            _token: '{{csrf_token()}}'
        }
    })
    // .done(function (msg) {
    //     alert('Likes Diterima');
    // })
    ;
}
