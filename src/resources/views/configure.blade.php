@extends('web::layouts.grids.12')

@section('title', trans('moonbot::moonbot.configure'))
@section('page_header', trans('moonbot::moonbot.configure'))

@push('head')
<link rel = "stylesheet"
   type = "text/css"
   href = "https://snoopy.crypta.tech/snoopy/seat-moonbot-configure.css" />
@endpush

@section('full')

@if($apis->isEmpty())

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">{{ trans('moonbot::moonbot.no_api') }}</h3>
    </div>
    <div class="card-body">
        <p>You dont appear to have any APIs configured. Perhaps you should check out the instructions page!</p>
        <a type="button" href="{{ route('moonbot.instructions') }}" class="btn btn-warning">Instructions</a>
    </div>
</div>

@endif

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">{{ trans('moonbot::moonbot.existing_api') }}</h3>
        <div class="card-tools float-right">
            <button type="button" class="btn btn-xs btn-tool" id="addApi" data-toggle="tooltip" data-placement="top"
                title="Add a new API">
                <span class="fa fa-plus-square"></span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="apis" class="table table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ trans('moonbot::moonbot.name') }}</th>
                    <th>{{ trans('moonbot::moonbot.slug') }}</th>
                    <th>{{ trans('moonbot::moonbot.token') }}</th>
                    <th>{{ trans_choice('web::seat.corporation', 2) }}</th>
                    <th>{{ trans('moonbot::moonbot.delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apis as $api)
                <tr>
                    <td>{{ $api->name }}</td>
                    <td>{{ $api->slug }}</td>
                    <td>{{ $api->token }}</td>
                    <td>@foreach($api->corporations as $corp) {{ $corp->name }}, @endforeach</td>
                    <td>
                        <a class="btn btn-xs btn-primary" role="button" href="{{ route('moonbot.public', $api->slug) }}">Show</a>
                        <a class="btn btn-xs btn-danger" role="button" href="{{ route('moonbot.deleteApi', $api->id) }}">Delete!</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        Plugin maintained by <a href="{{ route('squadsync.about') }}"> {!! img('characters', 'portrait', 96057938, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Crypta Electrica</a>. <span class="float-right snoopy" style="color: #fa3333;"><i class="fas fa-signal"></i></span>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="apiEditModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{ trans('moonbot::moonbot.new') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form role="form" action="{{ route('moonbot.createApi') }}" method="post" class="needs-validation"
                novalidate>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">{{ trans('moonbot::moonbot.name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    required>
                                <div class="valid-feedback">Looks Good!</div>
                                <div class="invalid-feedback">You need to specify a name</div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group">
                                <label for="corps">{{ trans_choice('web::seat.corporation', 2) }}</label>
                                <select multiple="multiple" id="corps" name="corporations[]" class="form-control selectpicker"
                                    style="width: 100%;" size="7" required>
                                    @foreach($corps as $corp)
                                    <option value="{{ $corp->corporation_id }}">
                                        {{ $corp->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks Good!</div>
                                <div class="invalid-feedback">You need to specify at least one corporation to grant</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group float-right" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" id="savefitting" value="Create Api" />
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@push('javascript')
@include('web::includes.javascript.id-to-name')
<script type="application/javascript">
    $(function () {
        $('#apis').DataTable();

        $('#corps').select2();

        $('#addApi').on('click', function () {
            $('#apiEditModal').modal('show');
        });

        $('#apiEditModal').on('shown.bs.modal', function () {
            $('#apiEditModal').trigger('focus')
        });

    });
</script>

<script type="application/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>



@endpush