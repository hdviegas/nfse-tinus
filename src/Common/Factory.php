<?php

namespace HDViegas\NFSeTinus\Common;

/**
 * Class for RPS XML convertion
 *
 * @category  NFePHP
 * @package   HDViegas\NFSeTinus
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Hilthermann Viegas <hdviegas>
 * @link      http://github.com/hdviegas/nfse-tinus for the canonical source repository
 */

use DOMElement;
use DOMNode;
use NFePHP\Common\DOMImproved as Dom;
use stdClass;

class Factory
{
    /**
     * @var stdClass
     */
    protected $std;
    /**
     * @var Dom
     */
    protected $dom;
    /**
     * @var DOMNode
     */
    protected $rps;
    /**
     * @var \stdClass
     */
    protected $config;

    /**
     * Constructor
     * @param stdClass $std
     */
    public function __construct(stdClass $std)
    {
        $this->std = $std;

        $this->dom = new Dom('1.0', 'UTF-8');
        $this->dom->preserveWhiteSpace = false;
        $this->dom->formatOutput = false;
        $this->rps = $this->dom->createElement('Rps');
    }

    /**
     * Adicona dos dados de configuração
     * @param stdClass $config
     */
    public function addConfig(\stdClass $config)
    {
        $this->config = $config;
    }

    /**
     * Builder, converts sdtClass Rps in XML Rps
     * NOTE: without Prestador Tag
     * @return string RPS in XML string format
     */
    public function render()
    {
        $infRps = $this->dom->createElement('InfRps');
        $att = $this->dom->createAttribute('id');
        $att->value = $this->std->identificacaorps->numero;
        $infRps->appendChild($att);

        $this->addIdentificacao($infRps);

        $this->dom->addChild(
            $infRps,
            "DataEmissao",
            $this->std->dataemissao,
            true
        );
        $this->dom->addChild(
            $infRps,
            "NaturezaOperacao",
            $this->std->naturezaoperacao,
            true
        );
        $this->dom->addChild(
            $infRps,
            "RegimeEspecialTributacao",
            $this->std->regimeespecialtributacao,
            true
        );
        $this->dom->addChild(
            $infRps,
            "OptanteSimplesNacional",
            $this->std->optantesimplesnacional,
            true
        );
        $this->dom->addChild(
            $infRps,
            "IncentivadorCultural",
            $this->std->incentivadorcultural,
            false
        );
        $this->dom->addChild(
            $infRps,
            "Status",
            $this->std->status,
            true
        );

        $this->addServico($infRps);
        $this->addPrestador($infRps);
        $this->addTomador($infRps);
        $this->addIntermediario($infRps);
        $this->addConstrucao($infRps);

        $this->rps->appendChild($infRps);
        $this->dom->appendChild($this->rps);
        return $this->dom->saveXML($this->rps);
    }

    /**
     * Includes Identificacao TAG in parent NODE
     * @param DOMNode $parent
     */
    protected function addIdentificacao(&$parent)
    {
        $id = $this->std->identificacaorps;
        $node = $this->dom->createElement('IdentificacaoRps');
        $this->dom->addChild(
            $node,
            "Numero",
            $id->numero,
            true
        );
        $this->dom->addChild(
            $node,
            "Serie",
            $id->serie,
            true
        );
        $this->dom->addChild(
            $node,
            "Tipo",
            $id->tipo,
            true
        );
        $parent->appendChild($node);
    }

    /**
     * Adiciona o Prestador com base nos daddos do config
     * @param \DOMElement $parent
     * @return void
     */
    protected function addPrestador(&$parent)
    {
        if (!isset($this->config)) {
            return;
        }
        $node = $this->dom->createElement('Prestador');
        $this->dom->addChild(
            $node,
            "Cnpj",
            !empty($this->config->cnpj) ? $this->config->cnpj : null,
            false
        );
        $this->dom->addChild(
            $node,
            "Cpf",
            !empty($this->config->cpf) ? $this->config->cpf : null,
            false
        );
        $this->dom->addChild(
            $node,
            "InscricaoMunicipal",
            str_pad($this->config->im, 7, '0', STR_PAD_LEFT),
            true
        );
        $parent->appendChild($node);
    }

