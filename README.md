# 📘 Projet : Gestion de Budget Personnel

Ce projet est une **application web de gestion de budget personnel**. Elle permet à chaque utilisateur de **créer un compte**, de **se connecter** en toute sécurité, puis de **gérer ses propres revenus, dépenses, comptes bancaires, catégories et sous-catégories**.  
Chaque utilisateur a **son propre espace personnel** après connexion, exactement comme sur Facebook ou d’autres plateformes, avec un tableau de bord privé.

---

## 💡 Objectif principal

Permettre à chaque personne de suivre précisément :
- Ses **ressources** (revenus)
- Ses **dépenses**
- L’origine des ressources (**sources**)
- La répartition de ses dépenses (**catégories** et **sous-catégories**)
- Ses **comptes bancaires** associés
- Et d'avoir une vue personnalisée de ses finances

Toutes les données sont **sécurisées** et liées uniquement à **l'utilisateur connecté**.

---

## 🧱 Structure du projet

### 1. Authentification
- Formulaire de **connexion** : identifiant (nom, email ou numéro de téléphone) + mot de passe
- Formulaire de **création de compte**
- Système de **sessions PHP**
- Sécurité : chaque utilisateur ne voit que ses propres données

### 2. Tableau de bord (dashboard.php)
Après connexion, l’utilisateur accède à une **interface personnelle** avec un menu :
- **Comptes**
- **Ressources**
- **Dépenses**
- **Catégories**
- **Sous-catégories**
- **Déconnexion**

### 3. Fichiers PHP
Chaque type de donnée (compte, ressource, dépense...) a deux fichiers :
- `ajouter_XXXX.php` → Formulaire d’ajout
- `liste_XXXX.php` → Liste filtrée par l’utilisateur connecté

Par exemple :
- `ajouter_compte.php` et `liste_comptes.php`
- `ajouter_ressource.php` et `liste_ressources.php`
- etc.

---

## 🗃️ Base de données (MySQL)

Nom de la base : `gestion_budget`

Tables principales :

| Table             |                                                               
|-------------------|
| `personne`        | 
| `compte`          |
| `ressource`       |
| `source`          |
| `depense`         | 
| `categorie`       | 
| `sous_categorie`  | 

---


## 📁 Structure du projet

/gestion_budget/
├── login.php
├── register.php
├── dashboard.php
├── ajouter_compte.php
├── liste_comptes.php
├── ajouter_ressource.php
├── liste_ressources.php
├── ajouter_depense.php
├── liste_depenses.php
├── ajouter_categorie.php
├── liste_categories.php
├── ajouter_sous_categorie.php
├── liste_sous_categories.php
└── includes/ (connexion à la base, fonctions communes, etc.)

## 📌 Fonctionnalités principales

- 🔐 Authentification :
  - Création de compte (nom, email ou téléphone + mot de passe)
  - Connexion sécurisée
  - Session utilisateur active

- 🏦 Comptes bancaires :
  - Ajout de comptes avec solde initial
  - Consultation des comptes de l'utilisateur

- 💸 Ressources (revenus) :
  - Ajout de ressources (montant, date, compte, source)
  - Liste des ressources de l’utilisateur connecté

- 📤 Dépenses :
  - Ajout de dépenses avec catégories et sous-catégories
  - Liste des dépenses avec détails

- 🗂️ Catégorisation :
  - Création de catégories et sous-catégories personnalisées
  - Affectation des dépenses aux bonnes catégories

- 📊 Tableau de bord personnel :
  - Accès après connexion
  - Vue centralisée des données

## Captures d'ecran
---------------------------------------------------------------------------------------------------------------------------------
-Login : 
<img width="1307" height="577" alt="image" src="https://github.com/user-attachments/assets/cbb5c7f6-eb82-4765-8e71-34465b355857" />
-Register : (Creation d'un compte)
<img width="1303" height="618" alt="image" src="https://github.com/user-attachments/assets/af33ae34-2616-4307-a4f4-7c76c4e88026" />
--------------------------------------------------------------------------------------------------------------------------------

-Dashboard :
<img width="1309" height="539" alt="image" src="https://github.com/user-attachments/assets/d0871743-d23d-47a4-a741-c82f52dbd472" />
Cette page presente le menu regroupant toutes les fonctions accessibles a l'utilisteur .
--------------------------------------------------------------------------------------------------------------------------------

-Ajouter un compte :
<img width="1303" height="473" alt="image" src="https://github.com/user-attachments/assets/5f5f77a6-5e08-4f55-9157-5744686d5182" />

-Liste de compte :
<img width="1308" height="350" alt="image" src="https://github.com/user-attachments/assets/655217b8-bf35-4205-b5c1-2f9758af6af3" />

--------------------------------------------------------------------------------------------------------------------------------

-Ajouter une source :
<img width="1307" height="526" alt="image" src="https://github.com/user-attachments/assets/387d589d-0888-45fd-abaf-38cfeae43c03" />

-Liste de source :
<img width="1303" height="297" alt="image" src="https://github.com/user-attachments/assets/ef670f22-fb98-41c9-bc8b-b91b9bc46558" />

--------------------------------------------------------------------------------------------------------------------------------

-Ajouter une ressource :
<img width="1309" height="585" alt="image" src="https://github.com/user-attachments/assets/ec679a59-2858-45ae-b290-a963ce105935" />

-Liste de ressource :
<img width="1305" height="349" alt="image" src="https://github.com/user-attachments/assets/8c29ad9f-b456-4395-9de0-d5f0a94137a8" />

--------------------------------------------------------------------------------------------------------------------------------

-Ajouter une categorie :
<img width="1313" height="395" alt="image" src="https://github.com/user-attachments/assets/8c27665e-1221-40db-8d88-b74083493c15" />

-Liste de categorie :
<img width="1309" height="346" alt="image" src="https://github.com/user-attachments/assets/a32f69be-ac03-4dd3-9317-e73d767e3c6e" />

--------------------------------------------------------------------------------------------------------------------------------

-Ajouter une sous-categorie :
<img width="1309" height="452" alt="image" src="https://github.com/user-attachments/assets/d7dda4f0-4a6d-42c4-9a32-baecb92d31f4" />

-Liste de sous-categorie :
<img width="1305" height="334" alt="image" src="https://github.com/user-attachments/assets/8e91cd15-d65e-4346-ba79-f11497e0d7eb" />

--------------------------------------------------------------------------------------------------------------------------------

-Ajouter une depense :
<img width="1303" height="565" alt="image" src="https://github.com/user-attachments/assets/47d83f21-65d0-4480-b421-73eaaa54fc50" />

-Liste de depense :
<img width="1310" height="354" alt="image" src="https://github.com/user-attachments/assets/3490236d-2992-48ef-9322-c7cc85dbd01f" />

--------------------------------------------------------------------------------------------------------------------------------
