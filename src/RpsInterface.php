<?php

namespace NFePHP\NFSeTinus;

/**
 * Simple interface to RPS Class
 *
 * @category  NFePHP
 * @package   NFePHP\NFSeTinus
 * @copyright NFePHP Copyright (c) 2020
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse-tinus for the canonical source repository
 */

use stdClass;

interface RpsInterface
{
    /**
     * Convert Rps::class data in XML
     * @param stdClass $rps
     * @return string
     */
    public function render(stdClass $rps = null);
}
