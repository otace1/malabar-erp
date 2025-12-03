<?php
/**
 * Page Z-Rapport DGI
 * Rapport de clôture de session fiscale (DÉFINITIF)
 */

include("tete.php");
include("menuHaut.php");
include("menuGauche.php");

// Charger la configuration DGI
require_once __DIR__ . '/../config/api_config.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="header">
        <h5>
          <i class="fas fa-file-invoice"></i> Z-RAPPORT DGI (Clôture de Session)
          <span class="float-right">
            <button class="btn btn-sm btn-danger" onclick="cloturerSession()">
              <i class="fas fa-lock"></i> Clôturer Session et Générer Z-Rapport
            </button>
            <button class="btn btn-sm btn-primary" onclick="imprimerRapportZ()" id="btn_imprimer" style="display:none;">
              <i class="fas fa-print"></i> Imprimer
            </button>
          </span>
        </h5>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Avertissement -->
      <!-- <div class="row">
        <div class="col-md-12">
          <div class="alert alert-warning">
            <h5><i class="icon fas fa-exclamation-triangle"></i> ATTENTION !</h5>
            <p><strong>Le Z-Rapport est DÉFINITIF et IRRÉVERSIBLE !</strong></p>
            <ul>
              <li>Il clôture la session fiscale actuelle</li>
              <li>Il génère un rapport archivé</li>
              <li>Une nouvelle session sera automatiquement créée</li>
              <li>Vous ne pourrez plus modifier les données de cette session</li>
            </ul>
            <p class="mb-0"><strong>Recommandation :</strong> Vérifiez d'abord avec un X-Rapport avant de clôturer.</p>
          </div>
        </div>
      </div> -->

      <!-- Info Session Actuelle -->
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-info">
            <h5><i class="icon fas fa-info"></i> Session Actuelle</h5>
            <div id="info_session_active">
              <i class="fas fa-spinner fa-spin"></i> Chargement des informations de la session...
            </div>
          </div>
        </div>
      </div>

      <!-- Statistiques de la Session -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="stat_nbre_factures">0</h3>
              <p>Factures dans cette Session</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="stat_montant_ht">0.00 USD</h3>
              <p>Montant Total HT</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="stat_montant_tva">0.00 USD</h3>
              <p>Montant Total TVA</p>
            </div>
            <div class="icon">
              <i class="fas fa-percentage"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="stat_montant_ttc">0.00 USD</h3>
              <p>Montant Total TTC</p>
            </div>
            <div class="icon">
              <i class="fas fa-money-bill-wave"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Aperçu du Rapport -->
      <div class="row" id="apercu_rapport" style="display:none;">
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-danger">
              <h3 class="card-title"><i class="fas fa-file-invoice"></i> Aperçu Z-Rapport</h3>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <h5>Informations Générales</h5>
                  <table class="table table-sm table-bordered">
                    <tr><td><strong>Dénomination:</strong></td><td id="info_denom"><?php echo defined('ENTREPRISE_NOM') ? ENTREPRISE_NOM : 'BELEJ'; ?></td></tr>
                    <tr><td><strong>NIF:</strong></td><td id="info_nif"><?php echo defined('ENTREPRISE_NIF') ? ENTREPRISE_NIF : 'A1809181A'; ?></td></tr>
                    <tr><td><strong>ISF (e-MCF ID):</strong></td><td id="info_isf"><?php echo defined('ENTREPRISE_EMCF_ID') ? ENTREPRISE_EMCF_ID : 'CD01002974-1'; ?></td></tr>
                    <tr><td><strong>Type de Rapport:</strong></td><td>Z-Rapport (Clôture)</td></tr>
                    <tr><td><strong>Numéro Session:</strong></td><td id="info_numero_session">-</td></tr>
                    <tr><td><strong>Période:</strong></td><td id="info_periode">-</td></tr>
                  </table>
                </div>
                <div class="col-md-6">
                  <h5>Totaux de la Session</h5>
                  <table class="table table-sm table-bordered">
                    <tr><td><strong>Nombre de factures:</strong></td><td id="total_factures">0</td></tr>
                    <tr><td><strong>Factures de Vente (FV):</strong></td><td id="total_fv">0</td></tr>
                    <tr><td><strong>Factures d'Avoir (FA):</strong></td><td id="total_fa">0</td></tr>
                    <tr><td><strong>Montant HT:</strong></td><td id="total_ht">0.00 USD</td></tr>
                    <tr><td><strong>Montant TVA:</strong></td><td id="total_tva">0.00 USD</td></tr>
                    <tr><td><strong>Montant TTC:</strong></td><td class="font-weight-bold text-danger" id="total_ttc">0.00 USD</td></tr>
                  </table>
                </div>
              </div>

              <hr>

              <h5>Par Type de Facture</h5>
              <div id="details_type_facture"></div>

              <hr>

              <h5>Par Groupe de Taxation</h5>
              <div id="details_taxation"></div>

              <hr>

              <h5>Liste des Factures</h5>
              <table id="table_factures" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Réf. Facture</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Client</th>
                    <th>Code DEF</th>
                    <th>Montant TTC</th>
                  </tr>
                </thead>
                <tbody id="tbody_factures"></tbody>
              </table>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let sessionActive = null;
