@extends('layouts.app')

@section('title', 'Estaciones del Proyecto - Visor Geográfico')
@section('page_title', 'Estaciones del Proyecto')

@push('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.2/dist/leaflet-search.min.css" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        /* CLEAN PROFESSIONAL MAP STYLE */
        #map {
            background: #f1f5f9;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .leaflet-container {
            font-family: 'Inter', sans-serif !important;
        }

        /* PREMIUM MARKERS (CLEAN BLUE) */
        .pulsing-marker {
            width: 14px;
            height: 14px;
            background: #0088cc;
            border: 3px solid #fff;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 136, 204, 0.4);
            position: relative;
        }

        .pulsing-marker::after {
            content: '';
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #0088cc;
            position: absolute;
            animation: clean-pulse 2s infinite;
        }

        @keyframes clean-pulse {
            0% { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(3.5); opacity: 0; }
        }

        .marker-label {
            position: absolute;
            top: 22px;
            left: 50%;
            transform: translateX(-50%);
            color: #1e293b;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            pointer-events: none;
            text-shadow: 0 0 4px #fff, 0 0 4px #fff, 0 0 4px #fff;
            font-family: 'Inter', sans-serif !important;
        }

        /* MODAL CUSTOM STYLING */
        #chartModal .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        #chartModal .modal-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 12px 12px 0 0;
            padding: 25px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #chartModal .modal-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: #1e293b;
            font-size: 24px;
            margin: 0;
        }

        .coordinates-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f0f7ff;
            color: #0088cc;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #d0e7ff;
        }

        .modal-close-wrapper {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #94a3b8;
        }

        .modal-close-wrapper:hover {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
        }

        /* LOADER */
        #map-loader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* MAP CONTROLS OVERRIDE */
        .leaflet-control-layers, .leaflet-control-zoom {
            border: none !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
            border-radius: 8px !important;
        }

        /* TOOLTIP LEAFLET CUSTOM */
        .leaflet-custom-tooltip {
            background: #1e293b !important;
            border: 1px solid #334155 !important;
            color: #fff !important;
            border-radius: 6px !important;
            font-size: 11px !important;
            padding: 8px 12px !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            font-family: 'Inter', sans-serif !important;
        }

        .leaflet-custom-tooltip:before {
            border-top-color: #1e293b !important;
        }
    </style>
@endpush

