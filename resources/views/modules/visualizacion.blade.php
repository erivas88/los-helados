@extends('layouts.app')
@section('title', 'Visualización')
@section('page_title', 'Visualización')
@section('content')
   @include('partials.modules')
   <!-- Intro Banner -->
   <div class="row" style="margin-bottom: 25px;">
      <div class="col-md-12">
         <div
            style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #28a745; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
               <div>
                  <h2
                     style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                     <i class="fa fa-eye" style="color: #28a745;"></i> Visualización de Datos
                  </h2>
                  <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                    Consulte y descargue datos analíticos verificados y validados con control de calidad
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Main Row -->
   <div class="row" style="display: none">
      <div class="col-md-12">
         <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div class="panel-body" style="padding: 25px;">
               <!-- Filter Toolbar -->
               <div class="filter-toolbar" style="margin-bottom: 20px;">
                  <div class="flex-toolbar-container">
                     <!-- Depósito -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                        <select id="select-sector" class="form-control selectpicker" data-live-search="true"
                           data-width="100%">
                           <!-- Dynamic -->
                        </select>
                     </div>
                     <!-- Estaciones -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                        <select multiple id="filtro-estaciones" class="form-control selectpicker" title="Estaciones"
                           data-size="5" data-live-search="true" data-width="100%" data-dropup-auto="false"
                           data-selected-text-format="count" data-count-selected-text=" ({0}) Estaciones "
                           data-actions-box="true" data-select-all-text="Todos" data-deselect-all-text="Ninguno">
                        </select>
                     </div>
                     <!-- Mes -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar text-success"></i> MES</label>
                        <select multiple id="filtro-meses" class="form-control selectpicker" title="Seleccionar Meses"
                           data-size="5" data-width="100%" data-actions-box="true" data-select-all-text="Todos"
                           data-deselect-all-text="Ninguno" data-selected-text-format="count > 1"
                           data-count-selected-text="({0}) Meses">
                        </select>
                     </div>
                     <!-- Año -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar-alt text-success"></i> AÑO</label>
                        <select multiple id="filtro-anios" class="form-control selectpicker" title="Años" data-size="5"
                           data-width="100%" data-actions-box="true" data-select-all-text="Todos"
                           data-deselect-all-text="Ninguno" data-selected-text-format="count > 1"
                           data-count-selected-text="({0}) Años">
                        </select>
                     </div>
                     <!-- Indicador -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-check-circle text-success"></i> INDICADOR</label>
                        <select id="filtro-indicador" class="form-control selectpicker" data-size="5"
                           data-live-search="true" data-width="100%">
                           <!-- Dynamic -->
                        </select>
                     </div>
                     <!-- Buttons as equal items -->
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <button type="button" id="btn-filtrar" class="btn btn-success filter-btn btn-block"
                           style="background-color: #28a745; border-color: #28a745; font-family: 'Outfit', sans-serif; font-weight: 600;">
                           <i class="fa fa-search mr-1"></i> &nbsp; Consultar
                        </button>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <button type="button" id="btn-export-xlsx" class="btn btn-default filter-btn btn-block"
                           style="background-color: #fff; border: 1px solid #E5E7E9; font-family: 'Outfit', sans-serif; font-weight: 600;">
                           <i class="fa fa-file-excel-o text-success mr-1"></i> &nbsp; Exportar
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
   <!-- Historical Chart Row -->
   <div class="row">
      <div class="col-md-12">
         <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div class="panel-body" style="padding: 25px;">
               <h3
                  style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #2c3e50; margin-bottom: 20px; border-bottom: 2px solid #f1f4f9; padding-bottom: 10px;">
                  <i class="fa fa-line-chart text-success"></i> Gráficos Analíticos
               </h3>
               <!-- Filter Toolbar for Chart -->
               <div class="filter-toolbar" style="margin-bottom: 20px;">
                  <div class="flex-toolbar-container">
                     <!-- Sector -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                        <select id="select-sector-chart" class="form-control selectpicker" data-live-search="true"
                           data-width="100%">
                           <!-- Dynamic -->
                        </select>
                     </div>
                     <!-- Estaciones -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                        <select multiple id="filtro-estaciones-chart" class="form-control selectpicker" title="Estaciones"
                           data-size="5" data-live-search="true" data-width="100%" data-dropup-auto="false"
                           data-selected-text-format="count" data-count-selected-text=" ({0}) Estaciones "
                           data-actions-box="true" data-select-all-text="Todos" data-deselect-all-text="Ninguno">
                        </select>
                     </div>
                     <!-- Parámetros -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-flask text-success"></i> PARÁMETROS</label>
                        <select multiple id="filtro-parametros-chart" class="form-control selectpicker"
                           title="Seleccionar Parámetros" data-live-search="true" data-width="100%" data-size="5"
                           data-actions-box="true" data-select-all-text="Todos" data-deselect-all-text="Ninguno"
                           data-selected-text-format="count > 1" data-count-selected-text="({0}) Parámetros">
                        </select>
                     </div>
                     <!-- Programas -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-tasks text-success"></i> PROGRAMAS</label>
                        <select multiple id="filtro-indicador-chart" class="form-control selectpicker"
                           data-live-search="true" data-width="100%">
                           <!-- Dynamic -->
                        </select>
                     </div>

                     <!-- Norma -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-balance-scale text-success"></i> NORMA</label>
                        <select multiple id="filtro-norma-chart" class="form-control selectpicker" data-live-search="true"
                           data-width="100%" title="Seleccionar normas" data-actions-box="true"
                           data-selected-text-format="count > 1" data-count-selected-text="({0}) normas">
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
@endsection
@push('css')
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
   <link href="https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">
   <style>
      .filter-toolbar {
         background: #ffffff;
         padding: 20px;
         border-radius: 8px;
         border: 1px solid #e2e8f0;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
         margin-bottom: 25px;
      }

      .flex-toolbar-container {
         display: flex;
         flex-direction: row;
         flex-wrap: nowrap;
         align-items: stretch;
         gap: 8px;
         width: 100%;
      }

      .filter-item {
         flex: 1 1 0;
         min-width: 0;
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

      #tabla-muestras {
         border: 1px solid #E5E7E9;
         margin-top: 15px;
         font-family: 'Inter', sans-serif;
         border-radius: 8px;
         overflow: hidden;
      }

      .tabulator-header {
         background-color: #f0f2f5 !important;
         color: #333 !important;
         border-bottom: 2px solid #dde1e5 !important;
         font-weight: 600 !important;
      }

      .tabulator-col,
      .tabulator-col-content {
         background-color: #f0f2f5 !important;
         border-right: 1px solid #dde1e5 !important;
      }

      .tabulator-cell {
         border-right: 1px solid #dde1e5 !important;
      }

      .tabulator-col-title {
         padding: 6px 8px !important;
         font-size: 13px !important;
         text-transform: none !important;
      }

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

      .tabulator-placeholder-contents {
         color: #999;
         font-style: italic;
         padding: 30px !important;
         background-color: #fff;
      }

      .tabulator-header-filter input {
         border: 1px solid #cbd2d9 !important;
         border-radius: 4px !important;
         padding: 4px 6px !important;
         font-size: 12px !important;
         background: #ffffff !important;
         color: #333 !important;
         width: 100%;
      }

      .btn-status-1 {
         padding: 4px 8px;
         font-size: 14px;
         line-height: 1;
         border-radius: 4px;
         background-color: #27ae60;
         color: #fff;
         border: 1px solid #2ecc71;
         display: inline-flex;
         align-items: center;
         justify-content: center;
      }

      /* Premium Dropdown Styling */
      .btn-group.btn-block .dropdown-menu {
         border-radius: 8px;
         box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
         border: 1px solid #eef2f7 !important;
         margin-top: 5px;
         padding: 8px 0;
         min-width: 160px;
      }

      .dropdown-menu li a {
         padding: 10px 20px !important;
         font-size: 13px !important;
         font-weight: 500 !important;
         transition: all 0.2s ease;
         display: flex;
         align-items: center;
      }

      .dropdown-menu li a i {
         width: 20px;
         margin-right: 10px;
         font-size: 15px;
      }

      .dropdown-menu li a:hover {
         background-color: #f1f4f9 !important;
         color: #28a745 !important;
      }

      @media (max-width: 992px) {
         .flex-toolbar-container {
            flex-wrap: wrap;
         }
         .filter-item {
            flex: 1 0 30%;
            margin-bottom: 10px;
         }
      }

      @media (max-width: 576px) {
         .filter-item {
            flex: 1 0 100%;
         }
      }


   </style>
