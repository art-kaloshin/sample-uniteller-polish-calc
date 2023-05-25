<?php

interface CalcInterface
{
    public function setExpression(string $expression): self;

    public function getResult(): float;
}