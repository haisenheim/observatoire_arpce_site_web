
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offset">
        <div class="container">
            <div class="m-5">
                <form method="POST" action="/account/fiches">
                    <div class="modal-body">
                        @csrf
                      <div style="max-width: 600px; margin:10px auto;" class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-title">
                                        <h5>FORMULE DE COLLECTE DE DONNEES</h5>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="annee" placeholder="Annee" class="form-control">
                                    </div>
                                    <fieldset>
                                        <legend>Emissions de GES</legend>
                                        <div class="form-group mt-2">
                                            <input type="text" name="ges_ge" placeholder="Groupe electrogène (temps de fonctionnement et Puissance)" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="ges_equip_dc" placeholder="Equipement des datacenters (données supplémentaires en annexe)" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="ges_infra" placeholder="Construction de l'infrastructure des réseaux (données supplémentaires en annexe)" class="form-control">
                                        </div>
                                    </fieldset>


                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success">Enregistrer</button>
                                      </div>
                                </div>
                            </div>
                      </div>
                    </div>

                    </form>
            </div>
        </div>
    </div>
@endsection
