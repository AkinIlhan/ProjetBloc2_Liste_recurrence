CREATE TABLE site(
   id_site INT AUTO_INCREMENT,
   nom_site VARCHAR(50) NOT NULL,
   actif_site BOOLEAN,
   PRIMARY KEY(id_site)
);

CREATE TABLE role(
   id_role INT AUTO_INCREMENT,
   nom_role VARCHAR(50),
   PRIMARY KEY(id_role)
);

CREATE TABLE statut(
   id_statut INT AUTO_INCREMENT,
   nom_statut VARCHAR(50),
   PRIMARY KEY(id_statut)
);

CREATE TABLE unite(
   id_unite INT AUTO_INCREMENT,
   nom_unite VARCHAR(50),
   PRIMARY KEY(id_unite)
);

CREATE TABLE utilisateur(
   id_utilisateur INT AUTO_INCREMENT,
   nom_utilisateur VARCHAR(50) NOT NULL,
   prenom_utilisateur VARCHAR(50) NOT NULL,
   mail_utilisateur VARCHAR(50) NOT NULL,
   mdp_utilisateur VARCHAR(70) NOT NULL,
   token_utilisateur VARCHAR(64),
   date_exp_token_utilisateur DATETIME,
   valide_utilisateur BOOLEAN,
   actif_utilisateur BOOLEAN NOT NULL,
   id_role INT NOT NULL,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(mail_utilisateur),
   FOREIGN KEY(id_role) REFERENCES role(id_role)
);

CREATE TABLE batiment(
   id_batiment INT AUTO_INCREMENT,
   nom_batiment VARCHAR(50),
   actif_batiment BOOLEAN,
   id_site INT NOT NULL,
   PRIMARY KEY(id_batiment),
   FOREIGN KEY(id_site) REFERENCES site(id_site)
);

CREATE TABLE lieu(
   id_lieu INT AUTO_INCREMENT,
   nom_lieu VARCHAR(50) NOT NULL,
   actif_lieu BOOLEAN,
   id_batiment INT NOT NULL,
   PRIMARY KEY(id_lieu),
   FOREIGN KEY(id_batiment) REFERENCES batiment(id_batiment)
);

CREATE TABLE recurrence(
   id_recurrence INT AUTO_INCREMENT,
   sujet_reccurrence VARCHAR(50),
   desc_recurrence VARCHAR(512),
   date_anniv_recurrence DATE,
   valeur_freq_recurrence INT,
   valeur_rappel_recurrence INT,
   id_lieu INT NOT NULL,
   id_unite INT NOT NULL,
   id_unite_1 INT NOT NULL,
   PRIMARY KEY(id_recurrence),
   FOREIGN KEY(id_lieu) REFERENCES lieu(id_lieu),
   FOREIGN KEY(id_unite) REFERENCES unite(id_unite),
   FOREIGN KEY(id_unite_1) REFERENCES unite(id_unite)
);

CREATE TABLE demande(
   id_demande INT AUTO_INCREMENT,
   num_ticket_dmd VARCHAR(50),
   sujet_dmd VARCHAR(50),
   description_dmd VARCHAR(512),
   date_creation_dmd DATETIME,
   commentaire_admin_dmd VARCHAR(512),
   id_recurrence INT,
   id_utilisateur INT NOT NULL,
   id_lieu INT NOT NULL,
   PRIMARY KEY(id_demande),
   UNIQUE(num_ticket_dmd),
   FOREIGN KEY(id_recurrence) REFERENCES recurrence(id_recurrence),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
   FOREIGN KEY(id_lieu) REFERENCES lieu(id_lieu)
);

CREATE TABLE tache(
   id_tache INT AUTO_INCREMENT,
   sujet_tache VARCHAR(50),
   description_tache VARCHAR(512),
   date_creation_tache DATETIME,
   date_planif_tache DATETIME,
   date_fin_tache DATETIME,
   commentaire_technicien_tache VARCHAR(512),
   ordre_tache INT,
   id_utilisateur INT NOT NULL,
   id_demande INT NOT NULL,
   PRIMARY KEY(id_tache),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
   FOREIGN KEY(id_demande) REFERENCES demande(id_demande)
);

CREATE TABLE media(
   id_media INT AUTO_INCREMENT,
   nom_media VARCHAR(50),
   url_media VARCHAR(1024),
   id_demande INT,
   id_tache INT,
   PRIMARY KEY(id_media),
   FOREIGN KEY(id_demande) REFERENCES demande(id_demande),
   FOREIGN KEY(id_tache) REFERENCES tache(id_tache)
);

CREATE TABLE travaille(
   id_utilisateur INT,
   id_batiment INT,
   PRIMARY KEY(id_utilisateur, id_batiment),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
   FOREIGN KEY(id_batiment) REFERENCES batiment(id_batiment)
);

CREATE TABLE historique(
   id_tache INT,
   id_statut INT,
   date_modif DATETIME,
   PRIMARY KEY(id_tache, id_statut),
   FOREIGN KEY(id_tache) REFERENCES tache(id_tache),
   FOREIGN KEY(id_statut) REFERENCES statut(id_statut)
);

CREATE TABLE est(
   id_demande INT,
   id_statut INT,
   date_modif_dmd DATETIME,
   PRIMARY KEY(id_demande, id_statut),
   FOREIGN KEY(id_demande) REFERENCES demande(id_demande),
   FOREIGN KEY(id_statut) REFERENCES statut(id_statut)
);
