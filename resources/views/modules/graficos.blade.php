@extends('layouts.app')
@section('title', 'Gráficos - Plataforma de Seguimiento Ambiental')
@section('page_title', 'Gráficos')

@section('content')
    @include('partials.modules')

    <!-- Main Row -->
    <div class="row">
        <div class="col-md-12">
            <!-- Intro Banner -->
            <div class="row" style="margin-bottom: 25px;">
                <div class="col-md-12">
                    <div
                        style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #17a2b8; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div>
                                <h2
                                    style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                                    <i class="fa fa-signal" style="color: #17a2b8;"></i> Gráficos
                                </h2>
                                <p
                                    style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                                        Visualice series históricas por estación y parámetro, con ejes y normas de referencia
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Row -->
            <div class="row">
                <div class="col-md-12">
                    <section class="panel"
                        style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                        <div class="panel-body" style="padding: 25px;">

                            <!-- Filter Toolbar (Sync with Control Calidad) -->
                            <div class="filter-toolbar mb-4">
                                <div class="flex-toolbar-container">
                                    <!-- Sector -->
                                    <div class="filter-item">
                                        <label class="filter-label"><i class="fa fa-industry text-success"></i>
                                            SECTOR</label>
                                        <select id="select-sector" class="form-control selectpicker" data-live-search="true"
                                            data-width="100%"></select>
                                    </div>
                                    <!-- Estaciones -->
                                    <div class="filter-item">
                                        <label class="filter-label"><i class="fa fa-map-marker text-success"></i>
                                            ESTACIONES</label>
                                        <select multiple id="filtro-estaciones" class="form-control selectpicker"
                                            title="Estaciones" data-size="5" data-live-search="true" data-width="100%"
                                            data-actions-box="true"></select>
                                    </div>
                                    <!-- Parámetros -->
                                    <div class="filter-item">
                                        <label class="filter-label"><i class="fa fa-flask text-success"></i>
                                            PARÁMETROS</label>
                                        <select multiple id="filtro-parametros" class="form-control selectpicker"
                                            title="Seleccionar Parámetros" data-live-search="true" data-width="100%"
                                            data-size="5" data-actions-box="true"></select>
                                    </div>
                                    <!-- Programas -->
                                    <div class="filter-item">
                                        <label class="filter-label"><i class="fa fa-tasks text-success"></i>
                                            PROGRAMAS</label>
                                        <select multiple id="filtro-programas" class="form-control selectpicker"
                                            data-live-search="true" data-width="100%"></select>
                                    </div>

                                    <!-- Normas -->
                                    <div class="filter-item">
                                        <label class="filter-label"><i class="fa fa-balance-scale text-success"></i>
                                            NORMAS</label>
                                        <select multiple id="filtro-normas" class="form-control selectpicker"
                                            data-live-search="true" data-width="100%" title="Seleccionar Normas"
                                            data-actions-box="true" data-selected-text-format="count > 1"
                                            data-count-selected-text="({0}) Normas"></select>
                                    </div>
                                    <!-- Graficar Button -->
                                    <div class="filter-item">
                                        <label class="filter-label">&nbsp;</label>
                                        <button type="button" id="btn-graficar" class="btn btn-info filter-btn btn-block"
                                            style="background-color: #17a2b8; border-color: #17a2b8; font-family: 'Outfit', sans-serif; font-weight: 600; color: white;">
                                            <i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar
                                        </button>
                                    </div>
                                    <!-- Config Button -->
                                    <div class="filter-item">
                                        <label class="filter-label">&nbsp;</label>
                                        <button type="button" class="btn btn-default filter-btn btn-block"
                                            data-toggle="modal" data-target="#modalConfiguracion"
                                            style="font-family: 'Outfit', sans-serif; font-weight: 600;">
                                            <i class="fa fa-cog text-primary mr-1"></i> &nbsp; Configuración
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Container -->
                            <div id="chart-container-wrapper"
                                style="background: #fff; border: 1px solid #E5E7E9; border-radius: 4px; padding: 15px;">
                                <div id="main-chart" style="height: 550px; width: 100%;">
                                    <div class="text-center" style="padding-top: 200px; color: #999;">
                                        <i class="fa fa-line-chart fa-5x" style="opacity: 0.2; margin-bottom: 20px;"></i>
                                        <h4>Seleccione estaciones y parámetros para visualizar el histórico.</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>

            <!-- Modal de Configuración -->
            <div class="modal fade" id="modalConfiguracion" tabindex="-1" role="dialog" aria-labelledby="modalConfigLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content"
                        style="border-radius: 8px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
                        <div class="modal-header"
                            style="background: #f8f9fa; border-bottom: 1px solid #eee; border-radius: 8px 8px 0 0;">
                            <h4 class="modal-title" id="modalConfigLabel"
                                style="font-weight: 700; color: #333; font-family: 'Outfit', sans-serif;">
                                <i class="fa fa-sliders text-primary mr-2"></i> Ajustes de Visualización Avanzada
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                                style="margin-top: -25px;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 25px;">

                            <div class="row">
                                <!-- Ejes -->
                                <div class="col-md-6">
                                    <h5
                                        style="font-weight: 700; color: #555; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 8px;">
                                        <i class="fa fa-arrows-v mr-2"></i> Configuración de Ejes Y
                                    </h5>

                                    <!-- Toggle Dual Axis (Professional Switch) -->
                                    <div class="form-group mb-3"
                                        style="background: #f0f7ff; padding: 12px; border-radius: 6px; border: 1px solid #d0e7ff;">
                                        <label class="switch-container d-flex align-items-center justify-content-between"
                                            style="cursor:pointer; width: 100%;">
                                            <span
                                                style="font-weight: 700; color: #0056b3; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px;">Eje
                                                Secundario (Dual)</span>
                                            <div class="switch">
                                                <input type="checkbox" id="cfg-use-dual-axis">
                                                <span class="slider round"></span>
                                            </div>
                                        </label>
                                        <p class="text-muted mb-0" style="font-size: 9px; margin-top: 5px;">Habilite esta
                                            opción para graficar parámetros en escalas diferentes (Y1 e Y2).</p>
                                    </div>

                                    <div id="axes-config-container">
                                        <p class="text-muted small">Cargue datos para habilitar los ajustes de ejes.</p>
                                    </div>
                                </div>

                                <!-- Series -->
                                <div class="col-md-6">
                                    <h5
                                        style="font-weight: 700; color: #555; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 8px;">
                                        <i class="fa fa-paint-brush mr-2"></i> Personalización de Series
                                    </h5>
                                    <div id="series-config-container" style="max-height: 400px; overflow-y: auto;">
                                        <p class="text-muted small">Cargue datos para habilitar los ajustes de series.</p>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-light">

                            <div class="row">
                                <div class="col-md-12">
                                    <h5
                                        style="font-weight: 700; color: #555; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; margin-bottom: 15px;">
                                        <i class="fa fa-font mr-2"></i> Títulos del Reporte
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small font-weight-bold text-muted">Título Principal</label>
                                                <input type="text" id="cfg-chart-title" class="form-control input-sm"
                                                    placeholder="Ej: Análisis Histórico - Sector Los Helados">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small font-weight-bold text-muted">Etiqueta Eje X</label>
                                                <input type="text" id="cfg-xaxis-title" class="form-control input-sm"
                                                    placeholder="Ej: Fecha de muestreo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer"
                            style="background: #f8f9fa; border-top: 1px solid #eee; border-radius: 0 0 8px 8px;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btn-apply-general" class="btn btn-primary">Guardar
                                Cambios</button>
                        </div>
                    </div>
                </div>
            </div>

