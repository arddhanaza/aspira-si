function addLikes(idm, id) {
    var x = getLikes(id);
    var y = getDisLikes(id);
    var maxCount = document.getElementById('totalLikes' + id).getAttribute('data-max-count');
    var count = document.getElementById('totalLikes' + id).getAttribute('data-count');
    if (parseInt(count) < parseInt(maxCount)){
        x = x + 1;
        y = y - 1;
        document.getElementById('totalLikes' + id).setAttribute('data-count','1');
        document.getElementById('totalDisLikes' + id).setAttribute('data-count','0');
    }
    document.getElementById('totalLikes' + id).innerText = x;
    document.getElementById('totalDisLikes' + id).innerText = y;
    runAjaxForLikes(idm, id);
}

function getLikes(id) {
    var likes = document.getElementById('totalLikes' + id).innerText;
    return parseInt(likes);
}

function getDisLikes(id) {
    var disLikes = document.getElementById('totalDisLikes' + id).innerText;
    return parseInt(disLikes);
}

function addDisLikes(idm, id) {
    var x = getDisLikes(id);
    var y = getLikes(id);
    var maxCount = document.getElementById('totalDisLikes' + id).getAttribute('data-max-count');
    var count = document.getElementById('totalDisLikes' + id).getAttribute('data-count');
    if (parseInt(count) < parseInt(maxCount)){
        x = x + 1;
        y = y - 1;
        document.getElementById('totalDisLikes' + id).setAttribute('data-count','1');
        document.getElementById('totalLikes' + id).setAttribute('data-count','0');
    }
    document.getElementById('totalDisLikes' + id).innerText = x;
    document.getElementById('totalLikes' + id).innerText = y;
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