@endpush
@push('js')
   <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js"></script>
   <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            }
         });

         const estatusFormatter = function (cell) {
            return `<button class="btn-status-1" title="Aprobado JP"><i class="fa fa-lock"></i></button>`;
         };

         window.paramModifiedFormatter = function (cell) {
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

            return val;
         };

         let table;
         $.get('{{ url("/api/visualizacion/columns") }}', function (columns) {
            columns.forEach(col => {
               if (col.field === 'estatus') {
                  col.formatter = estatusFormatter;
                  col.download = false;
               }
               if (col.formatter === 'paramModifiedFormatter') col.formatter = window.paramModifiedFormatter;

               if (col.title) {
                  let htmlTitle = col.title; 
                  let plainTitleWithUnits = htmlTitle.replace(/<[^>]*>/g, '').replace(/&lt;[^&gt;]*&gt;/g, '').trim();
                  
                  col.title = plainTitleWithUnits; // Primary title now has units (no HTML) for Excel
                  col.downloadTitle = plainTitleWithUnits; 
                  
                  col.titleFormatter = function(column) {
                     const div = document.createElement("div");
                     div.innerHTML = htmlTitle;
                     return div;
                  };
               }
            });

            // Ensure XLSX is globally available for Tabulator download module
            if (typeof XLSX !== 'undefined') window.XLSX = XLSX;

            table = new Tabulator("#tabla-muestras", {
               layout: "fitColumns",
               placeholder: "Sin datos disponibles",
               columns: columns,
               height: "500px",
               pagination: "local",
               paginationSize: 20,
               paginationSizeSelector: [10, 20, 50, 100],
               paginationCounter: "rows"
            });
         });

         $.get('{{ url("/api/visualizacion/filters") }}', function (data) {
            $.each(data.depositos, function (i, d) {
               $('#select-sector').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
               $('#select-sector-chart').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
            });
            $('#select-sector').val(1); $('#select-sector-chart').val(1);
            const heladosGroup = $('<optgroup>', { label: 'Los Helados' }), otrosGroup = $('<optgroup>', { label: 'Otras Estaciones' });
            $.each(data.estaciones, function (i, e) {
               const opt = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               if (parseInt(e.clasificacion) === 1) heladosGroup.append(opt); else otrosGroup.append(opt.clone());
            });
            const hgc = heladosGroup.clone(), ogc = otrosGroup.clone();
            $('#filtro-estaciones').append(heladosGroup, otrosGroup);
            $('#filtro-estaciones-chart').append(hgc, ogc);
            $.each(data.years, function (i, y) { $('#filtro-anios').append($('<option>', { value: y, text: y })); });
            $.each(data.meses, function (i, m) { $('#filtro-meses').append($('<option>', { value: m.id, text: m.nombre })); });
            $.each(data.programas, function (i, p) {
               $('#filtro-indicador').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
               $('#filtro-indicador-chart').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
            });
            $.each(data.parametros, function (i, p) {
               const normalized = window.normalizeText ? window.normalizeText(p.nombre) : p.nombre;
               $('#filtro-parametros-chart').append($('<option>', { value: p.id_parametro, text: p.nombre, 'data-tokens': normalized }));
            });

            $.each(data.normas || [], function (i, n) {
               $('#filtro-norma-chart').append($('<option>', { value: n.id_norma, text: n.nombre }));
            });
            $('.selectpicker').selectpicker('refresh');
         });

         $('#btn-filtrar').on('click', function () {
            let stations = $('#filtro-estaciones').val(), months = $('#filtro-meses').val(), years = $('#filtro-anios').val();
            if (!stations || !months || !years) return Swal.fire('Aviso', 'Seleccione filtros.', 'warning');
            let params = { stations, months, years, indicador: [$('#filtro-indicador').val() || "1"] };
            fetch("{{ url('/api/visualizacion/filtrar') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify(params)
            }).then(res => res.json()).then(data => table.setData(data));
         });

         // Export handler
         $('#btn-export-xlsx').on('click', function () {
            if (!table) return;
            table.download("xlsx", "datos_visualizacion.xlsx", { sheetName: "Datos" });
         });

         // State variables for chart
         let chartDataHist = [];
         let chartMetaHist = {};
         let chartNormaData = null;
         let currentHistoricalChart = null;

         $('#btn-graficar').on('click', function () {
            let stations = $('#filtro-estaciones-chart').val(),
               parametros = $('#filtro-parametros-chart').val(),
               indicador = $('#filtro-indicador-chart').val(),
               id_norma = $('#filtro-norma-chart').val() || [];

            if (!stations || !parametros) return Swal.fire('Aviso', 'Seleccione filtros.', 'warning');
            let $btn = $(this); $btn.prop('disabled', true).html('Graficando...');
            fetch("{{ url('/api/visualizacion/chart-data') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify({ stations, parametros, indicador, id_norma })
            }).then(res => res.json()).then(data => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
               chartDataHist = data.raw;
               chartMetaHist = data.parametros_info;
               chartNormaData = data.norma || null;
               renderHistoricalChart();
            }).catch(e => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
               Swal.fire('Error', 'No se pudieron recuperar los datos', 'error');
            });
         });

         function renderHistoricalChart() {
            if (!chartDataHist || chartDataHist.length === 0) return;
            
            const axisFontSize = '13px';
            const legendFontSize = '13px';
            const series = [], yAxes = [];
            const pIDs = Object.keys(chartMetaHist);
            // Default useDual to true if >1 parameters are selected so we get separate axes
            const useDual = pIDs.length > 1;

            pIDs.forEach((pID, idx) => {
               const stationsInRaw = [...new Set(chartDataHist.map(item => item.estacion))];
               let allDataValues = [];

               stationsInRaw.forEach((stName, sIdx) => {
                  const points = chartDataHist
                     .filter(item => item.estacion === stName)
                     .map(item => {
                        const d = item.fecha_label.split('-');
                        let rawVal = String(item['parametro_' + pID] || '').replace(',', '.');
                        let cleanVal = parseFloat(rawVal.replace('<', '').replace('>', ''));
                        if (!isNaN(cleanVal)) {
                           allDataValues.push(cleanVal);
                        }
                        return { x: Date.UTC(d[0], d[1] - 1, d[2]), y: cleanVal, str: item['parametro_' + pID] };
                     })
                     .filter(p => !isNaN(p.y))
                     .sort((a, b) => a.x - b.x);

                  if (points.length > 0) {
                     series.push({
                        name: `${chartMetaHist[pID].nombre_largo} [${stName}]`,
                        data: points,
                        yAxis: (useDual && idx > 0) ? 1 : 0,
                        type: 'line',
                        marker: {
                           enabled: true,
                           radius: 5,
                           fillColor: 'white',
                           lineColor: null,
                           lineWidth: 2
                        },
                        userOptions: { unit: chartMetaHist[pID].unidad }
                     });
                  }
               });

               if (idx === 0 || (useDual && idx === 1)) {
                  const normaRanges = chartNormaData?.ranges || {};
                  const paramRanges = normaRanges[pID] || [];
                  const plotLines = [];
                  const unit = chartMetaHist[pID].unidad ? ' ' + chartMetaHist[pID].unidad : '';

                  const normaValues = [];
                  paramRanges.forEach((range) => {
                     if (range.max !== null && range.max !== undefined) {
                        const value = Number(range.max);
                        if (!isNaN(value)) {
                           normaValues.push(value);
                           plotLines.push({
                              id: `norma-${range.id_norma}-${pID}-max`,
                              value,
                              color: '#e74c3c',
                              dashStyle: 'ShortDash',
                              width: 2,
                              zIndex: 5,
                              label: {
                                 text: `Máx ${range.nombre}: ${range.max}${unit}`,
                                 align: 'right',
                                 x: -4,
                                 style: { color: '#e74c3c', fontWeight: 'bold', fontSize: '11px' }
                              }
                           });
                        }
                     }

                     if (range.min !== null && range.min !== undefined) {
                        const value = Number(range.min);
                        if (!isNaN(value)) {
                           normaValues.push(value);
                           plotLines.push({
                              id: `norma-${range.id_norma}-${pID}-min`,
                              value,
                              color: '#2980b9',
                              dashStyle: 'ShortDash',
                              width: 2,
                              zIndex: 5,
                              label: {
                                 text: `Mín ${range.nombre}: ${range.min}${unit}`,
                                 align: 'right',
                                 x: -4,
                                 style: { color: '#2980b9', fontWeight: 'bold', fontSize: '11px' }
                              }
                           });
                        }
                     }
                  });

                  let axisSoftMin = undefined;
                  let axisSoftMax = undefined;
                  const allValues = [...allDataValues, ...normaValues].filter(v => !isNaN(v) && isFinite(v));
                  if (allValues.length > 0) {
                     const vMin = Math.min(...allValues);
                     const vMax = Math.max(...allValues);
                     const rng = vMax - vMin;
                     const pad = rng > 0 ? rng * 0.12 : Math.max(Math.abs(vMax) * 0.1, 1);
                     axisSoftMin = vMin - pad;
                     axisSoftMax = vMax + pad;
                  }

                  yAxes.push({
                     title: {
                        text: chartMetaHist[pID].nombre_largo + ' [' + chartMetaHist[pID].unidad + ']',
                        style: { color: idx === 0 ? '#337ab7' : '#5cb85c', fontWeight: 'bold', fontSize: axisFontSize }
                     },
                     gridLineColor: '#f3f3f3',
                     labels: { style: { fontSize: axisFontSize, color: '#666' } },
                     opposite: idx === 1,
                     plotLines: plotLines.length ? plotLines : undefined,
                     softMin: axisSoftMin,
                     softMax: axisSoftMax
                  });
               }
            });

            if (currentHistoricalChart) {
               currentHistoricalChart.destroy();
            }

            currentHistoricalChart = Highcharts.chart('chart-historico', {
               title: {
                  text: 'Histórico de Parámetros',
                  style: { fontSize: '18px', fontWeight: 'bold' }
               },
               subtitle: {
                  text: chartNormaData?.nombres ? 'Normas activas: ' + Object.values(chartNormaData.nombres).join(', ') : null
               },
               xAxis: {
                  type: 'datetime',
                  labels: { style: { fontSize: axisFontSize, color: '#333' } }
               },
               yAxis: yAxes,
               tooltip: {
                  shared: true,
                  useHTML: true,
                  style: { fontSize: '14px' },
                  formatter: function () {
                     let s = `<span style="font-size: 14px; font-weight: bold;">${Highcharts.dateFormat('%Y-%m-%d', this.x)}</span><br/>`;
                     this.points.forEach(p => {
                        let unitStr = p.series.options.userOptions && p.series.options.userOptions.unit ? ' ' + p.series.options.userOptions.unit : '';
                        s += `<span style="color:${p.color}">\u25CF</span> ${p.series.name}: <b>${p.point.str}${unitStr}</b><br/>`;
                     });
                     return s;
                  }
               },
               legend: { enabled: true, itemStyle: { fontSize: legendFontSize, fontWeight: 'normal' } },
               credits: { enabled: false },
               exporting: {
                  enabled: true,
                  buttons: {
                     contextButton: {
                        menuItems: ['downloadPNG', 'downloadJPEG', 'downloadPDF', 'separator', 'downloadCSV', 'downloadXLS']
                     }
                  }
               },
               series: series
            });
         }

      });
   </script>
@endpush