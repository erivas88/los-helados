@extends('layouts.app')

@section('title', 'Dashboard - Plataforma de Seguimiento Ambiental')
@section('page_title', 'Dashboard')

@section('content')
    @include('partials.modules')

    <!-- Dashboard Summary Cards -->
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fa fa-flask"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Muestras</h4>
                                <div class="info">
                                    <strong class="amount" id="stat-total">-</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ url('/visualizacion') }}">(ver todas)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-featured-left panel-featured-warning">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-warning">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Pendientes QC</h4>
                                <div class="info">
                                    <strong class="amount" id="stat-pending">-</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ url('/control-calidad') }}">(validar ahora)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-featured-left panel-featured-success">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-success">
                                <i class="fa fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Aprobadas</h4>
                                <div class="info">
                                    <strong class="amount" id="stat-approved">-</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <span class="text-muted text-uppercase">Datos listos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-featured-left panel-featured-info">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-info">
                                <i class="fa fa-shield"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Consistencia QC</h4>
                                <div class="info">
                                    <strong class="amount" id="stat-qc-score">- %</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <span class="text-muted text-uppercase">Confiabilidad</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Charts and History -->
    <div class="row">
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Estado de Certificaciones</h2>
                </header>
                <div class="panel-body">
                    <div id="statusChart" style="height: 300px;"></div>
                </div>
            </section>
        </div>
        <div class="col-lg-6">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Historial Reciente de Modificaciones</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-none" id="history-table">
                            <thead>
                                <tr>
                                    <th>Estación</th>
                                    <th>Parámetro</th>
                                    <th>Anterior</th>
                                    <th>Nuevo</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">Cargando historial...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Tendencia de Ingreso de Datos (Últimos 6 meses)</h2>
                </header>
                <div class="panel-body">
                    <div id="trendChart" style="height: 350px;"></div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('css')
<style>
    .amount { font-size: 28px !important; }
    .panel-featured-left .summary-icon { border-radius: 8px; width: 50px; height: 50px; line-height: 50px; font-size: 24px; }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/highcharts@11/highcharts.js"></script>
<script>
    $(document).ready(function() {
        // Fetch dashboard summary
        $.get('{{ url("/api/dashboard/summary") }}', function(data) {
            // Update Stats
            $('#stat-total').text(data.stats.total);
            $('#stat-pending').text(data.stats.pending);
            $('#stat-approved').text(data.stats.approved);
            $('#stat-qc-score').text(data.stats.qc_score + '%');

            // Render Pie Chart
            Highcharts.chart('statusChart', {
                chart: { type: 'pie', backgroundColor: 'transparent' },
                title: { text: '' },
                credits: { enabled: false },
                tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Muestras',
                    colorByPoint: true,
                    data: [
                        { name: 'Pendientes QC', y: data.stats.pending, color: '#f39c12' },
                        { name: 'Aprobadas', y: data.stats.approved, color: '#27ae60' }
                    ]
                }]
            });

            // Update History Table
            let htmlTable = '';
            if(data.recent_changes.length > 0) {
                data.recent_changes.forEach(row => {
                    htmlTable += `<tr>
                        <td><span class="badge badge-info" style="font-size:10px; background-color: #0088cc;">${row.estacion}</span></td>
                        <td><strong>${row.nombre_parametro}</strong></td>
                        <td><span class="text-danger">${row.valor_anterior}</span></td>
                        <td><span class="text-success">${row.valor_nuevo}</span></td>
                        <td><small>${row.fecha}</small></td>
                    </tr>`;
                });
            } else {
                htmlTable = '<tr><td colspan="5" class="text-center">No hay cambios registrados.</td></tr>';
            }
            $('#history-table tbody').html(htmlTable);

            // Render Trend Chart
            const months = data.monthly_imports.map(m => m.month);
            const counts = data.monthly_imports.map(m => m.count);

            Highcharts.chart('trendChart', {
                chart: { type: 'area', backgroundColor: 'transparent' },
                title: { text: '' },
                xAxis: { categories: months },
                yAxis: { title: { text: 'N° de Muestras' } },
                credits: { enabled: false },
                series: [{
                    name: 'Registros Ingresados',
                    data: counts,
                    color: '#27ae60'
                }]
            });
        });
    });
</script>
@endpush
