$(document).ready(function(){
    if (!jQuery().DataTable) {
        console.log('DataTable is null!');
        return;
    }
    $('#alumnos').DataTable({
        scrollX: true,
        buttons: ['copy', 'excel', 'csv', 'print'],
        info: false,
        order: [], // Clearing default order
        pageLength: 10,
        columns: [{data: 'ID'},{data: 'Rut'},{data: 'Nombre'}, {data: 'ApellidoPaterno'}, {data: 'ApellidoMaterno'}, {data: 'NombreSocial'},{data: 'Correo'},{data: 'Telefono'},{data: 'Universidad'},{data: 'Carrera'},{data: 'Check'}],
        language: {
          paginate: {
            previous: '<i class="cs-chevron-left"></i>',
            next: '<i class="cs-chevron-right"></i>',
          },
        },
        initComplete: function (settings, json) {
          _this._setInlineHeight();
        },
        drawCallback: function (settings) {
          _this._setInlineHeight();
        },
        columnDefs: [
        ],
      });
    _setInlineHeight = () => {
        if (!this._datatable) {
          return;
        }
        const pageLength = this._datatable.page.len();
        document.querySelector('.dataTables_scrollBody').style.height = this._staticHeight * pageLength + 'px';
      }  
});

var modalEliminar = document.getElementById('modalEliminar')
modalEliminar.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var id = button.getAttribute('data-bs-id')
  document.getElementById('idEliminar').value = id;
})