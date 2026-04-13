const fs = require('fs');
let c = fs.readFileSync('resources/views/modules/visualizacion.blade.php', 'utf8');

c = c.replace(/<section class="panel">\s*<header class="panel-heading">\s*<h2 class="panel-title">Módulo de Visualización - Resultados <\/h2>\s*<\/header>\s*<div class="panel-body">/, 
`<!-- Intro Banner -->
   <div class="row" style="margin-bottom: 25px;">
      <div class="col-md-12">
         <div style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #28a745; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
               <div>
                  <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                     <i class="fa fa-eye" style="color: #28a745;"></i> Tableros de Visualización
                  </h2>
                  <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                     Consulte dinámicamente los tableros analíticos con datos previamente sometidos a control de calidad.
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
            <div class="panel-body" style="padding: 25px;">`);

c = c.replace(/<button type="button" id="btn-filtrar" class="btn btn-default filter-btn btn-block">\s*<i class="fa fa-filter text-success mr-1"><\/i> &nbsp; Filtrar\s*<\/button>/,
`<button type="button" id="btn-filtrar" class="btn btn-success filter-btn btn-block" style="background-color: #28a745; border-color: #28a745; font-family: 'Outfit', sans-serif; font-weight: 600;">
                           <i class="fa fa-search mr-1"></i> &nbsp; Consultar
                        </button>`);

c = c.replace(/<section class="panel">\s*<header class="panel-heading">\s*<h2 class="panel-title">Gráfico Histórico - Resultados <\/h2>\s*<\/header>\s*<div class="panel-body">/,
`<section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div class="panel-body" style="padding: 25px;">
               <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #2c3e50; margin-bottom: 20px; border-bottom: 2px solid #f1f4f9; padding-bottom: 10px;">
                  <i class="fa fa-line-chart text-success"></i> Gráficos Analíticos
               </h3>`);

c = c.replace(/\.filter-toolbar\s*\{\s*background:\s*#f8f9fa;\s*padding:\s*10px\s*15px;\s*border-radius:\s*4px;\s*border:\s*1px\s*solid\s*#eee;\s*\}/, 
`.filter-toolbar {
         background: #ffffff;
         padding: 20px;
         border-radius: 8px;
         border: 1px solid #e2e8f0;
         box-shadow: 0 4px 10px rgba(0,0,0,0.02);
         margin-bottom: 25px;
      }`);

c = c.replace(/#tabla-muestras\s*\{\s*border:\s*1px\s*solid\s*#E5E7E9;\s*margin-top:\s*15px;\s*font-family:\s*inherit;\s*\}/, 
`#tabla-muestras {
         border: 1px solid #E5E7E9;
         margin-top: 15px;
         font-family: 'Inter', sans-serif;
         border-radius: 8px;
         overflow: hidden;
      }`);

fs.writeFileSync('resources/views/modules/visualizacion.blade.php', c, 'utf8');
console.log('Done replacement');
