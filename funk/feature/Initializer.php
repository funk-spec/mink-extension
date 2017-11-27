<?php

namespace funk\feature;

use Behat\Mink\Mink;

class Initializer implements \Funk\Spec
{
    private $mink;

    public function __construct(Mink $mink)
    {
        $this->mink = $mink;
    }

    public function it_uses_mink()
    {
        expect($this->mink)->toHaveType('Behat\Mink\Mink');
    }
}
