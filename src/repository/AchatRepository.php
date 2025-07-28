<?php

namespace App\Repository;

use App\Entity\Achat;
use PDO;
use DateTime;

class AchatRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Achat $achat): Achat
    {
        $sql = "INSERT INTO achats (reference, code_recharge, numero_compteur, montant,
                nbre_kwt, tranche, prix_kw, date_achat, statut, client_nom)
                VALUES (:reference, :code_recharge, :numero_compteur, :montant,
                :nbre_kwt, :tranche, :prix_kw, :date_achat, :statut, :client_nom) RETURNING id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':reference', $achat->getReference());
        $stmt->bindValue(':code_recharge', $achat->getCodeRecharge());
        $stmt->bindValue(':numero_compteur', $achat->getNumeroCompteur());
        $stmt->bindValue(':montant', $achat->getMontant());
        $stmt->bindValue(':nbre_kwt', $achat->getNbreKwt());
        $stmt->bindValue(':tranche', $achat->getTranche());
        $stmt->bindValue(':prix_kw', $achat->getPrixKw());
        $stmt->bindValue(':date_achat', $achat->getDateAchat()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':statut', $achat->getStatut());
        $stmt->bindValue(':client_nom', $achat->getClientNom());

        $stmt->execute();
        $achat->setId($stmt->fetchColumn());

        return $achat;
    }

    public function findByReference(string $reference): ?Achat
    {
        $sql = "SELECT * FROM achats WHERE reference = :reference";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['reference' => $reference]);
        $data = $stmt->fetch();

        return $data ? $this->hydrate($data) : null;
    }

    private function hydrate(array $data): Achat
    {
        return (new Achat($data['id']))
            ->setReference($data['reference'])
            ->setCodeRecharge($data['code_recharge'])
            ->setNumeroCompteur($data['numero_compteur'])
            ->setMontant($data['montant'])
            ->setNbreKwt($data['nbre_kwt'])
            ->setTranche($data['tranche'])
            ->setPrixKw($data['prix_kw'])
            ->setDateAchat(new DateTime($data['date_achat']))
            ->setStatut($data['statut'])
            ->setClientNom($data['client_nom']);
    }
}