    /**
     * Includes Servico TAG in parent NODE
     * @param DOMNode $parent
     */
    protected function addServico(&$parent)
    {
        $serv = $this->std->servico;
        $val = $this->std->servico->valores;
        $node = $this->dom->createElement('Servico');
        $valnode = $this->dom->createElement('Valores');
        $this->dom->addChild(
            $valnode,
            "ValorServicos",
            number_format($val->valorservicos, 2, '.', ''),
            true
        );
        $this->dom->addChild(
            $valnode,
            "ValorDeducoes",
            isset($val->valordeducoes)
                ? number_format($val->valordeducoes, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorPis",
            isset($val->valorpis)
                ? number_format($val->valorpis, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorCofins",
            isset($val->valorcofins)
                ? number_format($val->valorcofins, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorInss",
            isset($val->valorinss)
                ? number_format($val->valorinss, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorIr",
            isset($val->valorir)
                ? number_format($val->valorir, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorCsll",
            isset($val->valorcsll)
                ? number_format($val->valorcsll, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "IssRetido",
            isset($val->issretido) ? $val->issretido : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorIss",
            isset($val->valoriss)
                ? number_format($val->valoriss, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "ValorIssRetido",
            isset($val->valorissretido) ? $val->valorissretido : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "OutrasRetencoes",
            isset($val->outrasretencoes)
                ? number_format($val->outrasretencoes, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "BaseCalculo",
            isset($val->basecalculo)
                ? number_format($val->basecalculo, 2, '.', '')
                : null,
            false
        );

        if(isset($val->aliquota)) {
            $this->dom->addChild(
                $valnode,
                "Aliquota",
                number_format($val->aliquota, 4),
                false
            );
        }

        if(isset($val->valorliquidonfse)) {
            $this->dom->addChild(
                $valnode,
                "ValorLiquidoNfse",
                $val->valorliquidonfse,
                true
            );
        }

        $this->dom->addChild(
            $valnode,
            "DescontoIncondicionado",
            isset($val->descontoincondicionado)
                ? number_format($val->descontoincondicionado, 2, '.', '')
                : null,
            false
        );
        $this->dom->addChild(
            $valnode,
            "DescontoCondicionado",
            isset($val->descontocondicionado)
                ? number_format($val->descontocondicionado, 2, '.', '')
                : null,
            false
        );
        $node->appendChild($valnode);

        $this->dom->addChild(
            $node,
            "ItemListaServico",
            $serv->itemlistaservico,
            true
        );

        $this->dom->addChild(
            $node,
            "CodigoCnae",
            isset($serv->codigocnae) ? $serv->codigocnae : null,
            false
        );

        $this->dom->addChild(
            $node,
            "CodigoTributacaoMunicipio",
            $serv->codigotributacaomunicipio,
            true
        );

        $this->dom->addChild(
            $node,
            "Discriminacao",
            $serv->discriminacao,
            true
        );

        if (isset($val->codigomunicipio)) {
            $this->dom->addChild(
                $node,
                "CodigoMunicipio",
                $serv->codigomunicipio,
                true
            );
        }

        $parent->appendChild($node);
    }

    /**
     * Includes Tomador TAG in parent NODE
     * @param DOMNode $parent
     */
    protected function addTomador(&$parent)
    {
        if (!isset($this->std->tomador)) {
            return;
        }
        $tom = $this->std->tomador;

        $node = $this->dom->createElement('Tomador');
        $ide = $this->dom->createElement('IdentificacaoTomador');
        $cpfcnpj = $this->dom->createElement('CpfCnpj');

        if (isset($tom->cnpj)) {
            $this->dom->addChild(
                $cpfcnpj,
                "Cnpj",
                $tom->cnpj,
                true
            );
        } else {
            $this->dom->addChild(
                $cpfcnpj,
                "Cpf",
                $tom->cpf,
                true
            );
        }

        $ide->appendChild($cpfcnpj);

        if(isset($tom->inscricaomunicipal)) {
            $this->dom->addChild(
                $ide,
                "InscricaoMunicipal",
                str_pad($tom->inscricaomunicipal, 7, '0', STR_PAD_LEFT),
                false
            );
        }

        $node->appendChild($ide);
        $this->dom->addChild(
            $node,
            "RazaoSocial",
            $tom->razaosocial,
            true
        );

        if ( $address = $this->makeAddress() ) {
            $node->appendChild($address);
        }

        $parent->appendChild($node);
    }

    protected function makeAddress(): ?DOMElement
    {
        $end = $this->std->tomador->endereco ?? new stdClass;

        $endereco = $this->dom->createElement('Endereco');

        $this->dom->addChild(
            $endereco,
            "Endereco",
            $end->endereco ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "Numero",
            $end->numero ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "Complemento",
            $end->complemento ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "Bairro",
            $end->bairro ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "CodigoMunicipio",
            $end->codigomunicipio ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "Uf",
            $end->uf ?? null,
            false
        );

        $this->dom->addChild(
            $endereco,
            "Cep",
            $end->cep ?? null,
            false
        );

        return $endereco;
    }

    /**
     * Includes Intermediario TAG in parent NODE
     * @param DOMNode $parent
     */
    protected function addIntermediario(&$parent)
    {
        if (!isset($this->std->intermediarioservico)) {
            return;
        }
        $int = $this->std->intermediarioservico;
        $node = $this->dom->createElement('IntermediarioServico');
        $this->dom->addChild(
            $node,
            "RazaoSocial",
            $int->razaosocial,
            true
        );
        $cpfcnpj = $this->dom->createElement('CpfCnpj');
        if (isset($int->cnpj)) {
            $this->dom->addChild(
                $cpfcnpj,
                "Cnpj",
                $int->cnpj,
                true
            );
        } else {
            $this->dom->addChild(
                $cpfcnpj,
                "Cpf",
                $int->cpf,
                true
            );
        }
        $node->appendChild($cpfcnpj);
        $this->dom->addChild(
            $node,
            "InscricaoMunicipal",
            str_pad($int->inscricaomunicipal, 7, '0', STR_PAD_LEFT),
            false
        );
        $parent->appendChild($node);
    }

    /**
     * Includes Construcao TAG in parent NODE
     * @param DOMNode $parent
     */
    protected function addConstrucao(&$parent)
    {
        if (!isset($this->std->construcaocivil)) {
            return;
        }
        $obra = $this->std->construcaocivil;
        $node = $this->dom->createElement('ConstrucaoCivil');
        $this->dom->addChild(
            $node,
            "CodigoObra",
            $obra->codigoobra,
            true
        );
        $this->dom->addChild(
            $node,
            "Art",
            $obra->art,
            true
        );
        $parent->appendChild($node);
    }
}
