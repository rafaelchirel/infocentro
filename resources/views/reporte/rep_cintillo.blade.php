@if ($cintillo)
    <div style="text-align: right" style="margin-bottom: 1%; font-weight: bold">
        {{ $date }}
    </div>
    <div>
        <img src="{{ asset('img/cintillo/' . $cintillo->banner_1) }}" width="100%" height="50px">
    </div>
    <div>
        <img src="{{ asset('img/cintillo/' . $cintillo->banner_2) }}" width="100%" height="100px">
    </div>
    <div style="text-align: right; font-weight: bold; margin-top: 1%;">
        {{ $cintillo->nombre . ' | ' . $cintillo->codigo . ' | ' . $cintillo->direccion }}
    </div>
@endif
