@extends('layouts.app')
@section('title', 'Carga de Datos - Porto Admin')
@section('page_title', 'Carga de Datos')
@section('content')
@include('partials.modules')
<!-- Intro Banner -->
<div class="row" style="margin-bottom: 25px;">
    <div class="col-md-12">
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #0088cc; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                <div>
                    <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                        <i class="fa fa-database" style="color: #0088cc;"></i> Carga de Datos
                    </h2>
                    <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                           Cargue la información requerida en la base de datos
                    </p>
                </div>
                <div>
                    <button type="button" id="btn-load-top" class="btn btn-primary" data-toggle="modal" data-target="#modalCargar" style="padding: 12px 24px; font-family: 'Outfit', sans-serif; font-weight: 600; font-size: 15px; border-radius: 6px; box-shadow: 0 4px 15px rgba(0,136,204,0.3); transition: all 0.3s ease;">
                        <i class="fa fa-cloud-upload mr-2"></i> Importar Excel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Row -->
<div class="row">
    <div class="col-md-12">
        <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div class="panel-body" style="padding: 25px;">
                <!-- Filter Toolbar -->
                <div class="filter-toolbar">
                    <div class="flex-toolbar-container">
                        
                        <!-- Depósito -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                            <select id="select-sector" class="form-control selectpicker" data-live-search="true" data-width="100%">
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <!-- Estaciones -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                            <select 
                                multiple 
                                id="filtro-estaciones" 
                                class="form-control selectpicker"  
                                title="Estaciones"  
                                data-size="5" 
                                data-live-search="true" 
                                data-width="100%"
                                data-dropup-auto="false"
                                data-selected-text-format="count" 
                                data-count-selected-text=" ({0}) Estaciones "                            
                                data-actions-box="true" 
                                data-select-all-text="Todos"
                                data-deselect-all-text="Ninguno">
                     </select>
                        </div>

                        <!-- Mes -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-calendar text-success"></i> MES</label>
                            <select 
                        multiple 
                        id="filtro-meses" 
                        class="form-control selectpicker" 
                        title="Seleccionar Meses"
                        data-size="5" 
                        data-width="100%"
                        data-actions-box="true"
                        data-select-all-text="Todos"
                        data-deselect-all-text="Ninguno"
                        data-selected-text-format="count > 1"
                        data-count-selected-text="({0}) Meses">
                     </select>
                        </div>

                        <!-- Año -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-calendar-alt text-success"></i> AÑO</label>
                           <select 
                        multiple 
                        id="filtro-anios" 
                        class="form-control selectpicker" 
                        title="Años"
                        data-size="5" 
                        data-width="100%"
                        data-actions-box="true"
                        data-select-all-text="Todos"
                        data-deselect-all-text="Ninguno"
                        data-selected-text-format="count > 1"
                        data-count-selected-text="({0}) Años">
                     </select>
                        </div>

                        <!-- Indicador -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-check-circle text-success"></i> INDICADOR</label>
                            <select id="filtro-indicador" class="form-control selectpicker" data-live-search="true" data-width="100%">
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <div class="filter-item">
                            <label class="filter-label">&nbsp;</label>
                            <button type="button" id="btn-filtrar" class="btn btn-primary filter-btn btn-block" style="background-color: #0088cc; border-color: #0088cc; font-family: 'Outfit', sans-serif; font-weight: 600;">
                                <i class="fa fa-search mr-1"></i> &nbsp; Consultar
                            </button>
                        </div>

                        <div class="filter-item">
                            <label class="filter-label">&nbsp;</label>
                            <button type="button" id="btn-delete" class="btn btn-danger filter-btn btn-block" style="font-family: 'Outfit', sans-serif; font-weight: 600;">
                                <i class="fa fa-trash mr-1"></i> &nbsp; Eliminar
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Table Section -->
                <div id="tabla-muestras"></div>
            </div>
        </section>
    </div>
</div>

