@extends('layouts.app')
@section('title', 'Carga de Datos - Porto Admin')
@section('page_title', 'Carga de Datos')
@section('content')
@include('partials.modules')
<!-- Main Row -->
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Módulo de Carga de Datos</h2>
            </header>
            <div class="panel-body">
                <!-- Filter Toolbar -->
                <div class="filter-toolbar" style="margin-bottom: 20px;">
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
                            <select id="select-estacion" class="form-control selectpicker" data-live-search="true" data-width="100%" disabled>
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <!-- Mes -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-calendar text-success"></i> MES</label>
                            <select id="select-mes" class="form-control selectpicker" data-width="100%">
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <!-- Año -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-calendar-alt text-success"></i> AÑO</label>
                            <select id="select-year" class="form-control selectpicker" data-width="100%">
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <!-- Indicador -->
                        <div class="filter-item">
                            <label class="filter-label"><i class="fa fa-check-circle text-success"></i> INDICADOR</label>
                            <select id="select-programa" class="form-control selectpicker" data-live-search="true" data-width="100%">
                                <!-- Dynamic -->
                            </select>
                        </div>

                        <!-- Buttons as equal items -->
                        <div class="filter-item">
                            <label class="filter-label">&nbsp;</label>
                            <button type="button" id="btn-filter" class="btn btn-default filter-btn btn-block">
                                <i class="fa fa-filter text-success mr-1"></i> &nbsp; Filtrar
                            </button>
                        </div>

                        <div class="filter-item">
                            <label class="filter-label">&nbsp;</label>
                            <button type="button" id="btn-delete" class="btn btn-default filter-btn btn-block">
                                <i class="fa fa-trash text-danger mr-1"></i> &nbsp;  Eliminar
                            </button>
                        </div>

                        <div class="filter-item">
                            <label class="filter-label">&nbsp;</label>
                            <button type="button" id="btn-load" class="btn btn-success filter-btn btn-block" data-toggle="modal" data-target="#modalCargar">
                                <i class="fa fa-cloud mr-1"></i>&nbsp;  Cargar
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Table Section -->
                <div id="carga-datos-table"></div>
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
                    <div class="row text-center mb-4">
                        <div class="col-md-4">
                            <span class="badge badge-secondary" style="font-size: 14px;">PROCESADOS</span><br><br>
                            <span style="font-size: 24px" id="res-procesados">0</span>
                        </div>
                        <div class="col-md-4">
                            <span class="badge badge-success" style="font-size: 14px; background-color: #28a745;">INGRESADOS</span><br><br>
                            <span style="font-size: 24px; color: #28a745;" id="res-ingresados">0</span>
                        </div>
                        <div class="col-md-4">
                            <span class="badge badge-danger" style="font-size: 14px; background-color: #dc3545;">RECHAZADOS</span><br><br>
                            <span style="font-size: 24px; color: #dc3545;" id="res-rechazados">0</span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5 class="mt-3">Detalle de Registros Rechazados</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="tabla-rechazos">
                            <thead>
                                <tr>
                                    <th>Certificado</th>
                                    <th>Fecha</th>
                                    <th>Estación</th>
                                    <th>Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic -->
                            </tbody>
                        </table>
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
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 4px;
        border: 1px solid #eee;
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

    #carga-datos-table {
        border: 1px solid #E5E7E9;
        margin-top: 15px;
        font-family: inherit;
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
<script>
   $(document).ready(function () {
   
       // ── 1. TABULATOR (columnas dinámicas) ───────────────────────────
       let table;
       $.get('{{ url("/api/carga-datos/columns") }}', function (columns) {
           table = new Tabulator("#carga-datos-table", {
               layout: "fitColumns",
               placeholder: "Sin datos disponibles",
               columns: columns,
               height: "500px",
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
   
           // Estaciones (todas, en memoria para cascada)
           allEstaciones = data.estaciones;
   
           // Años → #select-year
           $.each(data.years, function (i, y) {
               $('#select-year').append(
                   $('<option>', { value: y, text: y })
               );
           });
   
           // Meses → #select-mes
           $.each(data.meses, function (i, m) {
               $('#select-mes').append(
                   $('<option>', { value: m.id, text: m.nombre })
               );
           });
   
           // Programas → #select-programa
           $.each(data.programas, function (i, p) {
               $('#select-programa').append(
                   $('<option>', { value: p.id_programa, text: p.nombre_serie })
               );
           });
   
           // Refrescar todos los selectpickers
           $('.selectpicker').selectpicker('refresh');
   
       }).fail(function (xhr) {
           console.error('Error cargando filtros:', xhr.responseText);
       });
   
       // ── 3. CASCADA: Depósito → Estaciones ───────────────────────────
       $('#select-sector').on('change', function () {
           const depositoId = parseInt($(this).val());
   
           $('#select-estacion').empty().prop('disabled', true);
   
           if (depositoId) {
               // Filtrar las estaciones por clasificacion == id_depositos
               const filtradas = allEstaciones.filter(function (e) {
                   return parseInt(e.clasificacion) === depositoId;
               });
   
               $.each(filtradas, function (i, e) {
                   $('#select-estacion').append(
                       $('<option>', { value: e.id_estacion, text: e.nombre_estacion })
                   );
               });
   
               if (filtradas.length > 0) {
                   $('#select-estacion').prop('disabled', false);
               }
           }
   
           $('#select-estacion').selectpicker('refresh');
       });
   
       // ── 4. BOTONES (placeholder) ─────────────────────────────────────
       $('#btn-filter').on('click', function () {
           alert('Función de Filtrar próximamente');
       });
       $('#btn-delete').on('click', function () {
           alert('Función de Eliminar próximamente');
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

                    // Llenar tabla
                    if (response.tabla && response.tabla.length > 0) {
                        var tbody = '';
                        $.each(response.tabla, function(i, row) {
                            if(row.motivo !== 'Ingresado') {
                                tbody += '<tr>' +
                                    '<td>' + row.certificado + '</td>' +
                                    '<td>' + row.fecha + '</td>' +
                                    '<td>' + row.estacion + '</td>' +
                                    '<td><span class="text-danger">' + row.motivo + '</span></td>' +
                                '</tr>';
                            }
                        });
                        if(tbody === '') {
                             tbody = '<tr><td colspan="4" class="text-center text-success">Todos los registros fueron ingresados correctamente.</td></tr>';
                        }
                        $('#tabla-rechazos tbody').html(tbody);
                    } else {
                        $('#tabla-rechazos tbody').html('<tr><td colspan="4" class="text-center">No hubo rechazos.</td></tr>');
                    }

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
           $('#tabla-rechazos tbody').empty();
       });
   
   });
</script>
@endpush