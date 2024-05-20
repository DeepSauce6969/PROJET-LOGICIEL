<?php

// Path: deconnexion.php
// Detecter les données de session
session_start();
// Supprimer les données de session
session_destroy();
// Rediriger vers la page d'accueil
header('Location: index.php');