let rapportData = null;

// Au chargement
$(document).ready(function() {
  chargerSessionActive();
});

// Charger la session active
function chargerSessionActive() {
  $.ajax({
    url: '../pages/ajax/generer_rapport_x.php',
    type: 'POST',
    dataType: 'json',
    data: { operation: 'generer_rapport_x' },
    success: function(response) {
      if (response.success) {
        sessionActive = response.session;
        rapportData = response.rapport;
        afficherSessionActive(response);
      } else {
        Swal.fire('Erreur', response.error || 'Impossible de charger la session', 'error');
      }
    },
    error: function() {
      Swal.fire('Erreur', 'Erreur serveur', 'error');
    }
  });
}

// Afficher les infos de session
function afficherSessionActive(response) {
  const rapport = response.rapport;

  $('#info_session_active').html(`
    <strong>Session:</strong> ${rapport.session.numero_session} |
    <strong>Débutée le:</strong> ${rapport.session.date_debut} |
    <strong>Par:</strong> ${rapport.session.utilisateur_ouverture}
  `);

  $('#stat_nbre_factures').text(rapport.statistiques.nbre_factures_total);
  $('#stat_montant_ht').text(formatMontant(rapport.statistiques.montant_total_ht) + ' USD');
  $('#stat_montant_tva').text(formatMontant(rapport.statistiques.montant_total_tva) + ' USD');
  $('#stat_montant_ttc').text(formatMontant(rapport.statistiques.montant_total_ttc) + ' USD');

  // Aperçu
  $('#info_numero_session').text(rapport.session.numero_session);
  $('#info_periode').text(rapport.session.date_debut + ' - Maintenant');
  $('#total_factures').text(rapport.statistiques.nbre_factures_total);
  $('#total_fv').text(rapport.statistiques.nbre_factures_fv);
  $('#total_fa').text(rapport.statistiques.nbre_factures_fa);
  $('#total_ht').text(formatMontant(rapport.statistiques.montant_total_ht) + ' USD');
  $('#total_tva').text(formatMontant(rapport.statistiques.montant_total_tva) + ' USD');
  $('#total_ttc').text(formatMontant(rapport.statistiques.montant_total_ttc) + ' USD');

  // Détails
  afficherDetailsTypeFacture(rapport.par_type_facture);
  afficherDetailsTaxation(rapport.par_groupe_taxation);
  afficherListeFactures(rapport.factures);

  $('#apercu_rapport').show();
}

