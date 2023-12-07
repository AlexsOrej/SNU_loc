<!-- Jquery DataTable Plugin Js -->
<script src="Assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="Assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="Assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('#sedes').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#estados').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#fabricantes').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#categorias').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tb_usuarios').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_requicision').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });

        $('#tbl_servicios').DataTable({
            order: [
                [0, 'asc'],
                [1, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_externos').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_aspirante').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tblConByGrupo').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_traslado').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_ejecutar').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_plan').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tbl_Ubicacion').DataTable({
            order: [
                [1, 'desc'],
                [0, 'asc'],

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },

        });
        $('#tbl_Ubicacion1').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"]
            ]
        });

        $('#tbl_val_mant').DataTable({
            order: [
                [2, 'desc'],

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#tbl_mantenimiento').DataTable({
            order: [
                [4, 'desc'],

            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#table').DataTable({
            order: [
                [3, 'desc'],
                [0, 'desc']
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });

        $('#tableDoc').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },
            }
        });
        $('#tableMan').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros por página",
                "zeroRecords": "Nada se encontró",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "BUSCAR:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "responsive": true,
                "autoWidth": true
            }
        });
        $('#tableCliente').DataTable({
            // order: [[3, 'desc'], [0, 'desc']],
            "language": {
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"]
            ]
        });
        $('#tableCliente1').DataTable({
            order: [
                [1, 'desc']
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"]
            ]
        });

        $('#tableCargo').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#tableSolicitud').DataTable({
            order: [
                [3, 'desc']
            ],
            // dom: '<"top"f>rt<"bottom"lp><"clear">',
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#tablePqrs').DataTable({
            order: [
                [1, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#tableIndicador').DataTable({
            order: [
                [2, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            }
        });
        $('#tablerot').DataTable({
            order: [
                [1, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"]
            ]
        });
        $('#tbl_RotUser').DataTable({
            order: [
                [0, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 10, 20, -1],
                [5, 10, 20, "Todos"]
            ]
        });
        $('#tblkardex').DataTable({
            order: [
                [4, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "Todos"]
            ]
        });
        $('#TblUsuarios').DataTable({
            order: [
                [2, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#TblEventos').DataTable({
            order: [
                [4, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#tbl_novedad').DataTable({
            order: [
                [0, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#eventos').DataTable({
            order: [
                [0, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });

        $('#acciones').DataTable({
            order: [
                [0, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [2, 5, 15, 20, -1],
                [2, 5, 15, 20, "Todos"]
            ]
        });

        $('#datos').DataTable({
            order: [
                [0, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Items",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "BUSCAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#autoreporte').DataTable({
            order: [
                [1, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Eventos Registrados",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#info').DataTable({
            order: [
                [0, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Eventos Registrados",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#tbl_eventos').DataTable({
            order: [
                [4, 'asc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Eventos Registrados",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#gestionmante').DataTable({
            order: [
                [1, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Mantenimientos Registrados",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#asignados').DataTable({
            order: [
                [1, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
        $('#ingresosporusuario').DataTable({
            order: [
                [1, 'desc'],
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros",
                "zeroRecords": "Nada se encontro",
                "info": "Mostrando pag _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "<i class='glyphicon glyphicon-search'></i> FILTRAR:",
                "responsive": true,
                "autoWidth": true,
                paginate: {
                    previous: '‹‹',
                    next: '››'
                },

            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "Todos"]
            ]
        });
    });
</script>
<script src="Assets/js/pages/tables/jquery-datatable.js"></script>