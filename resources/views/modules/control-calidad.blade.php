@extends('layouts.app')
@section('title', 'Control de Calidad - Porto Admin')
@section('page_title', 'Control de Calidad')
@section('content')
@include('partials.modules')
<!-- Main Row -->
<div class="row">
   <div class="col-md-12">
      <section class="panel">
         <header class="panel-heading">
            <h2 class="panel-title">Módulo de Control de Calidad</h2>
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
                     <select id="filtro-indicador" class="form-control selectpicker" data-size="5" data-live-search="true" data-width="100%">
                        <!-- Dynamic -->
                     </select>
                  </div>
                  <!-- Buttons as equal items -->
                  <div class="filter-item">
                     <label class="filter-label">&nbsp;</label>
                     <button type="button" id="btn-filtrar" class="btn btn-default filter-btn btn-block">
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
                  <div class="filter-item">
                     <label class="filter-label">&nbsp;</label>
                     <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default filter-btn dropdown-toggle btn-block" data-toggle="dropdown">
                        <i class="fa fa-cog text-primary mr-1"></i> &nbsp; Opciones <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" style="min-width: 100%;">
                           <li><a href="javascript:void(0)" id="btn-bulk-status"><i class="fa fa-check-circle text-success"></i> Aprobar Muestras</a></li>
                           <li><a href="javascript:void(0)" id="btn-bulk-pendiente"><i class="fa fa-unlock-alt text-warning"></i> Marcar como Pendiente</a></li>
                           <li><a href="javascript:void(0)" id="btn-view-historial"><i class="fa fa-history text-info"></i> Ver Historial</a></li>
                           <li><a href="javascript:void(0)" id="btn-select-all"><i class="fa fa-list"></i> Seleccionar todo</a></li>
                           <li><a href="javascript:void(0)" id="btn-qa-qc"><i class="fa fa-line-chart text-danger"></i> Control de calidad...</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Table Section -->
            <div id="tabla-muestras"></div>
         </div>
      </section>
   </div>
</div>
<!-- Historical Chart Row -->
<div class="row">
   <div class="col-md-12">
      <section class="panel">
         <header class="panel-heading">
            <div class="panel-actions">
               <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">Gráfico histórico</h2>
         </header>
         <div class="panel-body">
            <!-- Filter Toolbar for Chart -->
            <div class="filter-toolbar" style="margin-bottom: 20px;">
               <div class="flex-toolbar-container">
                  <!-- Sector -->
                  <div class="filter-item">
                     <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                     <select id="select-sector-chart" class="form-control selectpicker" data-live-search="true" data-width="100%">
                        <!-- Dynamic -->
                     </select>
                  </div>
                  <!-- Estaciones -->
                  <div class="filter-item">
                     <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                     <select 
                        multiple 
                        id="filtro-estaciones-chart" 
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
                  <!-- Parámetros -->
                  <div class="filter-item">
                     <label class="filter-label"><i class="fa fa-flask text-success"></i> PARÁMETROS</label>
                     <select 
                        multiple 
                        id="filtro-parametros-chart" 
                        class="form-control selectpicker" 
                        title="Seleccionar Parámetros"
                        data-live-search="true" 
                        data-width="100%"
                        data-size="5"
                        data-actions-box="true"
                        data-select-all-text="Todos"
                        data-deselect-all-text="Ninguno"
                        data-selected-text-format="count > 1"
                        data-count-selected-text="({0}) Parámetros">
                     </select>
                  </div>
                  <!-- Programas -->
                  <div class="filter-item">
                     <label class="filter-label"><i class="fa fa-tasks text-success"></i> PROGRAMAS</label>
                     <select multiple id="filtro-indicador-chart" class="form-control selectpicker" data-live-search="true" data-width="100%">
                        <!-- Dynamic -->
                     </select>
                  </div>
                  <!-- Graficar Button -->
                  <div class="filter-item">
                     <label class="filter-label">&nbsp;</label>
                     <button type="button" id="btn-graficar" class="btn btn-success filter-btn btn-block">
                     <i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar
                     </button>
                  </div>
                  <!-- Config Button -->
                  <div class="filter-item">
                     <label class="filter-label">&nbsp;</label>
                     <div class="btn-group btn-block">
                        <button type="button" class="btn btn-default filter-btn dropdown-toggle btn-block" data-toggle="dropdown">
                        <i class="fa fa-cog mr-1"></i> &nbsp; Configuración <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="#">Ajustes de Ejes</a></li>
                           <li><a href="#">Exportar Imagen</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Chart Container -->
            <div id="chart-historico" style="height: 500px; width: 100%;">
               <div class="text-center" style="padding-top: 150px; color: #999;">
                  <i class="fa fa-line-chart fa-5x" style="opacity: 0.2; margin-bottom: 20px;"></i>
                  <h4>Seleccione estaciones y parámetros para visualizar el histórico.</h4>
               </div>
            </div>
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

