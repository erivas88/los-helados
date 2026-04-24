@extends('layouts.app')
@section('title', 'Control de Calidad - Porto Admin')
@section('page_title', 'Control de Calidad')
@section('content')
   @include('partials.modules')
   <!-- Intro Banner -->
   <div class="row" style="margin-bottom: 25px;">
      <div class="col-md-12">
         <div
            style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #f39c12; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
               <div>
                  <h2
                     style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                     <i class="fa fa-shield" style="color: #f39c12;"></i> Control de Calidad Analítico
                  </h2>
                  <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                      Verificación y validación de datos
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Main Row -->
   <div class="row">
      <div class="col-md-12">
         <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">

            <div class="panel-body">
               <!-- Filter Toolbar -->
               <div class="filter-toolbar" style="margin-bottom: 20px;">
                  <div class="flex-toolbar-container">
                     <!-- DepÃƒÆ’Ã‚Â³sito -->
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
                     <!-- AÃƒÆ’Ã‚Â±o -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar-alt text-success"></i> Años </label>
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
                     <!-- Estatus -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-lock text-success"></i> ESTATUS</label>
                        <select id="filtro-estatus" class="form-control selectpicker" data-width="100%" data-size="5">
                           <option value="" selected>Todos</option>
                           <option value="0" data-content="<i class='fa fa-unlock-alt text-warning'></i> Pendiente">
                              Pendiente</option>
                           <option value="1" data-content="<i class='fa fa-lock text-success'></i> Aprobado JP">Aprobado JP
                           </option>
                           <option value="2" data-content="<i class='fa fa-lock text-primary'></i> Aprobado Analista">
                              Aprobado Analista</option>
                        </select>
                     </div>
                     <!-- Buttons as equal items -->
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <button type="button" id="btn-filtrar" class="btn btn-warning filter-btn btn-block"
                           style="background-color: #f39c12; border-color: #f39c12; font-family: 'Outfit', sans-serif; font-weight: 600; color: white;">
                           <i class="fa fa-filter text-success mr-1"></i> &nbsp; Filtrar
                        </button>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <div class="btn-group btn-block">
                           <button type="button" class="btn btn-default filter-btn dropdown-toggle btn-block"
                              data-toggle="dropdown">
                              <i class="fa fa-cog text-primary mr-1"></i> &nbsp; Opciones <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu" role="menu" style="min-width: 100%;">
                              <li><a href="javascript:void(0)" id="btn-bulk-status"><i
                                       class="fa fa-check-circle text-success"></i> Aprobar Muestras</a></li>
                              <li><a href="javascript:void(0)" id="btn-bulk-pendiente"><i
                                       class="fa fa-unlock-alt text-warning"></i> Marcar como Pendiente</a></li>
                              <li><a href="javascript:void(0)" id="btn-view-historial"><i
                                       class="fa fa-history text-info"></i> Ver Historial</a></li>
                              <li><a href="javascript:void(0)" id="btn-select-all"><i class="fa fa-list"></i> Seleccionar
                                    todo</a></li>
                              <li><a href="javascript:void(0)" id="btn-qa-qc"><i class="fa fa-line-chart text-danger"></i>
                                    Control de calidad...</a></li>
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
               <h2 class="panel-title">Gráfico Histórico</h2>
            </header>
            <div class="panel-body">
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
                     <!-- ParÃƒÆ’Ã‚Â¡metros -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-flask text-success"></i> PARAMETROS</label>
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
                     <!-- Estatus -->
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-lock text-success"></i> ESTATUS</label>
                        <select id="filtro-estatus-chart" class="form-control selectpicker" data-width="100%"
                           data-size="5">
                           <option value="" selected>Todos</option>
                           <option value="0" data-content="<i class='fa fa-unlock-alt text-warning'></i> Pendiente">
                              Pendiente</option>
                           <option value="1" data-content="<i class='fa fa-lock text-success'></i> Aprobado JP">Aprobado JP
                           </option>
                           <option value="2" data-content="<i class='fa fa-lock text-primary'></i> Aprobado Analista">
                              Aprobado Analista</option>
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
                        <button type="button" class="btn btn-default filter-btn btn-block" data-toggle="modal"
                           data-target="#modalConfiguracionHist">
                           <i class="fa fa-cog mr-1"></i> &nbsp; Configuración
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

   <!-- Gráficos QA/QC Row -->
   <div class="row">
      <div class="col-md-12">
         <section class="panel">
            <header class="panel-heading">
               <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
               </div>
               <h2 class="panel-title">Gráficos (QA/QC)</h2>
            </header>
            <div class="panel-body">
               <!-- Filter Toolbar -->
               <div class="filter-toolbar" style="margin-bottom: 20px;">
                  <div class="flex-toolbar-container">
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                        <select id="select-sector-qaqc" class="form-control selectpicker" data-live-search="true"
                           data-width="100%"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                        <select multiple id="filtro-estaciones-qaqc" class="form-control selectpicker" title="Estaciones"
                           data-size="5" data-live-search="true" data-width="100%" data-dropup-auto="false"
                           data-selected-text-format="count" data-count-selected-text=" ({0}) Estaciones "
                           data-actions-box="true" data-select-all-text="Todos" data-deselect-all-text="Ninguno"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar text-success"></i> MESES</label>
                        <select multiple id="filtro-meses-qaqc" class="form-control selectpicker" title="Meses"
                           data-size="5" data-live-search="true" data-width="100%" data-actions-box="true"
                           data-select-all-text="Todos" data-deselect-all-text="Ninguno" data-selected-text-format="count"
                           data-count-selected-text=" ({0}) Meses"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar-o text-success"></i> AÑOS</label>
                        <select multiple id="filtro-anios-qaqc" class="form-control selectpicker" title="Años"
                           data-size="5" data-width="100%" data-actions-box="true" data-select-all-text="Todos"
                           data-deselect-all-text="Ninguno" data-selected-text-format="count"
                           data-count-selected-text=" ({0}) Años"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-tasks text-success"></i> PROGRAMAS</label>
                        <select multiple id="filtro-indicador-qaqc" class="form-control selectpicker"
                           data-live-search="true" data-width="100%"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-lock text-success"></i> ESTATUS</label>
                        <select id="filtro-estatus-qaqc" class="form-control selectpicker" data-width="100%" data-size="5">
                           <option value="" selected>Todos</option>
                           <option value="0" data-content="<i class='fa fa-unlock-alt text-warning'></i> Pendiente">
                              Pendiente</option>
                           <option value="1" data-content="<i class='fa fa-lock text-success'></i> Aprobado JP">Aprobado JP
                           </option>
                           <option value="2" data-content="<i class='fa fa-lock text-primary'></i> Aprobado Analista">
                              Aprobado Analista</option>
                        </select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <button type="button" id="btn-graficar-qaqc" class="btn btn-success filter-btn btn-block">
                           <i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar
                        </button>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <div class="btn-group btn-block">
                           <button type="button" class="btn btn-default filter-btn dropdown-toggle btn-block"
                              data-toggle="dropdown">
                              <i class="fa fa-cog mr-1"></i> &nbsp; Configuración <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu" role="menu">
                              <li><a href="javascript:void(0)" id="btn-config-qaqc"><i class="fa fa-sliders"></i> Ajustes
                                    del Gráfico</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Tabs Navigation -->
               <ul class="nav nav-tabs qaqc-nav-tabs" role="tablist"
                  style="background: #f5f7fa; border-bottom: 2px solid #dee2e6; margin: 0 -15px;">
                  <li class="active"><a href="#tab-section-cond" data-toggle="tab" role="tab" style="border-radius: 0;"><i
                           class="fa fa-bolt"></i> Conductividad Eléctrica <span class="badge qaqc-badge"
                           id="badge-section-cond">0</span></a></li>
                  <li><a href="#tab-section-ph" data-toggle="tab" role="tab" style="border-radius: 0;"><i
                           class="fa fa-tint"></i> pH <span class="badge qaqc-badge" id="badge-section-ph">0</span></a>
                  </li>
                  <li><a href="#tab-section-sdt" data-toggle="tab" role="tab" style="border-radius: 0;"><i
                           class="fa fa-flask"></i> SDT <span class="badge qaqc-badge" id="badge-section-sdt">0</span></a>
                  </li>
               </ul>

               <!-- Tab Content -->
               <div class="tab-content qaqc-tab-content" style="padding: 20px 0 0 0; border: none; box-shadow: none;">
                  <div class="tab-pane active" id="tab-section-cond" role="tabpanel">
                     <div id="chart-section-cond" style="height: 420px; width: 100%;">
                        <div class="text-center" style="padding-top: 150px; color: #999;"><i class="fa fa-line-chart fa-5x"
                              style="opacity: 0.2; margin-bottom: 20px;"></i>
                           <h4>Seleccione filtros y presione Graficar.</h4>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab-section-ph" role="tabpanel">
                     <div id="chart-section-ph" style="height: 420px; width: 100%;">
                        <div class="text-center" style="padding-top: 150px; color: #999;"><i class="fa fa-line-chart fa-5x"
                              style="opacity: 0.2; margin-bottom: 20px;"></i>
                           <h4>Seleccione filtros y presione Graficar.</h4>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab-section-sdt" role="tabpanel">
                     <div id="chart-section-sdt" style="height: 420px; width: 100%;">
                        <div class="text-center" style="padding-top: 150px; color: #999;"><i class="fa fa-line-chart fa-5x"
                              style="opacity: 0.2; margin-bottom: 20px;"></i>
                           <h4>Seleccione filtros y presione Graficar.</h4>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </section>
      </div>
   </div>


   <!-- SECTION: BALANCE IONICO -->
   <div class="row">
      <div class="col-md-12">
         <section class="panel">
            <header class="panel-heading">
               <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
               </div>
               <h2 class="panel-title">Balance Iónico</h2>
            </header>
            <div class="panel-body">
               <!-- Filter Toolbar -->
               <div class="filter-toolbar" style="margin-bottom: 20px;">
                  <div class="flex-toolbar-container">
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-industry text-success"></i> SECTOR</label>
                        <select id="select-sector-balance" class="form-control selectpicker" data-live-search="true"
                           data-width="100%"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-map-marker text-success"></i> ESTACIONES</label>
                        <select multiple id="filtro-estaciones-balance" class="form-control selectpicker"
                           title="Estaciones" data-size="5" data-live-search="true" data-width="100%"
                           data-dropup-auto="false" data-selected-text-format="count"
                           data-count-selected-text=" ({0}) Estaciones " data-actions-box="true"
                           data-select-all-text="Todos" data-deselect-all-text="Ninguno"></select>
                     </div>

                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar text-success"></i> MESES</label>
                        <select multiple id="filtro-meses-balance" class="form-control selectpicker" title="Meses"
                           data-size="5" data-live-search="true" data-width="100%" data-actions-box="true"
                           data-select-all-text="Todos" data-deselect-all-text="Ninguno" data-selected-text-format="count"
                           data-count-selected-text=" ({0}) Meses"></select>
                     </div>

                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-calendar-o text-success"></i> AÑOS</label>
                        <select multiple id="filtro-anios-balance" class="form-control selectpicker" title="Años"
                           data-size="5" data-width="100%" data-actions-box="true" data-select-all-text="Todos"
                           data-deselect-all-text="Ninguno" data-selected-text-format="count"
                           data-count-selected-text=" ({0}) Años"></select>
                     </div>

                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-tasks text-success"></i> PROGRAMAS</label>
                        <select multiple id="filtro-indicador-balance" class="form-control selectpicker"
                           data-live-search="true" data-width="100%"></select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label"><i class="fa fa-lock text-success"></i> ESTATUS</label>
                        <select id="filtro-estatus-balance" class="form-control selectpicker" data-width="100%"
                           data-size="5">
                           <option value="" selected>Todos</option>
                           <option value="0" data-content="<i class='fa fa-unlock-alt text-warning'></i> Pendiente">
                              Pendiente</option>
                           <option value="1" data-content="<i class='fa fa-lock text-success'></i> Aprobado JP">Aprobado JP
                           </option>
                           <option value="2" data-content="<i class='fa fa-lock text-primary'></i> Aprobado Analista">
                              Aprobado Analista</option>
                        </select>
                     </div>
                     <div class="filter-item">
                        <label class="filter-label">&nbsp;</label>
                        <button type="button" id="btn-graficar-balance" class="btn btn-success filter-btn btn-block">
                           <i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar
                        </button>
                     </div>
                  </div>
               </div>

               <div id="chart-section-balance" style="height: 420px; width: 100%;">
                  <div class="text-center" style="padding-top: 150px; color: #999;"><i class="fa fa-bar-chart fa-5x"
                        style="opacity: 0.2; margin-bottom: 20px;"></i>
                     <h4>Seleccione filtros y presione Graficar.</h4>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>

   <!-- Modal Cargar -->
   <div class="modal fade" id="modalCargar" tabindex="-1" role="dialog" aria-labelledby="modalCargarLabel"
      aria-hidden="true">
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
   <div class="modal fade" id="modalEstatus" tabindex="-1" role="dialog" aria-labelledby="modalEstatusLabel"
      aria-hidden="true">
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
   <div class="modal fade" id="modalHistorial" tabindex="-1" role="dialog" aria-labelledby="modalHistorialLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalHistorialLabel"><i class="fa fa-history"></i> Historial de Modificaciones
               </h5>
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
               <h5 class="modal-title" id="modalQAQCLabel"><i class="fa fa-line-chart"></i> &nbsp;Control de Calidad
                  (QA / QC)</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                  style="color:#fff; opacity:.8;">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" style="padding: 0;">
               <!-- Tabs Navigation -->
               <ul class="nav nav-tabs qaqc-nav-tabs" role="tablist">
                  <li class="active"><a href="#tab-qc-cond" data-toggle="tab" role="tab"><i class="fa fa-bolt"></i>
                        Conductividad Eléctrica <span class="badge qaqc-badge" id="badge-qc-cond">0</span></a></li>
                  <li><a href="#tab-qc-ph" data-toggle="tab" role="tab"><i class="fa fa-tint"></i> pH <span
                           class="badge qaqc-badge" id="badge-qc-ph">0</span></a></li>
                  <li><a href="#tab-qc-sdt" data-toggle="tab" role="tab"><i class="fa fa-flask"></i> SDT <span
                           class="badge qaqc-badge" id="badge-qc-sdt">0</span></a></li>
               </ul>
               <!-- Tab Content -->
               <div class="tab-content qaqc-tab-content">
                  <!-- CE Tab -->
                  <div class="tab-pane active" id="tab-qc-cond" role="tabpanel">
                     <div id="chart-qc-cond" style="height: 420px;"></div>
                     <div class="qaqc-table-section">
                        <h6 class="qaqc-table-title"><i class="fa fa-table"></i> &nbsp;Datos de Conductividad
                           Eléctrica</h6>
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
               <span class="qaqc-footer-info"><i class="fa fa-info-circle"></i> Los calculos se generan
                  automáticamente a partir de los registros seleccionados.</span>
               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>


   <!-- Modal Configuración de Gráficos QA/QC -->
   <div class="modal fade" id="modalConfigQAQC" tabindex="-1" role="dialog" aria-labelledby="modalConfigQAQCLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document" style="width: 720px; max-width: 95vw;">
         <div class="modal-content config-modal-content">
            <div class="modal-header config-modal-header">
               <h5 class="modal-title" id="modalConfigQAQCLabel"><i class="fa fa-sliders"></i> &nbsp;Configuración de
                  Gráficos QA/QC</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                  style="color:#fff; opacity:.8;">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body" style="padding: 0;">
               <ul class="nav nav-tabs config-nav-tabs" role="tablist">
                  <li class="active"><a href="#cfg-tab-cond" data-toggle="tab" role="tab"><i class="fa fa-bolt"></i>
                        Conductividad</a></li>
                  <li><a href="#cfg-tab-ph" data-toggle="tab" role="tab"><i class="fa fa-tint"></i> pH</a></li>
                  <li><a href="#cfg-tab-sdt" data-toggle="tab" role="tab"><i class="fa fa-flask"></i> SDT</a></li>
               </ul>
               <div class="tab-content config-tab-content">
                  <!-- CE Config -->
                  <div class="tab-pane active" id="cfg-tab-cond" role="tabpanel">
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-arrows-alt"></i> Ejes</h6>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje X — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-cond-x-title"
                                    value="CE Terreno (µS/cm, 25°C)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-cond-x-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-cond-x-max" value=""
                                    step="any" placeholder="Auto">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje Y — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-cond-y-title"
                                    value="CE Laboratorio (µS/cm, 25°C)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-cond-y-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-cond-y-max" value=""
                                    step="any" placeholder="Auto">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-paint-brush"></i> Series de Datos</h6>
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(52,152,219,0.65)"></span> Color OK</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-cond-color-ok" value="#3498db">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(231,76,60,0.65)"></span> Color Fuera</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-cond-color-fuera"
                                    value="#e74c3c">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><i class="fa fa-circle-o"></i> Radio Marcador</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-cond-marker-radius" value="6"
                                    min="2" max="20">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-minus"></i> Líneas de Referencia</h6>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-cond-line-m1" checked> Recta m=1</label>
                           <input type="color" class="cfg-color-sm" id="cfg-cond-line-m1-color" value="#333333">
                        </div>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-cond-line-10" checked> ±10%</label>
                           <input type="color" class="cfg-color-sm" id="cfg-cond-line-10-color" value="#e74c3c">
                        </div>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-cond-line-20" checked> ±20%</label>
                           <input type="color" class="cfg-color-sm" id="cfg-cond-line-20-color" value="#27ae60">
                        </div>
                     </div>
                  </div>
                  <!-- pH Config -->
                  <div class="tab-pane" id="cfg-tab-ph" role="tabpanel">
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-arrows-alt"></i> Ejes</h6>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje X — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-ph-x-title"
                                    value="pH Terreno (u.pH)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-ph-x-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-ph-x-max" value="14"
                                    step="any">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje Y — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-ph-y-title"
                                    value="pH Laboratorio (u.pH)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-ph-y-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-ph-y-max" value="14"
                                    step="any">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-paint-brush"></i> Series de Datos</h6>
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(52,152,219,0.65)"></span> Color OK</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-ph-color-ok" value="#3498db">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(231,76,60,0.65)"></span> Color Fuera</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-ph-color-fuera"
                                    value="#e74c3c">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><i class="fa fa-circle-o"></i> Radio Marcador</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-ph-marker-radius" value="6"
                                    min="2" max="20">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-minus"></i> Líneas de Referencia</h6>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-ph-line-m1" checked> m = 1</label>
                           <input type="color" class="cfg-color-sm" id="cfg-ph-line-m1-color" value="#333333">
                        </div>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-ph-line-05" checked> ±0.5 u pH</label>
                           <input type="color" class="cfg-color-sm" id="cfg-ph-line-05-color" value="#e74c3c">
                        </div>
                     </div>
                  </div>
                  <!-- SDT Config -->
                  <div class="tab-pane" id="cfg-tab-sdt" role="tabpanel">
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-arrows-alt"></i> Ejes</h6>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje X — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-sdt-x-title"
                                    value="Conductividad Laboratorio (µS/cm, 25°C)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-sdt-x-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx X</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-sdt-x-max" value="" step="any"
                                    placeholder="Auto">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="cfg-group">
                                 <label class="cfg-label">Eje Y — Título</label>
                                 <input type="text" class="form-control cfg-input" id="cfg-sdt-y-title" value="SDT (mg/L)">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Mín Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-sdt-y-min" value="0"
                                    step="any">
                              </div>
                           </div>
                           <div class="col-sm-3">
                              <div class="cfg-group">
                                 <label class="cfg-label">Máx Y</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-sdt-y-max" value="" step="any"
                                    placeholder="Auto">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-paint-brush"></i> Series de Datos</h6>
                        <div class="row">
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(52,152,219,0.65)"></span> Color OK</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-sdt-color-ok" value="#3498db">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><span class="cfg-color-dot"
                                       style="background: rgba(231,76,60,0.65)"></span> Color Fuera</label>
                                 <input type="color" class="form-control cfg-color" id="cfg-sdt-color-fuera"
                                    value="#e74c3c">
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <div class="cfg-group">
                                 <label class="cfg-label"><i class="fa fa-circle-o"></i> Radio Marcador</label>
                                 <input type="number" class="form-control cfg-input" id="cfg-sdt-marker-radius" value="6"
                                    min="2" max="20">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cfg-section">
                        <h6 class="cfg-section-title"><i class="fa fa-minus"></i> Líneas de Referencia</h6>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-sdt-line-07" checked> m = 0.7</label>
                           <input type="color" class="cfg-color-sm" id="cfg-sdt-line-07-color" value="#3498db">
                        </div>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-sdt-line-09" checked> m = 0.9</label>
                           <input type="color" class="cfg-color-sm" id="cfg-sdt-line-09-color" value="#e74c3c">
                        </div>
                        <div class="cfg-refline-row">
                           <label class="cfg-check"><input type="checkbox" id="cfg-sdt-line-055" checked> m = 0.55</label>
                           <input type="color" class="cfg-color-sm" id="cfg-sdt-line-055-color" value="#e74c3c">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer config-modal-footer">
               <button type="button" class="btn btn-default" id="btn-cfg-reset"><i class="fa fa-undo"></i>
                  Restablecer</button>
               <div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" id="btn-cfg-apply"><i class="fa fa-check"></i> Aplicar
                     Cambios</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Modal de Configuración Histórico -->
   <div class="modal fade" id="modalConfiguracionHist" tabindex="-1" role="dialog" aria-labelledby="modalConfigHistLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2);">
            <div class="modal-header"
               style="background: #f8f9fa; border-bottom: 1px solid #eee; border-radius: 8px 8px 0 0;">
               <h4 class="modal-title" id="modalConfigHistLabel"
                  style="font-weight: 700; color: #333; font-family: 'Outfit', sans-serif;">
                  <i class="fa fa-sliders text-primary mr-2"></i> Ajustes de Visualización Avanzada
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="margin-top: -25px;">
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
                              <input type="checkbox" id="cfg-use-dual-axis-hist">
                              <span class="slider round"></span>
                           </div>
                        </label>
                        <p class="text-muted mb-0" style="font-size: 9px; margin-top: 5px;">Habilite esta opción para
                           graficar parámetros en escalas diferentes (Y1 e Y2).</p>
                     </div>

                     <div id="axes-config-container-hist">
                        <p class="text-muted small">Cargue datos para habilitar los ajustes de ejes.</p>
                     </div>
                  </div>

                  <!-- Series -->
                  <div class="col-md-6">
                     <h5
                        style="font-weight: 700; color: #555; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 8px;">
                        <i class="fa fa-paint-brush mr-2"></i> Personalización de Series
                     </h5>
                     <div id="series-config-container-hist" style="max-height: 400px; overflow-y: auto;">
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
                              <input type="text" id="cfg-chart-title-hist" class="form-control input-sm"
                                 placeholder="Ej: Análisis Histórico - Sector Los Helados">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="small font-weight-bold text-muted">Etiqueta Eje X</label>
                              <input type="text" id="cfg-xaxis-title-hist" class="form-control input-sm"
                                 placeholder="Ej: Fecha de muestreo">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
            <div class="modal-footer" style="background: #f8f9fa; border-top: 1px solid #eee; border-radius: 0 0 8px 8px;">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
               <button type="button" id="btn-apply-general-hist" class="btn btn-primary">Guardar
                  Cambios</button>
            </div>
         </div>
      </div>
   </div>

