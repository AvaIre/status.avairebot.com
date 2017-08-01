@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="alert alert-{{ $status['css'] }}">
                <span class="font-large">
                    <strong>{{ $status['txt'] }}</strong>
                </span>
                <span class="last-updated">
                    Refreshed {{ $status['ref']->diffForHumans() }}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="tab-title">
                        <h4>Application Metrics</h4>
                    </li>
                    <li><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
                    <li><a href="#channels" aria-controls="channels" role="tab" data-toggle="tab">Channels</a></li>
                    <li class="active"><a href="#servers" aria-controls="servers" role="tab" data-toggle="tab">Servers</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="servers">
                        <div style="width:100%; height: 180px;">
                            @include('partials.graph', ['obj' => $guilds])
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="channels">
                        <div style="width:100%; height: 180px;">
                            @include('partials.graph', ['obj' => $channels])
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="users">
                        <div style="width:100%; height: 180px;">
                            @include('partials.graph', ['obj' => $users])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
