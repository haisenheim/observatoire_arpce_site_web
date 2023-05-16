@extends('Layouts.app')

@section('content')
 <div class="content">
     <h3>LISTE DES PRODUCTEURS</h3>
     <hr>
    <div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>&numero;</th>
                <th>IDENTIFIANT</th>
                <th>NOM ET PRENOM</th>
                <th>DATE DE NAISSANCE</th>
                <th>LIEU DE NAISSAINCE</th>
                <th>SEXE</th>
                <th>NUM CNI</th>
                <th>DATE CNI</th>
                <th>TELEPHONE</th>
                <th>MOBILE</th>
                <th>DATE EXP. CNI</th>
                <th>ARRONDISSEMENT</th>
                <th>RESIDENCE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operateurs as $operateur)
                <tr>
                    <td>{{ $operateur->id }}</td>
                    <td><a href="/print/{{ $operateur->id }}">{{ $operateur->identifiant }}</a></td>
                    <td>{{ $operateur->name }}</td>
                    <td>{{ $operateur->dtn?date_format($operateur->dtn,'d/m/Y'):'' }}</td>
                    <td>{{ $operateur->lieu }}</td>
                    <td>{{ $operateur->sexe }}</td>
                    <td>{{ $operateur->cni }}</td>
                    <td>{{ $operateur->date_cni?date_format($operateur->date_cni,'d/m/Y'):'' }}</td>
                    <td>{{ $operateur->phone }}</td>
                    <td>{{ $operateur->mobile }}</td>
                    <td>{{ $operateur->expiration_cni?date_format($operateur->expiration_cni,'d/m/Y'):'' }}</td>
                    <td>{{ $operateur->arrondissement }}</td>
                    <td>{{ $operateur->residence }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
 </div>
@endsection
