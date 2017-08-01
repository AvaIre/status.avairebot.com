@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="alert alert-{{ $status['css'] }}">
                <span class="font-large">
                    <strong>{{ $status['txt'] }}</strong>
                </span>
                <span class="last-updated">
                    Refreshed <span id="refresh-time" data-seconds="{{ $status['ref'] }}">
                        <i>Loading last refresh date...</i>
                    </span>
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

@section('scripts')
    <script type="text/javascript">
        $(function() {
            var refreshTimeObj = $('#refresh-time');
            var refreshSeconds = refreshTimeObj.data('seconds');

            var prepareUptimeFormat = function (number, name) {
                return `${number} ${name}` + (number === 1 ? '' : 's');
            }

            var incrementSeconds = function () {
                let h = Math.floor((refreshSeconds % 86400) / 3600);
                let m = Math.floor(((refreshSeconds % 86400) % 3600) / 60);
                let s = Math.floor(((refreshSeconds % 86400) % 3600) % 60);

                if (h > 0) {
                    var refreshMessage = `${prepareUptimeFormat(h, 'hour')}, and ${prepareUptimeFormat(m, 'minute')}`;
                } else if (m > 0) {
                    var refreshMessage = prepareUptimeFormat(m, 'minute');
                } else {
                    var refreshMessage = prepareUptimeFormat(s, 'second');
                }

                refreshTimeObj.text(refreshMessage + ' ago');
                refreshSeconds++;
            }

            incrementSeconds();
            setInterval(incrementSeconds, 1000);
        });
    </script>
@endsection