@section('content')
    <!-- Intro Banner (Cintillo Estándar) -->
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-12">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #0088cc; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                            <i class="fa fa-map-marker" style="color: #0088cc;"></i> Ubicación Estaciones
                        </h2>
                        <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                            Consulte en el mapa la ubicación de las estaciones y sus datos analíticos históricos
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <section class="panel" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden;">
                <div class="panel-body p-none" style="height: calc(100vh - 280px); min-height: 550px; position: relative;">
                    
                    <div id="map"></div>

                    <div id="map-loader">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
                        <p class="mt-4 text-muted" style="font-weight: 500;">Iniciando Visor Geográfico...</p>
                    </div>

                </div>
            </section>
        </div>
    </div>

    <!-- Modal para Gráficos -->
    <div class="modal fade" id="chartModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <h4 class="modal-title" id="modal-station-name">Nombre Estación</h4>
                        <div class="coordinates-pill">
                            <i class="fa fa-crosshairs"></i> <span id="modal-utm">...</span>
                        </div>
                    </div>
                    <div class="modal-close-wrapper" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #64748b; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; margin-bottom: 15px;">
                                <i class="fa fa-line-chart text-primary mr-2"></i> Análisis Histórico de Parámetros
                            </h5>
                            <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #edf2f7;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <label class="small font-weight-bold text-muted mb-0" style="display:block;">Seleccione hasta 2 variables para comparar:</label>
                                    <button type="button" id="btn-limpiar-selector" class="btn btn-sm btn-outline-secondary" style="padding: 4px 12px; font-size: 11px; font-weight: 600;">
                                        <i class="fa fa-times mr-1"></i> Limpiar
                                    </button>
                                </div>
                                <select id="param-selector" class="form-control selectpicker" multiple data-max-options="2" data-live-search="true" data-width="100%" data-style="btn-white" data-size="5" data-selected-text-format="count" data-count-selected-text="({0}) parámetros" title="Seleccione Parámetros"></select>
                            </div>
                        </div>
                    </div>

                    <div id="mini-chart" style="height: 400px; width: 100%; border-radius: 8px; border: 1px solid #f1f5f9; background: #fff;"></div>
                </div>
                        <div style="border-top: 1px solid #f1f5f9; padding-top: 20px; margin-top: 20px;">
                            <div class="row text-center">
                                <div style="flex-grow: 1; text-align: right; padding-right: 25px;">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: 'Outfit', sans-serif; font-weight: 600;">Cerrar Ventana</button>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.2/dist/leaflet-search.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/proj4@2.11.0/dist/proj4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/highcharts@11.1.0/highcharts.js"></script>

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

            const utm19S = "+proj=utm +zone=19 +south +datum=WGS84 +units=m +no_defs";
            const wgs84 = "+proj=longlat +datum=WGS84 +no_defs";

            const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
            const satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');

            const map = L.map('map', { 
                center: [-27.3666, -70.3323], 
                zoom: 10, 
                zoomControl: false, 
                attributionControl: false, 
                layers: [satellite] 
            });

            const baseMaps = {
                "Mapa Estándar": streets,
                "Satélite": satellite
            };

            L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);
            L.control.zoom({ position: 'topright' }).addTo(map);

            const markersLayer = new L.LayerGroup().addTo(map);

            fetch("{{ url('/api/estaciones-proyecto/map-data') }}")
                .then(res => res.json())
                .then(stations => {
                    $('#map-loader').fadeOut(800);
                    const bounds = [];
                    stations.forEach(s => {
                        const coords = proj4(utm19S, wgs84, [parseFloat(s.utm_este), parseFloat(s.utm_norte)]);
                        if (!isNaN(coords[0]) && !isNaN(coords[1])) {
                            const marker = L.marker([coords[1], coords[0]], {
                                title: s.nombre_estacion,
                                icon: L.divIcon({
                                    className: 'custom-div-icon',
                                    html: `<div class="marker-wrapper"><div class="pulsing-marker"></div><div class="marker-label">${s.nombre_estacion}</div></div>`,
                                    iconSize: [20, 20], iconAnchor: [10, 10]
                                })
                            }).addTo(markersLayer);

                            // Map marker hover tooltip (Optional professional touch)
                            marker.bindTooltip(`<b>Estación:</b> ${s.nombre_estacion}<br><b>UTM:</b> ${s.utm_este} E | ${s.utm_norte} N`, {
                                direction: 'top',
                                offset: [0, -15],
                                className: 'leaflet-custom-tooltip'
                            });

                            marker.on('click', (e) => {
                                window.showStationModal(s, [coords[1], coords[0]]);
                            });
                            bounds.push([coords[1], coords[0]]);
                        }
                    });
                    if (bounds.length > 0) map.fitBounds(bounds, { padding: [100, 100] });
                });

            let sharedData = null, sharedMeta = [];

            window.showStationModal = function (station, ll) {
                $('#modal-station-name').text(station.nombre_estacion);
                const fmt = new Intl.NumberFormat('es-CL');
                $('#modal-utm').text(`${fmt.format(station.utm_este)} E | ${fmt.format(station.utm_norte)} N`);
                
                // Clear previous state
                $('#param-selector').empty().selectpicker('refresh');
                if (Highcharts.charts[0]) Highcharts.charts[0].destroy();

                $('#chartModal').modal('show');
                map.flyTo(ll, 14, { duration: 1.5 });

                fetch(`{{ url('/api/estaciones-proyecto/station-history') }}/${station.id_estacion}`)
                    .then(res => res.json())
                    .then(res => {
                        if (res.error) {
                            console.error(res.error);
                            return;
                        }

                        sharedData = res.data; 
                        sharedMeta = res.parametros;
                        
                        const $sel = $('#param-selector').empty();
                        
                        // Populate selector with all available parameters
                        if (res.parametros && res.parametros.length > 0) {
                            res.parametros.forEach(p => {
                                const normalized = window.normalizeText ? window.normalizeText(p.nombre) : p.nombre;
                                $sel.append($('<option>', { 
                                    value: p.id_parametro, 
                                    text: p.nombre,
                                    'data-tokens': normalized
                                }));
                            });
                        }

                        $sel.selectpicker('refresh');
                        
                        // Select "Sulfato" by default, or the first one if not found
                        let defaultParam = res.parametros[0];
                        const sulfato = res.parametros.find(p => p.nombre.toLowerCase().includes('sulfato'));
                        if (sulfato) defaultParam = sulfato;
                        
                        $sel.val(defaultParam.id_parametro).selectpicker('refresh');
                        
                        setTimeout(renderChart, 500);
                    })
                    .catch(err => console.error("Error fetching station history:", err));
            };

            $('#param-selector').on('changed.bs.select', renderChart);

            $('#btn-limpiar-selector').on('click', function () {
                $('#param-selector').val([]).selectpicker('refresh');
                if (Highcharts.charts[0]) Highcharts.charts[0].destroy();
            });

            function renderChart() {
                const ids = $('#param-selector').val();
                if (!ids || (Array.isArray(ids) && ids.length === 0)) return;
                const selected = Array.isArray(ids) ? ids : [ids];
                const series = [], yAxes = [];

                selected.forEach((id, idx) => {
                    const meta = sharedMeta.find(m => String(m.id_parametro) === String(id));
                    const pts = sharedData.filter(d => d['parametro_' + id] && d['parametro_' + id] !== '―')
                        .map(d => {
                            const dm = d.fecha.split('-');
                            return [Date.UTC(dm[0], dm[1] - 1, dm[2]), parseFloat(String(d['parametro_' + id]).replace('<', '').replace('>', '').replace(',', '.'))];
                        }).sort((a, b) => a[0] - b[0]);

                    if (pts.length) {
                        series.push({ 
                            name: meta.nombre, 
                            data: pts, 
                            yAxis: idx, 
                            color: idx === 0 ? '#0088cc' : '#2ecc71',
                            marker: { radius: 4 },
                            tooltip: { valueSuffix: ' ' + meta.unidad, valueDecimals: 1 }
                        });
                        yAxes.push({
                            title: { text: meta.nombre + ' [' + meta.unidad + ']', style: { color: idx === 0 ? '#0088cc' : '#2ecc71', fontSize: '14px', fontWeight: 'bold' } },
                            gridLineColor: '#e2e8f0',
                            gridLineDashStyle: 'Dash',
                            labels: { style: { color: '#64748b', fontSize: '13px' } },
                            opposite: idx === 1
                        });
                    }
                });

                Highcharts.chart('mini-chart', {
                    chart: { backgroundColor: '#fff', style: { fontFamily: "'Inter', sans-serif" } },
                    title: { text: null },
                    xAxis: { 
                        type: 'datetime', 
                        labels: { style: { color: '#64748b', fontSize: '13px' } }, 
                        lineColor: '#e2e8f0',
                        gridLineWidth: 1,
                        gridLineDashStyle: 'Dash',
                        gridLineColor: '#f1f5f9'
                    },
                    yAxis: yAxes,
                    legend: { itemStyle: { color: '#1e293b', fontWeight: '500', fontSize: '13px' } },
                    tooltip: {
                        shared: true,
                        useHTML: true,
                        backgroundColor: 'rgba(255, 255, 255, 0.98)',
                        borderWidth: 1, 
                        borderColor: '#e2e8f0', 
                        shadow: true,
                        headerFormat: '<span style="font-size: 10px; color: #64748b; font-weight: 700;">{point.key}</span><br/>',
                        pointFormat: '<div style="margin-top: 4px;"><span style="color:{point.color}">●</span> {series.name}: <b>{point.y}</b></div>'
                    },
                    credits: { enabled: false },
                    series: series
                });
            }
            
            // Re-render chart when modal is fully shown to avoid sizing issues
            $('#chartModal').on('shown.bs.modal', function () {
                if (sharedData) renderChart();
            });
        });
    </script>
@endpush