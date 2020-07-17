<?php

/*
 * This file is part of the Omed project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Omed\Laravel\Security\Model;

use Doctrine\ORM\Mapping as ORM;
use Kilip\SanctumORM\Contracts\SanctumUserInterface;
use Kilip\SanctumORM\Model\Tokens as BaseTokens;

/**
 * Class Tokens.
 *
 * @ORM\Entity
 */
class Tokens extends BaseTokens
{
    /**
     * @ORM\ManyToOne(targetEntity="Kilip\SanctumORM\Contracts\SanctumUserInterface", cascade={"persist"})
     *
     * @var SanctumUserInterface|null
     */
    protected $owner;
}
