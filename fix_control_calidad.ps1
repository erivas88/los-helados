$path = "c:\laragon\www\held\resources\views\modules\control-calidad.blade.php"
$content = [System.IO.File]::ReadAllText($path)

$newJs = @'
       $('#btn-filtrar').on('click', function () {
            let stations = $('#filtro-estaciones').val(), 
                months = $('#filtro-meses').val(), 
                years = $('#filtro-anios').val(),
                estatus = $('#filtro-estatus').val();

            if (!stations || !months || !years) return Swal.fire({ icon: 'warning', text: 'Seleccione filtros.' });
            
            let params = { 
               stations, 
               months, 
               years, 
               estatus,
               indicador: [ $('#filtro-indicador').val() || "1" ] 
            };

            let btn = $(this); btn.prop('disabled', true);
            fetch("{{ url('/api/control-calidad/filtrar') }}", {
                method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify(params)
            })
            .then(res => res.json())
            .then(data => { table.setData(data); btn.prop('disabled', false); })
            .catch(() => { btn.prop('disabled', false); });
       });
'@

# We find the start of btn-filtrar and replace its whole handler
$start = $content.IndexOf("$('#btn-filtrar')")
$end = $content.IndexOf("});", $start) + 3
$chunk = $content.Substring($start, $end - $start)
$content = $content.Replace($chunk, $newJs.Replace("`r`n", "`n"))

# Repeat for delete (to remove it)
$startD = $content.IndexOf("$('#btn-delete')")
if ($startD -ge 0) {
    # Match the leading whitespace as well
    $lineStart = $content.LastIndexOf("`n", $startD) + 1
    $endD = $content.IndexOf("});", $startD) + 3
    $chunkD = $content.Substring($lineStart, $endD - $lineStart)
    $content = $content.Replace($chunkD, "")
}

[System.IO.File]::WriteAllText($path, $content, [System.Text.UTF8Encoding]::new($false))
