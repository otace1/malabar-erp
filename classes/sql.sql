

INSERT INTO `affectation_debours_client_modele_licence` (`id_deb`, `id_cli`, `id_mod_lic`, `code_serv`, `montant`, `usd`, `tva`, `detail`) 
	VALUES ('86', '881', '2', NULL, NULL, '0', '0', '0'),
		('10', '881', '2', NULL, NULL, '0', '0', '0'),
		('87', '881', '2', NULL, NULL, '0', '0', '0'),
		('26', '881', '2', NULL, NULL, '0', '0', '0'),
		('88', '881', '2', NULL, NULL, '0', '0', '0'),
		('89', '881', '2', NULL, NULL, '0', '0', '0'),
		('90', '881', '2', NULL, NULL, '0', '0', '0'),
		('91', '881', '2', NULL, NULL, '0', '0', '0'),
		('31', '881', '2', NULL, NULL, '0', '0', '0'),
		('32', '881', '2', NULL, NULL, '0', '0', '0'),
		('92', '881', '2', NULL, NULL, '0', '0', '0'),
		('12', '881', '2', NULL, NULL, '0', '0', '0');





CREATE TABLE `transmis_facture_dossier` (
  `id_trans_fact` int(11) NOT NULL,
  `date_create_fact` datetime NOT NULL DEFAULT current_timestamp(),
  `date_trans_fact` date NOT NULL,
  `ref_trans_fact` varchar(50) NOT NULL,
  `fichier_trans_fact` varchar(100) DEFAULT NULL,
  `id_util` int(11) NOT NULL,
  `finger` enum('0','1') NOT NULL DEFAULT '0',
  `id_util_finger` varchar(2) DEFAULT NULL,
  `date_finger` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `transmis_facture_dossier`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `transmis_facture_dossier`
--
ALTER TABLE `transmis_facture_dossier`
  ADD PRIMARY KEY (`id_trans_fact`),
  ADD UNIQUE KEY `ref_trans_fact` (`ref_trans_fact`),
  ADD KEY `id_util` (`id_util`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `transmis_facture_dossier`
--
ALTER TABLE `transmis_facture_dossier`
  MODIFY `id_trans_fact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `transmis_facture_dossier`
--
ALTER TABLE `transmis_facture_dossier`
  ADD CONSTRAINT `transmis_facture_dossier_ibfk_1` FOREIGN KEY (`id_util`) REFERENCES `utilisateur` (`id_util`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;



CREATE TABLE `detail_transmis_facture_dossier` (
  `id_trans_fact` int(11) NOT NULL,
  `ref_fact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Index pour la table `detail_transmis_facture_dossier`
--
ALTER TABLE `detail_transmis_facture_dossier`
  ADD PRIMARY KEY (`id_trans_fact`,`ref_fact`),
  ADD KEY `ref_fact` (`ref_fact`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_transmis_facture_dossier`
--
ALTER TABLE `detail_transmis_facture_dossier`
  ADD CONSTRAINT `detail_transmis_facture_dossier_ibfk_1` FOREIGN KEY (`id_trans_fact`) REFERENCES `transmis_facture_dossier` (`id_trans_fact`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transmis_facture_dossier_ibfk_2` FOREIGN KEY (`ref_fact`) REFERENCES `facture_dossier` (`ref_fact`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
