@extends('layouts.app')

@section('title', 'Estaciones del Proyecto - Mapa Interactivo')
@section('page_title', 'Estaciones del Proyecto')

@push('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.2/dist/leaflet-search.min.css" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        /* Full height adjustments */
        body,
        html {
            height: 100%;
        }

        /* The Map */
        #map {
            background: #0b0c1b;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* GLOBAL LEAFLET FONT */
        .leaflet-container {
            font-family: 'Inter', sans-serif !important;
        }

        /* Sidebar Glassmorphism Card */
        .station-sidecard {
            position: absolute;
            top: 20px;
            right: -480px;
            width: 450px;
            height: calc(100% - 40px);
            z-index: 1001;
            background: rgba(22, 24, 45, 0.9);
            backdrop-filter: blur(30px) saturate(160%);
            -webkit-backdrop-filter: blur(30px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 28px;
            padding: 30px;
            color: #fff;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            transition: right 0.7s cubic-bezier(0.22, 1, 0.36, 1);
            overflow: hidden;
        }

        .station-sidecard.active {
            right: 20px;
        }

        .card-content {
            height: 100%;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .close-btn {
            position: absolute;
            top: 25px;
            right: 25px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #888;
            font-size: 18px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1002;
        }

        .close-btn:hover {
            background: #ff5f56;
            color: #fff;
            transform: rotate(90deg);
        }

        .section-title {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #7d8bb2;
            margin-bottom: 25px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 12px;
            color: #00e5ff;
        }

        .glass-hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin: 30px 0;
        }

        /* Bootstrap Select Styling */
        .bootstrap-select {
            background: transparent !important;
        }

        .bootstrap-select .dropdown-toggle {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border-radius: 14px !important;
            padding: 12px 18px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .bootstrap-select .dropdown-menu {
            background-color: #1a1b32 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 18px !important;
            padding: 10px !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5) !important;
        }

        .bootstrap-select .dropdown-menu li a {
            color: #e1e2e6 !important;
            padding: 10px 15px !important;
            border-radius: 10px !important;
            transition: all 0.2s ease !important;
            font-family: 'Inter', sans-serif !important;
        }

        /* FIX HOVER INVISIBILITY */
        .bootstrap-select .dropdown-menu li a:hover,
        .bootstrap-select .dropdown-menu li.active a,
        .bootstrap-select .dropdown-menu li:hover a {
            background: rgba(0, 229, 255, 0.15) !important;
            color: #00e5ff !important;
            outline: none !important;
        }

        .bootstrap-select .dropdown-menu li.selected a {
            background: rgba(0, 229, 255, 0.08) !important;
            color: #00e5ff !important;
            font-weight: 600 !important;
        }

        /* CUSTOM DARK STYLING FOR LEAFLET SEARCH & LAYERS */
        .leaflet-control-search {
            background: rgba(22, 24, 45, 0.8) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
        }

        .leaflet-control-search .search-input {
            background: transparent !important;
            color: #fff !important;
            border: none !important;
            margin: 6px 10px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .leaflet-control-search .search-button {
            filter: invert(1) brightness(2);
        }

        .leaflet-control-search .search-tooltip {
            background: #1a1b32 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 8px !important;
            color: #fff !important;
            font-family: 'Inter', sans-serif !important;
        }

        .leaflet-control-search .search-tip:hover {
            background: rgba(0, 229, 255, 0.1) !important;
        }

        .leaflet-control-layers {
            background: rgba(22, 24, 45, 0.8) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            color: #fff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
            font-family: 'Inter', sans-serif !important;
        }

        .leaflet-control-layers-expanded {
            padding: 10px 15px !important;
        }

        /* Floating Marker Styling */
        .pulsing-marker {
            width: 16px;
            height: 16px;
            background: #2ecc71;
            border: 3px solid rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            position: relative;
        }

        .pulsing-marker::after {
            content: '';
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #2ecc71;
            position: absolute;
            top: 0;
            left: 0;
            animation: pulse-green 1.8s infinite;
        }

        @keyframes pulse-green {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(3.5);
                opacity: 0;
            }
        }

        .pulsing-marker.active {
            background: #00e5ff !important;
            border-color: #fff !important;
            transform: scale(1.2);
        }

        .pulsing-marker.active::after {
            background: #00e5ff !important;
            animation: pulse-blue 1.5s infinite !important;
        }

        @keyframes pulse-blue {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(4.5);
                opacity: 0;
            }
        }

        .marker-label {
            position: absolute;
            top: 22px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            background: rgba(11, 12, 27, 0.8);
            backdrop-filter: blur(5px);
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            pointer-events: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-family: 'Inter', sans-serif !important;
        }
    </style>
@endpush

@push('css')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-featured-left panel-featured-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Visor - Estaciones</h2>
                </header>
                <div class="panel-body p-none"
                    style="height: calc(100vh - 180px); min-height: 500px; position: relative; overflow: hidden; border-radius: 0 0 12px 12px;">

                    <div id="map" style="width: 100%; height: 100%;"></div>

                    <div id="map-loader"
                        style="position:absolute; top:0; left:0; width:100%; height:100%; background:#0b0c1b; z-index:2000; display:flex; flex-direction:column; align-items:center; justify-content:center;">
                        <div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status"></div>
                        <p class="mt-4 text-white opacity-40" style="letter-spacing: 1px; font-size: 12px;">Cargando</p>
                    </div>

                    <div id="station-sidebar" class="station-sidecard" style="height: calc(100% - 40px); top: 20px;">
                        <button id="close-sidebar" class="close-btn"><i class="fa fa-times"></i></button>
                        <div class="card-content">
                            <h2 id="side-station-name" class="mt-0 mb-1"
                                style="color:#fff; font-weight:200; letter-spacing:1px; font-size: 28px;">Estación</h2>
                            <div id="side-coordinates" class="mb-4">
                                <span class="badge"
                                    style="background: rgba(0, 229, 255, 0.08); border:1px solid rgba(0, 229, 255, 0.15); padding:10px 15px; color:#00e5ff; border-radius: 12px;">
                                    <i class="fa fa-crosshairs mr-2"></i> <span id="val-utm"
                                        style="font-weight:400; font-size: 11px;">---</span>
                                </span>
                            </div>
                            <hr class="glass-hr">
                            <div class="chart-section">
                                <p class="section-title"><i class="fa fa-stream"></i> Análisis de Variables</p>
                                <div class="param-selector-wrapper mb-4">
                                    <label class="small text-muted mb-3" style="display:block; opacity: 0.6;">Seleccionar
                                        Parámetros (Máximo 2):</label>
                                    <select id="param-selector" class="form-control selectpicker" multiple
                                        data-max-options="2" data-live-search="true" data-width="100%" data-size="5"
                                        data-actions-box="true" data-deselect-all-text="Limpiar Análisis"
                                        data-selected-text-format="count > 1"
                                        data-count-selected-text="({0}) Variables seleccionadas"
                                        title="Seleccionar Parámetros"></select>
                                </div>
                                <div id="mini-chart" style="height: 380px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
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
            Highcharts.setOptions({ lang: { thousandsSep: '.', decimalPoint: ',' } });

            const utm19S = "+proj=utm +zone=19 +south +datum=WGS84 +units=m +no_defs";
            const wgs84 = "+proj=longlat +datum=WGS84 +no_defs";

            const satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');
            const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
            const dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png');

            const map = L.map('map', { center: [-27.3666, -70.3323], zoom: 9, zoomControl: false, attributionControl: false, layers: [satellite] });

            const baseMaps = {
                "<span style='color:#ccc'>Satélite</span>": satellite,
                "<span style='color:#ccc'>Calles</span>": streets,
                "<span style='color:#ccc'>Oscuro</span>": dark
            };

            L.control.layers(baseMaps, null, { position: 'topleft' }).addTo(map);
            L.control.zoom({ position: 'topright' }).addTo(map);

            const markersLayer = new L.LayerGroup().addTo(map);

            const searchControl = new L.Control.Search({
                layer: markersLayer, propertyName: 'title', marker: false,
                moveToLocation: function (latlng, title, map) { map.flyTo(latlng, 15, { duration: 1.5 }); }
            });
            searchControl.on('search:locationfound', (e) => { e.layer.fire('click'); });
            map.addControl(searchControl);

            let activeMarkerElement = null;

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

                            marker.on('click', (e) => {
                                window.showStation(s, [coords[1], coords[0]], e.target.getElement().querySelector('.pulsing-marker'));
                            });
                            bounds.push([coords[1], coords[0]]);
                        }
                    });
                    if (bounds.length > 0) map.fitBounds(bounds, { padding: [100, 100] });
                });

            let sharedData = null, sharedMeta = [];

            window.showStation = function (station, ll, el) {
                if (activeMarkerElement) activeMarkerElement.classList.remove('active');
                if (el) { el.classList.add('active'); activeMarkerElement = el; }

                $('#side-station-name').text(station.nombre_estacion);
                const fmt = new Intl.NumberFormat('es-CL', { minimumFractionDigits: 1 });
                $('#val-utm').text(`${fmt.format(station.utm_este)} E | ${fmt.format(station.utm_norte)} N`);
                $('#station-sidebar').addClass('active');
                map.flyTo(ll, 14, { duration: 1.5 });

                fetch(`{{ url('/api/estaciones-proyecto/station-history') }}/${station.id_estacion}`)
                    .then(res => res.json()).then(res => {
                        sharedData = res.data; sharedMeta = res.parametros;
                        const $sel = $('#param-selector').empty();
                        const valid = res.parametros.filter(p => res.data.some(d => d['parametro_' + p.id_parametro] && d['parametro_' + p.id_parametro] !== '―'))
                            .sort((a, b) => a.nombre.localeCompare(b.nombre));

                        valid.forEach(p => $sel.append($('<option>', { value: p.id_parametro, text: p.nombre })));
                        const ph = valid.find(p => p.nombre.toLowerCase().includes('ph'));
                        $sel.val(ph ? ph.id_parametro : (valid[0] ? valid[0].id_parametro : null)).selectpicker('refresh');
                        renderChart();
                    });
            };

            $('#param-selector').on('changed.bs.select', renderChart);
            $('#close-sidebar').on('click', () => {
                $('#station-sidebar').removeClass('active');
                if (activeMarkerElement) { activeMarkerElement.classList.remove('active'); activeMarkerElement = null; }
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
                        series.push({ name: meta.nombre, data: pts, yAxis: idx, color: idx === 0 ? '#71b6f9' : '#00e5ff', marker: { radius: 4 }, tooltip: { valueSuffix: ' ' + meta.unidad, valueDecimals: 1 } });
                        yAxes.push({
                            title: { text: meta.nombre + ' [' + meta.unidad + ']', style: { color: idx === 0 ? '#71b6f9' : '#00e5ff', fontSize: '11px' } },
                            gridLineColor: 'rgba(255,255,255,0.04)', labels: { style: { color: '#8d92a1', fontSize: '10px' } }, opposite: idx === 1
                        });
                    }
                });

                Highcharts.chart('mini-chart', {
                    chart: { backgroundColor: 'transparent' },
                    title: { text: null },
                    xAxis: { type: 'datetime', labels: { style: { color: '#8d92a1', fontFamily: "'Inter', sans-serif" } }, lineColor: 'rgba(255,255,255,0.08)' },
                    yAxis: yAxes,
                    legend: { itemStyle: { color: '#e1e2e6', fontFamily: "'Inter', sans-serif", fontWeight: '400' } },
                    tooltip: {
                        shared: true,
                        backgroundColor: 'rgba(22, 24, 45, 0.95)',
                        borderWidth: 1,
                        borderColor: 'rgba(255,255,255,0.1)',
                        shadow: true,
                        style: {
                            fontSize: '13px',
                            color: '#fff',
                            fontFamily: "'Inter', sans-serif"
                        },
                        headerFormat: '<span style="font-size: 11px; color: #7d8bb2; font-weight: 700;">{point.key}</span><br/>',
                        pointFormat: '<span style="color:{point.color}">●</span> {series.name}: <b>{point.y}</b><br/>'
                    },
                    credits: { enabled: false },
                    series: series
                });
            }
        });
    </script>
@endpush