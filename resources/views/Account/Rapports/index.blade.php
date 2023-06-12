
@extends('Layouts.front')

@section('content')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<main id="main" class="scrolled-offset">
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

              <ol>
                <li><a href="/">ACCUEIL</a></li>
                <li>Rapports</li>
              </ol>
              <h2>Rapports</h2>

            </div>
          </section><!-- End Breadcrumbs -->

  <div style="max-height:300px; overflow: scroll;" class="">
    <div class="">
        <div class="p-3">
            <div class="m-2">
                <div class=""><button data-target="#addFournisseur" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus-circle" title="Ajouter un rapport"></i> Ajouter un rapport</button></div>
            </div>
            <table class="table table-bordered table-sm table-hover data-table">
                <thead>
                      <tr>
                            <th>ANNEE</th>
                            <th>INTITULE</th>
                            <th></th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($rapports as $p)
                        <tr>
                            <td>{{ $p->annee }}</td>
                            <td><a href="{{ $p->fichier }}"> {{ $p->name }} </a></td>

                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</main>

@endsection

@section('modal')
<div class="modal fade" id="addFournisseur">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NOUVEAU RAPPORT</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="/account/rapports">
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
                    <input type="number" name="annee" required placeholder="Annee" class="form-control">
                </div>
            </div>
              <div class="col-md-12 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="">FICHIER PDF</label>
                    <input type="file" name="fichier_uri" required class="form-control">
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
