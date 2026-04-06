<?php
$request = Illuminate\Http\Request::create('/api/carga-datos/filtrar', 'POST', [], [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
    'stations' => ['1'], 
    'months' => ['8'],
    'years' => ['2025'],
    'indicador' => ['1']
]));
$controller = app(App\Http\Controllers\CargaDatosController::class);
$response = $controller->filtrarMuestras($request);
echo "STATUS: " . $response->getStatusCode() . "\n";
echo "BODY: " . $response->getContent() . "\n";
