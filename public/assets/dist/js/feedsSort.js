document.getElementById('sortByOption').addEventListener('change', function (e) {
    if (e.target.value == 'teratas') {
        refreshTeratas();
    } else {
        refreshTerbaru();
    }
})

function refreshTerbaru() {
    let url = "{{ route('feed')}}";
    document.location.href = url;
}

function refreshTeratas() {
    let url = "{{ route('feedPopular')}}";
    document.location.href = url;
}