@endsection

        @push('css')
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
            <style>
                /* SYNC WITH CONTROL CALIDAD STYLE */
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
                    font-family: 'Inter', sans-serif !important;
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
                    border-radius: 4px !important;
                }

                /* MODAL CONFIG STYLING */
                .cfg-group-card {
                    background: #fff;
                    border: 1px solid #f0f0f0;
                    padding: 15px;
                    border-radius: 6px;
                    margin-bottom: 15px;
                }

                .cfg-label-mini {
                    font-size: 9px;
                    font-weight: 700;
                    color: #999;
                    text-transform: uppercase;
                    margin-bottom: 4px;
                    display: block;
                }

                .cfg-input-sm {
                    height: 28px !important;
                    font-size: 11px !important;
                    border-radius: 4px !important;
                }

                .btn-inv {
                    background: #f0f3f5;
                    border: 1px solid #dce1e5;
                    color: #7d8bb2;
                    font-size: 10px;
                    font-weight: 700;
                    padding: 5px 10px;
                    border-radius: 4px;
                    cursor: pointer;
                    width: 100%;
                    text-align: center;
                    transition: all 0.2s;
                }

                .btn-inv.active {
                    background: #5bc0de;
                    border-color: #46b8da;
                    color: #fff;
                }

                .color-preview {
                    width: 100%;
                    height: 28px;
                    border-radius: 4px;
                    border: 1px solid #ddd;
                    cursor: pointer;
                    position: relative;
                }

                .color-preview input {
                    position: absolute;
                    opacity: 0;
                    width: 100%;
                    height: 100%;
                    cursor: pointer;
                }

                /* Fix fonts */
                body {
                    font-family: 'Inter', sans-serif !important;
                }

                /* SWITCH STYLING */
                .switch {
                    position: relative;
                    display: inline-block;
                    width: 34px;
                    height: 18px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    transition: .4s;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 14px;
                    width: 14px;
                    left: 2px;
                    bottom: 2px;
                    background-color: white;
                    transition: .4s;
                }

                input:checked+.slider {
                    background-color: #2196F3;
                }

                input:focus+.slider {
                    box-shadow: 0 0 1px #2196F3;
                }

                input:checked+.slider:before {
                    transform: translateX(16px);
                }

                .slider.round {
                    border-radius: 18px;
                }

                .slider.round:before {
                    border-radius: 50%;
                }

                h2,
                h4,
                h5 {
                    font-family: 'Outfit', sans-serif !important;
                }
            </style>
        @endpush

        @push('js')
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/highcharts@11/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
                $(document).ready(function () {
                    let currentChart = null;
                    let chartData = null;
                    let chartMeta = null;
                    let chartNormaData = null;

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

                    // Initial Filters Data
                    $.get('{{ url("/api/visualizacion/filters") }}', function (data) {
                        $.each(data.depositos, (i, d) => $('#select-sector').append($('<option>', { value: d.id_depositos, text: d.descripcion })));
                        $('#select-sector').val(1);
                        $.each(data.estaciones, (i, e) => $('#filtro-estaciones').append($('<option>', { value: e.id_estacion, text: e.nombre_estacion })));
                        $.each(data.parametros, (i, p) => {
                            const normalized = window.normalizeText ? window.normalizeText(p.nombre) : p.nombre;
                            $('#filtro-parametros').append($('<option>', { value: p.id_parametro, text: p.nombre, 'data-tokens': normalized }));
                        });
                        $.each(data.programas, (i, p) => $('#filtro-programas').append($('<option>', { value: p.id_programa, text: p.nombre_serie })));

                        $.each(data.normas || [], (i, n) => $('#filtro-normas').append($('<option>', { value: n.id_norma, text: n.nombre })));
                        $('.selectpicker').selectpicker('refresh');
                    });

                    $('#btn-graficar').on('click', function () {
                        let stations = $('#filtro-estaciones').val(), parameters = $('#filtro-parametros').val();
                        if (!stations || !parameters) return Swal.fire('Aviso', 'Seleccione estaciones y parámetros.', 'warning');

                        Swal.fire({ title: 'Generando análisis...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

                        fetch("{{ url('/api/visualizacion/chart-data') }}", {
                            method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                            body: JSON.stringify({
                                stations,
                                parametros: parameters,
                                indicador: $('#filtro-programas').val(),
                                id_norma: $('#filtro-normas').val() || []
                            })
                        }).then(res => res.json()).then(data => {
                            Swal.close();
                            chartData = data.raw;
                            chartMeta = data.parametros_info;
                            chartNormaData = data.norma || null;
                            renderChart();
                            buildModalConfig();
                        });
                    });
                    function renderChart() {
                        if (!chartData || chartData.length === 0) return;
                        const series = [], yAxes = [];
                        const pIDs = Object.keys(chartMeta);
                        const useDual = $('#cfg-use-dual-axis').is(':checked');

                        pIDs.forEach((pID, idx) => {
                            const stationsInRaw = [...new Set(chartData.map(item => item.estacion))];
                            let allDataValues = [];

                            stationsInRaw.forEach((stName, sIdx) => {
                                const pts = chartData.filter(item => item.estacion === stName)
                                    .map(item => {
                                        const d = item.fecha_label.split('-');
                                        let rv = String(item['parametro_' + pID] || '').replace(',', '.').replace('<', '').replace('>', '');
                                        let cleanVal = parseFloat(rv);
                                        if (!isNaN(cleanVal)) {
                                            allDataValues.push(cleanVal);
                                        }
                                        return [Date.UTC(d[0], d[1] - 1, d[2]), cleanVal, item['parametro_' + pID]];
                                    })
                                    .filter(p => !isNaN(p[1])).sort((a, b) => a[0] - b[0]);

                                if (pts.length) {
                                    series.push({
                                        name: `${chartMeta[pID].nombre_largo} [${stName}]`,
                                        data: pts,
                                        yAxis: (useDual && idx > 0) ? 1 : 0,
                                        type: 'line',
                                        unit: chartMeta[pID].unidad
                                    });
                                }
                            });

                            if (idx === 0 || (useDual && idx === 1)) {
                                const normaRanges = chartNormaData?.ranges || {};
                                const paramRanges = normaRanges[pID] || [];
                                const plotLines = [];
                                const unit = chartMeta[pID].unidad ? ' ' + chartMeta[pID].unidad : '';

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
                                        text: chartMeta[pID].nombre_largo + ' [' + chartMeta[pID].unidad + ']',
                                        style: { color: idx === 0 ? '#337ab7' : '#5cb85c', fontWeight: 'bold' }
                                    },
                                    gridLineColor: '#f3f3f3',
                                    labels: { style: { color: '#666' } },
                                    opposite: idx === 1,
                                    plotLines: plotLines.length ? plotLines : undefined,
                                    softMin: axisSoftMin,
                                    softMax: axisSoftMax
                                });
                            }
                        });

                        if (currentChart) {
                            currentChart.destroy();
                        }

                        currentChart = Highcharts.chart('main-chart', {
                            chart: { borderWidht: 0, spacingTop: 20 },
                            title: { text: null },
                            subtitle: {
                                text: chartNormaData?.nombres ? 'Normas activas: ' + Object.values(chartNormaData.nombres).join(', ') : null
                            },
                            xAxis: { type: 'datetime' },
                            yAxis: yAxes,
                            tooltip: {
                                shared: true,
                                useHTML: true,
                                formatter: function () {
                                    let s = `<b>${Highcharts.dateFormat('%Y-%m-%d', this.x)}</b><br/>`;
                                    this.points.forEach(p => {
                                        let unitStr = p.series.userOptions.unit ? ' ' + p.series.userOptions.unit : '';
                                        s += `<span style="color:${p.color}">\u25CF</span> ${p.series.name}: <b>${p.point.options[2]}${unitStr}</b><br/>`;
                                    });
                                    return s;
                                }
                            },
                            legend: { enabled: true },
                            series: series,
                            exporting: {
                                enabled: true,
                                buttons: {
                                    contextButton: {
                                        menuItems: ['downloadPNG', 'downloadJPEG', 'downloadPDF', 'separator', 'downloadCSV', 'downloadXLS']
                                    }
                                }
                            },
                            credits: { enabled: false }
                        });
                    }

                    function buildModalConfig() {
                        // AXES
                        let axisHTML = '';
                        currentChart.yAxis.forEach((ax, i) => {
                            axisHTML += `
                                <div class="cfg-group-card">
                                    <span class="cfg-label-mini">EJE ${i === 0 ? 'PRIMARIO' : 'SECUNDARIO'}</span>
                                    <div class="row">
                                         <div class="col-xs-4"><label class="small text-muted">Lím. Sup</label><input type="number" class="form-control cfg-input-sm ax-u" data-idx="${i}" value="${ax.max !== null && ax.max !== undefined ? ax.max : ''}"></div>
                                         <div class="col-xs-4"><label class="small text-muted">Lím. Inf</label><input type="number" class="form-control cfg-input-sm ax-l" data-idx="${i}" value="${ax.min !== null && ax.min !== undefined ? ax.min : ''}"></div>
                                        <div class="col-xs-4"><label class="small text-muted">Invertir</label><div class="btn-inv ax-inv ${ax.reversed ? 'active' : ''}" data-idx="${i}"><i class="fa fa-refresh"></i> INV</div></div>
                                    </div>
                                </div>`;
                        });
                        $('#axes-config-container').html(axisHTML);

                        // SERIES
                        let seriesHTML = '';
                        currentChart.series.forEach((s, i) => {
                            seriesHTML += `
                                <div class="cfg-group-card p-2" style="margin-bottom: 8px;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-xs-6"><span style="font-size: 10px; font-weight:700; color:#666;">${s.name}</span></div>
                                        <div class="col-xs-2"><div class="color-preview" style="background:${s.color};"><input type="color" class="s-c" data-idx="${i}" value="${s.color}"></div></div>
                                        <div class="col-xs-4 pl-1">
                                            <select class="form-control cfg-input-sm s-t" data-idx="${i}">
                                                <option value="line" ${s.type === 'line' ? 'selected' : ''}>Line</option>
                                                <option value="spline" ${s.type === 'spline' ? 'selected' : ''}>Spline</option>
                                                <option value="column" ${s.type === 'column' ? 'selected' : ''}>Bars</option>
                                                <option value="area" ${s.type === 'area' ? 'selected' : ''}>Area</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>`;
                        });
                        $('#series-config-container').html(seriesHTML);
                    }

                    // Modal Handlers
                    $(document).on('change', '.ax-u, .ax-l', function () {
                        const i = $(this).data('idx');
                        const maxVal = $(`.ax-u[data-idx="${i}"]`).val();
                        const minVal = $(`.ax-l[data-idx="${i}"]`).val();
                        const max = maxVal !== '' ? parseFloat(maxVal) : null;
                        const min = minVal !== '' ? parseFloat(minVal) : null;
                        currentChart.yAxis[i].update({
                            max: (max !== null && !isNaN(max)) ? max : null,
                            min: (min !== null && !isNaN(min)) ? min : null,
                            softMin: null,
                            softMax: null
                        });
                    });

                    $(document).on('click', '.ax-inv', function () {
                        const i = $(this).data('idx');
                        $(this).toggleClass('active');
                        currentChart.yAxis[i].update({ reversed: $(this).hasClass('active') });
                    });

                    $(document).on('input', '.s-c', function () {
                        const i = $(this).data('idx');
                        const col = $(this).val();
                        $(this).parent().css('background', col);
                        currentChart.series[i].update({ color: col });
                    });

                    $(document).on('change', '.s-t', function () {
                        const i = $(this).data('idx');
                        currentChart.series[i].update({ type: $(this).val() });
                    });

                    // Immediate Dual Axis toggle
                    $('#cfg-use-dual-axis').on('change', function () {
                        if (currentChart) {
                            renderChart();
                            buildModalConfig();
                        }
                    });

                    $('#btn-apply-general').on('click', function () {
                        currentChart.update({
                            title: { text: $('#cfg-chart-title').val() || null },
                            xAxis: { title: { text: $('#cfg-xaxis-title').val() || null } }
                        });
                        Swal.fire({ icon: 'success', title: 'Ajustes guardados', timer: 1500, showConfirmButton: false });
                    });

                });
            </script>
        @endpush