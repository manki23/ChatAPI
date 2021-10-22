# Chat API

*Résumé :* ce projet est une simple API pour stocker des messages

## 1 - Introduction
Ce projet est une API laravel pour mon [portfolio](https://github.com/manki23/manki23.github.io).
Elle permet de stocker les messages du chat et de m'envoyer un sms à chaque ajout de message dans la base de donnée via le service [twilio](https://www.twilio.com/).

## 2 - Routes
### 2.1 - Routes publiques
Routes ne nécessitant pas de token d'identification :
- `POST` : `/users` -> pour creer un utilisateur
``` JSON 
{
    "name": "name",
    "email": "e@mail.co",
    "password": "password",
    "password_confirmation": "password"
}
```
- `POST` : `/login`
``` JSON
{
    "email": "e@mail.co",
    "password": "password"
}
```
- `POST` : `/messages`
``` JSON 
{
    "text": "bla bla bla"
}
```

### 2.2 - Routes privées
Routes nécessitant un bearer token d'autentification.
- `GET` : `/messages`
- `GET` : `/messages/:id`
- `DELETE` : `/messages/:id`
- `POST` : `/logout`
- `GET` : `/me`

## 3 - Télécharger et lancer le projet en local
1 )
``` bash
git clone git@github.com:manki23/ChatAPI.git ; cd ChatAPI ; composer install
```
2 )
- créer le `.env` :
``` bash
cp .env.example .env
```
- remplir les champs suivants :
```
...
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
...
TWILIO_SID=
TWILIO_TOKEN=
TWILIO_FROM=
TWILIO_TO=
...
```
3 )
``` bash
php artisan serve
```
