
@extends('Layouts.admin')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">CATEGORIES DE PUBLICATION</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('content')
  <div class="">
        <div class="card card-light">
            <div class="card-body">
                <div class="card-header">
                    <div class="pull-right"><button data-target="#addFournisseur" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus-circle" title="Ajouter une entreprise"></i></button></div>
                </div>
                <table class="table table-bordered table-sm table-hover data-table">
                    <thead>
                          <tr>
                                <th>NOM</th>

                                <th></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $p)
                            <tr>
                                <td><a href="#"></a> {{ $p->name }}</td>

                                <td></td>
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
          <h4 class="modal-title">NOUVELLE CATEGORIE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="/admin/categories">
        <div class="modal-body">
            @csrf
          <div class="row">
              <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                      <input type="text" name="name" placeholder="Nom" class="form-control">
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
@endsection
