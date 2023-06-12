
@extends('Layouts.front')

@section('content')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <div id="main" class="scrolled-offset">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

          <ol>
            <li><a href="/">ACCUEIL</a></li>
            <li>DATACENTERS</li>
          </ol>
          <h2>CENTRES DE DONNEES</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <div class="p-4">
        <div class="">
            <div class="">
                <div class="m-2">
                    <div class=""><button data-target="#addFournisseur" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus-circle" title="Ajouter un datacenter"></i> Ajouter</button></div>
                </div>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-sm table-hover data-table">
                        <thead>
                              <tr>
                                    <th>NOM</th>
                                    <th>MISE EN SERVICE</th>
                                    <th>PROPRIETAIRE</th>
                                    <th>OPERATEUR</th>
                                    <th>COMMUNE</th>
                                    <th></th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($centres as $p)
                                <tr>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->start?date_format($p->start,'d/m/Y'):'-' }}</td>
                                    <td>{{ $p->owner }}</td>
                                    <td>{{ $p->operateur }}</td>
                                    <td>{{ $p->commune?$p->commune->name:'-' }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>
  </div>
@endsection

@section('modal')
<div class="modal fade" id="addFournisseur">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NOUVEAU DATACENTER</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="/account/datacenters">
        <div class="modal-body">
            @csrf
          <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="name" required placeholder="Intitule" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 mt-3">
                    <div class="form-group">
                        <input type="date" name="start" required placeholder="Date de mise en service" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="owner" required placeholder="Proprietaire des donnees" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="operateur" required placeholder="Operateur du centre" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <select name="commune_id" id="" required class="form-control">
                            <option value="">Communes ...</option>
                            @foreach ($communes as $opt)
                                <option value="{{ $opt->id }}">{{ $opt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <style>
    .form-group{
        margin: 10px;
    }
  </style>
@endsection