<!-- Modal Cargar -->
<div class="modal fade" id="modalCargar" tabindex="-1" role="dialog" aria-labelledby="modalCargarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCargarLabel">Cargar Datos desde Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCargarExcel">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 control-label text-right">Archivo Excel</label>
                        <div class="col-sm-9">
                            <input type="file" id="dataxls" name="dataxls" class="form-control" accept=".xls,.xlsx" required>
                        </div>
                    </div>
                </form>

                <div id="resultado-carga" style="display: none; margin-top: 20px;">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 20px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                                <h6 style="color: #6c757d; font-family: 'Inter', sans-serif; font-weight: 600; margin-top: 0; text-transform: uppercase; letter-spacing: 1px;">Procesados</h6>
                                <span style="font-size: 32px; font-weight: 800; font-family: 'Outfit', sans-serif; color: #495057;" id="res-procesados">0</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: #f0fdf4; border: 1px solid #d1fae5; border-radius: 8px; padding: 20px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                                <h6 style="color: #10b981; font-family: 'Inter', sans-serif; font-weight: 600; margin-top: 0; text-transform: uppercase; letter-spacing: 1px;">Ingresados</h6>
                                <span style="font-size: 32px; font-weight: 800; font-family: 'Outfit', sans-serif; color: #059669;" id="res-ingresados">0</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: #fef2f2; border: 1px solid #fee2e2; border-radius: 8px; padding: 20px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                                <h6 style="color: #ef4444; font-family: 'Inter', sans-serif; font-weight: 600; margin-top: 0; text-transform: uppercase; letter-spacing: 1px;">Rechazados</h6>
                                <span style="font-size: 32px; font-weight: 800; font-family: 'Outfit', sans-serif; color: #dc2626;" id="res-rechazados">0</span>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="border-top: 1px dashed #e2e8f0; margin-bottom: 25px;">
                    
                    <div class="row">
                        <div class="col-md-5">
                            <div id="grafico-carga" style="height: 350px;"></div>
                        </div>
                        <div class="col-md-7">
                            <h5 class="mt-0">Detalle de Registros Rechazados</h5>
                            <div id="tabla-rechazos" style="font-family: inherit;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnProcesarExcel">
                    <i class="fa fa-cogs"></i> Procesar
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
<!-- Bootstrap Selectpicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
<!-- Tabulator CSS -->
<link href="https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">
<style>
    .filter-toolbar {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        margin-bottom: 25px;
    }

    /* Custom Flexbox Classes (Bootstrap 3 fallback) */
    .flex-toolbar-container {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap; /* Force exactly one line */
        align-items: stretch; /* Stretch to fill vertically if needed, but we use flex-end mostly */
        gap: 8px; /* Slightly tighter gap to fit 8 elements comfortably */
        width: 100%;
    }

    .filter-item {
        flex: 1 1 0; /* Mathematical exactness: each box takes exactly the same width */
        min-width: 0; /* Allows shrinking below content width to fit single line */
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .filter-label {
        font-size: 10px !important;
        font-weight: 700;
        color: #777;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Uniform Height for Toolbar */
    .bootstrap-select .btn, 
    .filter-btn {
        height: 34px !important;
        padding: 5px 12px !important;
        font-size: 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .bootstrap-select .btn {
        background-color: #fff !important;
        border: 1px solid #E5E7E9 !important;
    }

    .filter-btn i {
        font-size: 14px;
    }

    #tabla-muestras {
        border: 1px solid #E5E7E9;
        margin-top: 15px;
        font-family: 'Inter', sans-serif;
        border-radius: 8px;
        overflow: hidden;
    }
   /* Estilo para el encabezado */
   .tabulator-header {
   background-color: #f0f2f5 !important;
   color: #333 !important;
   border-bottom: 2px solid #dde1e5 !important;
   font-weight: 600 !important;
   }
   /* Corregir el solapamiento al deslizar (Importante para columnas 'frozen') */
   .tabulator-col, .tabulator-col-content {
   background-color: #f0f2f5 !important; /* Mismo color que el header pero opaco */
   border-right: 1px solid #dde1e5 !important;
   }
   /* Añadir la grilla vertical en todas las celdas */
   .tabulator-cell {
       border-right: 1px solid #dde1e5 !important;
   }
   .tabulator-col-title {
   padding: 6px 8px !important; /* Reducir padding vertical */
   font-size: 13px !important;
   text-transform: none !important; /* No mayúsculas */
   }
   /* Zebra striping para las filas */
   .tabulator-row-odd {
   background-color: #ffffff !important;
   }
   .tabulator-row-even {
   background-color: #f9fbfe !important;
   }
   .tabulator-row:hover {
   background-color: #f1f4f9 !important;
   transition: background-color 0.2s ease;
   }
   /* Ajustes para el placeholder */
   .tabulator-placeholder-contents {
   color: #999;
   font-style: italic;
   padding: 30px !important;
   background-color: #fff;
   }
   /* Personalización de los filtros en el header */
   .tabulator-header-filter {
   padding: 3px 6px 6px 6px !important; /* Reducir padding superior */
   background-color: #f0f2f5 !important;
   }
   .tabulator-header-filter input {
   border: 1px solid #cbd2d9 !important;
   border-radius: 4px !important;
   padding: 4px 6px !important; /* Reducir padding interno del input */
   font-size: 12px !important;
   background: #ffffff !important;
   color: #333 !important;
   width: 100%;
   }
   .tabulator-header-filter input:focus {
   border-color: #3498db !important;
   box-shadow: 0 0 3px rgba(52, 152, 219, 0.3);
   outline: none;
   }
</style>
@endpush
@push('js')
<!-- Tabulator JS -->
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js"></script>
<!-- Bootstrap Selectpicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Highcharts JS -->
<script src="https://cdn.jsdelivr.net/npm/highcharts@11/highcharts.js"></script>
<script>
   $(document).ready(function () {
    
       Highcharts.setOptions({
           lang: {
               months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
               weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
               shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
               thousandsSep: '.',
               decimalPoint: ',',
               downloadPNG: 'Descargar imagen PNG',
               downloadJPEG: 'Descargar imagen JPEG',
               downloadPDF: 'Descargar documento PDF',
               downloadSVG: 'Descargar imagen SVG',
               printChart: 'Imprimir gráfico',
               viewFullscreen: 'Ver en pantalla completa',
               exportButtonTitle: 'Exportar gráfico',
               contextButtonTitle: 'Menú contextual',
               resetZoom: 'Restablecer zoom',
               resetZoomTitle: 'Restablecer nivel de zoom 1:1',
               loading: 'Cargando...',
               noData: 'No hay datos para mostrar'
           },
           chart: { style: { fontFamily: "'Inter', sans-serif" } }
       });
   
       // Formateador para parámetros (miles: . , decimal: , )
       const paramFormatter = function(cell) {
           let val = cell.getValue();
           if (val !== null && val !== undefined && val !== '' && val !== '―') {
               let prefix = '';
               let cleanVal = String(val).trim();
               if (cleanVal.startsWith('<') || cleanVal.startsWith('>')) {
                   prefix = cleanVal.charAt(0);
                   cleanVal = cleanVal.substring(1).trim();
               }
               
               // Parse numerically, handle comma decimal from DB
               let parsed = parseFloat(cleanVal.replace(',', '.'));
               if (!isNaN(parsed)) {
                   // Chilean format: dots for thousands, comma for decimals, always at least 1 decimal
                   const formatter = new Intl.NumberFormat('es-CL', {
                       minimumFractionDigits: 1,
                       maximumFractionDigits: 4
                   });
                   val = prefix + formatter.format(parsed);
               }
           }
           return val;
       };

       // ── 1. TABULATOR (columnas dinámicas) ───────────────────────────
       let table;
       $.get('{{ url("/api/carga-datos/columns") }}', function (columns) {
           // Aplicar formateador a columnas de parámetros
           columns.forEach(col => {
               if (col.field && col.field.startsWith('parametro_')) {
                   col.formatter = paramFormatter;
               }
           });

           // Agregar columna de selección (Checkbox) al inicio
           columns.unshift({
               formatter:"rowSelection", 
               titleFormatter:"rowSelection", 
               hozAlign:"center", 
               headerSort:false, 
               frozen:true, 
               width:40
           });

           table = new Tabulator("#tabla-muestras", {
               layout: "fitColumns",
               placeholder: "Sin datos disponibles",
               columns: columns,
               height: "500px",
               selectableRows: true, // Habilitar selección de filas
               pagination: "local",
               paginationSize: 20,
               paginationSizeSelector: [10, 20, 50, 100],
               paginationCounter: "rows",
           });
       });
   
       // ── 2. CARGA DE FILTROS (un solo request) ────────────────────────
       let allEstaciones = []; // guardamos todas para filtrar por depósito
   
       $.get('{{ url("/api/carga-datos/filters") }}', function (data) {
   
           // Depósitos → #select-sector
           $.each(data.depositos, function (i, d) {
               $('#select-sector').append(
                   $('<option>', { value: d.id_depositos, text: d.descripcion })
               );
           });
           // Seleccionar "Los Helados" (id 1) por defecto
           $('#select-sector').val(1);
   
           // Estaciones (Agrupadas)
           allEstaciones = data.estaciones;
           const heladosGroup = $('<optgroup>', { label: 'Los Helados' });
           const otrosGroup = $('<optgroup>', { label: 'Otras Estaciones' });

           $.each(allEstaciones, function (i, e) {
               const opt = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               if (parseInt(e.clasificacion) === 1) {
                   heladosGroup.append(opt);
               } else {
                   otrosGroup.append(opt);
               }
           });

           $('#filtro-estaciones').empty().append(heladosGroup).append(otrosGroup);
           $('#filtro-estaciones').prop('disabled', false);
   
           // Años → #filtro-anios
           $.each(data.years, function (i, y) {
               $('#filtro-anios').append(
                   $('<option>', { value: y, text: y })
               );
           });
   
           // Meses → #filtro-meses
           $.each(data.meses, function (i, m) {
               $('#filtro-meses').append(
                   $('<option>', { value: m.id, text: m.nombre })
               );
           });
   
           // Programas → #filtro-indicador
           $.each(data.programas, function (i, p) {
               $('#filtro-indicador').append(
                   $('<option>', { value: p.id_programa, text: p.nombre_serie })
               );
           });
   
           // Refrescar todos los selectpickers
           $('.selectpicker').selectpicker('refresh');
   
       }).fail(function (xhr) {
           console.error('Error cargando filtros:', xhr.responseText);
       });
   
       // ── 3. CASCADA: Depósito → Estaciones (OBSOLETO) ─────────────────
       $('#select-sector').on('change', function () {
           // Las estaciones ya se muestran todas agrupadas al inicio
       });
   
       // ── 4. BOTONES ─────────────────────────────────────
       $('#btn-filtrar').on('click', function () {
           let stations = $('#filtro-estaciones').val() || [];
           let months = $('#filtro-meses').val() || [];
           let years = $('#filtro-anios').val() || [];

           if (stations.length === 0 || months.length === 0 || years.length === 0) {
               Swal.fire({
                   icon: 'warning',
                   title: 'Faltan parámetros',
                   text: 'Por favor seleccione al menos una estación, un mes y un año.',
                   confirmButtonColor: '#28a745'
               });
               return;
           }
           
           let indicadorVal = $('#filtro-indicador').val() || "1";
           let indicador = Array.isArray(indicadorVal) ? indicadorVal : [indicadorVal];

           let params = {
               stations: stations,
               months: months,
               years: years,
               indicador: indicador
           };

           // Petición fetch nativa para mejor manejo de errores (ignorar el "Error" genérico de Tabulator)
           let btn = $(this);
           btn.prop('disabled', true);
           
           fetch("{{ url('/api/carga-datos/filtrar') }}", {
               method: "POST",
               headers: {
                   "Content-Type": "application/json",
                   "Accept": "application/json",
                   "X-CSRF-TOKEN": "{{ csrf_token() }}"
               },
               body: JSON.stringify(params)
           })
           .then(response => {
               if (!response.ok) {
                   // Si hay un error HTTP (ej: 500, 419, 422)
                   return response.text().then(text => {
                       let msg = text;
                       try { let j = JSON.parse(text); msg = j.message || j.error || text; } catch(e) {}
                       throw new Error(msg);
                   });
               }
               return response.json();
           })
           .then(data => {
               if (data.error) throw new Error(data.error);
               table.setData(data);
               btn.prop('disabled', false);
           })
           .catch(error => {
               console.error("Error backend:", error);
               alert("Error al cargar datos: " + error.message);
               btn.prop('disabled', false);
           });
       });

       $('#btn-delete').on('click', function () {
           if (!table) return;
           let selectedRows = table.getSelectedData();
           
           if (selectedRows.length === 0) {
               Swal.fire({
                   icon: 'info',
                   title: 'Ninguna muestra seleccionada',
                   text: 'Debes seleccionar al menos una muestra de la tabla para eliminar.',
                   confirmButtonColor: '#17a2b8'
               });
               return;
           }

           let certificados = selectedRows.map(row => row.certificado);

           Swal.fire({
               title: '¿Estás seguro?',
               text: "Se eliminarán " + selectedRows.length + " muestras seleccionadas. Esta acción no se puede deshacer.",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#3085d6',
               confirmButtonText: 'Sí, eliminar',
               cancelButtonText: 'Cancelar'
           }).then((result) => {
               if (result.isConfirmed) {
                   Swal.fire({
                       title: 'Eliminando...',
                       allowOutsideClick: false,
                       didOpen: () => { Swal.showLoading(); }
                   });

                   fetch("{{ url('/api/carga-datos/eliminar') }}", {
                       method: 'POST',
                       headers: {
                           "Content-Type": "application/json",
                           "Accept": "application/json",
                           "X-CSRF-TOKEN": "{{ csrf_token() }}"
                       },
                       body: JSON.stringify({ certificados: certificados })
                   })
                   .then(response => response.json().then(j => ({status: response.status, ok: response.ok, body: j})))
                   .then(res => {
                       if (!res.ok) throw new Error(res.body.message || res.body.error || 'Error al eliminar');
                       Swal.fire('Eliminado!', 'Las muestras han sido eliminadas correctamente.', 'success');
                       // Recargar la tabla usando el botón de filtro
                       $('#btn-filtrar').click(); 
                   })
                   .catch(error => {
                       Swal.fire('Error', error.message, 'error');
                   });
               }
           });
       });

       // ── 5. IMPORTACION EXCEL ─────────────────────────────────────────
       $('#btnProcesarExcel').on('click', function() {
            var fileInput = $('#dataxls')[0];
            if (fileInput.files.length === 0) {
                alert('Por favor, selecciona un archivo Excel.');
                return;
            }

            var formData = new FormData();
            formData.append('dataxls', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            var $btn = $(this);
            var originalText = $btn.html();
            $btn.html('<i class="fa fa-spinner fa-spin"></i> Procesando...').prop('disabled', true);
            $('#resultado-carga').hide();
            $('#tabla-rechazos tbody').empty();

            $.ajax({
                url: '{{ url("/muestras/importar") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $btn.html(originalText).prop('disabled', false);

                    // Llenar contadores
                    $('#res-procesados').text(response.procesados);
                    $('#res-ingresados').text(response.ingresados);
                    $('#res-rechazados').text(response.rechazados);

                    // Interfaz Tabulator en lugar de tabla manual HTML
                    let dataMuestras = response.tabla || [];
                    new Tabulator("#tabla-rechazos", {
                        data: dataMuestras.filter(r => r.motivo !== 'Ingresado'), // Mostramos los rechazados
                        layout: "fitColumns",
                        height: "350px",
                        placeholder: "Todos los registros fueron ingresados correctamente.",
                        columns: [
                            {title: "Certificado", field: "certificado", width: 120},
                            {title: "Fecha", field: "fecha", width: 100},
                            {title: "Estación", field: "estacion"},
                            {title: "Motivo", field: "motivo", formatter: function(cell) {
                                let val = cell.getValue();
                                return val === 'Ingresado' ? `<span class="text-success">${val}</span>` : `<span class="text-danger">${val}</span>`;
                            }}
                        ]
                    });

                    // Gráfico de Donut con Highcharts
                    Highcharts.chart('grafico-carga', {
                        chart: { type: 'pie' },
                        title: { text: null },
                        subtitle: {
                            text: '<span style="font-size: 14px; color: #666">Total</span><br><span style="font-size: 24px; color: #333; font-weight: bold">' + response.procesados + '</span>',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 10
                        },
                        tooltip: { pointFormat: '<b>{point.y}</b> ({point.percentage:.1f}%)' },
                        plotOptions: {
                            pie: {
                                innerSize: '65%',
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: { 
                                    enabled: true, 
                                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                                    distance: 15
                                },
                                showInLegend: false
                            }
                        },
                        series: [{
                            name: 'Registros',
                            colorByPoint: true,
                            data: [
                                { name: 'Ingresados', y: parseInt(response.ingresados), color: '#28a745' },
                                { name: 'Rechazados', y: parseInt(response.rechazados), color: '#dc3545' }
                            ]
                        }],
                        credits: { enabled: false }
                    });

                    // Ocultar form y mostrar resultado
                    $('#formCargarExcel').hide();
                    $('#btnProcesarExcel').hide();
                    $('#resultado-carga').fadeIn();
                    
                    // Si habia tabla tabulator podria recargarse aqui.
                },
                error: function(xhr) {
                    $btn.html(originalText).prop('disabled', false);
                    var errorMessage = xhr.responseJSON ? (xhr.responseJSON.error || xhr.responseJSON.message) : xhr.statusText;
                    alert('Ocurrió un error: ' + errorMessage);
                    console.error('SERVER RESPONSE:', xhr.responseText);
                }
            });
       });

       // Resetear modal al cerrarlo
       $('#modalCargar').on('hidden.bs.modal', function () {
           $('#formCargarExcel').show();
           $('#btnProcesarExcel').show();
           $('#resultado-carga').hide();
           $('#formCargarExcel')[0].reset();
           $('#tabla-rechazos').empty();
           $('#grafico-carga').empty();
       });
   
   });
</script>
@endpush
