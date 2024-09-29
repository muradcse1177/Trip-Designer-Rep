
$('.nav-item').click( function(){
    $(this).toggleClass('menu-is-opening menu-open');
});
$(function () {
    $("#example11").DataTable({
        "pageLength": 50,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print",],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "exportOptions": {
            columns: [ 1,2,3,4,5,6,7,8,9,10,11 ]
        },
    }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');
});

$(function () {
    $("#example111").DataTable({
        "pageLength": 50,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print",],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "exportOptions": {
            columns: [ 1,2,3,4,5,6,7,8,9,10,11 ]
        },
    }).buttons().container().appendTo('#example111_wrapper .col-md-6:eq(0)');
});

