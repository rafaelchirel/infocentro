<!-- Small modal -->
{!! Form::open(['route' => 'cambiar-estatus', 'method' => 'post']) !!}
      {{-- id equipo para redireccionar --}}
    <input type="hidden" name="RedirectEquipo" value="{{ $e->equipo_id }}">
    {{-- id componente --}}
    <input type="hidden" name="componente_id" value="{{ $e->comp_id }}">

      <div class="modal fade modal-{{ $cont }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabel2">{{ $e->periferico }}</h4>
            </div>
            <div class="modal-body">

            {{-- select estatus --}}
            <div class="form-group">
                {!! Html::decode(Form::label('estatus','Estatus: <span class="required">*</span>', ["class" => "control-label"])) !!}
                <div>
                    <select name="estatus_id" id="estatus-{{ $cont }}" class="form-control selectpicker" title="seleccione una opcion" required="">
                        @foreach ($estatus as $est)
                            @if ($est->id != 1)
                                <option value="{{ $est->id }}">{{ $est->condicion }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- condicion --}}
            <div class="form-group" id="condicion-{{ $cont }}">
                {!! Html::decode(Form::label('Condicion','Condicion: <span class="required">*</span>', ["class" => "control-label"])) !!}
                <div class=''>
                     <div class="btn-group" data-toggle="buttons">
                     @if (count($equipos) > 1)
                        <label class="btn btn-default" id="condicion1-{{ $cont }}">
                          <input type="radio" name="condicion" value="1"> Mismo Equipo
                        </label>
                        <!-- input hidden - componente vinculado con el equipo actual -->
                            <input type="hidden" name="equipo_vinculado" value="{{ $e->equipo_id }}">

                        <label class="btn btn-default" id="condicion2-{{ $cont }}">
                          <input type="radio" name="condicion" value="2"> Otro Equipo
                        </label>
                      @else
                        <label class="btn btn-default active" id="condicion1-{{ $cont }}">
                          <input type="radio" name="condicion" value="1"> Mismo Equipo
                        </label>
                        <!-- input hidden - componente vinculado con el equipo actual -->
                            <input type="hidden" name="equipo_vinculado" value="{{ $e->equipo_id }}">
                      @endif
                      </div>
                </div>
            </div>
            {{-- select Equipos --}}
            @if (count($equipos) > 1)
           
              <div class="form-group" id="equipos-{{ $cont }}">
                  {!! Html::decode(Form::label('equipos','Equipos: <span class="required">*</span>', ["class" => "control-label"])) !!}
                  <div>
                      <select name="equipo" id="equipo_id" class="form-control selectpicker" title="seleccione una opcion" required="">
                             @foreach ($equipos as $equipo)
                              @if ($equipo->id != $e->equipo_id)
                                <option value="{{ $equipo->id }}">{{ $equipo->numero }}</option>
                              @endif
                             @endforeach
                              
                      </select>
                  </div>
              </div>

             @endif
            {{-- textarea observacion --}}
            <div class="item form-group">
                {!! Html::decode(Form::label('observacion','Observacion: <span class="required">*</span>', ["class" => "control-label"])) !!}
            <div class="">
                <textarea name="observacion" class="form-control" required="" rows="4" placeholder="" id="observacion-{{ $cont }}" onpaste='return false' onclick="UpperTrim(this.id)"></textarea>
                </div>
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

          </div>
        </div>
      </div>

{!! Form::close() !!}
    <!-- Small modal -->

<script type="text/javascript">
  $("#equipos-<?php echo $cont; ?>").hide();
  $('#condicion-<?php echo $cont; ?>').hide();

 //Mostrar select listado equipos
    $('#estatus-<?php echo $cont; ?>').on('change', function() {
        if (this.value == 3) {
            $("#equipos-<?php echo $cont; ?>").show();
        }else{
            $('#equipos-<?php echo $cont; ?>').hide();
        }

        if (this.value == 7) {
            $("#condicion-<?php echo $cont; ?>").show();
        }else{
            $('#condicion-<?php echo $cont; ?>').hide();
        }
    });
    //Grupo boton condicion estatu Dañado | Equipo
    $("#condicion1-<?php echo $cont; ?>").click(function(){
        $('#equipos-<?php echo $cont; ?>').hide();
    });
    $("#condicion2-<?php echo $cont; ?>").click(function(){
        $("#equipos-<?php echo $cont; ?>").show();
    });

    var cont = '';

</script>