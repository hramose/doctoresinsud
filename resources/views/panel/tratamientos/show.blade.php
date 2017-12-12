    <link href="{{ asset('/css/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

<div class="container-fluid">
        <div class="well well-lg" style="margin-top: 10px">
            <fieldset>
                <legend>
                    Detalle de Tratamiento
                </legend>
 
                <div class="row">
                    <label for="droga" class="col-lg-2 control-label">Droga</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="droga" name="droga"
                               value=" {!! $tratamiento->droga !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="flia_droga" class="col-lg-2 control-label">Familia Droga</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="flia_droga" name="flia_droga"
                               value=" {!! $tratamiento->flia_droga !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="dosis" class="col-lg-2 control-label">Dosis</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="dosis" name="dosis"
                               value=" {!! $tratamiento->dosis !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="fecha_trat" class="col-lg-2 control-label">Fecha</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="fecha_trat" name="fecha_trat"
                               value=" {!! \Carbon\Carbon::parse($tratamiento->fecha_trat)->format('d/m/Y') !!}" readonly>
                    </div>
                </div>
                <div class="row">
                    <label for="obs" class="col-lg-2 control-label">Descripción</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="obs" name="obs"
                               value=" {!! $tratamiento->obs_trat !!}" readonly>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>