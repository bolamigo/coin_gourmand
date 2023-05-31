# Coin Gourmand
School project : recipes website

# Tuto Git

## Initialisation

### A - Accès
Vous devez **Créer un compte github** et **me donner votre adresse mail associée** pour que je vous donne l'accès au repository

### B - Votre OS

#### Linux
Passez à l'étape C

#### Windows :
Téléchargez **Git Bash** : https://gitforwindows.org/ et utilisez **toujours Git Bash** en tant que terminal git. Syntaxe des commandes : Linux (cd, ls...)

### C - Clôner le repo

* **Déplacez vous avec "cd" dans le dossier** où vous souhaitez clôner le repository
* Exécutez la commande **git clone https://github.com/bolamigo/coin_gourmand**
* Vérifiez que le git bash vous affiche **(main)** à la fin de la ligne. Si oui, vous avez bien clôné le repo et vous êtes sur la branche "main".

## Utilisation

### En début de session ou en début de grosse étape

* Déplacez vous avec "cd" dans votre repo local, vérifiez que vous voyez le **(main)**
* Mettez à jour votre repo local avec **git pull origin main**

### Après chaque étape ou chaque heure environ

* Vérifiez les fichiers que vous avez modifié avec **git status**
* Vérifiez les modifications avec **git diff**
* Ajoutez les fichiers correspondants à votre modification avec **git add \<fichier\>**
> **git add \*** pour ajouter toutes vos modifications au commit
* Créez un commit avec **git commit -m \<message\>**.
**Le message doit contenir une brève description de vos modification**
* publiez votre commit sur le repository avec **git push**. Faîtes-le souvent pour éviter les problèmes de merge conflicts.

**En cas de problème** comme un conflit par exemple, ne faîtes rien hâtivement, **on en parle** sur le discord
