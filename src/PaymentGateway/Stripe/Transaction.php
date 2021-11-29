<?php

    declare(strict_types=1);

namespace App\PaymentGateway\Stripe;

    //? A partir d'ici on utilisera un typage strict afin de s'assurer de la validité de nos valeurs.
    //* Il faudra typer les attributs/propriétés dans les classes (private float $amount)
    //* Il faudra typer les arguments de méthodes (public function maFunction (int $arg1){})
    //* Il faudra caster un typage sur les variables retournées $this->amount = (float) $amount;
    //* Il faudra typer le retour des fonction (function maFunction(int $arg1):int{})

    class Transaction
    {
        //? Propriétés/Attributs d'une classe
        //* Promotion de propriétés : un feature de PHP8 permet de ne pas avoir à définir des propriétés avant d'utiliser un constructeur. On peut les définir en même temps, en donner une portée (private,public ou protected) à la propriété.
        // private float $amount; //Montant de la transaction
        // private string $description; // Description de la transaction

        private const COMMISSION = 1.4;

        //? Méthodes magiques de PHP (on les reconnaît car elles commencent toutes par un double underscore __)
        public function __construct(private float $amount, private string $description)
        {
            // $this->amount = (float) $amount;
            // $this->description = (string) $description;
        }

        public function __destruct()
        {
            echo 'Stripe';
        }

        //? Accesseurs/Modificateurs de propriétés (Getters/setters) : Ce sont des méthodes qui servent à accéder ou à modifier des propriétés de classe.
        //* La notation ?float signifie que le retour peut être un float ou null
        //* Getters/setters écrits à la main
        public function getAmount(): ?float
        {
            return $this->amount;
        }

        //* La notation int|float permet de définir les types acceptés par la fonction.
        public function setAmount(int|float $newAmount): Transaction
        {
            $this->amount = (float) $newAmount;

            return $this;
        }

        //*Getters setters générés via PHP Getters & Setters (extension)

        /**
         * Get the value of description.
         */
        public function getDescription(): string
        {
            return $this->description;
        }

        /**
         * Set the value of description.
         *
         * @return self
         */
        public function setDescription($description): Transaction
        {
            $this->description = (string) $description;

            return $this;
        }

        //? Méthodes : Ce sont des fonctions qui s'appliquent à nos objets invidiuellement.Tous les objets de cette classe peuvent les appliquer chacun leur tour.

        public function addTax(float $rate): Transaction
        {
            $this->amount += $this->amount * $rate / 100;

            return $this;
        }

        public function addCommission(): Transaction
        {
            $this->amount += $this->amount * $this::COMMISSION / 100;

            return $this;
        }

        public function applyDiscount(float $rate): Transaction
        {
            $this->amount -= $this->amount * $rate / 100;

            return $this;
        }
    }