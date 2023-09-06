
@extends('Layouts.front')

@section('content')
    <div id="main" class="scrolled-offset">
        <div class="container">
            <div class="m-5">
                <form method="POST" action="{{ route('account.fiches.store') }}">
                    <div class="modal-body">
                        @csrf
                      <div style="max-width: 800px; margin:10px auto;" class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-title">
                                        <h5>FORMULE DE COLLECTE DE DONNEES</h5>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" required name="annee" placeholder="Annee" class="form-control">
                                    </div>
                                    <fieldset>
                                        <legend>ENERGIE ET EAU</legend>
                                        <div class="form-group mt-2">
                                            <input type="number" name="qt_eau" placeholder="Quantité d’eau en m3 consommée en litre / an ?" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="energie_elec" required placeholder="Énergie électrique consommée en kWh / an *" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="per_renew" required placeholder="Pourcentage d’énergie renouvelable utilisé" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="conso_elec_infra" placeholder="Consommation d’énergie des infrastructures réseau" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" required name="qt_carburant" placeholder="Quantité totale de carburant consommée par an en litre ? *" class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="text" name="carburant_ge" placeholder="Quel est le Carburant utilisé par les groupes électrogènes ?" class="form-control">
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>DECHETS</legend>
                                        <div class="form-group mt-2">
                                            <input type="text" name="qt_moy_papier" placeholder="Quantité moyenne de papier consommée en tonne / an " class="form-control">
                                        </div>
                                        <div class="form-group mt-2">
                                            <textarea name="how_about_old_equip" class="form-control" id="" placeholder="Comment sont gérés les équipements obsolètes?" cols="30" rows="4"></textarea>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Équipement Informatique</legend>
                                        <fieldset>
                                            <legend>Centre de données</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-12">
                                                        <input type="number" name="nb_datacenter" placeholder="Le nombre de data center ou salle serveur" class="form-control">
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <input type="number" name="conso_elec_datacenter" placeholder="La consommation moyenne d’énergie en kWh/salle" class="form-control">
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <input type="text" name="puissance_datacenter" placeholder="La puissance installée du Data center/salle" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Routeur</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_router" placeholder="nombre de routeurs" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_elec_router" placeholder="La consommation moyenne d’énergie en kWh par routeur" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Serveur</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_server" placeholder="nombre de serveurs" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_elec_server" placeholder="La consommation moyenne d’énergie en kWh par serveur" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Switch</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_switch" placeholder="nombre de switchs" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_elec_switch" placeholder="La consommation moyenne d’énergie en kWh par switch" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Climatisation</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_clim" placeholder="Nombre de module de climatisation" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_elec_clim" placeholder="La consommation moyenne d’énergie en kWh par module" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Onduleur</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_onduleur" placeholder="Nombre d'onduleur" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_elec_onduleur" placeholder="La consommation moyenne d’énergie en kWh par onduleur" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Groupe électrogène</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_ge" required placeholder="Nombre de groupe" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="puissance_ge" required placeholder="La puissance énergétique en KVA par groupe" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Terminaux</legend>
                                        <fieldset>
                                            <legend>Téléviseurs</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_tv" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_tv"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Ordinateurs portables</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_laptop" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_laptop"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Ordinateurs fixes</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_ordi" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_ordi"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Box internet</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_box" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_box"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Tablettes</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_tablet" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_tablet"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Téléphones fixes</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_phone" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_phone"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Vidéo projecteurs</legend>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="number" name="nb_projector" required placeholder="Nombre d’équipement" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <input type="text" name="conso_projector"  required placeholder="La consommation moyenne d’énergie Par appareil en kWh" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </fieldset>
                                    <fieldset>
                                        <legend>INFORMATIONS GÉNÉRALES</legend>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-12">
                                                    <label for="">Oui vous avez une politique environnementale </label>
                                                    <input type="checkbox" name="has_policy" class="form-check-control">
                                                </div>
                                                <div class="col-md-5 col-sm-12">
                                                    <input type="number" name="nb_staff"  required placeholder="Nombre de collaborateurs" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>SECTION COMMENTAIRES</legend>
                                        <div class="container">
                                            <textarea name="comment" id="" placeholder="Indiquez la méthodologie utilisée pour obtenir les données présentées. Toute suggestion constructive pour faire évoluer et améliorer la fiche est encouragée." class="form-control" cols="30" rows="5"></textarea>
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
