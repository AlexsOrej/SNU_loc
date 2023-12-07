<!-- Jquery DataTable Plugin Js -->
<!-- <script src="Assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="Assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="Assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Assets/plugins/jszip/jszip.min.js"></script>
<script src="Assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>


<script>
  $(document).ready(function() {
    $("#informe").DataTable({
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros por pagina",
        "zeroRecords": "Nada se encontro",
        "info": "Mostrando pag _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Filtrar:",
        "responsive": true,
        "autoWidth": true,
        paginate: {
          previous: '‹‹',
          next: '››'
        },
      },
      paging: false,
      "order": [
        [0, 'desc'],
        [1, 'desc']
      ],
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#informe_wrapper .col-md-6:eq(0)');
  });
</script>
<!-- <script src="Assets/js/pages/tables/jquery-datatable.js"></script> -->