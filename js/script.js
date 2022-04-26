$(document).ready(() => {
    $('#search').on('keyup', () => {
        $('#container').load('ajax/data.php?keyword=' + $('#search').val())
    })
})
