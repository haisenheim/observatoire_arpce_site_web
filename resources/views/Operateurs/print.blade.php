<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #3a3a3b;
          }
          table {
            border-collapse: collapse;
          }
          .table-bordered thead td, .table-bordered thead th {
            border-bottom-width: 1px;
          }
          .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #222222;
              border-bottom-width: 1px;
          }
          .table-bordered td, .table-bordered th {
            border: 1px solid #222;
              border-bottom-color: #222;
              border-bottom-style: solid;
              border-bottom-width: 1px;
          }
          .table-sm td, .table-sm th {
            padding: .3rem;
          }

          .table td {
            font-size: 12px;*3
          }

          .i-circle {
                background: #aaaaaa;
                color: #222;
                border-color: #222;
                padding: 10px 5px;
                border-radius: 50%;
            }
      </style>
    <img src="img/entete.png" style="width: 100%" alt="">

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th style="font-size: 11px;">
                        DATE DE COLLECTE : |_|_| <br>
                        ______________________
                </th>
                <th style="font-size: 11px;">
                        REGION:|_|_| <br>
                        SUD
                </th>
                <th style="font-size: 11px;">
                        DEPARTEMENT: |_|_| <br>
                        VALLEE DU NTEM
                </th>
                <th style="font-size: 11px;">
                        BASSIN DE PRODUCTION: |_|_|<br>
                        {{ $operateur->arrondissement }}
                </th>
            </tr>
        </tbody>
    </table>
    <p style="width: 95%; margin:10px auto;">
        Instructions : Encercler le(s) numéro(s) correspondant à votre réponse et/ou remplir la case à cocher
    </p>
    <table class="table table-sm table-bordered">
        <tbody>
            <tr>
                <td></td>
                <td>QUESTIONS</td>
                <td>REPONSES</td>
            </tr>
            <tr><td colspan="3"><div style="width: 250px; margin:2px auto;">Section 0 : IDENTIFICATION DE L'ACTEUR </div></td></tr>
            <tr>
                <td>Q001</td>
                <td>Nom de l'acteur</td>
                <td>{{ $operateur->name }}</td>
            </tr>
            <tr>
                <td>Q002</td>
                <td>Localité de résidence de l'acteur</td>
                <td>{{ $operateur->residence }}</td>
            </tr>
            <tr>
                <td>Q003</td>
                <td>Type d'acteur</td>
                <td><span class="i-circle">1</span>-Acteur individuel 2-GIC 3-UGIC 4-FUGIC 5-SCOOP <br>  6-USCOOP 7-Autre </td>
            </tr>
            <tr>
                <td>Q004</td>
                <td>L’acteur est-il membre d’une organisation professionnelle/faitière ?</td>
                <td><span class="i-circle">1</span>-OUI 2-NON  <br> Si OUI précisez : <span style="text-decoration: underline"> SCAM MAYAE COOP-CA </span></td>
            </tr>
            <tr>
                <td>Q005</td>
                <td style="padding-top: 0;">
                    Contact de l’acteur (ou son représentant)

                    <br>
                    <span style="text-align: right;">NOM :</span>
                    <br>
                    <span style="text-align: right;">Sexe :</span>
                    <br>
                    <span style="text-align: right;">Tel :</span>
                    <br>
                    <span style="text-align: right;">E-mail :</span>
                    <br>
                    <span style="text-align: right;">BP :</span>

                </td>
                <td>
                   <span style="text-align: right;"></span>
                    <br>
                     <br>
                    <span style="text-align: right;">{{ $operateur->name }}</span>
                    <br>
                    <span style="text-align: right;">{{ $operateur->sexe }}</span>
                    <br>
                    <span style="text-align: right;">{{ $operateur->phone }}</span>
                    <br>
                    <span style="text-align: right;">{{ $operateur->mobile }}</span>
                    <br>
                    <span style="text-align: right;">________________________________</span>
                    <br>
                    <span style="text-align: right;">________________________________</span>

                </td>
            </tr>
            <tr>
                <td>Q006</td>
                <td>Domaine d’activité de l’acteur  </td>
                <td>1. Production des semences cabosses   2. Production des plants             <span class="i-circle"> 3.</span> Production des fèves de cacao    4. Achat et commercialisation des fèves (coxeur, OP…)  5. transformation
                    6 Fourniture d’intrants   7 Autre
                    </td>
            </tr>
        </tbody>
    </table>

  </body>
</html>
