<?php
namespace pdt256\elo;

interface KFactorInterface
{
    public function getValue(ParticipantInterface $participant);
}
