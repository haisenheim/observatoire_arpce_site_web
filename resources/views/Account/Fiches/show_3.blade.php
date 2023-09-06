
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offset">
        <div class="container">
            <div class="m-5">
                <div style="max-width: 700px; margin:10px auto;" class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="section-title">
                                <h5>FICHE DE COLLECTE DE DONNEES {{ $fiche->annee }}</h5>
                            </div>

                            <h4 class="text-bold">I  - Emissions de GES et consommations énergétiques des opérateurs de communications électroniques</h4>
                            <h6 class="text-bold mt-4 mb-4">I.1 Emissions de GES</h6>
                            <table class="table table-hover table-sm table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Ensemble des émissions  de gaz à effet de serre au Congo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Groupe electrogène (temps de fonctionnement et Puissance)</td>
                                        <td>{{ $fiche->ges_ge }}</td>
                                    </tr>
                                    <tr>
                                        <td>Equipement des datacenters (données supplémentaires en annexe)</td>
                                        <td>{{ $fiche->ges_equip_dc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Construction de l'infrastructure des réseaux (données supplémentaires en annexe) </td>
                                        <td>{{ $fiche->ges_infra }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <h4 class="bg-light text-dark">Données caractéristiques des centres de données</h4>
                            <div>
                                <div>
                                    <div class=""><button data-target="#addModal" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus-circle" title="Lier un datacenter"></i>Renseigner un datacenter</button></div>
                                </div>
                                <table class="table table-sm table-bordered table-hover">
                                    <thead class="table-success">
                                        <tr>
                                            <td>DATACENTER</td>
                                            <td>COMMUNE</td>
                                            <td>Conso. élec. annuelle</td>
                                            <td>Conso. élec. annuelle des équip. info.</td>
                                            <td>Vol. d'eau annuel entrant</td>
                                            <td>Vol. d'eau annuel sortant</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fiche->datafiches as $d)
                                            <tr>
                                                <td>{{ $d->datacenter->name }}</td>
                                                <td>{{ $d->datacenter->commune?$d->datacenter->commune->name:'-' }}</td>
                                                <td>{{ $d->conso_elec_dc }} GWh</td>
                                                <td>{{ $d->conso_elec_equip }} GWh</td>
                                                <td>{{ $d->vol_eau_entrant }} m3</td>
                                                <td>{{ $d->vol_eau_sortant }} m3</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('modal')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Renseigner les données caractéristiques du centre de données</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('account.save-fiche') }}">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="token" value="{{ $fiche->token }}">
            <div class="">
                    <div class="">
                        <div class="form-group">
                            <select name="datacenter_id" id="" required class="form-control">
                                <option value="">Datacenter ...</option>
                                @foreach ($datacenters as $opt)
                                    <option value="{{ $opt->id }}">{{ $opt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Consommation électrique</legend>
                        <div class="form-group mt-2">
                            <input type="text" name="conso_elec_dc" placeholder="Consommation électrique annuelle du centre de données (GWh)" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" name="conso_elec_equip" placeholder="Consommation électrique annuelle des équipements informatiques du centre de données (GWh)" class="form-control">
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Consommation d'eau</legend>
                        <div class="form-group mt-2">
                            <input type="text" name="vol_eau_entrant" placeholder="Volume d'eau annuel entrant dans le centre de données (total en m3)" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <input type="text" name="vol_eau_sortant" placeholder="Volume d'eau annuel sortant dans le centre de données (total en m3)" class="form-control">
                        </div>
                    </fieldset>
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
@endsection
