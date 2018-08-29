<?php
namespace pdt256\skill\Elo;

use pdt256\skill\ParticipantInterface;

class EloCalculator extends AbstractEloCalculator
{
    /** @var int */
    protected $kFactor = 32;

    /**
     * @param int $kFactor
     */
    public function __construct($kFactor)
    {
        $this->kFactor = $kFactor;
    }

    protected function getParticipantKFactor(ParticipantInterface $participant)
    {
        return $this->kFactor;
    }
}
