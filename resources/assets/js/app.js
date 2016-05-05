$('.dropdown-toggle').dropdown();

function registerDownload(type, id) {
    $.get('/api/downloads/add/' + type + '/' + id);
}
