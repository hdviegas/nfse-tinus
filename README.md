# sped-nfse-tinus

Api para comunicação com webservices do [Provedor Tinus](https://www.tinus.com.br/)

[![Latest Stable Version][ico-stable]][link-packagist]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![License][ico-license]][link-packagist]


Este pacote é aderente com os [PSR-1], [PSR-2] e [PSR-4]. Se você observar negligências de conformidade, por favor envie um patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Dependências

- PHP >= 7.1
- ext-curl
- ext-soap
- ext-zlib
- ext-dom
- ext-openssl
- ext-json
- ext-simplexml
- ext-libxml

### Outras Libs

- nfephp-org/sped-common
- justinrainbow/json-schema

## Contribuindo
Este é um projeto totalmente *OpenSource*, para usa-lo e modifica-lo você não paga absolutamente nada. Porém para continuarmos a mante-lo é necessário qua alguma contribuição seja feita, seja auxiliando na codificação, na documentação ou na realização de testes e identificação de falhas e BUGs.

## Instalando
```bash
composer require hdviegas/nfse-tinus
```

## Comentários

O mesmo segue a definição sugerida pela Abrasf, modelo 1.0, no entanto apresenta algumas particularidades:

– Não permite Substituição de RPS.

– O número do RPS deverá ser sequencial independente da série.

– É obrigatório informar dados para o Tomador.

1. Cancelamento NFS-e

Notas Fiscais de Serviço Eletrônica canceladas não retornam o arquivo de xml de NFS-e com as informações que a mesma foi cancelada. O padrão Tinus não permite consultar documentos cancelados.

2. Considerações

Observação 1: “Para o Município de Jaboatão dos Guararapes/PE, é necessário realizar o pedido de liberação de uso para o ambiente de Produção e homologação. Sem esta liberação, o RPS enviado ficará com status pendente no InvoiCy.

Para que a liberação seja realizada, o Município exige que seja enviado ao menos um RPS em homologação. Após envio deste RPS em homologação, o ERP receberá no retorno uma mensagem contendo o número do lote e o número do protocolo que aquele envio originou. Ex: Lote 12 enviado para processamento na prefeitura retornou protocolo 20131085123.

Este número de lote e protocolo, deve ser enviado ao e-mail jneilton@gmail.com, com o Assunto “Liberação de emissão de NFS-e em Homologação– Município X, CNPJ xx.xxx.xxx/xxxx-xx”. O Sr. Neilton, fará então a validação do lote, e a liberação do RPS enviado.

Após a validação do RPS enviado em homologação, será liberada a emissão em produção, pelo próprio Sr. Neilton.”

> Observação 2: “O município de Jaboatão dos Guararapes/PE, possui processamento assíncrono, ou seja, recebe os RPS e os processa posteriormente. O tempo médio para retorno do processamento de um RPS é de até 30 minutos. Neste tempo, o ERP deverá disparar algumas consultas, até obter o status final do RPS.”. Todos os Lotes carregados são processados a cada meia-hora do relógio Ex. 16:30, 17:00, 17:30, 18:00, 18:30, etc.

## License

Este pacote está diponibilizado sob LGPLv3 ou MIT License (MIT). Leia  [Arquivo de Licença](LICENSE.md) para maiores informações.


[ico-stable]: https://poser.pugx.org/nfephp-org/sped-nfse-tinus/version
[ico-version]: https://img.shields.io/packagist/v/nfephp-org/sped-nfse-tinus.svg?style=flat-square
[ico-license]: https://poser.pugx.org/nfephp-org/nfephp/license.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hdviegas/nfse-tinus
[link-author]: https://www.linkedin.com/in/hdviegas/
