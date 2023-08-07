
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offset">
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <div style="min-height:300px; overflow: scroll;" class="mt-4 p-2">
                <div>
                    <div class="pull-right"><a href="/account/fiches/create" class="btn btn-xs btn-success"><i class="fa fa-edit" title="Ajouter une fiche"></i>Remplir une fiche</a></div>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach ($fiches as $p)
                            <div class="col-md-3 col-sm-12">
                                <a href="/account/fiches/{{ $p->token }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{{ $p->annee }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
@endsection