<!-- Modal Estatus -->
<div class="modal fade" id="modalEstatus" tabindex="-1" role="dialog" aria-labelledby="modalEstatusLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #f8f9fa;">
            <h5 class="modal-title" id="modalEstatusLabel"><i class="fa fa-exchange"></i> Estatus de Certificado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="status-certificados">
            <table class="table table-bordered">
               <tr>
                  <th width="40%" style="background: #fdfdfd;">Certificado</th>
                  <td id="status-display-cert"></td>
               </tr>
               <tr>
                  <th style="background: #fdfdfd;">Estatus Actual</th>
                  <td id="status-display-current"></td>
               </tr>
               <tr>
                  <th style="background: #fdfdfd;">Cambiar Estatus</th>
                  <td>
                     <select id="select-nuevo-estatus" class="form-control selectpicker" data-width="100%">
                        <option value="0">Pendiente</option>
                        <option value="1">Aprobado Jefe de Proyecto</option>
                        <option value="2">Aprobado Analista</option>
                     </select>
                  </td>
               </tr>
               <tr>
                  <th style="background: #fdfdfd;">Usuario</th>
                  <td id="status-display-user"></td>
               </tr>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btn-actualizar-status">
               <i class="fa fa-refresh"></i> Actualizar
            </button>
         </div>
      </div>
   </div>
</div>

