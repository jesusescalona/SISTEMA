jQuery(document).ready(function() {
    jQuery('#listausuario tfoot th').each(function() {
        var title = jQuery(this).text();
        jQuery(this).html('<i class="fas fa-search fa-fw"></i><input type="text" placeholder="BUSCAR USUARIO ' + title + '" />');
    });
    jQuery('#listausuario').DataTable({
        language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ de _END_ de un total de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior"
            }
        }
    });

});