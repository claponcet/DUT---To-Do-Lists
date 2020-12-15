<?php


class Tache
{
    private string $intitule;
    private bool $effectuee;
    private int $id;

    /**
     * Tache constructor.
     * @param int $id
     * @param string $intitule
     * @param bool $effectuee
     */
    public function __construct(int $id, string $intitule, bool $effectuee)
    {
        $this->intitule = $intitule;
        $this->effectuee = $effectuee;
        $this->id=$id;
    }

    /**
     * @return string
     */
    public function getIntitule(): string
    {
        return $this->intitule;
    }

    /**
     * @return bool
     */
    public function isEffectuee(): bool
    {
        return $this->effectuee;
    }

    /**
     * @param bool $effectuee
     */
    public function setEffectuee(bool $effectuee): void
    {
        $this->effectuee = $effectuee;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



}