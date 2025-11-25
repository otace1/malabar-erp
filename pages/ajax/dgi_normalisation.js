/**
 * Script JavaScript pour la normalisation DGI des factures
 */

function normaliserFactureDGI(ref_fact) {
    if (!confirm('Voulez-vous normaliser cette facture avec la DGI ?\n\nCette action va générer un code QR et enregistrer les informations DGI.')) {
        return;
    }

    // Afficher un loader
    Swal.fire({
        title: 'Normalisation en cours...',
        html: 'Veuillez patienter pendant la normalisation de la facture avec la DGI.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Appel AJAX
    $.ajax({
        url: 'ajax/normaliser_facture_dgi.php',
        type: 'POST',
        data: {
            ref_fact: ref_fact
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès !',
                    html: '<div style="text-align: left;"><strong>Facture normalisée avec succès</strong><br><br>' +
                          '<p><b>UID:</b> ' + response.data.uid + '</p>' +
                          '<p><b>Code DEF DGI:</b> ' + response.data.codeDEFDGI + '</p>' +
                          '<p><b>NIM (e-MCF):</b> ' + (response.data.nim || 'N/A') + '</p>' +
                          '<p><b>Type Facture:</b> ' + (response.data.typeFacture || 'FV') + '</p>' +
                          '<p><b>NIF:</b> ' + (response.data.nif || 'N/A') + '</p>' +
                          '<p><b>Compteur:</b> ' + (response.data.compteur || 'N/A') + '</p>' +
                          '<p><b>Date:</b> ' + response.data.dateTime + '</p></div>',
                    confirmButtonText: 'OK',
                    width: '600px'
                }).then(() => {
                    // Recharger la page ou le tableau
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: '<strong>Erreur lors de la normalisation:</strong><br>' + response.error,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX:', error);
            console.error('Réponse:', xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Erreur serveur',
                html: '<strong>Une erreur est survenue:</strong><br>' + error + '<br><br>' +
                      'Veuillez vérifier la console pour plus de détails.',
                confirmButtonText: 'OK'
            });
        }
    });
}

// Fonction pour afficher les détails DGI d'une facture normalisée
function afficherDetailsDGI(ref_fact) {
    $.ajax({
        url: 'ajax/get_facture_dgi_details.php',
        type: 'POST',
        data: {
            ref_fact: ref_fact
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const data = response.data;
                Swal.fire({
                    title: 'Détails DGI',
                    html: '<div style="text-align: left;">' +
                          '<p><strong>UID:</strong> ' + data.code_UID + '</p>' +
                          '<p><strong>Code DEF DGI:</strong> ' + data.code_DEF_DGI + '</p>' +
                          '<p><strong>NIM (e-MCF):</strong> ' + (data.nim_DGI || 'N/A') + '</p>' +
                          '<p><strong>Type Facture:</strong> ' + (data.type_facture_DGI || 'N/A') + '</p>' +
                          '<p><strong>NIF:</strong> ' + (data.nif_DGI || 'N/A') + '</p>' +
                          '<p><strong>Compteur:</strong> ' + (data.compteur_DGI || 'N/A') + '</p>' +
                          '<p><strong>QR Code:</strong> <code style="font-size: 10px;">' + (data.qrcode_string_DGI || 'N/A') + '</code></p>' +
                          '<p><strong>Date normalisation:</strong> ' + data.date_DGI + '</p>' +
                          '<p><strong>Utilisateur:</strong> ' + data.nom_util + '</p>' +
                          '</div>',
                    confirmButtonText: 'Fermer',
                    width: '700px'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: response.error,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Impossible de récupérer les détails DGI',
                confirmButtonText: 'OK'
            });
        }
    });
}

/**
 * Fonction pour normaliser une facture d'avoir (FA - Credit Note)
 * Cette fonction transforme une facture normale en facture d'avoir
 * Les champs DGI normaux sont mis à NULL et les champs _FA sont remplis
 */
function normaliserFactureAvoirDGI(ref_fact) {
    if (!confirm('Voulez-vous créer une FACTURE D\'AVOIR (Credit Note) pour cette facture ?\n\n' +
                 '⚠️ ATTENTION :\n' +
                 '- Les informations DGI normales (FV) seront supprimées\n' +
                 '- Une nouvelle facture d\'avoir (FA) sera créée\n' +
                 '- Les montants seront négatifs (remboursement)\n\n' +
                 'Confirmer cette action ?')) {
        return;
    }

    // Afficher un loader
    Swal.fire({
        title: 'Création de la facture d\'avoir...',
        html: 'Veuillez patienter pendant la normalisation de la facture d\'avoir avec la DGI.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Appel AJAX
    $.ajax({
        url: 'ajax/normaliser_facture_avoir_dgi.php',
        type: 'POST',
        data: {
            ref_fact: ref_fact
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès !',
                    html: '<div style="text-align: left;"><strong>Facture d\'avoir normalisée avec succès</strong><br><br>' +
                          '<p><b>UID FA:</b> ' + response.data.uid + '</p>' +
                          '<p><b>Code DEF DGI FA:</b> ' + response.data.codeDEFDGI + '</p>' +
                          '<p><b>NIM (e-MCF):</b> ' + (response.data.nim || 'N/A') + '</p>' +
                          '<p><b>Type Facture:</b> <span style="color: red; font-weight: bold;">FA (AVOIR)</span></p>' +
                          '<p><b>NIF:</b> ' + (response.data.nif || 'N/A') + '</p>' +
                          '<p><b>Compteur:</b> ' + (response.data.compteur || 'N/A') + '</p>' +
                          '<p><b>Date:</b> ' + response.data.dateTime + '</p>' +
                          '<p><b>Facture Origine:</b> ' + response.data.factureOrigine + '</p></div>',
                    confirmButtonText: 'OK',
                    width: '600px'
                }).then(() => {
                    // Recharger la page ou le tableau
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: '<strong>Erreur lors de la création de la facture d\'avoir:</strong><br>' + response.error,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX:', error);
            console.error('Réponse:', xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'Erreur serveur',
                html: '<strong>Une erreur est survenue:</strong><br>' + error + '<br><br>' +
                      'Veuillez vérifier la console pour plus de détails.',
                confirmButtonText: 'OK'
            });
        }
    });
}

// Fonction pour afficher les détails DGI d'une facture d'avoir normalisée
function afficherDetailsAvoirDGI(ref_fact) {
    $.ajax({
        url: 'ajax/get_facture_avoir_dgi_details.php',
        type: 'POST',
        data: {
            ref_fact: ref_fact
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const data = response.data;
                Swal.fire({
                    title: 'Détails DGI - Facture d\'Avoir (FA)',
                    html: '<div style="text-align: left;">' +
                          '<p><strong>Type:</strong> <span style="color: red; font-weight: bold;">FACTURE D\'AVOIR (FA)</span></p>' +
                          '<p><strong>UID FA:</strong> ' + data.code_UID_FA + '</p>' +
                          '<p><strong>Code DEF DGI FA:</strong> ' + data.code_DEF_DGI_FA + '</p>' +
                          '<p><strong>NIM (e-MCF):</strong> ' + (data.nim_DGI_FA || 'N/A') + '</p>' +
                          '<p><strong>Type Facture:</strong> ' + (data.type_facture_DGI_FA || 'FA') + '</p>' +
                          '<p><strong>NIF:</strong> ' + (data.nif_DGI_FA || 'N/A') + '</p>' +
                          '<p><strong>Compteur:</strong> ' + (data.compteur_DGI_FA || 'N/A') + '</p>' +
                          '<p><strong>QR Code:</strong> <code style="font-size: 10px;">' + (data.qrcode_string_DGI_FA || 'N/A') + '</code></p>' +
                          '<p><strong>Date normalisation:</strong> ' + data.date_DGI_FA + '</p>' +
                          '<p><strong>Facture Origine:</strong> ' + (data.facture_origine_ref || 'N/A') + '</p>' +
                          '<p><strong>Utilisateur:</strong> ' + data.nom_util + '</p>' +
                          '</div>',
                    confirmButtonText: 'Fermer',
                    width: '700px'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: response.error,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Impossible de récupérer les détails DGI de la facture d\'avoir',
                confirmButtonText: 'OK'
            });
        }
    });
}
