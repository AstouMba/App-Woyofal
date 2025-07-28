<?php

namespace App\Repository;

use App\Entity\Client;
use PDO;

class ClientRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): ?Client
    {
        $sql = "SELECT * FROM clients WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch();

        return $data ? $this->hydrate($data) : null;
    }

    public function save(Client $client): Client
    {
        if ($client->getId()) {
            return $this->update($client);
        }

        $sql = "INSERT INTO clients (nom, prenom, telephone, adresse)
                VALUES (:nom, :prenom, :telephone, :adresse) RETURNING id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':nom', $client->getNom());
        $stmt->bindValue(':prenom', $client->getPrenom());
        $stmt->bindValue(':telephone', $client->getTelephone());
        $stmt->bindValue(':adresse', $client->getAdresse());
        $stmt->execute();

        $client->setId($stmt->fetchColumn());

        return $client;
    }

    private function update(Client $client): Client
    {
        $sql = "UPDATE clients SET nom = :nom, prenom = :prenom,
                telephone = :telephone, adresse = :adresse WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $client->getId());
        $stmt->bindValue(':nom', $client->getNom());
        $stmt->bindValue(':prenom', $client->getPrenom());
        $stmt->bindValue(':telephone', $client->getTelephone());
        $stmt->bindValue(':adresse', $client->getAdresse());
        $stmt->execute();

        return $client;
    }

    private function hydrate(array $data): Client
    {
        return (new Client($data['id']))
            ->setNom($data['nom'])
            ->setPrenom($data['prenom'])
            ->setTelephone($data['telephone'])
            ->setAdresse($data['adresse']);
    }
}
