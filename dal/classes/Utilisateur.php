<?php


class Utilisateur
{
    public string $nom;
    private int $id;

    /**
     * Utilisateur constructor.
     * @param string $nom
     * @param int $id
     */
    public function __construct(string $nom, int $id)
    {
        $this->nom = $nom;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}