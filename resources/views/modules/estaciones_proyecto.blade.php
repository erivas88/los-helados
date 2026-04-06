@extends('layouts.app')

@section('title', 'Estaciones del Proyecto - Mapa Interactivo')

@push('css')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
<!-- Bootstrap Select CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<style>
    /* Full height adjustments */
    body, html { height: 100%; }
    .content-body { padding: 0 !important; }
    
    /* The Map */
    #map { background: #0b0c1b; width: 100%; height: 100%; z-index: 1; }

    /* Sidebar Glassmorphism Card - REFINED ELEGANCE */
    .station-sidecard {
        position: absolute;
        top: 20px;
        right: -480px;
        width: 450px;
        height: calc(100% - 40px);
        z-index: 1001;
        background: rgba(22, 24, 45, 0.9); /* Deep Indigo */
        backdrop-filter: blur(30px) saturate(160%);
        -webkit-backdrop-filter: blur(30px) saturate(160%);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 28px;
        padding: 30px;
        color: #fff;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        transition: right 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        overflow: hidden;
    }
    .station-sidecard.active { right: 20px; }
    .card-content { height: 100%; overflow-y: auto; scrollbar-width: none; }

    .close-btn {
        position: absolute; top: 25px; right: 25px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        color: #888; font-size: 18px;
        width: 40px; height: 40px; border-radius: 50%;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1002;
    }
    .close-btn:hover { background: #ff5f56; color: #fff; transform: rotate(90deg); }

    .section-title {
        font-size: 10px; font-weight: 800; letter-spacing: 2px;
        color: #7d8bb2; margin-bottom: 25px; text-transform: uppercase;
        display: flex; align-items: center;
    }
    .section-title i { margin-right: 12px; color: #00e5ff; }

    .glass-hr { border: 0; border-top: 1px solid rgba(255,255,255,0.08); margin: 30px 0; }
    
    /* 
       Bootstrap Select Styling Override - MAXIMUM ELEGANCE (NO WHITE)
    */
    .bootstrap-select { background: transparent !important; }
    .bootstrap-select .dropdown-toggle {
        background-color: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        border-radius: 14px !important;
        padding: 12px 18px !important;
        font-size: 13px !important;
        box-shadow: none !important;
    }
    .bootstrap-select .dropdown-toggle:hover {
        background-color: rgba(255, 255, 255, 0.06) !important;
        border-color: rgba(0, 229, 255, 0.4) !important;
    }

    .bootstrap-select .dropdown-menu {
        background-color: #1a1b32 !important; /* Elegant Navy Menu */
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 18px !important;
        padding: 8px !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.6) !important;
        margin-top: 5px !important;
    }

    /* Fix Search Box Being White */
    .bootstrap-select .bs-searchbox { background: transparent !important; border: none !important; padding: 12px !important; }
    .bootstrap-select .bs-searchbox .form-control {
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #fff !important;
        border-radius: 12px !important;
        font-size: 12px !important;
        padding: 10px 15px !important;
        box-shadow: none !important;
    }

    /* Fix Action Box (Select All) Being White */
    .bootstrap-select .bs-actionsbox { background: transparent !important; padding: 0 12px 10px 12px !important; border: none !important; }
    .bootstrap-select .bs-actionsbox .btn-group { display: flex; gap: 8px; }
    .bootstrap-select .bs-actionsbox .btn-group .bs-select-all { display: none !important; } /* Hidden */
    .bootstrap-select .bs-actionsbox .btn-group .bs-deselect-all { 
        flex: 1;
        background: rgba(255, 59, 48, 0.1) !important;
        color: #ff3b30 !important;
        border: 1px solid rgba(255, 59, 48, 0.2) !important;
        border-radius: 10px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 8px !important;
    }
    .bootstrap-select .bs-actionsbox .btn-group .bs-deselect-all:hover {
        background: #ff3b30 !important;
        color: #fff !important;
    }

    /* Fix List Text Invisibility */
    .bootstrap-select .dropdown-menu li a { 
        color: #e1e2e6 !important; /* Bright Silver/White Text */
        font-size: 12px !important;
        font-weight: 400 !important;
        padding: 10px 16px !important;
        border-radius: 10px !important;
        margin: 2px 0 !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .bootstrap-select .dropdown-menu li a:hover { 
        background: rgba(255,255,255,0.05) !important; 
        color: #fff !important; 
    }
    .bootstrap-select .dropdown-menu li.selected a { 
        background: rgba(0, 229, 255, 0.1) !important; 
        color: #00e5ff !important; 
        font-weight: 600 !important;
    }

    /* Floating Marker Styling */
    .pulsing-marker {
        width: 16px; height: 16px;
        background: #2ecc71;
        border: 3px solid rgba(255,255,255,0.8);
        border-radius: 50%;
        position: relative;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .pulsing-marker::after {
        content: ''; width: 100%; height: 100%;
        border-radius: 50%; background: #2ecc71;
        position: absolute; top: 0; left: 0;
        animation: pulse-green 1.8s infinite;
    }
    @keyframes pulse-green { 0% { transform: scale(1); opacity: 0.8; } 100% { transform: scale(3.5); opacity: 0; } }

    .pulsing-marker.active {
        background: #00e5ff !important;
        border-color: #fff !important;
        transform: scale(1.2);
        box-shadow: 0 0 25px rgba(0, 229, 255, 0.6);
    }
    .pulsing-marker.active::after { background: #00e5ff !important; animation: pulse-blue 1.5s infinite !important; }
    @keyframes pulse-blue { 0% { transform: scale(1); opacity: 0.8; } 100% { transform: scale(4.5); opacity: 0; } }

    .marker-label {
        position: absolute; top: 22px; left: 50%;
        transform: translateX(-50%);
        color: #fff; background: rgba(11, 12, 27, 0.8);
        -webkit-backdrop-filter: blur(5px); backdrop-filter: blur(5px);
        padding: 4px 12px; border-radius: 8px;
        font-size: 11px; font-weight: 600;
        white-space: nowrap; pointer-events: none;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }
</style>
@endpush

@section('content')
<div class="row m-0 p-0" style="height: calc(100vh - 100px); position: relative; overflow: hidden;">
    <div id="map"></div>

    <div id="map-loader" style="position:absolute; top:0; left:0; width:100%; height:100%; background:#0b0c1b; z-index:2000; display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status"></div>
        <p class="mt-4 text-white opacity-40" style="letter-spacing: 1px; font-size: 12px;">Cargando</p>
    </div>

    <div id="station-sidebar" class="station-sidecard">
        <button id="close-sidebar" class="close-btn"><i class="fa fa-times"></i></button>
        <div class="card-content">
            <h2 id="side-station-name" class="mt-0 mb-1" style="color:#fff; font-weight:200; letter-spacing:1px; font-size: 28px;">Estación</h2>
            <div id="side-coordinates" class="mb-4">
                <span class="badge" style="background: rgba(0, 229, 255, 0.08); border:1px solid rgba(0, 229, 255, 0.15); padding:10px 15px; color:#00e5ff; border-radius: 12px;">
                    <i class="fa fa-crosshairs mr-2"></i> <span id="val-utm" style="font-weight:400; font-size: 11px;">---</span>
                </span>
            </div>
            
            <hr class="glass-hr">

            <div class="chart-section">
                <p class="section-title"><i class="fa fa-stream"></i> Análisis de Variables</p>
                
                <div class="param-selector-wrapper mb-4">
                    <label class="small text-muted mb-3" style="display:block; opacity: 0.6;">Seleccionar Parámetros (Máximo 2):</label>
                    <select id="param-selector" class="form-control selectpicker" 
                            multiple 
                            data-max-options="2" 
                            data-live-search="true" 
                            data-width="100%" 
                            data-size="5"
                            data-actions-box="true"
                            data-deselect-all-text="Limpiar Análisis"
                            data-selected-text-format="count > 1"
                            data-count-selected-text="({0}) Variables seleccionadas"
                            title="Seleccionar Parámetros">
                    </select>
                </div>

                <div id="mini-chart" style="height: 380px; width: 100%;"></div>
            </div>

            <div class="info-footer mt-5 pt-4" style="border-top:1px solid rgba(255,255,255,0.06)">
                <small class="text-muted opacity-40"></small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Leaflet & PROJ4 -->
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/proj4@2.11.0/dist/proj4.js"></script>
<!-- Bootstrap Select -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- Highcharts -->
<script src="https://cdn.jsdelivr.net/npm/highcharts@11.1.0/highcharts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highcharts@11.1.0/modules/accessibility.js"></script>

<script>
$(document).ready(function() {
    Highcharts.setOptions({
        lang: {
            thousandsSep: '.',
            decimalPoint: ','
        }
    });

    const utm19S = "+proj=utm +zone=19 +south +datum=WGS84 +units=m +no_defs";
    const wgs84 = "+proj=longlat +datum=WGS84 +no_defs";

    const map = L.map('map', { 
        center: [-27.3666, -70.3323], zoom: 9, zoomControl: false,
        attributionControl: false
    });
    L.control.zoom({ position: 'bottomleft' }).addTo(map);

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}').addTo(map);

    let activeMarkerElement = null;

    fetch("{{ url('/api/estaciones-proyecto/map-data') }}")
        .then(res => res.json())
        .then(stations => {
            $('#map-loader').fadeOut(800);
            const markers = [];
            stations.forEach(s => {
                const coords = proj4(utm19S, wgs84, [parseFloat(s.utm_este), parseFloat(s.utm_norte)]);
                if (!isNaN(coords[0]) && !isNaN(coords[1])) {
                    const marker = L.marker([coords[1], coords[0]], {
                        icon: L.divIcon({
                            className: 'custom-div-icon',
                            html: `<div class="marker-wrapper">
                                     <div class="pulsing-marker"></div>
                                     <div class="marker-label">${s.nombre_estacion}</div>
                                   </div>`,
                            iconSize: [20, 20], iconAnchor: [10, 10]
                        })
                    }).addTo(map);
                    
                    marker.on('click', (e) => {
                        if (activeMarkerElement) activeMarkerElement.classList.remove('active');
                        const el = e.target.getElement().querySelector('.pulsing-marker');
                        el.classList.add('active');
                        activeMarkerElement = el;
                        showStation(s, [coords[1], coords[0]]);
                    });
                    markers.push([coords[1], coords[0]]);
                }
            });
            if (markers.length > 0) map.fitBounds(markers, { padding: [100, 100] });
        });

    let sharedData = null, sharedMeta = [];

    function showStation(station, ll) {
        $('#side-station-name').text(station.nombre_estacion);
        const formatter = new Intl.NumberFormat('es-CL', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
        const formattedEste = formatter.format(station.utm_este);
        const formattedNorte = formatter.format(station.utm_norte);
        $('#val-utm').text(`${formattedEste} E | ${formattedNorte} N`);
        $('#station-sidebar').addClass('active');
        map.flyTo(ll, 14, { duration: 1.5, easeLinearity: 0.25 });

        fetch(`{{ url('/api/estaciones-proyecto/station-history') }}/${station.id_estacion}`)
            .then(res => res.json()).then(res => {
                sharedData = res.data;
                sharedMeta = res.parametros;
                const $sel = $('#param-selector').empty();
                const valid = res.parametros.filter(p => res.data.some(d => d['parametro_'+p.id_parametro] !== null && d['parametro_'+p.id_parametro] !== '―'))
                              .sort((a,b) => a.nombre.localeCompare(b.nombre));

                valid.forEach(p => {
                    $sel.append($('<option>', { value: p.id_parametro, text: p.nombre }));
                });
                
                const ph = valid.find(p => p.nombre.toLowerCase().includes('ph'));
                $sel.val(ph ? ph.id_parametro : (valid[0] ? valid[0].id_parametro : null));
                $sel.selectpicker('refresh');
                renderChart();
            });
    }

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
            const pts = sharedData.filter(d => d['parametro_'+id] && d['parametro_'+id] !== '―')
                        .map(d => {
                            const dm = d.fecha.split('-');
                            const v = parseFloat(String(d['parametro_'+id]).replace('<','').replace('>','').replace(',','.'));
                            return [Date.UTC(dm[0], dm[1]-1, dm[2]), v];
                        }).sort((a,b) => a[0]-b[0]);

            if (pts.length) {
                series.push({ 
                    name: meta.nombre, data: pts, yAxis: idx, 
                    color: idx === 0 ? '#71b6f9' : '#00e5ff', 
                    marker: { symbol: 'circle', radius: 4 },
                    tooltip: { valueSuffix: ' '+meta.unidad, valueDecimals: 1 } 
                });
                yAxes.push({ 
                    title: { text: meta.nombre + ' [' + meta.unidad + ']', style: { color: idx === 0 ? '#71b6f9' : '#00e5ff', fontSize:'11px', fontWeight:'700' } },
                    gridLineColor: 'rgba(255,255,255,0.04)',
                    labels: { 
                        style: { color: '#8d92a1', fontSize: '10px' },
                        format: '{value:,.1f}'
                    },
                    opposite: idx === 1
                });
            }
        });

        Highcharts.chart('mini-chart', {
            chart: { backgroundColor: 'transparent', spacingTop: 20 },
            title: { text: null },
            xAxis: { type: 'datetime', labels: { style: { color: '#8d92a1', fontSize: '10px' } }, lineColor: 'rgba(255,255,255,0.08)' },
            yAxis: yAxes,
            legend: { itemStyle: { color: '#e1e2e6', fontWeight: '400', fontSize: '11px' }, margin: 20 },
            tooltip: { shared: true, theme: 'dark', backgroundColor: 'rgba(22, 24, 45, 0.95)', borderWidth: 0, style: { fontSize: '13px', color: '#fff' } },
            credits: { enabled: false },
            series: series
        });
    }
});
</script>
@endpush
