<?php
namespace pdt256\elo;

class StaticKFactor implements KFactorInterface
{
    private $kFactor;

    public function __construct($kFactor)
    {
        $this->kFactor = $kFactor;
    }

    public function getValue(ParticipantInterface $participant)
    {
        return $this->kFactor;
    }
}
