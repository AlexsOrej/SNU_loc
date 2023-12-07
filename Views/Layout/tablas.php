<script src="Assests/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="Assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="Assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Assests/plugins/jszip/jszip.min.js"></script>
<script src="Assests/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Assests/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#tabla").DataTable({

            language: {
                search: "Buscar:",
                paginate: {
            previous: '‹',
            next:     '›'
        },
        aria: {
            paginate: {
                previous: 'Anterior',
                next:     'Siguiente'
            }
        }
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>