// Clôturer la session
function cloturerSession() {
  if (!sessionActive) {
    Swal.fire('Erreur', 'Aucune session active', 'error');
    return;
  }

  Swal.fire({
    title: 'Clôturer la Session ?',
    html: `
      <p><strong>ATTENTION : Cette action est IRRÉVERSIBLE !</strong></p>
      <p>Session: <strong>${rapportData.session.numero_session}</strong></p>
      <p>Nombre de factures: <strong>${rapportData.statistiques.nbre_factures_total}</strong></p>
      <p>Montant total: <strong>${formatMontant(rapportData.statistiques.montant_total_ttc)} USD</strong></p>
      <br>
      <p>Confirmez-vous la clôture définitive ?</p>
    `,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Oui, clôturer !',
    cancelButtonText: 'Annuler'
  }).then((result) => {
    if (result.isConfirmed) {
      executerCloture();
    }
  });
}

// Exécuter la clôture
function executerCloture() {
  $.ajax({
    url: '../pages/ajax/generer_rapport_z.php',
    type: 'POST',
    dataType: 'json',
    data: {
      operation: 'cloturer_session',
      id_session: sessionActive.id_session
    },
    beforeSend: function() {
      Swal.fire({
        title: 'Clôture en cours',
        html: 'Génération du Z-Rapport et archivage...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
      });
    },
    success: function(response) {
      Swal.close();

      if (response.success) {
        Swal.fire({
          icon: 'success',
          title: 'Session Clôturée !',
          html: `
            <p>Z-Rapport généré avec succès</p>
            <p>Numéro: <strong>${response.rapport.numero_rapport}</strong></p>
            <p>Une nouvelle session a été créée automatiquement</p>
          `,
          confirmButtonText: 'OK'
        }).then(() => {
          $('#btn_imprimer').show();
          window.location.href = 'rapports_dgi_sessions.php';
        });
      } else {
        Swal.fire('Erreur', response.error || 'Échec de la clôture', 'error');
      }
    },
    error: function() {
      Swal.close();
      Swal.fire('Erreur', 'Erreur serveur lors de la clôture', 'error');
    }
  });
}

// Afficher détails type facture
function afficherDetailsTypeFacture(data) {
  let html = '<table class="table table-sm table-bordered">';
  html += '<thead><tr><th>Type</th><th>Nombre</th><th>Montant HT</th><th>TVA</th><th>TTC</th></tr></thead><tbody>';

  $.each(data, function(type, values) {
    html += `<tr>
      <td><strong>${type}</strong></td>
      <td>${values.nombre}</td>
      <td>${formatMontant(values.montant_ht)} USD</td>
      <td>${formatMontant(values.montant_tva)} USD</td>
      <td>${formatMontant(values.montant_ttc)} USD</td>
    </tr>`;
  });

  html += '</tbody></table>';
  $('#details_type_facture').html(html);
}

// Afficher détails taxation
function afficherDetailsTaxation(data) {
  let html = '<table class="table table-sm table-bordered">';
  html += '<thead><tr><th>Groupe</th><th>Description</th><th>Montant HT</th><th>TVA</th><th>TTC</th></tr></thead><tbody>';

  $.each(data, function(groupe, values) {
    let desc = groupe === 'A' ? 'Exonéré (0%)' : 'Taxable (16%)';
    html += `<tr>
      <td><strong>${groupe}</strong></td>
      <td>${desc}</td>
      <td>${formatMontant(values.montant_ht)} USD</td>
      <td>${formatMontant(values.montant_tva)} USD</td>
      <td>${formatMontant(values.montant_ttc)} USD</td>
    </tr>`;
  });

  html += '</tbody></table>';
  $('#details_taxation').html(html);
}

// Afficher liste factures
function afficherListeFactures(factures) {
  let tbody = '';
  $.each(factures, function(i, facture) {
    tbody += `<tr>
      <td>${facture.ref_fact}</td>
      <td>${facture.date_fact}</td>
      <td>${facture.type_facture}</td>
      <td>${facture.nom_cli}</td>
      <td>${facture.code_def}</td>
      <td class="text-right">${formatMontant(facture.montant_ttc)}</td>
    </tr>`;
  });
  $('#tbody_factures').html(tbody);
}

// Formater montant
function formatMontant(montant) {
  return parseFloat(montant).toLocaleString('fr-FR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });
}

// Imprimer
function imprimerRapportZ() {
  window.print();
}
</script>

<?php include("pied.php"); ?>