@endsection

@push('css')
   <!-- Bootstrap Selectpicker CSS -->
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
   <!-- Tabulator CSS -->
   <link href="https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">
   <style>
      /* Modal QA/QC Configuración Premium */
      .config-modal-content {
         border-radius: 8px;
         border: none;
         box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
         overflow: hidden;
      }

      .config-modal-header {
         background: #f8f9fa;
         border-bottom: 1px solid #e9ecef;
         padding: 16px 24px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .config-modal-header .modal-title {
         font-size: 16px;
         font-weight: 700;
         color: #495057;
         margin: 0;
         display: flex;
         align-items: center;
      }

      .config-modal-header .modal-title i {
         color: #0088cc;
         margin-right: 8px;
         font-size: 18px;
      }

      .config-modal-header .close {
         color: #6c757d !important;
         opacity: 0.6;
         font-size: 24px;
         font-weight: 300;
         line-height: 1;
         margin-top: -5px;
         transition: opacity 0.2s;
      }

      .config-modal-header .close:hover {
         opacity: 1;
      }

      /* Tabs */
      .config-nav-tabs {
         border-bottom: 1px solid #dee2e6;
         padding: 0 15px;
         background: #fff;
         margin: 0;
      }

      .config-nav-tabs>li {
         margin-bottom: -1px;
      }

      .config-nav-tabs>li>a {
         color: #6c757d;
         font-weight: 600;
         font-size: 14px;
         padding: 12px 20px;
         border: 1px solid transparent;
         border-top-left-radius: 4px;
         border-top-right-radius: 4px;
         margin-right: 2px;
         transition: all 0.2s ease-in-out;
      }

      .config-nav-tabs>li>a:hover {
         background-color: #f8f9fa;
         color: #495057;
         border-color: #e9ecef #e9ecef #dee2e6;
      }

      .config-nav-tabs>li.active>a,
      .config-nav-tabs>li.active>a:focus,
      .config-nav-tabs>li.active>a:hover {
         color: #495057;
         background-color: #fff;
         border-color: #dee2e6 #dee2e6 #fff;
         border-top: 3px solid #0088cc;
      }

      /* Tab Content Inner */
      .config-tab-content {
         padding: 0;
         border: none;
         background: #fff;
      }

      .cfg-section {
         padding: 20px 24px;
         border-bottom: 1px solid #f1f3f5;
      }

      .cfg-section:last-child {
         border-bottom: none;
      }

      .cfg-section-title {
         font-size: 13px;
         font-weight: 700;
         color: #adb5bd;
         text-transform: uppercase;
         letter-spacing: 0.5px;
         margin-bottom: 16px;
         display: flex;
         align-items: center;
      }

      .cfg-section-title i {
         margin-right: 6px;
         font-size: 14px;
      }

      .cfg-group {
         margin-bottom: 15px;
      }

      .cfg-label {
         display: block;
         font-size: 13px;
         font-weight: 600;
         color: #495057;
         margin-bottom: 6px;
      }

      .cfg-input {
         height: 38px;
         border: 1px solid #ced4da;
         border-radius: 4px;
         box-shadow: none;
         font-size: 14px;
         transition: border-color 0.2s, box-shadow 0.2s;
      }

      .cfg-input:focus {
         border-color: #80bdff;
         box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
      }

      .cfg-color {
         height: 38px;
         padding: 3px 5px;
         border: 1px solid #ced4da;
         border-radius: 4px;
         cursor: pointer;
         box-shadow: none;
      }

      .cfg-color-dot {
         display: inline-block;
         width: 12px;
         height: 12px;
         border-radius: 50%;
         margin-right: 4px;
         vertical-align: -1px;
      }

      .cfg-checkbox {
         margin-top: 10px;
      }

      /* Footer Container inside Tab */
      .config-modal-footer {
         padding: 16px 24px;
         background: #f8f9fa;
         border-top: 1px solid #e9ecef;
         border-bottom-left-radius: 8px;
         border-bottom-right-radius: 8px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .config-modal-footer .btn {
         font-weight: 600;
         font-size: 14px;
      }

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
         flex-wrap: nowrap;
         /* Force exactly one line */
         align-items: stretch;
         /* Stretch to fill vertically if needed, but we use flex-end mostly */
         gap: 8px;
         /* Slightly tighter gap to fit 8 elements comfortably */
         width: 100%;
      }

      .filter-item {
         flex: 1 1 0;
         /* Mathematical exactness: each box takes exactly the same width */
         min-width: 0;
         /* Allows shrinking below content width to fit single line */
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
      .tabulator-col,
      .tabulator-col-content {
         background-color: #f0f2f5 !important;
         /* Mismo color que el header pero opaco */
         border-right: 1px solid #dde1e5 !important;
      }

      /* AÃƒÆ’Ã‚Â±adir la grilla vertical en todas las celdas */
      .tabulator-cell {
         border-right: 1px solid #dde1e5 !important;
      }

      .tabulator-col-title {
         padding: 6px 8px !important;
         /* Reducir padding vertical */
         font-size: 13px !important;
         text-transform: none !important;
         /* No mayÃƒÆ’Ã‚Âºsculas */
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

      /* PersonalizaciÃƒÆ’Ã‚Â³n de los filtros en el header */
      .tabulator-header-filter {
         padding: 3px 6px 6px 6px !important;
         /* Reducir padding superior */
         background-color: #f0f2f5 !important;
      }

      .tabulator-header-filter input {
         border: 1px solid #cbd2d9 !important;
         border-radius: 4px !important;
         padding: 4px 6px !important;
         /* Reducir padding interno del input */
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

      .btn-status-0 {
         background-color: #f39c12;
         color: #fff;
         border-color: #e67e22;
      }

      /* Naranja */
      .btn-status-1 {
         background-color: #27ae60;
         color: #fff;
         border-color: #2ecc71;
      }

      /* Verde */
      .btn-status-2 {
         background-color: #2980b9;
         color: #fff;
         border-color: #3498db;
      }

      /* Azul */
      .btn-status:hover {
         opacity: 0.8;
         transform: scale(1.05);
      }

      .cell-modified {
         background-color: #ffff00 !important;
         color: #000 !important;
         font-weight: bold;
      }

      /* ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ QA/QC Modal Premium Styles ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ */
      .qaqc-modal-content {
         border: none;
         border-radius: 8px;
         overflow: hidden;
         box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
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

      .qaqc-nav-tabs>li>a {
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

      .qaqc-nav-tabs>li>a:hover {
         background: transparent;
         color: #2c3e50;
         border-bottom-color: #bdc3c7;
      }

      .qaqc-nav-tabs>li.active>a,
      .qaqc-nav-tabs>li.active>a:focus,
      .qaqc-nav-tabs>li.active>a:hover {
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

      .qaqc-nav-tabs>li.active .qaqc-badge {
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
         display: inline-flex;
         align-items: center;
         gap: 5px;
         font-weight: 700;
         color: #27ae60;
         font-size: 12px;
      }

      .qc-result-no {
         display: inline-flex;
         align-items: center;
         gap: 5px;
         font-weight: 700;
         color: #e74c3c;
         font-size: 12px;
      }

      .qc-result-ok i,
      .qc-result-no i {
         font-size: 13px;
      }

      /* Tab pane transition */
      .qaqc-tab-content>.tab-pane {
         display: none;
      }

      .qaqc-tab-content>.active {
         display: block;
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
         let currentHistoricalChart = null;
         let chartDataHist = null;
         let chartMetaHist = null;

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

         // Permisos de usuario
         const currentUser = {
            name: "{{ auth()->user()->name }}",
            type: parseInt("{{ auth()->user()->type_user }}")
         };

         // Formateador personalizado para Estatus
         const estatusFormatter = function (cell) {
            const val = parseInt(cell.getValue());
            let icon = "fa-lock-open", title = "Pendiente", cls = "btn-status-0";
            if (val === 1) { icon = "fa-lock"; title = "Aprobado JP"; cls = "btn-status-1"; }
            else if (val === 2) { icon = "fa-unlock-alt"; title = "Aprobado Analista"; cls = "btn-status-2"; }
            return `<button class="btn-status ${cls}" title="${title}"><i class="fa ${icon}"></i></button>`;
         };

         window.checkEditStatus = function (cell) {
            return parseInt(cell.getData().estatus) === 0;
         };

         window.paramModifiedFormatter = function (cell) {
            let val = cell.getValue();
            if (val !== null && val !== undefined && val !== '' && val !== 'ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â¢') {
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

         // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ 1. TABULATOR (columnas dinÃƒÆ’Ã‚Â¡micas) ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
         let table;
         $.get('{{ url("/api/control-calidad/columns") }}', function (columns) {
            columns.forEach(col => {
               if (col.field === 'estatus') {
                  col.formatter = estatusFormatter;
                  col.cellClick = function (e, cell) { abrirModalStatus([cell.getData().certificado]); };
               }
               if (col.editable === 'checkEditStatus') col.editable = window.checkEditStatus;
               if (col.formatter === 'paramModifiedFormatter') col.formatter = window.paramModifiedFormatter;
            });

            // Agregar columna de selecciÃƒÆ’Ã‚Â³n (Checkbox) al inicio
            columns.unshift({
               formatter: "rowSelection",
               titleFormatter: "rowSelection",
               hozAlign: "center",
               headerSort: false,
               frozen: true,
               width: 40
            });

            table = new Tabulator("#tabla-muestras", {
               layout: "fitColumns",
               placeholder: "Sin datos disponibles",
               columns: columns,
               height: "500px",
               selectableRows: true, // Habilitar selecciÃƒÆ’Ã‚Â³n de filas
               pagination: "local",
               paginationSize: 20,
               paginationSizeSelector: [10, 20, 50, 100],
               paginationCounter: "rows"
            });

            table.on("cellEdited", function (cell) {
               const data = cell.getData();
               const colDef = cell.getColumn().getDefinition();
               const newValue = cell.getValue();
               const oldValue = cell.getOldValue();

               if (newValue == oldValue) return;

               // Extract id_parametro from field name just in case colDef property is missing/stripped
               const fieldName = cell.getField();
               let extractedId = null;
               if (fieldName && fieldName.includes('_')) {
                  extractedId = parseInt(fieldName.split('_')[1]);
               }
               const finalIdParam = colDef.id_parametro || extractedId;
               const finalNombre = colDef.nombre_parametro || (colDef.title ? colDef.title.replace(/<[^>]*>?/gm, '') : fieldName);

               Swal.fire({
                  title: 'Modificando valor...',
                  text: `El valor de ${finalNombre} cambiará ¡ de ${oldValue} a ${newValue}.`,
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
                           'Accept': 'application/json',
                           'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                           certificado: data.certificado,
                           id_parametro: finalIdParam,
                           nombre_parametro: finalNombre,
                           valor_nuevo: newValue,
                           valor_anterior: oldValue
                        })
                     })
                        .then(async res => {
                           if (!res.ok) {
                              let errorMsg = 'No se pudo actualizar el registro';
                              try {
                                 const err = await res.json();
                                 errorMsg = err.error || err.message || errorMsg;
                              } catch (e) { }
                              throw new Error(errorMsg);
                           }
                           return res.json();
                        })
                        .then(res => {
                           if (res.error) throw new Error(res.error);
                           Swal.fire({ icon: 'success', text: res.message || 'Actualizado', timer: 1500, showConfirmButton: false });
                           let updatedData = {}; updatedData["band_edit_" + finalIdParam] = 1;
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
            });
         });

         // ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ 2. CARGA DE FILTROS ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬Â Ã¢â€šÂ¬
         let allEstaciones = [];
         $.get('{{ url("/api/control-calidad/filters") }}', function (data) {
            // Depósitos
            $.each(data.depositos, function (i, d) {
               $('#select-sector').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
               $('#select-sector-chart').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
               $('#select-sector-qaqc').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
            });
            $('#select-sector').val(1);
            $('#select-sector-chart').val(1);
            $('#select-sector-qaqc').val(1);

            // Estaciones (Agrupadas)
            allEstaciones = data.estaciones;
            const heladosGroup = $('<optgroup>', { label: 'Los Helados' });
            const otrosGroup = $('<optgroup>', { label: 'Otras Estaciones' });
            const heladosGroupChart = $('<optgroup>', { label: 'Los Helados' });
            const otrosGroupChart = $('<optgroup>', { label: 'Otras Estaciones' });
            const heladosGroupQAQC = $('<optgroup>', { label: 'Los Helados' });
            const otrosGroupQAQC = $('<optgroup>', { label: 'Otras Estaciones' });

            $.each(allEstaciones, function (i, e) {
               const opt = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               const optChart = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               const optQAQC = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               if (parseInt(e.clasificacion) === 1) {
                  heladosGroup.append(opt);
                  heladosGroupChart.append(optChart);
                  heladosGroupQAQC.append(optQAQC);
               } else {
                  otrosGroup.append(opt);
                  otrosGroupChart.append(optChart);
                  otrosGroupQAQC.append(optQAQC);
               }
            });

            $('#filtro-estaciones').empty().append(heladosGroup).append(otrosGroup);
            $('#filtro-estaciones-chart').empty().append(heladosGroupChart).append(otrosGroupChart);
            $('#filtro-estaciones-qaqc').empty().append(heladosGroupQAQC).append(otrosGroupQAQC);
            $('#filtro-estaciones').prop('disabled', false);
            $('#filtro-estaciones-chart').prop('disabled', false);
            $('#filtro-estaciones-qaqc').prop('disabled', false);

            // Años, Meses, Programas, Parámetros
            $.each(data.years, function (i, y) {
               $('#filtro-anios').append($('<option>', { value: y, text: y }));
               if ($('#filtro-anios-qaqc').length) $('#filtro-anios-qaqc').append($('<option>', { value: y, text: y }));
               if ($('#filtro-anios-chart').length) $('#filtro-anios-chart').append($('<option>', { value: y, text: y }));
            });
            $.each(data.meses, function (i, m) {
               $('#filtro-meses').append($('<option>', { value: m.id, text: m.nombre }));
               if ($('#filtro-meses-qaqc').length) $('#filtro-meses-qaqc').append($('<option>', { value: m.id, text: m.nombre }));
               if ($('#filtro-meses-chart').length) $('#filtro-meses-chart').append($('<option>', { value: m.id, text: m.nombre }));
            });
            $.each(data.programas, function (i, p) {
               $('#filtro-indicador').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
               $('#filtro-indicador-chart').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
               $('#filtro-indicador-qaqc').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
            });
            $.each(data.normas || [], function (i, n) {
               $('#filtro-norma-chart').append($('<option>', { value: n.id_norma, text: n.nombre }));
            });
            $.each(data.parametros, function (i, p) {
               const normalized = window.normalizeText ? window.normalizeText(p.nombre) : p.nombre;
               $('#filtro-parametros-chart').append($('<option>', { value: p.id_parametro, text: p.nombre, 'data-tokens': normalized }));
               $('#filtro-parametros-qaqc').append($('<option>', { value: p.id_parametro, text: p.nombre, 'data-tokens': normalized }));
            });
            $('.selectpicker').selectpicker('refresh');
         });

         // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ 4. BOTONES TABLA ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
         $('#btn-filtrar').on('click', function () {
            let stations = $('#filtro-estaciones').val(), estatus = $('#filtro-estatus').val(), months = $('#filtro-meses').val(), years = $('#filtro-anios').val();
            if (!stations || !months || !years) return Swal.fire({ icon: 'warning', text: 'Seleccione filtros.' });
            let params = { stations, months, years, estatus, indicador: [$('#filtro-indicador').val() || "1"] };
            let btn = $(this); btn.prop('disabled', true);
            fetch("{{ url('/api/control-calidad/filtrar') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify(params)
            })
               .then(res => res.json())
               .then(data => { table.setData(data); btn.prop('disabled', false); })
               .catch(() => { btn.prop('disabled', false); });
         });


         $('#btn-select-all').on('click', function () { if (table) table.selectRow(); });

         $('#btn-bulk-status').on('click', function () {
            let selectedData = table.getSelectedData();
            if (selectedData.length === 0) return Swal.fire({ icon: 'warning', text: 'Seleccione muestras.' });
            abrirModalStatus(selectedData.map(d => d.certificado));
         });

         $('#btn-bulk-pendiente').on('click', function () {
            let selectedData = table.getSelectedData();
            if (selectedData.length === 0) return Swal.fire({ icon: 'warning', text: 'Seleccione muestras.' });
            let certs = selectedData.map(d => d.certificado);
            Swal.fire({ title: 'Desea ¿Marcar como pendientes?', icon: 'warning', showCancelButton: true }).then((r) => { if (r.isConfirmed) actualizarEstatusMasivo(certs, 0); });
         });

         function actualizarEstatusMasivo(certs, nuevoStatus) {
            fetch('{{ url("/api/control-calidad/update-estatus") }}', {
               method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
               body: JSON.stringify({ certificados: certs, nuevo_estatus: nuevoStatus })
            }).then(() => { $('#btn-filtrar').click(); });
         }

         // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ 4.3 LOG DE MODIFICACIONES ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
         let tableHistorial;
         $('#btn-view-historial').on('click', function () {
            let selectedData = table.getSelectedData();
            if (selectedData.length !== 1) return Swal.fire({ icon: 'info', text: 'Seleccione exactamente una muestra.' });

            const certificadoRaw = selectedData[0].certificado;

            $('#modalHistorial').modal('show');

            $('#modalHistorial').one('shown.bs.modal', function () {
               if (tableHistorial) tableHistorial.destroy();

               tableHistorial = new Tabulator("#tabla-historial", {
                  layout: "fitColumns",
                  placeholder: "Sin modificaciones para este certificado",
                  columns: [
                     { title: "ParÃƒÆ’Ã‚Â¡metro", field: "nombre_parametro", widthGrow: 2 },
                     { title: "Anterior", field: "valor_anterior", hozAlign: "center", widthGrow: 1 },
                     { title: "Nuevo", field: "valor_nuevo", hozAlign: "center", widthGrow: 1 },
                     { title: "Usuario", field: "usuario", hozAlign: "center", widthGrow: 1 },
                     { title: "Fecha", field: "fecha", hozAlign: "center", widthGrow: 1 }
                  ],
                  data: []
               });

               const url = '{{ url("/api/control-calidad/historial") }}?certificado=' + encodeURIComponent(certificadoRaw);
               fetch(url)
                  .then(res => res.json())
                  .then(data => {
                     if (Array.isArray(data)) {
                        tableHistorial.setData(data).then(() => {
                           // Force a redraw after data is loaded to ensure alignment
                           setTimeout(() => { tableHistorial.redraw(); }, 100);
                        });
                     } else if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                     }
                  })
                  .catch(e => {
                     console.error("Fetch history failed:", e);
                  });
            });
         });

         function abrirModalStatus(certificados) {
            $('#status-certificados').val(certificados.join(','));
            $('#status-display-user').text(currentUser.name);
            $('#select-nuevo-estatus option[value="1"]').prop('disabled', currentUser.type !== 1);
            $('#select-nuevo-estatus').selectpicker('refresh');
            $('#modalEstatus').modal('show');
         }

         $('#btn-actualizar-status').on('click', function () {
            fetch('{{ url("/api/control-calidad/update-estatus") }}', {
               method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
               body: JSON.stringify({ certificados: $('#status-certificados').val().split(','), nuevo_estatus: $('#select-nuevo-estatus').val() })
            }).then(() => { $('#modalEstatus').modal('hide'); $('#btn-filtrar').click(); });
         });

         // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ 5. IMPORTACION EXCEL ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
         $('#btnProcesarExcel').on('click', function () {
            var formData = new FormData(); formData.append('dataxls', $('#dataxls')[0].files[0]); formData.append('_token', '{{ csrf_token() }}');
            var $btn = $(this); $btn.prop('disabled', true).html('Procesando...');
            $.ajax({
               url: '{{ url("/muestras/importar") }}', type: 'POST', data: formData, contentType: false, processData: false,
               success: function () { $btn.prop('disabled', false).html('Procesar'); $('#modalCargar').modal('hide'); $('#btn-filtrar').click(); }
            });
         });

         // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ 6. GRAFICO HISTORICO ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
         $('#btn-graficar').on('click', function () {
            let stations = $('#filtro-estaciones-chart').val(),
               parametros = $('#filtro-parametros-chart').val(),
               indicador = $('#filtro-indicador-chart').val(),
               estatus = $('#filtro-estatus-chart').val(),
               id_norma = $('#filtro-norma-chart').val() || [];

            if (!stations || !parametros) return Swal.fire({ icon: 'warning', text: 'Seleccione filtros.' });
            let $btn = $(this); $btn.prop('disabled', true).html('Graficando...');
            fetch("{{ url('/api/control-calidad/chart-data') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify({ stations, parametros, indicador, estatus, id_norma })
            }).then(res => res.json()).then(data => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
               chartDataHist = data.raw;
               chartMetaHist = data.parametros_info;
               chartNormaData = data.norma || null;
               renderHistoricalChart();
               buildModalConfigHist();
            });
         });

         function renderHistoricalChart() {
            if (!chartDataHist || chartDataHist.length === 0) return;
            const series = [], yAxes = [];
            const pIDs = Object.keys(chartMetaHist);
            const useDual = $('#cfg-use-dual-axis-hist').is(':checked');

            pIDs.forEach((pID, idx) => {
               const stationsInRaw = [...new Set(chartDataHist.map(item => item.estacion))];
               let allDataValues = []; // Recopilar todos los valores de datos para este parámetro

               stationsInRaw.forEach((stName, sIdx) => {
                  const points = chartDataHist
                     .filter(item => item.estacion === stName)
                     .map(item => {
                        const d = item.fecha_label.split('-');
                        let rawVal = String(item['parametro_' + pID] || '').replace(',', '.');
                        let cleanVal = parseFloat(rawVal.replace('<', '').replace('>', ''));
                        if (!isNaN(cleanVal)) {
                           allDataValues.push(cleanVal); // Agregar a la lista de valores de datos
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
                        userOptions: { unit: chartMetaHist[pID].unidad }
                     });
                  }
               });

               if (idx === 0 || (useDual && idx === 1)) {
                  const normaRanges = chartNormaData?.ranges || {};
                  const paramRanges = normaRanges[pID] || [];
                  const plotLines = [];
                  const unit = chartMetaHist[pID].unidad ? ' ' + chartMetaHist[pID].unidad : '';

                  // Recopilar valores de normas (con guard contra NaN)
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

                  // Calcular softMin/softMax incluyendo datos y normas.
                  // softMin/softMax: el eje se expande si los datos lo requieren,
                  // pero garantiza que las normas sean siempre visibles.
                  let axisSoftMin = undefined;
                  let axisSoftMax = undefined;
                  const allValues = [...allDataValues, ...normaValues].filter(v => !isNaN(v) && isFinite(v));
                  if (allValues.length > 0) {
                     const vMin = Math.min(...allValues);
                     const vMax = Math.max(...allValues);
                     const rng = vMax - vMin;
                     // Padding: 12% del rango, o fallback cuando todos los valores son iguales
                     const pad = rng > 0 ? rng * 0.12 : Math.max(Math.abs(vMax) * 0.1, 1);
                     axisSoftMin = vMin - pad;
                     axisSoftMax = vMax + pad;
                  }

                  yAxes.push({
                     title: {
                        text: chartMetaHist[pID].nombre_largo + ' [' + chartMetaHist[pID].unidad + ']',
                        style: { color: idx === 0 ? '#337ab7' : '#5cb85c', fontWeight: 'bold', fontSize: '14px' }
                     },
                     gridLineColor: '#f3f3f3',
                     labels: { style: { color: '#666', fontSize: '13px' } },
                     opposite: idx === 1,
                     plotLines: plotLines.length ? plotLines : undefined,
                     softMin: axisSoftMin,
                     softMax: axisSoftMax
                  });
               }
            });

            currentHistoricalChart = Highcharts.chart('chart-historico', {
               title: { text: null },
               subtitle: {
                  text: chartNormaData?.ids?.length ? 'Normas activas: ' + (chartNormaData.nombres ? Object.values(chartNormaData.nombres).join(', ') : chartNormaData.ids.join(', ')) : null
               },
               xAxis: { type: 'datetime', labels: { style: { fontSize: '14px', color: '#333' } } },
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
               legend: { enabled: true, itemStyle: { fontSize: '14px', fontWeight: 'normal' } },
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

         function buildModalConfigHist() {
            if (!currentHistoricalChart) return;

            let axisHTML = '';
            currentHistoricalChart.yAxis.forEach((ax, i) => {
               axisHTML += `
                                    <div class="cfg-group-card" style="background: #fff; border: 1px solid #f0f0f0; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                                          <span style="font-size: 9px; font-weight:700; color:#999; text-transform:uppercase; margin-bottom:4px; display:block;">EJE ${i === 0 ? 'PRIMARIO' : 'SECUNDARIO'}</span>
                                          <div class="row">
                                             <div class="col-xs-4"><label class="small text-muted">Lím. Sup</label><input type="number" class="form-control input-sm ax-u-hist" data-idx="${i}" value="${ax.max || ''}"></div>
                                             <div class="col-xs-4"><label class="small text-muted">Lím. Inf</label><input type="number" class="form-control input-sm ax-l-hist" data-idx="${i}" value="${ax.min || ''}"></div>
                                             <div class="col-xs-4"><label class="small text-muted">Invertir</label><div class="btn btn-default btn-xs btn-block ax-inv-hist ${ax.reversed ? 'btn-info' : ''}" data-idx="${i}" style="margin-top:2px;">INV</div></div>
                                          </div>
                                    </div>`;
            });
            $('#axes-config-container-hist').html(axisHTML);

            let seriesHTML = '';
            currentHistoricalChart.series.forEach((s, i) => {
               seriesHTML += `
                                    <div class="cfg-group-card p-2" style="background: #fff; border: 1px solid #f0f0f0; padding: 15px; border-radius: 6px; margin-bottom: 8px;">
                                          <div class="row no-gutters align-items-center">
                                             <div class="col-xs-6"><span style="font-size: 10px; font-weight:700; color:#666;">${s.name}</span></div>
                                             <div class="col-xs-2"><div style="background:${s.color}; width:100%; height:28px; border-radius:4px; border:1px solid #ddd; cursor:pointer;"><input type="color" class="s-c-hist" data-idx="${i}" value="${s.color}" style="opacity:0; width:100%; height:100%; cursor:pointer;"></div></div>
                                             <div class="col-xs-4 pl-1">
                                                <select class="form-control input-sm s-t-hist" data-idx="${i}">
                                                      <option value="line" ${s.type === 'line' ? 'selected' : ''}>Line</option>
                                                      <option value="spline" ${s.type === 'spline' ? 'selected' : ''}>Spline</option>
                                                      <option value="column" ${s.type === 'column' ? 'selected' : ''}>Bars</option>
                                                      <option value="area" ${s.type === 'area' ? 'selected' : ''}>Area</option>
                                                </select>
                                             </div>
                                          </div>
                                    </div>`;
            });
            $('#series-config-container-hist').html(seriesHTML);
         }

         $(document).on('change', '.ax-u-hist, .ax-l-hist', function () {
            const i = $(this).data('idx');
            const max = parseFloat($(`.ax-u-hist[data-idx="${i}"]`).val());
            const min = parseFloat($(`.ax-l-hist[data-idx="${i}"]`).val());
            if (currentHistoricalChart) currentHistoricalChart.yAxis[i].update({ max: isNaN(max) ? null : max, min: isNaN(min) ? null : min });
         });

         $(document).on('click', '.ax-inv-hist', function () {
            const i = $(this).data('idx');
            $(this).toggleClass('btn-info');
            if (currentHistoricalChart) currentHistoricalChart.yAxis[i].update({ reversed: $(this).hasClass('btn-info') });
         });

         $(document).on('input', '.s-c-hist', function () {
            const i = $(this).data('idx');
            const col = $(this).val();
            $(this).parent().css('background', col);
            if (currentHistoricalChart) currentHistoricalChart.series[i].update({ color: col });
         });

         $(document).on('change', '.s-t-hist', function () {
            const i = $(this).data('idx');
            if (currentHistoricalChart) currentHistoricalChart.series[i].update({ type: $(this).val() });
         });

         $('#cfg-use-dual-axis-hist').on('change', function () {
            if (currentHistoricalChart) {
               renderHistoricalChart();
               buildModalConfigHist();
            }
         });

         $('#btn-apply-general-hist').on('click', function () {
            if (currentHistoricalChart) {
               currentHistoricalChart.update({
                  title: { text: $('#cfg-chart-title-hist').val() || null },
                  xAxis: { title: { text: $('#cfg-xaxis-title-hist').val() || null } }
               });
               Swal.fire({ icon: 'success', title: 'Ajustes guardados', timer: 1500, showConfirmButton: false });
            }
         });

         $('#btn-qa-qc').on('click', function () {
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
            // Helper: parse numeric from cell value
            const pn = (v) => { let s = String(v || '').replace(',', '.').replace(/[<>]/g, ''); return parseFloat(s); };
            const fmt = (v, d) => { if (isNaN(v)) return 'Parametros'; return v.toLocaleString('es-CL', { minimumFractionDigits: d, maximumFractionDigits: d }); };

            // Build raw arrays for charts AND tables

            const pointsCond = [], pointsPH = [], pointsSDT = [];
            const rowsCond = [], rowsPH = [], rowsSDT = [];

            data.forEach(item => {
               const est = item.estacion || 'S/E';
               const cert = item.certificado || '';
               const fecha = item.fecha || '';

               // CE
               let cLab = pn(item.parametro_26), cTerr = pn(item.parametro_27);
               if (!isNaN(cLab) && !isNaN(cTerr) && cLab !== 0) {
                  let cociente = cTerr / cLab;
                  let diff = Math.abs(cLab - cTerr) / cTerr;
                  let isOK = diff <= 0.10;
                  pointsCond.push({ x: cTerr, y: cLab, isOK, cert, est, fecha });
                  rowsCond.push({ certificado: cert, estacion: est, fecha, ce_terreno: cTerr, ce_lab: cLab, cociente, isOK });
               }

               // pH
               let pLab = pn(item.parametro_65), pTerr = pn(item.parametro_66);
               if (!isNaN(pLab) && !isNaN(pTerr) && pLab !== 0) {
                  let cociente = pTerr / pLab;
                  let dif = Math.abs(pLab - pTerr);
                  let isOK = dif <= 0.5;
                  pointsPH.push({ x: pTerr, y: pLab, isOK, cert, est, fecha });
                  rowsPH.push({ certificado: cert, estacion: est, fecha, ph_terreno: pTerr, ph_lab: pLab, cociente, dif, isOK });
               }

               // SDT
               let sdtVal = pn(item.parametro_14), cl = pn(item.parametro_26);
               if (!isNaN(sdtVal) && !isNaN(cl) && cl !== 0) {
                  let cociente = sdtVal / cl;
                  let isOK = cociente >= 0.55 && cociente <= 0.9;
                  pointsSDT.push({ x: cl, y: sdtVal, isOK, cert, est, fecha });
                  rowsSDT.push({ certificado: cert, estacion: est, fecha, sdt_val: sdtVal, ce_lab: cl, cociente, isOK });
               }
            });

            // Update tab badges
            $('#badge-qc-cond').text(rowsCond.length);
            $('#badge-qc-ph').text(rowsPH.length);
            $('#badge-qc-sdt').text(rowsSDT.length);

            // Chart colors & helpers
            const colorOK = 'rgba(52, 152, 219, 0.65)';
            const colorFuera = 'rgba(231, 76, 60, 0.65)';

            const makeSeries = (pts) => [
               { name: 'OK', color: colorOK, data: pts.filter(p => p.isOK).map(p => ({ x: p.x, y: p.y, cert: p.cert, est: p.est, fecha: p.fecha })), marker: { symbol: 'circle', radius: 6 } },
               { name: 'Fuera de Rango', color: colorFuera, data: pts.filter(p => !p.isOK).map(p => ({ x: p.x, y: p.y, cert: p.cert, est: p.est, fecha: p.fecha })), marker: { symbol: 'circle', radius: 6 } }
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
               formatter: function () {
                  const p = this.point;
                  return fields.map(f => f(p)).join('<br/>');
               }
            });

            // Axis maxes
            const maxCond = Math.max(...pointsCond.flatMap(p => [p.x, p.y]), 1000) * 1.1;
            const maxPH = 14;
            const maxSDT_X = Math.max(...pointsSDT.map(p => p.x), 1000) * 1.1;
            const maxSDT_Y = Math.max(...pointsSDT.map(p => p.y), 1000) * 1.1;

            // CHART: CE
            Highcharts.chart('chart-qc-cond', {
               ...common,
               title: { text: 'CE Laboratorio vs CE Terreno', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([
                  p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>',
                  p => 'Certificado: ' + (p.options.cert || ''),
                  p => 'Fecha: ' + (p.options.fecha || ''),
                  p => 'CE Terreno: <b>' + Highcharts.numberFormat(p.x, 2) + ' µS/cm</b>',
                  p => 'CE Laboratorio: <b>' + Highcharts.numberFormat(p.y, 2) + ' µS/cm</b>'
               ]),
               xAxis: { ...common.xAxis, title: { text: 'CE Terreno (µS/cm, 25°C)' }, min: 0, max: maxCond },
               yAxis: { ...common.yAxis, title: { text: 'CE Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxCond },
               series: [
                  ...makeSeries(pointsCond),
                  { type: 'line', name: 'Recta m=1', data: [[0, 0], [maxCond, maxCond]], color: '#333', dashStyle: 'Solid', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: '±10%', id: 'qc-cond-10', data: [[0, 0], [maxCond, maxCond * 1.1]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'qc-cond-10', data: [[0, 0], [maxCond, maxCond * 0.9]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false },
                  { type: 'line', name: '±20%', id: 'qc-cond-20', data: [[0, 0], [maxCond, maxCond * 1.2]], color: '#27ae60', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'qc-cond-20', data: [[0, 0], [maxCond, maxCond * 0.8]], color: '#27ae60', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false }
               ]
            });

            // CHART: pH
            Highcharts.chart('chart-qc-ph', {
               ...common,
               title: { text: 'pH Laboratorio vs pH Terreno', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([
                  p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>',
                  p => 'Certificado: ' + (p.options.cert || ''),
                  p => 'Fecha: ' + (p.options.fecha || ''),
                  p => 'pH Terreno: <b>' + Highcharts.numberFormat(p.x, 2) + ' u.pH</b>',
                  p => 'pH Laboratorio: <b>' + Highcharts.numberFormat(p.y, 2) + ' u.pH</b>'
               ]),
               xAxis: { ...common.xAxis, title: { text: 'pH Terreno (u.pH)' }, min: 0, max: maxPH },
               yAxis: { ...common.yAxis, title: { text: 'pH Laboratorio (u.pH)' }, min: 0, max: maxPH },
               series: [
                  ...makeSeries(pointsPH),
                  { type: 'line', name: 'm = 1', data: [[0, 0], [maxPH, maxPH]], color: '#333', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: '±0.5 u pH', id: 'qc-ph-05', data: [[0, 0.5], [maxPH - 0.5, maxPH]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'qc-ph-05', data: [[0.5, 0], [maxPH, maxPH - 0.5]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false }
               ]
            });

            // CHART: SDT
            Highcharts.chart('chart-qc-sdt', {
               ...common,
               title: { text: 'SDT vs Conductividad Laboratorio', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([
                  p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>',
                  p => 'Certificado: ' + (p.options.cert || ''),
                  p => 'Fecha: ' + (p.options.fecha || ''),
                  p => 'Cond. Lab: <b>' + Highcharts.numberFormat(p.x, 2) + ' µS/cm</b>',
                  p => 'SDT: <b>' + Highcharts.numberFormat(p.y, 2) + ' mg/L</b>'
               ]),
               xAxis: { ...common.xAxis, title: { text: 'Conductividad Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxSDT_X },
               yAxis: { ...common.yAxis, title: { text: 'SDT (mg/L)' }, min: 0, max: maxSDT_Y },
               series: [
                  ...makeSeries(pointsSDT),
                  { type: 'line', name: 'm = 0.7', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.7]], color: '#3498db', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: 'm = 0.9', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.9]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: 'm = 0.55', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.55]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false }
               ]
            });

            // QC Result formatter (shared)
            const resultFormatter = (cell) => {
               const v = cell.getValue();
               if (v === true) return '<span class="qc-result-ok">OK <i class="fa fa-check-circle"></i> <i class="fa fa-lock" style="color:#2980b9"></i></span>';
               if (v === false) return '<span class="qc-result-no">NO <i class="fa fa-times-circle"></i> <i class="fa fa-lock" style="color:#2980b9"></i></span>';
               return '—';
            };
            const numFmt = (decimals) => (cell) => { let v = cell.getValue(); return (v !== null && v !== undefined && !isNaN(v)) ? fmt(v, decimals) : '—'; };

            // TABLE: CE
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
                  { formatter: 'rowSelection', titleFormatter: 'rowSelection', hozAlign: 'center', headerSort: false, width: 40 },
                  { title: 'CERTIFICADO', field: 'certificado', sorter: 'string', headerFilter: 'input', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'ESTACIÓN', field: 'estacion', sorter: 'string', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'FECHA', field: 'fecha', sorter: 'date', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'CE TERRENO', field: 'ce_terreno', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(0) },
                  { title: 'CE LAB', field: 'ce_lab', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(0) },
                  { title: 'COCIENTE', field: 'cociente', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(2) }
               ]
            });

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
                  { formatter: 'rowSelection', titleFormatter: 'rowSelection', hozAlign: 'center', headerSort: false, width: 40 },
                  { title: 'CERTIFICADO', field: 'certificado', sorter: 'string', headerFilter: 'input', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'ESTACIÓN', field: 'estacion', sorter: 'string', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'FECHA', field: 'fecha', sorter: 'date', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'PH TERRENO', field: 'ph_terreno', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(2) },
                  { title: 'PH LAB', field: 'ph_lab', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(2) },
                  { title: 'COCIENTE', field: 'cociente', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(2) },
                  { title: 'DIF.', field: 'dif', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(3) },
                  { title: 'RESULTADO', field: 'isOK', hozAlign: 'center', headerHozAlign: 'center', formatter: resultFormatter, width: 130 }
               ]
            });

            // ÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚Â TABLE: SDT ÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚ÂÃƒÂ¢Ã¢â‚¬Â¢Ã‚Â
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
                  { formatter: 'rowSelection', titleFormatter: 'rowSelection', hozAlign: 'center', headerSort: false, width: 40 },
                  { title: 'CERTIFICADO', field: 'certificado', sorter: 'string', headerFilter: 'input', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'ESTACIÓN', field: 'estacion', sorter: 'string', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'FECHA', field: 'fecha', sorter: 'date', hozAlign: 'center', headerHozAlign: 'center' },
                  { title: 'SDT', field: 'sdt_val', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(0) },
                  { title: 'CE LABORATORIO', field: 'ce_lab', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(0) },
                  { title: 'COCIENTE', field: 'cociente', sorter: 'number', hozAlign: 'center', headerHozAlign: 'center', formatter: numFmt(5) },
                  { title: 'RESULTADO', field: 'isOK', hozAlign: 'center', headerHozAlign: 'center', formatter: resultFormatter, width: 130 }
               ]
            });

            // ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ Redraw charts when switching tabs (Highcharts needs visible container) ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬ÃƒÂ¢Ã¢â‚¬ÂÃ¢â€šÂ¬
            $('.qaqc-nav-tabs a[data-toggle="tab"]').off('shown.bs.tab').on('shown.bs.tab', function (e) {
               const target = $(e.target).attr('href');
               $(target).find('.highcharts-container').parent().each(function () {
                  const el = this;
                  const chart = Highcharts.charts.find(c => c && c.renderTo === el);
                  if (chart) chart.reflow();
               });
            });
         }
         $('#btn-graficar-qaqc').on('click', function () {
            let stations = $('#filtro-estaciones-qaqc').val(),
               parametros = $('#filtro-parametros-qaqc').val() || [14, 26, 27, 65, 66],
               indicador = $('#filtro-indicador-qaqc').val(),
               estatus = $('#filtro-estatus-qaqc').val(),
               months = $('#filtro-meses-qaqc').val(),
               years = $('#filtro-anios-qaqc').val();

            if (!stations) return Swal.fire({ icon: 'warning', text: 'Seleccione estaciones.' });
            let $btn = $(this); $btn.prop('disabled', true).html('Graficando...');
            fetch("{{ url('/api/control-calidad/chart-data') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify({ stations, parametros: [14, 26, 27, 65, 66], indicador, estatus, months, years })
            }).then(res => res.json()).then(resp => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
               if (resp.raw && resp.raw.length > 0) {
                  renderSectionQCCharts(resp.raw);
               } else {
                  Swal.fire({ icon: 'info', text: 'No se encontraron datos.' });
               }
            }).catch(e => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
            });
         });

         function renderSectionQCCharts(data) {
            const pn = (v) => { let s = String(v || '').replace(',', '.').replace(/[<>]/g, ''); return parseFloat(s); };
            const pointsCond = [], pointsPH = [], pointsSDT = [];

            data.forEach(item => {
               const est = item.estacion || 'S/E';
               const cert = item.certificado || '';
               let fechaParts = (item.fecha_label || "").split('-');
               let fechaFmt = fechaParts.length === 3 ? `${fechaParts[2]}-${fechaParts[1]}-${fechaParts[0]}` : item.fecha_label;

               let cLab = pn(item.parametro_26), cTerr = pn(item.parametro_27);
               if (!isNaN(cLab) && !isNaN(cTerr) && cLab !== 0) {
                  let diff = Math.abs(cLab - cTerr) / cTerr;
                  pointsCond.push({ x: cTerr, y: cLab, isOK: diff <= 0.10, cert, est, fecha: fechaFmt });
               }
               let pLab = pn(item.parametro_65), pTerr = pn(item.parametro_66);
               if (!isNaN(pLab) && !isNaN(pTerr) && pLab !== 0) {
                  let dif = Math.abs(pLab - pTerr);
                  pointsPH.push({ x: pTerr, y: pLab, isOK: dif <= 0.5, cert, est, fecha: fechaFmt });
               }
               let sdtVal = pn(item.parametro_14), cl = pn(item.parametro_26);
               if (!isNaN(sdtVal) && !isNaN(cl) && cl !== 0) {
                  let cociente = sdtVal / cl;
                  pointsSDT.push({ x: cl, y: sdtVal, isOK: cociente >= 0.55 && cociente <= 0.9, cert, est, fecha: fechaFmt });
               }
            });

            $('#badge-section-cond').text(pointsCond.length);
            $('#badge-section-ph').text(pointsPH.length);
            $('#badge-section-sdt').text(pointsSDT.length);

            const colorOK = 'rgba(52, 152, 219, 0.65)';
            const colorFuera = 'rgba(231, 76, 60, 0.65)';
            const makeSeries = (pts) => [
               { name: 'OK', color: colorOK, data: pts.filter(p => p.isOK).map(p => ({ x: p.x, y: p.y, cert: p.cert, est: p.est, fecha: p.fecha })), marker: { symbol: 'circle', radius: 6 } },
               { name: 'Fuera de Rango', color: colorFuera, data: pts.filter(p => !p.isOK).map(p => ({ x: p.x, y: p.y, cert: p.cert, est: p.est, fecha: p.fecha })), marker: { symbol: 'circle', radius: 6 } }
            ];

            const common = {
               chart: { type: 'scatter', zoomType: 'xy', style: { fontFamily: 'inherit' } },
               credits: { enabled: false },
               legend: { itemStyle: { fontWeight: '600', fontSize: '13px' } },
               xAxis: { labels: { style: { fontSize: '12px', color: '#444' } }, title: { style: { fontSize: '14px', fontWeight: '700', color: '#333' } }, gridLineWidth: 1 },
               yAxis: { labels: { style: { fontSize: '12px', color: '#444' } }, title: { style: { fontSize: '14px', fontWeight: '700', color: '#333' } } }
            };

            const makeTooltip = (fields) => ({
               useHTML: true, formatter: function () { return fields.map(f => f(this.point)).join('<br/>'); }
            });

            const maxCond = Math.max(...pointsCond.flatMap(p => [p.x, p.y]), 1000) * 1.1;
            const maxPH = 14;
            const maxSDT_X = Math.max(...pointsSDT.map(p => p.x), 1000) * 1.1;
            const maxSDT_Y = Math.max(...pointsSDT.map(p => p.y), 1000) * 1.1;

            Highcharts.chart('chart-section-cond', {
               ...common, title: { text: 'CE Laboratorio vs CE Terreno', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>', p => 'Certificado: ' + (p.options.cert || ''), p => 'Fecha: ' + (p.options.fecha || ''), p => 'CE Terreno: <b>' + Highcharts.numberFormat(p.x, 2) + ' µS/cm</b>', p => 'CE Laboratorio: <b>' + Highcharts.numberFormat(p.y, 2) + ' µS/cm</b>']),
               xAxis: { ...common.xAxis, title: { text: 'CE Terreno (µS/cm, 25°C)' }, min: 0, max: maxCond },
               yAxis: { ...common.yAxis, title: { text: 'CE Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxCond },
               series: [
                  ...makeSeries(pointsCond),
                  { type: 'line', name: 'Recta m=1', data: [[0, 0], [maxCond, maxCond]], color: '#333', dashStyle: 'Solid', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: '±10%', id: 'section-cond-10', data: [[0, 0], [maxCond, maxCond * 1.1]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'section-cond-10', data: [[0, 0], [maxCond, maxCond * 0.9]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false },
                  { type: 'line', name: '±20%', id: 'section-cond-20', data: [[0, 0], [maxCond, maxCond * 1.2]], color: '#27ae60', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'section-cond-20', data: [[0, 0], [maxCond, maxCond * 0.8]], color: '#27ae60', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false }
               ]
            });

            Highcharts.chart('chart-section-ph', {
               ...common, title: { text: 'pH Laboratorio vs pH Terreno', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>', p => 'Certificado: ' + (p.options.cert || ''), p => 'Fecha: ' + (p.options.fecha || ''), p => 'pH Terreno: <b>' + Highcharts.numberFormat(p.x, 2) + ' u.pH</b>', p => 'pH Laboratorio: <b>' + Highcharts.numberFormat(p.y, 2) + ' u.pH</b>']),
               xAxis: { ...common.xAxis, title: { text: 'pH Terreno (u.pH)' }, min: 0, max: maxPH },
               yAxis: { ...common.yAxis, title: { text: 'pH Laboratorio (u.pH)' }, min: 0, max: maxPH },
               series: [
                  ...makeSeries(pointsPH),
                  { type: 'line', name: 'm = 1', data: [[0, 0], [maxPH, maxPH]], color: '#333', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: '±0.5 u pH', id: 'section-ph-05', data: [[0, 0.5], [maxPH - 0.5, maxPH]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', linkedTo: 'section-ph-05', data: [[0.5, 0], [maxPH, maxPH - 0.5]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false, showInLegend: false }
               ]
            });

            Highcharts.chart('chart-section-sdt', {
               ...common, title: { text: 'SDT vs Conductividad Laboratorio', align: 'left', style: { fontSize: '18px', fontWeight: '800' } },
               tooltip: makeTooltip([p => '<b>Estación: ' + (p.options.est || 'S/E') + '</b>', p => 'Certificado: ' + (p.options.cert || ''), p => 'Fecha: ' + (p.options.fecha || ''), p => 'Cond. Lab: <b>' + Highcharts.numberFormat(p.x, 2) + ' µS/cm</b>', p => 'SDT: <b>' + Highcharts.numberFormat(p.y, 2) + ' mg/L</b>']),
               xAxis: { ...common.xAxis, title: { text: 'Conductividad Laboratorio (µS/cm, 25°C)' }, min: 0, max: maxSDT_X },
               yAxis: { ...common.yAxis, title: { text: 'SDT (mg/L)' }, min: 0, max: maxSDT_Y },
               series: [
                  ...makeSeries(pointsSDT),
                  { type: 'line', name: 'm = 0.7', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.7]], color: '#3498db', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: 'm = 0.9', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.9]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false },
                  { type: 'line', name: 'm = 0.55', data: [[0, 0], [maxSDT_X, maxSDT_X * 0.55]], color: '#e74c3c', dashStyle: 'Dash', marker: { enabled: false }, enableMouseTracking: false }
               ]
            });
         }

         // CONFIG MODAL LOGIC
         function getChartByContainer(containerId) {
            const el = document.getElementById(containerId);
            if (!el) return null;
            return Highcharts.charts.find(c => c && c.renderTo === el) || null;
         }

         $('#btn-config-qaqc').on('click', function () {
            populateConfigFromCharts();
            $('#modalConfigQAQC').modal('show');
         });

         function populateConfigFromCharts() {
            const chCond = getChartByContainer('chart-section-cond');
            if (chCond) {
               $('#cfg-cond-x-title').val(chCond.xAxis[0].options.title?.text || '');
               $('#cfg-cond-y-title').val(chCond.yAxis[0].options.title?.text || '');
               const xEx = chCond.xAxis[0].getExtremes();
               const yEx = chCond.yAxis[0].getExtremes();
               $('#cfg-cond-x-min').val(xEx.min != null ? xEx.min : 0);
               $('#cfg-cond-x-max').val(xEx.max != null ? Math.round(xEx.max * 100) / 100 : '');
               $('#cfg-cond-y-min').val(yEx.min != null ? yEx.min : 0);
               $('#cfg-cond-y-max').val(yEx.max != null ? Math.round(yEx.max * 100) / 100 : '');
               chCond.series.forEach(s => {
                  if (s.name === 'OK') $('#cfg-cond-color-ok').val(rgbaToHex(s.color));
                  if (s.name === 'Fuera de Rango') $('#cfg-cond-color-fuera').val(rgbaToHex(s.color));
               });
               const okS = chCond.series.find(s => s.name === 'OK');
               if (okS) $('#cfg-cond-marker-radius').val(okS.options.marker?.radius || 6);
               syncRefLineCheckbox(chCond, 'Recta m=1', '#cfg-cond-line-m1', '#cfg-cond-line-m1-color');
               syncRefLineCheckbox(chCond, '±10%', '#cfg-cond-line-10', '#cfg-cond-line-10-color');
               syncRefLineCheckbox(chCond, '±20%', '#cfg-cond-line-20', '#cfg-cond-line-20-color');
            }

            const chPH = getChartByContainer('chart-section-ph');
            if (chPH) {
               $('#cfg-ph-x-title').val(chPH.xAxis[0].options.title?.text || '');
               $('#cfg-ph-y-title').val(chPH.yAxis[0].options.title?.text || '');
               const xEx = chPH.xAxis[0].getExtremes();
               const yEx = chPH.yAxis[0].getExtremes();
               $('#cfg-ph-x-min').val(xEx.min != null ? xEx.min : 0);
               $('#cfg-ph-x-max').val(xEx.max != null ? Math.round(xEx.max * 100) / 100 : '');
               $('#cfg-ph-y-min').val(yEx.min != null ? yEx.min : 0);
               $('#cfg-ph-y-max').val(yEx.max != null ? Math.round(yEx.max * 100) / 100 : '');
               chPH.series.forEach(s => {
                  if (s.name === 'OK') $('#cfg-ph-color-ok').val(rgbaToHex(s.color));
                  if (s.name === 'Fuera de Rango') $('#cfg-ph-color-fuera').val(rgbaToHex(s.color));
               });
               const okPH = chPH.series.find(s => s.name === 'OK');
               if (okPH) $('#cfg-ph-marker-radius').val(okPH.options.marker?.radius || 6);
               syncRefLineCheckbox(chPH, 'm = 1', '#cfg-ph-line-m1', '#cfg-ph-line-m1-color');
               syncRefLineCheckbox(chPH, '±0.5 u pH', '#cfg-ph-line-05', '#cfg-ph-line-05-color');
            }

            const chSDT = getChartByContainer('chart-section-sdt');
            if (chSDT) {
               $('#cfg-sdt-x-title').val(chSDT.xAxis[0].options.title?.text || '');
               $('#cfg-sdt-y-title').val(chSDT.yAxis[0].options.title?.text || '');
               const xEx = chSDT.xAxis[0].getExtremes();
               const yEx = chSDT.yAxis[0].getExtremes();
               $('#cfg-sdt-x-min').val(xEx.min != null ? xEx.min : 0);
               $('#cfg-sdt-x-max').val(xEx.max != null ? Math.round(xEx.max * 100) / 100 : '');
               $('#cfg-sdt-y-min').val(yEx.min != null ? yEx.min : 0);
               $('#cfg-sdt-y-max').val(yEx.max != null ? Math.round(yEx.max * 100) / 100 : '');
               chSDT.series.forEach(s => {
                  if (s.name === 'OK') $('#cfg-sdt-color-ok').val(rgbaToHex(s.color));
                  if (s.name === 'Fuera de Rango') $('#cfg-sdt-color-fuera').val(rgbaToHex(s.color));
               });
               const okSDT = chSDT.series.find(s => s.name === 'OK');
               if (okSDT) $('#cfg-sdt-marker-radius').val(okSDT.options.marker?.radius || 6);
               syncRefLineCheckbox(chSDT, 'm = 0.7', '#cfg-sdt-line-07', '#cfg-sdt-line-07-color');
               syncRefLineCheckbox(chSDT, 'm = 0.9', '#cfg-sdt-line-09', '#cfg-sdt-line-09-color');
               syncRefLineCheckbox(chSDT, 'm = 0.55', '#cfg-sdt-line-055', '#cfg-sdt-line-055-color');
            }
         }

         function syncRefLineCheckbox(chart, seriesName, checkSel, colorSel) {
            const s = chart.series.find(s => s.name === seriesName);
            if (s) {
               $(checkSel).prop('checked', s.visible);
               $(colorSel).val(rgbaToHex(s.color));
            }
         }

         function rgbaToHex(color) {
            if (!color) return '#333333';
            if (color.startsWith('#')) return color.length <= 7 ? color : color.substring(0, 7);
            const m = color.match(/\d+/g);
            if (!m || m.length < 3) return '#333333';
            const hex = '#' + [m[0], m[1], m[2]].map(x => parseInt(x).toString(16).padStart(2, '0')).join('');
            return hex;
         }

         function hexToRgba(hex, alpha) {
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
         }

         $('#btn-cfg-apply').on('click', function () {
            applyConfigToCharts();
            $('#modalConfigQAQC').modal('hide');
            Swal.fire({ icon: 'success', text: 'Configuración aplicada correctamente.', timer: 1500, showConfirmButton: false });
         });

         function applyConfigToCharts() {
            const chCond = getChartByContainer('chart-section-cond');
            if (chCond) {
               const xMin = parseFloat($('#cfg-cond-x-min').val());
               const xMax = parseFloat($('#cfg-cond-x-max').val());
               const yMin = parseFloat($('#cfg-cond-y-min').val());
               const yMax = parseFloat($('#cfg-cond-y-max').val());
               chCond.xAxis[0].update({ title: { text: $('#cfg-cond-x-title').val() }, min: isNaN(xMin) ? null : xMin, max: isNaN(xMax) ? null : xMax }, false);
               chCond.yAxis[0].update({ title: { text: $('#cfg-cond-y-title').val() }, min: isNaN(yMin) ? null : yMin, max: isNaN(yMax) ? null : yMax }, false);
               const radius = parseInt($('#cfg-cond-marker-radius').val()) || 6;
               const okColor = hexToRgba($('#cfg-cond-color-ok').val(), 0.65);
               const fueraColor = hexToRgba($('#cfg-cond-color-fuera').val(), 0.65);
               chCond.series.forEach(s => {
                  if (s.name === 'OK') s.update({ color: okColor, marker: { radius: radius } }, false);
                  if (s.name === 'Fuera de Rango') s.update({ color: fueraColor, marker: { radius: radius } }, false);
               });
               applyRefLine(chCond, 'Recta m=1', '#cfg-cond-line-m1', '#cfg-cond-line-m1-color');
               applyRefLine(chCond, '±10%', '#cfg-cond-line-10', '#cfg-cond-line-10-color');
               applyRefLine(chCond, '±20%', '#cfg-cond-line-20', '#cfg-cond-line-20-color');
               chCond.series.forEach(s => {
                  if (s.options?.showInLegend === false && s.type === 'line') {
                     s.update({ visible: true }, false);
                  }
               });
               chCond.redraw();
            }

            const chPH = getChartByContainer('chart-section-ph');
            if (chPH) {
               const xMin = parseFloat($('#cfg-ph-x-min').val());
               const xMax = parseFloat($('#cfg-ph-x-max').val());
               const yMin = parseFloat($('#cfg-ph-y-min').val());
               const yMax = parseFloat($('#cfg-ph-y-max').val());
               chPH.xAxis[0].update({ title: { text: $('#cfg-ph-x-title').val() }, min: isNaN(xMin) ? null : xMin, max: isNaN(xMax) ? null : xMax }, false);
               chPH.yAxis[0].update({ title: { text: $('#cfg-ph-y-title').val() }, min: isNaN(yMin) ? null : yMin, max: isNaN(yMax) ? null : yMax }, false);
               const radius = parseInt($('#cfg-ph-marker-radius').val()) || 6;
               const okColor = hexToRgba($('#cfg-ph-color-ok').val(), 0.65);
               const fueraColor = hexToRgba($('#cfg-ph-color-fuera').val(), 0.65);
               chPH.series.forEach(s => {
                  if (s.name === 'OK') s.update({ color: okColor, marker: { radius: radius } }, false);
                  if (s.name === 'Fuera de Rango') s.update({ color: fueraColor, marker: { radius: radius } }, false);
               });
               applyRefLine(chPH, 'm = 1', '#cfg-ph-line-m1', '#cfg-ph-line-m1-color');
               applyRefLine(chPH, '±0.5 u pH', '#cfg-ph-line-05', '#cfg-ph-line-05-color');
               chPH.series.forEach(s => {
                  if (s.options?.showInLegend === false && s.type === 'line') {
                     const visible = $('#cfg-ph-line-05').is(':checked');
                     const color = $('#cfg-ph-line-05-color').val();
                     s.update({ visible: visible, color: color }, false);
                  }
               });
               chPH.redraw();
            }

            const chSDT = getChartByContainer('chart-section-sdt');
            if (chSDT) {
               const xMin = parseFloat($('#cfg-sdt-x-min').val());
               const xMax = parseFloat($('#cfg-sdt-x-max').val());
               const yMin = parseFloat($('#cfg-sdt-y-min').val());
               const yMax = parseFloat($('#cfg-sdt-y-max').val());
               chSDT.xAxis[0].update({ title: { text: $('#cfg-sdt-x-title').val() }, min: isNaN(xMin) ? null : xMin, max: isNaN(xMax) ? null : xMax }, false);
               chSDT.yAxis[0].update({ title: { text: $('#cfg-sdt-y-title').val() }, min: isNaN(yMin) ? null : yMin, max: isNaN(yMax) ? null : yMax }, false);
               const radius = parseInt($('#cfg-sdt-marker-radius').val()) || 6;
               const okColor = hexToRgba($('#cfg-sdt-color-ok').val(), 0.65);
               const fueraColor = hexToRgba($('#cfg-sdt-color-fuera').val(), 0.65);
               chSDT.series.forEach(s => {
                  if (s.name === 'OK') s.update({ color: okColor, marker: { radius: radius } }, false);
                  if (s.name === 'Fuera de Rango') s.update({ color: fueraColor, marker: { radius: radius } }, false);
               });
               applyRefLine(chSDT, 'm = 0.7', '#cfg-sdt-line-07', '#cfg-sdt-line-07-color');
               applyRefLine(chSDT, 'm = 0.9', '#cfg-sdt-line-09', '#cfg-sdt-line-09-color');
               applyRefLine(chSDT, 'm = 0.55', '#cfg-sdt-line-055', '#cfg-sdt-line-055-color');
               chSDT.redraw();
            }
         }

         function applyRefLine(chart, seriesName, checkSel, colorSel) {
            const s = chart.series.find(s => s.name === seriesName);
            if (s) {
               const visible = $(checkSel).is(':checked');
               const color = $(colorSel).val();
               s.update({ visible: visible, color: color }, false);
            }
         }

         $('#btn-cfg-reset').on('click', function () {
            $('#cfg-cond-x-title').val('CE Terreno (µS/cm, 25°C)');
            $('#cfg-cond-y-title').val('CE Laboratorio (µS/cm, 25°C)');
            $('#cfg-cond-x-min').val(0); $('#cfg-cond-x-max').val('');
            $('#cfg-cond-y-min').val(0); $('#cfg-cond-y-max').val('');
            $('#cfg-cond-color-ok').val('#3498db'); $('#cfg-cond-color-fuera').val('#e74c3c');
            $('#cfg-cond-marker-radius').val(6);
            $('#cfg-cond-line-m1').prop('checked', true); $('#cfg-cond-line-m1-color').val('#333333');
            $('#cfg-cond-line-10').prop('checked', true); $('#cfg-cond-line-10-color').val('#e74c3c');
            $('#cfg-cond-line-20').prop('checked', true); $('#cfg-cond-line-20-color').val('#27ae60');

            $('#cfg-ph-x-title').val('pH Terreno (u.pH)');
            $('#cfg-ph-y-title').val('pH Laboratorio (u.pH)');
            $('#cfg-ph-x-min').val(0); $('#cfg-ph-x-max').val(14);
            $('#cfg-ph-y-min').val(0); $('#cfg-ph-y-max').val(14);
            $('#cfg-ph-color-ok').val('#3498db'); $('#cfg-ph-color-fuera').val('#e74c3c');
            $('#cfg-ph-marker-radius').val(6);
            $('#cfg-ph-line-m1').prop('checked', true); $('#cfg-ph-line-m1-color').val('#333333');
            $('#cfg-ph-line-05').prop('checked', true); $('#cfg-ph-line-05-color').val('#e74c3c');

            $('#cfg-sdt-x-title').val('Conductividad Laboratorio (µS/cm, 25°C)');
            $('#cfg-sdt-y-title').val('SDT (mg/L)');
            $('#cfg-sdt-x-min').val(0); $('#cfg-sdt-x-max').val('');
            $('#cfg-sdt-y-min').val(0); $('#cfg-sdt-y-max').val('');
            $('#cfg-sdt-color-ok').val('#3498db'); $('#cfg-sdt-color-fuera').val('#e74c3c');
            $('#cfg-sdt-marker-radius').val(6);
            $('#cfg-sdt-line-07').prop('checked', true); $('#cfg-sdt-line-07-color').val('#3498db');
            $('#cfg-sdt-line-09').prop('checked', true); $('#cfg-sdt-line-09-color').val('#e74c3c');
            $('#cfg-sdt-line-055').prop('checked', true); $('#cfg-sdt-line-055-color').val('#e74c3c');

            Swal.fire({ icon: 'info', text: 'Valores restablecidos. Presione "Aplicar Cambios" para confirmar.', timer: 1800, showConfirmButton: false });
         });

      });
   </script>

   <script>
      $(document).ready(function () {
         $.get('{{ url("/api/control-calidad/filters") }}', function (data) {
            $.each(data.depositos, function (i, d) {
               $('#select-sector-balance').append($('<option>', { value: d.id_depositos, text: d.descripcion }));
            });
            $('#select-sector-balance').val(1);

            const heladosGroup = $('<optgroup>', { label: 'Los Helados' });
            const otrosGroup = $('<optgroup>', { label: 'Otras Estaciones' });
            $.each(data.estaciones, function (i, e) {
               const opt = $('<option>', { value: e.id_estacion, text: e.nombre_estacion });
               if (parseInt(e.clasificacion) === 1) heladosGroup.append(opt);
               else otrosGroup.append(opt);
            });
            $('#filtro-estaciones-balance').empty().append(heladosGroup).append(otrosGroup).prop('disabled', false);

            $.each(data.programas, function (i, p) {
               $('#filtro-indicador-balance').append($('<option>', { value: p.id_programa, text: p.nombre_serie }));
            });
            $.each(data.years, function (i, y) { $('#filtro-anios-balance').append($('<option>', { value: y, text: y })); });
            $.each(data.meses, function (i, m) { $('#filtro-meses-balance').append($('<option>', { value: m.id, text: m.nombre })); });
            $('#select-sector-balance, #filtro-estaciones-balance, #filtro-indicador-balance, #filtro-estatus-balance, #filtro-anios-balance, #filtro-meses-balance').selectpicker('refresh');
         });

         $('#select-sector-balance').on('change', function () {
            let sectorId = $(this).val();
            $('#filtro-estaciones-balance').prop('disabled', true).empty();
            $.get('{{ url("/api/control-calidad/estaciones") }}/' + sectorId, function (data) {
               $.each(data, function (i, e) {
                  $('#filtro-estaciones-balance').append($('<option>', { value: e.id_estacion, text: e.nombre_estacion }));
               });
               $('#filtro-estaciones-balance').prop('disabled', false).selectpicker('refresh');
            });
         });

         $('#btn-graficar-balance').on('click', function () {
            let stations = $('#filtro-estaciones-balance').val(),
               indicador = $('#filtro-indicador-balance').val(),
               estatus = $('#filtro-estatus-balance').val(),
               months = $('#filtro-meses-balance').val(),
               years = $('#filtro-anios-balance').val();

            if (!stations || !months || !years) return Swal.fire({ icon: 'warning', text: 'Seleccione estaciones, meses y años.' });
            let $btn = $(this); $btn.prop('disabled', true).html('Graficando...');

            fetch("{{ url('/api/control-calidad/chart-data') }}", {
               method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
               body: JSON.stringify({ stations, parametros: [10], indicador, estatus, months, years })
            }).then(res => res.json()).then(resp => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
               if (resp.raw && resp.raw.length > 0) {
                  renderBalanceChart(resp.raw);
               } else {
                  Swal.fire({ icon: 'info', text: 'No se encontraron datos.' });
               }
            }).catch(e => {
               $btn.prop('disabled', false).html('<i class="fa fa-line-chart mr-1"></i> &nbsp; Graficar');
            });
         });

         function renderBalanceChart(data) {
            const pn = (v) => { let s = String(v || '').replace(',', '.').replace(/[<>]/g, ''); return parseFloat(s); };

            let categories = [];
            let seriesData = [];

            data.forEach(item => {
               let val = pn(item.parametro_10);
               if (!isNaN(val)) {
                  let fechaParts = (item.fecha_label || "").split('-');
                  let fechaFmt = fechaParts.length === 3 ? `${fechaParts[2]}-${fechaParts[1]}-${fechaParts[0]}` : item.fecha_label;
                  let catName = (item.estacion || 'S/E') + ' | ' + fechaFmt;

                  categories.push(catName);
                  seriesData.push({
                     y: val,
                     cert: item.certificado,
                     est: item.estacion,
                     fecha: fechaFmt
                  });
               }
            });

            Highcharts.chart('chart-section-balance', {
               chart: { type: 'column', style: { fontFamily: 'inherit' } },
               title: { text: null },
               credits: { enabled: false },
               legend: { enabled: false },
               xAxis: {
                  categories: categories,
                  labels: { rotation: -90, style: { fontSize: '11px', color: '#444' } },
                  gridLineWidth: 1
               },
               yAxis: {
                  title: { text: 'Balance Iónico [%]', style: { fontSize: '14px', fontWeight: '700', color: '#333' } },
                  plotLines: [
                     { value: 5, color: '#e74c3c', dashStyle: 'Dash', width: 2, zIndex: 5 },
                     { value: 10, color: '#27ae60', dashStyle: 'Dash', width: 2, zIndex: 5 }
                  ]
               },
               tooltip: {
                  useHTML: true,
                  formatter: function () {
                     const p = this.point;
                     return '<b>Estación: ' + p.options.est + '</b><br/>' +
                        'Certificado: ' + p.options.cert + '<br/>' +
                        'Fecha: ' + p.options.fecha + '<br/>' +
                        'Balance Iónico: <b>' + Highcharts.numberFormat(p.y, 2) + '%</b>';
                  }
               },
               plotOptions: {
                  column: {
                     maxPointWidth: 45,
                     pointPadding: 0.15,
                     color: '#5DADE2',
                     borderColor: '#2874A6',
                     borderWidth: 1
                  }
               },
               series: [{
                  name: 'Balance Iónico',
                  data: seriesData
               }]
            });
         }
      });
   </script>
@endpush