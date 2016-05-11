<body>
{{--<div id="modal-consulta-editar" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">--}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="well well-lg">
                    <form id="form-editar-consulta" method="post" action="{{ URL::action('Panel\PanelHistoriasController@guardarConsulta') }}" class="form-horizontal">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <fieldset>
                            <legend>Editar consulta</legend>

                            <div class="form-group" style="vertical-align: middle">
                                <input type="hidden" name="id_usuario" value="{{ Auth::user()->id }}">
                                <label for="medico" class="col-lg-2 control-label"
                                       style="padding-top:0;">Médico</label>
                                <p id="medico" name="medico">
                                    @if(Auth::check())
                                        {{ Auth::user()->name }}
                                    @endif
                                </p>

                            </div>

                            <input type="hidden" id="id_paciente" name="id_paciente" value="{{ $paciente[0]->id }}">
                            <input type="hidden" id="id_consulta" name="id_consulta" value="{{ $consulta->id }}">
                            <input type="hidden" id="hidden_descripcion" name="hidden_descripcion">

                            <div class="form-group">
                                <label for="title" class="col-lg-2 control-label">Titulo</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="titulo" placeholder="Titulo"
                                           name="titulo" data-validation="required" data-validation-length="min4"
                                            value="{!!  $consulta->titulo !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-lg-2 control-label">Descripcion</label>
                                <div class="col-lg-10">
                                        <textarea class="form-control" rows="3" id="editor_descripcion_edit"
                                                  name="descripcion">{!! $consulta->descripcion !!}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="submitConsulta_editar" style="float: right;">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: right;">Cancelar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            {{--                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" data-dismiss="modal">Guardar</button>
                            </div>--}}
{{--        </div>
    </div>
</div>--}}

<script src="../../../ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor_descripcion_edit', {
     customConfig: '../../../ckeditor/custom_config.js'
     });
</script>
<script>
    $.validate({
        form : '#form-editar-consulta',
        lang : 'es',
        /*            onError : function($form) {
         alert('Validation of form '+$form.attr('id')+' failed!');
         },
         onSuccess : function($form) {
         alert('The form '+$form.attr('id')+' is valid!');
         return false; // Will stop the submission of the form
         },*/
    });
    $(document).on('ready', function () {
        $('#modal-consulta-editar').on('show.bs.modal', function(e){
            alert("hola, llegué");
        });

            //CKEDITOR.instances.editor_descripcion_edit.setData('');
    });
</script>

</body>