<!-- Modal Historial -->
<div class="modal fade" id="modalHistorial" tabindex="-1" role="dialog" aria-labelledby="modalHistorialLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalHistorialLabel"><i class="fa fa-history"></i> Historial de Modificaciones</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div id="tabla-historial"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal QA/QC -->
<div class="modal fade" id="modalQAQC" tabindex="-1" role="dialog" aria-labelledby="modalQAQCLabel" aria-hidden="true">
   <div class="modal-dialog" role="document" style="width: 95vw; max-width: 1700px;">
      <div class="modal-content qaqc-modal-content">
         <div class="modal-header qaqc-modal-header">
            <h5 class="modal-title" id="modalQAQCLabel"><i class="fa fa-line-chart"></i> &nbsp;Control de Calidad — QA / QC</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color:#fff; opacity:.8;">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="padding: 0;">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs qaqc-nav-tabs" role="tablist">
               <li class="active"><a href="#tab-qc-cond" data-toggle="tab" role="tab"><i class="fa fa-bolt"></i> Conductividad Eléctrica <span class="badge qaqc-badge" id="badge-qc-cond">0</span></a></li>
               <li><a href="#tab-qc-ph" data-toggle="tab" role="tab"><i class="fa fa-tint"></i> pH <span class="badge qaqc-badge" id="badge-qc-ph">0</span></a></li>
               <li><a href="#tab-qc-sdt" data-toggle="tab" role="tab"><i class="fa fa-flask"></i> SDT <span class="badge qaqc-badge" id="badge-qc-sdt">0</span></a></li>
            </ul>
            <!-- Tab Content -->
            <div class="tab-content qaqc-tab-content">
               <!-- CE Tab -->
               <div class="tab-pane active" id="tab-qc-cond" role="tabpanel">
                  <div id="chart-qc-cond" style="height: 420px;"></div>
                  <div class="qaqc-table-section">
                     <h6 class="qaqc-table-title"><i class="fa fa-table"></i> &nbsp;Datos de Conductividad Eléctrica</h6>
                     <div id="table-qc-cond"></div>
                  </div>
               </div>
               <!-- pH Tab -->
               <div class="tab-pane" id="tab-qc-ph" role="tabpanel">
                  <div id="chart-qc-ph" style="height: 420px;"></div>
                  <div class="qaqc-table-section">
                     <h6 class="qaqc-table-title"><i class="fa fa-table"></i> &nbsp;Datos de pH</h6>
                     <div id="table-qc-ph"></div>
                  </div>
               </div>
               <!-- SDT Tab -->
               <div class="tab-pane" id="tab-qc-sdt" role="tabpanel">
                  <div id="chart-qc-sdt" style="height: 420px;"></div>
                  <div class="qaqc-table-section">
                     <h6 class="qaqc-table-title"><i class="fa fa-table"></i> &nbsp;Datos de SDT</h6>
                     <div id="table-qc-sdt"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer qaqc-modal-footer">
            <span class="qaqc-footer-info"><i class="fa fa-info-circle"></i> Los cálculos se generan automáticamente a partir de los registros seleccionados.</span>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
   #tabla-muestras {
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
   .btn-status {
      padding: 4px 8px;
      font-size: 14px;
      line-height: 1;
      border-radius: 4px;
      border: 1px solid transparent;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
   }
   .btn-status-0 { background-color: #f39c12; color: #fff; border-color: #e67e22; } /* Naranja */
   .btn-status-1 { background-color: #27ae60; color: #fff; border-color: #2ecc71; } /* Verde */
   .btn-status-2 { background-color: #2980b9; color: #fff; border-color: #3498db; } /* Azul */
   .btn-status:hover { opacity: 0.8; transform: scale(1.05); }

   .cell-modified {
      background-color: #ffff00 !important;
      color: #000 !important;
      font-weight: bold;
   }

   /* ── QA/QC Modal Premium Styles ────────────────────── */
   .qaqc-modal-content {
      border: none;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,.25);
   }
   .qaqc-modal-header {
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: #fff;
      padding: 16px 24px;
      border-bottom: none;
   }
   .qaqc-modal-header .modal-title {
      font-size: 17px;
      font-weight: 700;
      letter-spacing: .3px;
   }
   .qaqc-modal-footer {
      background: #fafbfc;
      border-top: 1px solid #e9ecef;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 24px;
   }
   .qaqc-footer-info {
      font-size: 12px;
      color: #888;
   }
   .qaqc-nav-tabs {
      background: #f5f7fa;
      border-bottom: 2px solid #dee2e6;
      padding: 0 16px;
      margin: 0;
   }
   .qaqc-nav-tabs > li > a {
      color: #6c757d;
      font-size: 13px;
      font-weight: 600;
      padding: 12px 22px;
      border: none;
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      transition: all .25s ease;
      border-radius: 0;
   }
   .qaqc-nav-tabs > li > a:hover {
      background: transparent;
      color: #2c3e50;
      border-bottom-color: #bdc3c7;
   }
   .qaqc-nav-tabs > li.active > a,
   .qaqc-nav-tabs > li.active > a:focus,
   .qaqc-nav-tabs > li.active > a:hover {
      background: transparent;
      color: #2980b9;
      border: none;
      border-bottom: 3px solid #2980b9;
   }
   .qaqc-badge {
      background: #dee2e6;
      color: #555;
      font-size: 10px;
      padding: 2px 7px;
      border-radius: 10px;
      margin-left: 4px;
      vertical-align: middle;
      font-weight: 700;
   }
   .qaqc-nav-tabs > li.active .qaqc-badge {
      background: #2980b9;
      color: #fff;
   }
   .qaqc-tab-content {
      padding: 20px 24px 24px;
   }
   .qaqc-table-section {
      margin-top: 24px;
      border-top: 1px solid #e9ecef;
      padding-top: 18px;
   }
   .qaqc-table-title {
      font-size: 14px;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 12px;
   }
   .qaqc-table-title i {
      color: #3498db;
   }
   /* QC Result badges */
   .qc-result-ok {
      display: inline-flex; align-items: center; gap: 5px;
      font-weight: 700; color: #27ae60; font-size: 12px;
   }
   .qc-result-no {
      display: inline-flex; align-items: center; gap: 5px;
      font-weight: 700; color: #e74c3c; font-size: 12px;
   }
   .qc-result-ok i, .qc-result-no i { font-size: 13px; }
   /* Tab pane transition */
   .qaqc-tab-content > .tab-pane { display: none; }
   .qaqc-tab-content > .active { display: block; }
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
            thousandsSep: '.',
            decimalPoint: ','
        }
    });

    // Permisos de usuario
       const currentUser = {
           name: "{{ auth()->user()->name }}",
           type: parseInt("{{ auth()->user()->type_user }}")
       };
   
       // Formateador personalizado para Estatus
       const estatusFormatter = function(cell) {
           const val = parseInt(cell.getValue());
           let icon = "fa-lock-open", title = "Pendiente", cls = "btn-status-0";
           if (val === 1) { icon = "fa-lock"; title = "Aprobado JP"; cls = "btn-status-1"; }
           else if (val === 2) { icon = "fa-unlock-alt"; title = "Aprobado Analista"; cls = "btn-status-2"; }
           return `<button class="btn-status ${cls}" title="${title}"><i class="fa ${icon}"></i></button>`;
       };

       window.checkEditStatus = function(cell) {
           return parseInt(cell.getData().estatus) === 0;
       };

       window.paramModifiedFormatter = function(cell) {
            let val = cell.getValue();
            if (val !== null && val !== undefined && val !== '' && val !== '―') {
                let prefix = '';
                let cleanVal = String(val).trim();
                // Check if starts with < or >
                if (cleanVal.startsWith('<') || cleanVal.startsWith('>')) {
                    prefix = cleanVal.charAt(0);
                    cleanVal = cleanVal.substring(1).trim();
                }
                
                // Parse the numerical part, handling the comma decimal separator from database
                let parsed = parseFloat(cleanVal.replace(',', '.'));
                if (!isNaN(parsed)) {
                    // Chilean format: . for thousands, , for decimals, always at least 1 decimal
                    const formatter = new Intl.NumberFormat('es-CL', {
                        minimumFractionDigits: 1,
                        maximumFractionDigits: 4
                    });
                    val = prefix + formatter.format(parsed);
                }
            }
            const field = cell.getField(); 
            const parts = field.split('_');
            if (parts.length >= 2) {
                const id = parts[1];
                const data = cell.getData();
                if (data["band_edit_" + id] == 1) {
                    cell.getElement().classList.add("cell-modified");
                } else {
                    cell.getElement().classList.remove("cell-modified");
                }
            }
            return val;
        };

       // ── 1. TABULATOR (columnas dinámicas) ───────────────────────────
       let table;
       $.get('{{ url("/api/control-calidad/columns") }}', function (columns) {
           columns.forEach(col => {
               if (col.field === 'estatus') {
                   col.formatter = estatusFormatter;
                   col.cellClick = function(e, cell) { abrirModalStatus([cell.getData().certificado]); };
               }
               if (col.editable === 'checkEditStatus') col.editable = window.checkEditStatus;
               if (col.formatter === 'paramModifiedFormatter') col.formatter = window.paramModifiedFormatter;
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
                cellEdited: function(cell) {
                    const data = cell.getData();
                    const colDef = cell.getColumn().getDefinition();
                    const newValue = cell.getValue();
                    const oldValue = cell.getOldValue();

                    if (newValue == oldValue) return;

                    Swal.fire({
                        title: 'Modificando valor...',
                        text: `El valor de ${colDef.nombre_parametro} cambiará de ${oldValue} a ${newValue}.`,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Revertir'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ url('/api/control-calidad/update-parametro') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    certificado: data.certificado,
                                    id_parametro: colDef.id_parametro,
                                    nombre_parametro: colDef.nombre_parametro,
                                    valor_nuevo: newValue,
                                    valor_anterior: oldValue
                                })
                            })
                            .then(res => res.json())
                            .then(res => {
                                if (res.error) throw new Error(res.error);
                                Swal.fire({ icon: 'success', text: res.message, timer: 1500, showConfirmButton: false });
                                let updatedData = {}; updatedData["band_edit_" + colDef.id_parametro] = 1;
                                cell.getRow().update(updatedData);
                            })
                            .catch(err => {
                                Swal.fire('Error', err.message, 'error');
                                cell.restoreOldValue();
                            });
                        } else {
                            cell.restoreOldValue();
                        }
                    });
                }
            });
       });
    
       // ── 2. CARGA DE FILTROS ────────────────────────
       let allEstaciones = []; 
       $.get('{{ url("/api/control-calidad/filters") }}', function (data) {
             // Depósitos
             $.each(data.depositos, function (i, d) {
                 $('#select-sector').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
                 $('#select-sector-chart').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
             });
             $('#select-sector').val(1);
             $('#select-sector-chart').val(1);
     
             // Estaciones (Agrupadas)
             allEstaciones = data.estaciones;
             const heladosGroup = $('<optgroup>', { label: 'Los Helados' });
             const otrosGroup = $('<optgroup>', { label: 'Otras Estaciones' });
             const heladosGroupChart = $('<optgroup>', { label: 'Los Helados' });
             const otrosGroupChart = $('<optgroup>', { label: 'Otras Estaciones' });

             $.each(allEstaciones, function (i, e) {
                 const opt = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
                 const optChart = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
                 if (parseInt(e.clasificacion) === 1) {
                     heladosGroup.append(opt);
                     heladosGroupChart.append(optChart);
                 } else {
                     otrosGroup.append(opt);
                     otrosGroupChart.append(optChart);
                 }
             });

             $('#filtro-estaciones').empty().append(heladosGroup).append(otrosGroup);
             $('#filtro-estaciones-chart').empty().append(heladosGroupChart).append(otrosGroupChart);
             $('#filtro-estaciones').prop('disabled', false); $('#filtro-estaciones-chart').prop('disabled', false);
     
             // Años, Meses, Programas, Parámetros (Removed unit from label)
             $.each(data.years, function (i, y) { $('#filtro-anios').append($('<option>', { value: y, text: y })); });
             $.each(data.meses, function (i, m) { $('#filtro-meses').append($('<option>', { value: m.id, text: m.nombre })); });
             $.each(data.programas, function (i, p) {
                 $('#filtro-indicador').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
                 $('#filtro-indicador-chart').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
             });
             $.each(data.parametros, function (i, p) {
                  $('#filtro-parametros-chart').append($('<option>', { value: p.id_parametro, text: p.nombre }));
             });
             $('.selectpicker').selectpicker('refresh');
        });
    
       // ── 4. BOTONES TABLA ─────────────────────────────────────
       $('#btn-filtrar').on('click', function () {
            let stations = $('#filtro-estaciones').val(), months = $('#filtro-meses').val(), years = $('#filtro-anios').val();
            if (!stations || !months || !years) return Swal.fire({ icon: 'warning', text: 'Seleccione filtros.' });
            let params = { stations, months, years, indicador: [ $('#filtro-indicador').val() || "1" ] };
            let btn = $(this); btn.prop('disabled', true);
            fetch("{{ url('/api/control-calidad/filtrar') }}", {
                method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify(params)
            })
            .then(res => res.json())
            .then(data => { table.setData(data); btn.prop('disabled', false); })
            .catch(() => { btn.prop('disabled', false); });
       });

       $('#btn-delete').on('click', function () {
            let selectedRows = table.getSelectedData();
            if (selectedRows.length === 0) return Swal.fire({ icon: 'info', text: 'Selecciona muestras.' });
            let certificados = selectedRows.map(row => row.certificado);
            Swal.fire({ title: '¿Eliminar muestras?', icon: 'warning', showCancelButton: true, confirmButtonText: 'Sí, eliminar' }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ url('/api/control-calidad/eliminar') }}", {
                        method: 'POST', headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                        body: JSON.stringify({ certificados })
                    }).then(() => { $('#btn-filtrar').click(); });
                }
            });
       });

       $('#btn-select-all').on('click', function() { if (table) table.selectRow(); });

       $('#btn-bulk-status').on('click', function() {
           let selectedData = table.getSelectedData();
           if (selectedData.length === 0) return Swal.fire({ icon: 'warning', text: 'Seleccione muestras.' });
           abrirModalStatus(selectedData.map(d => d.certificado));
       });

       $('#btn-bulk-pendiente').on('click', function() {
           let selectedData = table.getSelectedData();
           if (selectedData.length === 0) return Swal.fire({ icon: 'warning', text: 'Seleccione muestras.' });
           let certs = selectedData.map(d => d.certificado);
           Swal.fire({ title: '¿Marcar como pendientes?', icon: 'warning', showCancelButton: true }).then((r) => { if (r.isConfirmed) actualizarEstatusMasivo(certs, 0); });
       });

       function actualizarEstatusMasivo(certs, nuevoStatus) {
           fetch('{{ url("/api/control-calidad/update-estatus") }}', {
               method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
               body: JSON.stringify({ certificados: certs, nuevo_estatus: nuevoStatus })
           }).then(() => { $('#btn-filtrar').click(); });
       }

       // ── 4.3 LOG DE MODIFICACIONES ──────────────────────────────────
       let tableHistorial;
       $('#btn-view-historial').on('click', function() {
           let selectedData = table.getSelectedData();
           if (selectedData.length !== 1) return Swal.fire({ icon: 'info', text: 'Seleccione exactamente una muestra.' });
           $('#modalHistorial').modal('show');
           if (tableHistorial) tableHistorial.destroy();
           tableHistorial = new Tabulator("#tabla-historial", {
               ajaxURL: '{{ url("/api/control-calidad/historial") }}/' + selectedData[0].certificado,
               layout: "fitColumns",
               placeholder: "Sin modificaciones",
               columns: [
                   { title: "Parámetro", field: "nombre_parametro", width: 150 },
                   { title: "Anterior", field: "valor_anterior", hozAlign: "center" },
                   { title: "Nuevo", field: "valor_nuevo", hozAlign: "center" },
                   { title: "Usuario", field: "usuario", hozAlign: "center" },
                   { title: "Fecha", field: "fecha", hozAlign: "center" }
               ]
           });
       });

       function abrirModalStatus(certificados) {
           $('#status-certificados').val(certificados.join(','));
           $('#status-display-user').text(currentUser.name);
           $('#select-nuevo-estatus option[value="1"]').prop('disabled', currentUser.type !== 1);
           $('#select-nuevo-estatus').selectpicker('refresh');
           $('#modalEstatus').modal('show');
       }

       $('#btn-actualizar-status').on('click', function() {
           fetch('{{ url("/api/control-calidad/update-estatus") }}', {
               method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
               body: JSON.stringify({ certificados: $('#status-certificados').val().split(','), nuevo_estatus: $('#select-nuevo-estatus').val() })
           }).then(() => { $('#modalEstatus').modal('hide'); $('#btn-filtrar').click(); });
       });
    
       // ── 5. IMPORTACION EXCEL ─────────────────────────────────────────
       $('#btnProcesarExcel').on('click', function() {
              var formData = new FormData(); formData.append('dataxls', $('#dataxls')[0].files[0]); formData.append('_token', '{{ csrf_token() }}');
              var $btn = $(this); $btn.prop('disabled', true).html('Procesando...');
              $.ajax({ url: '{{ url("/muestras/importar") }}', type: 'POST', data: formData, contentType: false, processData: false,
                  success: function() { $btn.prop('disabled', false).html('Procesar'); $('#modalCargar').modal('hide'); $('#btn-filtrar').click(); }
              });
       });
    
       // ── 6. GRAFICO HISTORICO ─────────────────────────────────────────
       $('#btn-graficar').on('click', function() {
              let stations = $('#filtro-estaciones-chart').val(), parametros = $('#filtro-parametros-chart').val(), indicador = $('#filtro-indicador-chart').val();
              if (!stations || !parametros) return Swal.fire({ icon: 'warning', text: 'Seleccione filtros.' });
              let $btn = $(this); $btn.prop('disabled', true).html('Graficando...');
              fetch("{{ url('/api/control-calidad/chart-data') }}", {
                  method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                  body: JSON.stringify({ stations, parametros, indicador })
              }).then(res => res.json()).then(data => { $btn.prop('disabled', false).html('Graficar'); renderHistoricalChart(data); });
       });

       function renderHistoricalChart(data) {
           const series = [];
           if (!data.raw || data.raw.length === 0) return;

           // Group by Parameter + Station
           Object.keys(data.parametros_info).forEach(pID => {
               const stationsInRaw = [...new Set(data.raw.map(item => item.estacion))];
               
               stationsInRaw.forEach(stName => {
                   const points = data.raw
                       .filter(item => item.estacion === stName)
                       .map(item => {
                           const d = item.fecha_label.split('-');
                           let rawVal = String(item['parametro_'+pID] || '').replace(',', '.');
                           let cleanVal = parseFloat(rawVal.replace('<', '').replace('>', ''));
                           return { x: Date.UTC(d[0], d[1]-1, d[2]), y: cleanVal, str: item['parametro_'+pID] };
                       })
                       .filter(p => !isNaN(p.y))
                       .sort((a,b) => a.x - b.x);

                   if (points.length > 0) {
                        series.push({ 
                            name: `${data.parametros_info[pID].nombre_largo} ${stName}`, 
                            data: points,
                            userOptions: { unit: data.parametros_info[pID].unidad }
                        });
                   }
               });
           });

           Highcharts.chart('chart-historico', {
               title: { 
                   text: 'Gráfico histórico',
                   style: { fontSize: '18px', fontWeight: 'bold' }
               },
               xAxis: { 
                   type: 'datetime',
                   labels: { style: { fontSize: '14px', color: '#333' } }
               },
               yAxis: {
                   title: { text: 'Concentración', style: { fontSize: '14px' } },
                   labels: { style: { fontSize: '14px', color: '#333' } }
               },
               tooltip: { 
                   shared: true, 
                   useHTML: true,
                   style: { fontSize: '14px' },
                   formatter: function() {
                       let s = `<span style="font-size: 14px; font-weight: bold;">${Highcharts.dateFormat('%Y-%m-%d', this.x)}</span><br/>`;
                       this.points.forEach(p => { 
                           let unitStr = p.series.options.userOptions && p.series.options.userOptions.unit ? ' ' + p.series.options.userOptions.unit : '';
                           s += `<span style="color:${p.color}">\u25CF</span> ${p.series.name}: <b>${p.point.str}${unitStr}</b><br/>`; 
                       });
                       return s;
                   }
               },
               legend: {
                   itemStyle: { fontSize: '14px', fontWeight: 'normal' },
                   padding: 10,
                   itemMarginTop: 5,
                   itemMarginBottom: 5
               },
               series: series
           });
        }

        // ── 7. QA/QC CHARTS ──────────────────────────────────────────────
        $('#btn-qa-qc').on('click', function() {
            const selectedRows = table.getSelectedRows();
            if (selectedRows.length === 0) {
                return Swal.fire({ icon: 'warning', text: 'Seleccione al menos un registro en la tabla para generar los gráficos QA/QC.' });
            }
            const data = selectedRows.map(row => row.getData());
            $('#modalQAQC').modal('show');
            setTimeout(() => {
                renderQCCharts(data);
            }, 400); 
        });

        function renderQCCharts(data) {
             // ── Helper: parse numeric from cell value ──
             const pn = (v) => { let s = String(v||'').replace(',','.').replace(/[<>]/g,''); return parseFloat(s); };
             const fmt = (v, d) => { if (isNaN(v)) return '―'; return v.toLocaleString('es-CL', {minimumFractionDigits: d, maximumFractionDigits: d}); };

             // ── Build raw arrays for charts AND tables ──

              const pointsCond = [], pointsPH = [], pointsSDT = [];
              const rowsCond = [], rowsPH = [], rowsSDT = [];

             data.forEach(item => {
                 const est = item.estacion || 'S/E';
                 const cert = item.certificado || '';
                 const fecha = item.fecha || '';

                 // ── CE ──
                 let cLab = pn(item.parametro_26), cTerr = pn(item.parametro_27);
                 if (!isNaN(cLab) && !isNaN(cTerr) && cLab !== 0) {
                     let cociente = cTerr / cLab;
                     let diff = Math.abs(cLab - cTerr) / cTerr;
                     let isOK = diff <= 0.10;
                     pointsCond.push({ x: cTerr, y: cLab, isOK, cert, est });
                     rowsCond.push({ certificado: cert, estacion: est, fecha, ce_terreno: cTerr, ce_lab: cLab, cociente, isOK });
                 }

                 // ── pH ──
                 let pLab = pn(item.parametro_65), pTerr = pn(item.parametro_66);
                 if (!isNaN(pLab) && !isNaN(pTerr) && pLab !== 0) {
                     let cociente = pTerr / pLab;
                     let dif = Math.abs(pLab - pTerr);
                     let isOK = dif <= 0.5;
                     pointsPH.push({ x: pTerr, y: pLab, isOK, cert, est });
                     rowsPH.push({ certificado: cert, estacion: est, fecha, ph_terreno: pTerr, ph_lab: pLab, cociente, dif, isOK });
                 }

                 // ── SDT ──
                 let sdtVal = pn(item.parametro_14), cl = pn(item.parametro_26);
                 if (!isNaN(sdtVal) && !isNaN(cl) && cl !== 0) {
                     let cociente = sdtVal / cl;
                     let isOK = cociente >= 0.55 && cociente <= 0.9;
                     pointsSDT.push({ x: cl, y: sdtVal, isOK, cert, est });
                     rowsSDT.push({ certificado: cert, estacion: est, fecha, sdt_val: sdtVal, ce_lab: cl, cociente, isOK });
                 }
             });

             // ── Update tab badges ──
             $('#badge-qc-cond').text(rowsCond.length);
             $('#badge-qc-ph').text(rowsPH.length);
             $('#badge-qc-sdt').text(rowsSDT.length);

             // ── Chart colors & helpers ──
             const colorOK = 'rgba(52, 152, 219, 0.65)';
             const colorFuera = 'rgba(231, 76, 60, 0.65)';

             const makeSeries = (pts) => [
                 { name: 'OK', color: colorOK, data: pts.filter(p=>p.isOK).map(p=>({x:p.x, y:p.y, cert:p.cert, est:p.est})), marker: {symbol:'circle', radius: 6} },
                 { name: 'Fuera de Rango', color: colorFuera, data: pts.filter(p=>!p.isOK).map(p=>({x:p.x, y:p.y, cert:p.cert, est:p.est})), marker: {symbol:'circle', radius: 6} }
             ];

             const common = {
                 chart: { type: 'scatter', zoomType: 'xy', style: { fontFamily: 'inherit' } },
                 credits: { enabled: false },
                 legend: { itemStyle: { fontWeight: '600', fontSize: '13px' } },
                 xAxis: { labels: { style: { fontSize: '12px', color: '#444' } }, title: { style: { fontSize: '14px', fontWeight: '700', color: '#333' } }, gridLineWidth: 1 },
                 yAxis: { labels: { style: { fontSize: '12px', color: '#444' } }, title: { style: { fontSize: '14px', fontWeight: '700', color: '#333' } } }
             };

             const makeTooltip = (fields) => ({
                 useHTML: true,
                 formatter: function() {
                     const p = this.point;
                     return fields.map(f => f(p)).join('<br/>');
                 }
             });

             // ── Axis maxes ──
             const maxCond = Math.max(...pointsCond.flatMap(p => [p.x, p.y]), 1000) * 1.1;
             const maxPH = 14;
             const maxSDT_X = Math.max(...pointsSDT.map(p => p.x), 1000) * 1.1;
             const maxSDT_Y = Math.max(...pointsSDT.map(p => p.y), 1000) * 1.1;

             // ═══════════════ CHART: CE ═══════════════
             Highcharts.chart('chart-qc-cond', {
                 ...common,
                 title: { text: 'CE Laboratorio vs CE Terreno', align: 'left', style:{fontSize:'18px', fontWeight:'800'} },
                 tooltip: makeTooltip([
                     p => '<b>Estación: ' + (p.options.est||'S/E') + '</b>',
                     p => 'Certificado: ' + (p.options.cert||''),
                     p => 'CE Terreno: <b>' + Highcharts.numberFormat(p.x,2) + '</b>',
                     p => 'CE Laboratorio: <b>' + Highcharts.numberFormat(p.y,2) + '</b>'
                 ]),
                 xAxis: { ...common.xAxis, title: { text: 'CE Terreno (µS/cm, 25°C)' }, min: 0, max: maxCond },
                 yAxis: { ...common.yAxis, title: { text: 'CE Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxCond },
                 series: [
                     ...makeSeries(pointsCond),
                     { type:'line', name:'Recta m=1', data:[[0,0],[maxCond,maxCond]], color:'#333', dashStyle:'Solid', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', name:'±10%', data:[[0,0],[maxCond,maxCond*1.1]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', data:[[0,0],[maxCond,maxCond*0.9]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false, showInLegend:false },
                     { type:'line', name:'±20%', data:[[0,0],[maxCond,maxCond*1.2]], color:'#27ae60', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', data:[[0,0],[maxCond,maxCond*0.8]], color:'#27ae60', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false, showInLegend:false }
                 ]
             });

             // ═══════════════ CHART: pH ═══════════════
             Highcharts.chart('chart-qc-ph', {
                 ...common,
                 title: { text: 'pH Laboratorio vs pH Terreno', align: 'left', style:{fontSize:'18px', fontWeight:'800'} },
                 tooltip: makeTooltip([
                     p => '<b>Estación: ' + (p.options.est||'S/E') + '</b>',
                     p => 'Certificado: ' + (p.options.cert||''),
                     p => 'pH Terreno: <b>' + Highcharts.numberFormat(p.x,2) + '</b>',
                     p => 'pH Laboratorio: <b>' + Highcharts.numberFormat(p.y,2) + '</b>'
                 ]),
                 xAxis: { ...common.xAxis, title: { text: 'pH Terreno (u.pH)' }, min: 0, max: maxPH },
                 yAxis: { ...common.yAxis, title: { text: 'pH Laboratorio (u.pH)' }, min: 0, max: maxPH },
                 series: [
                     ...makeSeries(pointsPH),
                     { type:'line', name:'m = 1', data:[[0,0],[maxPH,maxPH]], color:'#333', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', name:'±0.5 u pH', data:[[0,0.5],[maxPH-0.5,maxPH]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', data:[[0.5,0],[maxPH,maxPH-0.5]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false, showInLegend:false }
                 ]
             });

             // ═══════════════ CHART: SDT ═══════════════
             Highcharts.chart('chart-qc-sdt', {
                 ...common,
                 title: { text: 'SDT vs Conductividad Laboratorio', align: 'left', style:{fontSize:'18px', fontWeight:'800'} },
                 tooltip: makeTooltip([
                     p => '<b>Estación: ' + (p.options.est||'S/E') + '</b>',
                     p => 'Certificado: ' + (p.options.cert||''),
                     p => 'Cond. Lab: <b>' + Highcharts.numberFormat(p.x,2) + '</b>',
                     p => 'SDT: <b>' + Highcharts.numberFormat(p.y,2) + '</b>'
                 ]),
                 xAxis: { ...common.xAxis, title: { text: 'Conductividad Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxSDT_X },
                 yAxis: { ...common.yAxis, title: { text: 'SDT (mg/L)' }, min: 0, max: maxSDT_Y },
                 series: [
                     ...makeSeries(pointsSDT),
                     { type:'line', name:'m = 0.7', data:[[0,0],[maxSDT_X,maxSDT_X*0.7]], color:'#3498db', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', name:'m = 0.9', data:[[0,0],[maxSDT_X,maxSDT_X*0.9]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false },
                     { type:'line', name:'m = 0.55', data:[[0,0],[maxSDT_X,maxSDT_X*0.55]], color:'#e74c3c', dashStyle:'Dash', marker:{enabled:false}, enableMouseTracking:false }
                 ]
             });

             // ── QC Result formatter (shared) ──
             const resultFormatter = (cell) => {
                 const v = cell.getValue();
                 if (v === true)  return '<span class="qc-result-ok">OK <i class="fa fa-check-circle"></i> <i class="fa fa-lock" style="color:#2980b9"></i></span>';
                 if (v === false) return '<span class="qc-result-no">NO <i class="fa fa-times-circle"></i> <i class="fa fa-lock" style="color:#2980b9"></i></span>';
                 return '―';
             };
             const numFmt = (decimals) => (cell) => { let v = cell.getValue(); return (v !== null && v !== undefined && !isNaN(v)) ? fmt(v, decimals) : '―'; };

             // ═══════════════ TABLE: CE ═══════════════
             new Tabulator('#table-qc-cond', {
                 data: rowsCond,
                 layout: 'fitColumns',
                 height: '360px',
                 placeholder: 'Sin datos de Conductividad',
                 pagination: 'local',
                 paginationSize: 20,
                 paginationSizeSelector: [10, 20, 50],
                 paginationCounter: 'rows',
                 initialSort: [{ column: 'certificado', dir: 'asc' }],
                 selectableRows: true,
                 columns: [
                     { formatter:'rowSelection', titleFormatter:'rowSelection', hozAlign:'center', headerSort:false, width:40 },
                     { title:'CERTIFICADO', field:'certificado', sorter:'string', headerFilter:'input', hozAlign:'center', headerHozAlign:'center' },
                     { title:'ESTACIÓN', field:'estacion', sorter:'string', hozAlign:'center', headerHozAlign:'center' },
                     { title:'FECHA', field:'fecha', sorter:'date', hozAlign:'center', headerHozAlign:'center' },
                     { title:'CE TERRENO', field:'ce_terreno', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(0) },
                     { title:'CE LAB', field:'ce_lab', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(0) },
                     { title:'COCIENTE', field:'cociente', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(2) }
                 ]
             });

             // ═══════════════ TABLE: pH ═══════════════
             new Tabulator('#table-qc-ph', {
                 data: rowsPH,
                 layout: 'fitColumns',
                 height: '360px',
                 placeholder: 'Sin datos de pH',
                 pagination: 'local',
                 paginationSize: 20,
                 paginationSizeSelector: [10, 20, 50],
                 paginationCounter: 'rows',
                 initialSort: [{ column: 'certificado', dir: 'asc' }],
                 selectableRows: true,
                 columns: [
                     { formatter:'rowSelection', titleFormatter:'rowSelection', hozAlign:'center', headerSort:false, width:40 },
                     { title:'CERTIFICADO', field:'certificado', sorter:'string', headerFilter:'input', hozAlign:'center', headerHozAlign:'center' },
                     { title:'ESTACIÓN', field:'estacion', sorter:'string', hozAlign:'center', headerHozAlign:'center' },
                     { title:'FECHA', field:'fecha', sorter:'date', hozAlign:'center', headerHozAlign:'center' },
                     { title:'PH TERRENO', field:'ph_terreno', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(2) },
                     { title:'PH LAB', field:'ph_lab', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(2) },
                     { title:'COCIENTE', field:'cociente', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(2) },
                     { title:'DIF.', field:'dif', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(3) },
                     { title:'RESULTADO', field:'isOK', hozAlign:'center', headerHozAlign:'center', formatter: resultFormatter, width: 130 }
                 ]
             });

             // ═══════════════ TABLE: SDT ═══════════════
             new Tabulator('#table-qc-sdt', {
                 data: rowsSDT,
                 layout: 'fitColumns',
                 height: '360px',
                 placeholder: 'Sin datos de SDT',
                 pagination: 'local',
                 paginationSize: 20,
                 paginationSizeSelector: [10, 20, 50],
                 paginationCounter: 'rows',
                 initialSort: [{ column: 'certificado', dir: 'asc' }],
                 selectableRows: true,
                 columns: [
                     { formatter:'rowSelection', titleFormatter:'rowSelection', hozAlign:'center', headerSort:false, width:40 },
                     { title:'CERTIFICADO', field:'certificado', sorter:'string', headerFilter:'input', hozAlign:'center', headerHozAlign:'center' },
                     { title:'ESTACIÓN', field:'estacion', sorter:'string', hozAlign:'center', headerHozAlign:'center' },
                     { title:'FECHA', field:'fecha', sorter:'date', hozAlign:'center', headerHozAlign:'center' },
                     { title:'SDT', field:'sdt_val', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(0) },
                     { title:'CE LABORATORIO', field:'ce_lab', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(0) },
                     { title:'COCIENTE', field:'cociente', sorter:'number', hozAlign:'center', headerHozAlign:'center', formatter: numFmt(5) },
                     { title:'RESULTADO', field:'isOK', hozAlign:'center', headerHozAlign:'center', formatter: resultFormatter, width: 130 }
                 ]
             });

             // ── Redraw charts when switching tabs (Highcharts needs visible container) ──
             $('.qaqc-nav-tabs a[data-toggle="tab"]').off('shown.bs.tab').on('shown.bs.tab', function(e) {
                 const target = $(e.target).attr('href');
                 $(target).find('.highcharts-container').parent().each(function() {
                     const el = this;
                     const chart = Highcharts.charts.find(c => c && c.renderTo === el);
                     if (chart) chart.reflow();
                 });
             });
         }
    });
</script>
@endpush
