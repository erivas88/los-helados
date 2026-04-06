@extends('layouts.app')
@section('title', 'Visualización - Porto Admin')
@section('page_title', 'Visualización')
@section('content')
@include('partials.modules')
<!-- Main Row -->
<div class="row">
   <div class="col-md-12">
      <section class="panel">
         <header class="panel-heading">
            <h2 class="panel-title">Módulo de Visualización (Datos Aprobados)</h2>
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
            <h2 class="panel-title">Gráfico histórico (Datos Aprobados)</h2>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
<link href="https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">
<style>
   .filter-toolbar {
   background: #f8f9fa;
   padding: 10px 15px;
   border-radius: 4px;
   border: 1px solid #eee;
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
   font-family: inherit;
   }
   .tabulator-header {
   background-color: #f0f2f5 !important;
   color: #333 !important;
   border-bottom: 2px solid #dde1e5 !important;
   font-weight: 600 !important;
   }
   .tabulator-col, .tabulator-col-content {
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
   .cell-modified {
      background-color: #ffff00 !important;
      color: #000 !important;
      font-weight: bold;
   }
</style>
@endpush
@push('js')
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/highcharts@11/highcharts.js"></script>
<script>
   $(document).ready(function () {
    Highcharts.setOptions({
        lang: {
            thousandsSep: '.',
            decimalPoint: ','
        }
    });

    const estatusFormatter = function(cell) {
           return `<button class="btn-status-1" title="Aprobado JP"><i class="fa fa-lock"></i></button>`;
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

       let table;
       $.get('{{ url("/api/visualizacion/columns") }}', function (columns) {
           columns.forEach(col => {
               if (col.field === 'estatus') col.formatter = estatusFormatter;
               if (col.formatter === 'paramModifiedFormatter') col.formatter = window.paramModifiedFormatter;
           });

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
                  $('#filtro-parametros-chart').append($('<option>', { value: p.id_parametro, text: p.nombre }));
             });
             $('.selectpicker').selectpicker('refresh');
        });

       $('#btn-filtrar').on('click', function () {
            let stations = $('#filtro-estaciones').val(), months = $('#filtro-meses').val(), years = $('#filtro-anios').val();
            if (!stations || !months || !years) return Swal.fire('Aviso', 'Seleccione filtros.', 'warning');
            let params = { stations, months, years, indicador: [ $('#filtro-indicador').val() || "1" ] };
            fetch("{{ url('/api/visualizacion/filtrar') }}", {
                method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify(params)
            }).then(res => res.json()).then(data => table.setData(data));
       });

       $('#btn-graficar').on('click', function() {
           let stations = $('#filtro-estaciones-chart').val(), parametros = $('#filtro-parametros-chart').val();
           if (!stations || !parametros) return Swal.fire('Aviso', 'Seleccione filtros.', 'warning');
           fetch("{{ url('/api/visualizacion/chart-data') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify({ stations, parametros, indicador: $('#filtro-indicador-chart').val() })
           }).then(res => res.json()).then(data => renderHistoricalChart(data));
       });

       function renderHistoricalChart(data) {
           const series = [];
           if (!data.raw || data.raw.length === 0) return;

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
                   text: 'Gráfico histórico (Datos Aprobados)',
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
   });
</script>
@endpush
