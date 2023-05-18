
@extends('layouts.admin')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">REGIONS</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Regions</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  <div class="">
        <div class="card card-light">
            <div class="card-header">
                <div class="pull-right"><button data-target="#addFournisseur" data-toggle="modal" class="btn btn-xs btn-info"><i class="fa fa-plus-circle" title="Ajouter une region"></i></button></div>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover data-table">
                    <thead>
                          <tr>
                                <th>NOM</th>
                                <th>EXPLOITANTS</th>
                                <th>COOPERATIVES</th>
                                <th>GICS</th>
                                <th>ZONES</th>
                                <th>VILLAGES</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($regions as $p)
                            <tr>
                                <td><a href="/admin/regions/{{$p->id}}"></a> {{ $p->name }}</td>
                                <td>{{ number_format($p->exploitants->count()) }}</td>
                                <td>{{ number_format($p->cooperatives->count()) }}</td>
                                <td>{{ number_format($p->gics->count()) }}</td>
                                <td>{{ number_format($p->zones->count()) }}</td>
                                <td>{{ number_format($p->villages->count()) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
  </div>

  <div class="modal fade" id="addFournisseur">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">AJOUT D'UNE REGION</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/admin/regions">
        <div class="modal-body">
            @csrf
          <div class="row">
              <div class="col-md-8 col-sm-12">
                  <div class="form-group">
                      <input  required type="text" name="name" placeholder="Nom" class="form-control" >
                  </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <input required type="text" name="abb" placeholder="ABBREVIATION" class="form-control">
                </div>
            </div>

          </div>
          <fieldset>
              <legend>Infos Admin</legend>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="user_name" required=true placeholder="Nom d'utilisation" class="form-control">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input required type="text" name="phone" placeholder="Telephone" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input required type="text" name="email" placeholder="Email" required=true class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="password" required placeholder="Mot de passe" class="form-control">
                    </div>
                </div>
              </div>
          </fieldset>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@endsection
