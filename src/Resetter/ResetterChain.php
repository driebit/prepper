<?php

namespace Driebit\Prepper\Resetter;

class ResetterChain implements ResetterInterface
{
    /**
     * @var ResetterInterface[]
     */
    private $resetters = array();
    
    public function __construct(array $resetters = array())
    {
        foreach ($resetters as $resetter) {
            $this->addResetter($resetter);
        }
    }
    
    public function addResetter(ResetterInterface $resetter)
    {
        $this->resetters[] = $resetter;
    }

    public function reset()
    {
        foreach ($this->resetters as $resetter) {
            $resetter->reset();
        }
    }
}
