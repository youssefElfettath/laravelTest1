<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="ajoute">
                <form class="form_ajouter" method="POST" action="">
                        
                    {{ csrf_field() }}
                    <input type="hidden" name="tpl" value="" >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-10">
                            <label>Concentrateur : </label>
                            <div class="alert alert-danger print-error-msg-rasp" style="display:none">
                                <ul></ul>
                            </div>
                            <select class="form-control" name="raspb" id="raspb">
                                <option value="">None</option>
                                @if(session()->has('clientID'))
                                    @foreach ($client->Rasbs as $key => $rasb)
                                        <option value="{{$rasb->id_raspberry}}" data-num="{{$rasb->num_raspberry}}" data-uname="{{$rasb->name}}" class="{{$rasb->name_client}}" id="update-op">{{$rasb->name_client}}</option>
                                    @endforeach
                                @elseif(session()->has('installateurID'))
                                    @foreach ($raspbs as $rasb)
                                        <option value="{{$rasb->id_raspberry}}" data-num="{{$rasb->num_raspberry}}" data-uname="{{$rasb->name}}"  class="{{$rasb->name_client}}" id="update-op">{{$rasb->name_client}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-2">
                                <label></label>
                                <div class="alert alert-danger" style="display:none">
                                    <ul></ul>
                                </div>
                                <button class="btn btn-success" type="button" id="add_raspberry" data-name="Ajouter">Nouveau</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-10">
                                <label>Transmetteur : </label>
                                <div class="alert alert-danger print-error-msg-unite" style="display:none">
                                    <ul></ul>
                                </div>
                                <select class="form-control" name="unite_e" id="unite_e">
                                    <option value="">None</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label></label>
                                <div class="alert alert-danger" style="display:none">
                                    <ul></ul>
                                </div>
                                <button class="btn btn-success" type="button" id="add_circuit" data-name="Ajouter">Nouveau</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Entrez numero du port: </label>
                        <div class="alert alert-danger print-error-msg-capt" style="display:none">
                            <ul></ul>
                        </div>
                        <select class="form-control" placeholder="Port" placeholder="PORT" name="port" id="port_e">
                            <option value="">None</option>
                            @for($i=1;$i<10;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nom : </label>
                        <div class="alert alert-danger print-error-msg-name" style="display:none">
                            <ul></ul>
                        </div>
                        <input style="width:100%" type="text" class="form-control" placeholder="Nom" name="name" required>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger print-error-msg-type" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <label>Type : </label>
                                <select class="form-control" name="type" id='type'>
                                    <option value="">None</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{$type->name}}" id="{{$type->id_type}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>Unité:</label><br>
                                <select class="form-control " id="unite_a" name="unit">
                                    <option selected="" value="">Unité</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group box-check">
                        <label>Alertes : </label><br/>
                        <label class="checkcontainer2">
                                <input type="checkbox" class="checkbox-success checkbox_ajouter" id="checkbox" name="alert" />
                                <span class="checkmark2"></span>
                        </label>
                    </div>
                    <div class="form-group delai_alert_form">
                        <div class="form-group">
                        <div class="alert alert-danger print-error-msg-min" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row">
                            <div id='dynamic_field'>
                                <div class="div_add">
                                    <div class="col-sm-3 div_add">
                                        <label>Valeur MIN : </label>
                                            <input type="text" class="form-control number" id='min' placeholder="Valeur MIN" name="min">
                                        </div>
                                    <div class="col-sm-3 div_add">
                                        <label>Valeur MAX : </label>
                                        <input style="width:100%" type="text" class="form-control number" id='max' placeholder="Valeur MAX" name="max">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Délai entre deux alertes (secondes): </label>
                                        <input  type="text" class="form-control " placeholder="Délai entre deux alertes" name="delai" id='delai'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="form-group">
                            <input style="width:20%" type="submit" value="Ajouter" class="btn btn-primary add pull-left">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <script>
        
        </script>
    </body>
</html>
