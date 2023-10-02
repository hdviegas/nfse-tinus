<?php

namespace HDViegas\NFSeTinus;

/**
 * Simple interface to RPS Class
 *
 * @category  NFePHP
 * @package   HDViegas\NFSeTinus
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Hilthermann Viegas <hdviegas>
 * @link      http://github.com/hdviegas/nfse-tinus for the canonical source repository
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
