<?php

namespace AppleMapsServerApiClient\Auth;

interface TokenSource
{
    public function toJwt(): string;
}