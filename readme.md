# GestionReservation: Une Application de Gestion d’Activités et de Réservations

Bienvenue dans **GestionReservation**, une solution innovante permettant de gérer les membres, les activités, et les réservations via une architecture robuste basée sur la programmation orientée objet (POO) en PHP.

## 📚 Contexte du Projet
Ce projet est conçu pour répondre à un besoin de gestion efficace des activités et des réservations dans un cadre structurant. Basé sur un schéma de base de données défini, il exploite les concepts fondamentaux de la POO pour assurer modularité, réutilisabilité et maintenabilité.

---

## 📊 Architecture
Le projet repose sur trois entités principales :

### 1. **Membre**
- **Rôle** : Gérer les informations des membres inscrits.
- **Fonctionnalités** : Création de compte, consultation des réservations.

### 2. **Activité**
- **Rôle** : Gérer les activités proposées.
- **Fonctionnalités** : Ajout, modification, suppression et calcul de disponibilité.

### 3. **Réservation**
- **Rôle** : Gérer les réservations effectuées par les membres.
- **Fonctionnalités** : Confirmation, annulation, récapitulatif des réservations.

---

## 🔧 Fonctionnalités À Développer
### User Stories
#### En tant que membre :
- Créer un compte.
- Consulter les activités disponibles.
- Effectuer ou annuler une réservation.
- Visualiser un récapitulatif des réservations.

#### En tant qu’administrateur :
- Gérer les membres et leurs réservations.
- Ajouter, modifier ou supprimer des activités.
- Confirmer ou annuler des réservations.

### Système d’authentification et gestion des rôles
- **Connexion sécurisée** : Gestion des mots de passe hachés.
- **Rôles distincts** :
  - Membres : Gestion personnelle.
  - Administrateurs : Supervision globale.

---

## 🫠 Conception et Organisation

### Programmation Orientée Objet
- **Encapsulation** : Propriétés privées/protégées et méthodes getter/setter.
- **Constructeurs** : Initialisation simplifiée des objets.
- **Héritage** : Classe de base « Utilisateur », étendue par « Membre » et « Administrateur ».

### Interaction avec la Base de Données
- Utilisation de **PDO** pour assurer des interactions sécurisées.
- Fonctionnalités intégrées directement dans les classes.

---

## 🛠️ Technologies Utilisées
- **PHP** : Pour la logique backend et la gestion POO.
- **MySQL** : Pour la gestion des données.
- **HTML/CSS** : Interface utilisateur simple.

---

## 🔄 Workflow de Développement
1. Modélisation des entités et relations en POO.
2. Implémentation des interactions avec la base de données.
3. Ajout des fonctionnalités membres et administrateurs.
4. Système d’authentification et de rôles.
5. Tests unitaires pour valider chaque module.

---

## 🔎 Aperçu des Requêtes SQL Clés
- **Création d’une réservation confirmée** :
  ```sql
  INSERT INTO Reservation (id_membre, id_activite, date_reservation, status)
  VALUES (1, 1, NOW(), 'confirmee');
  ```

- **Consultation des trois activités les plus réservées** :
  ```sql
  SELECT titre, COUNT(*) AS nb_reservations
  FROM Reservation
  JOIN Activite ON Reservation.id_activite = Activite.id_activite
  GROUP BY titre
  ORDER BY nb_reservations DESC
  LIMIT 3;
  ```

---

## 🔧 Installation et Lancement
1. Clonez le dépôt :
   ```bash
   git clone <URL_du_depot>
   ```
2. Configurez la base de données MySQL.
3. Modifiez le fichier `config.php` avec vos paramètres.
4. Lancez le serveur PHP :
   ```bash
   php -S localhost:8000
   ```
5. Accédez à l’application via : [http://localhost:8000](http://localhost:8000).

---

## 🏆 Points Forts
- Architecture modulaire en POO.
- Intégration d’un système de rôles sécurisé.
- Utilisation de pratiques modernes (hashage, PDO).
- Base de données relationnelle bien structurée.

---

## 🚀 Perspectives d’Amélioration
- Ajouter une interface utilisateur plus avancée avec JavaScript.
- Intégrer un système de notifications par email.
- Implémenter des API REST pour une extensibilité future.

---

Préparez-vous à découvrir une expérience utilisateur exceptionnelle avec **GestionReservation** … et profitez d’une gestion simplifiée des activités et des réservations !