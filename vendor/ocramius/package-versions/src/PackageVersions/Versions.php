<?php

declare(strict_types=1);

namespace PackageVersions;

use OutOfBoundsException;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = 'devision/laminas-skeleton';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    public const VERSIONS          = array (
  'brick/varexporter' => '0.3.2@411110b797c6b1ecf947a0eec17ffaa59284f5a0',
  'container-interop/container-interop' => '1.2.0@79cbf1341c22ec75643d841642dd5d6acd83bdb8',
  'fig/http-message-util' => '1.1.4@3242caa9da7221a304b8f84eb9eaddae0a7cf422',
  'laminas/laminas-component-installer' => '2.3.0@92735977fb7ad9050712e8ff804edff50d01406e',
  'laminas/laminas-config-aggregator' => '1.3.0@141382658ab4ebd0f6c2e529c4736f88bef5dcca',
  'laminas/laminas-diactoros' => '2.4.1@36ef09b73e884135d2059cc498c938e90821bb57',
  'laminas/laminas-escaper' => '2.6.1@25f2a053eadfa92ddacb609dcbbc39362610da70',
  'laminas/laminas-filter' => '2.9.4@3c4476e772a062cef7531c6793377ae585d89c82',
  'laminas/laminas-httphandlerrunner' => '1.2.0@e1a5dad040e0043135e8095ee27d1fbf6fb640e1',
  'laminas/laminas-i18n' => '2.10.3@94ff957a1366f5be94f3d3a9b89b50386649e3ae',
  'laminas/laminas-inputfilter' => '2.10.1@b29ce8f512c966468eee37ea4873ae5fb545d00a',
  'laminas/laminas-servicemanager' => '3.4.1@0d4c8628a71fae9f7bd0b1b74b76382e5e9a04b1',
  'laminas/laminas-stdlib' => '3.3.0@b9d84eaa39fde733356ea948cdef36c631f202b6',
  'laminas/laminas-stratigility' => '3.2.2@3f88aa174324bc9e6dd55715f401f9f25dbd722c',
  'laminas/laminas-validator' => '2.13.4@93593684e70b8ed1e870cacd34ca32b0c0ace185',
  'laminas/laminas-zendframework-bridge' => '1.1.1@6ede70583e101030bcace4dcddd648f760ddf642',
  'league/fractal' => '0.19.2@06dc15f6ba38f2dde2f919d3095d13b571190a7c',
  'mezzio/mezzio' => '3.2.2@6bd539f29c7b27cab7bcb6ea433222f8b1c0d099',
  'mezzio/mezzio-helpers' => '5.3.0@276a539a9212bd2ff48ec7c411b049f11fcff62d',
  'mezzio/mezzio-router' => '3.1.3@21b1db5c28590cc563729189519bfde3218e38fa',
  'mezzio/mezzio-template' => '2.0.1@569c3433fbd2deab2777d1beab4f5749bf83e8bb',
  'monolog/monolog' => '2.0.2@c861fcba2ca29404dc9e617eedd9eff4616986b8',
  'nikic/php-parser' => 'v4.9.1@88e519766fc58bd46b8265561fb79b54e2e00b28',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/http-server-handler' => '1.0.1@aff2f80e33b7f026ec96bb42f63242dc50ffcae7',
  'psr/http-server-middleware' => '1.0.1@2296f45510945530b9dceb8bcedb5cb84d40c5f5',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'roave/security-advisories' => 'dev-master@88de753349e4deedb32796fc94bddf9b2db2dd1f',
  'symfony/console' => 'v4.4.0@35d9077f495c6d184d9930f7a7ecbd1ad13c7ab8',
  'symfony/polyfill-mbstring' => 'v1.18.1@a6977d63bf9a0ad4c65cd352709e230876f9904a',
  'symfony/polyfill-php73' => 'v1.18.1@fffa1a52a023e782cdcc221d781fe1ec8f87fcca',
  'symfony/service-contracts' => 'v2.2.0@d15da7ba4957ffb8f1747218be9e1a121fd298a1',
  'webimpress/safe-writer' => '2.1.0@5cfafdec5873c389036f14bf832a5efc9390dcdd',
  'behat/gherkin' => 'v4.6.2@51ac4500c4dc30cbaaabcd2f25694299df666a31',
  'codeception/codeception' => '4.0.0@03d7e33c155bf9da306f0209d520fb8423f6dd67',
  'codeception/lib-asserts' => '1.13.1@263ef0b7eff80643e82f4cf55351eca553a09a10',
  'codeception/lib-innerbrowser' => '1.3.2@7bdcee4cf654cfeeedd00405edd4f06f85255659',
  'codeception/module-asserts' => '1.3.0@32e5be519faaeb60ed3692383dcd1b3390ec2667',
  'codeception/module-datafactory' => '1.0.0@1ba8c265c2c58e44e4054c47ac9a60f5dc13fb2b',
  'codeception/module-doctrine2' => '1.0.1@bbeb69dadc7ca5e724907e81d35bb392f27b4480',
  'codeception/module-rest' => '1.2.3@63d09a1ed9fb9bb981d22396e7c2c7d20570f217',
  'codeception/module-zendexpressive' => '1.0.1@685ceb65c3d24acb562ece99c1a5a6bfcc90939b',
  'codeception/phpunit-wrapper' => '8.1.2@e610200adf75ebc1ea7cf10d7cdb43e0f5fff3cc',
  'codeception/stub' => '3.7.0@468dd5fe659f131fc997f5196aad87512f9b1304',
  'dealerdirect/phpcodesniffer-composer-installer' => 'v0.7.0@e8d808670b8f882188368faaf1144448c169c0b7',
  'doctrine/instantiator' => '1.3.1@f350df0268e904597e3bd9c4685c53e0e333feea',
  'flow/jsonpath' => '0.5.0@b9738858c75d008c1211612b973e9510f8b7f8ea',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'justinrainbow/json-schema' => '5.2.10@2ba9c8c862ecd5510ed16c6340aa9f6eadb4f31b',
  'laminas/laminas-code' => '3.4.1@1cb8f203389ab1482bf89c0e70a04849bacd7766',
  'laminas/laminas-composer-autoloading' => '2.1.1@8f3589aea9e4b3db3ea92d092f9ce7aa3140eb53',
  'laminas/laminas-development-mode' => '3.2.1@dccbfc5a1503eb3f3805869525258ca6e6f6a0ce',
  'laminas/laminas-eventmanager' => '3.3.0@1940ccf30e058b2fd66f5a9d696f1b5e0027b082',
  'league/factory-muffin' => 'v3.2.1@659b7eb9563d9cfd2284c0ddb74b9bc6d0a02332',
  'league/factory-muffin-faker' => 'v2.2.2@07f55317db9720cd750a196fa8bc41142d8ce0ca',
  'mezzio/mezzio-tooling' => '1.3.0@7e3c40d20b3a1ff9b5d014870797899aae85e80b',
  'myclabs/deep-copy' => '1.10.1@969b211f9a51aa1f6c01d1d2aef56d3bd91598e5',
  'ocramius/package-versions' => '1.9.0@94c9d42a466c57f91390cdd49c81313264f49d85',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.2@069a785b2141f5bcf49f3e353548dc1cce6df556',
  'phpdocumentor/type-resolver' => '1.4.0@6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
  'phpspec/prophecy' => '1.11.1@b20034be5efcdab4fb60ca3a29cba2949aead160',
  'phpstan/phpdoc-parser' => '0.4.9@98a088b17966bdf6ee25c8a4b634df313d8aa531',
  'phpunit/php-code-coverage' => '7.0.10@f1884187926fbb755a9aaf0b3836ad3165b478bf',
  'phpunit/php-file-iterator' => '2.0.2@050bedf145a257b1ff02746c31894800e5122946',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.2@1038454804406b0b5f5f520358e78c1c2f71501e',
  'phpunit/php-token-stream' => '3.1.1@995192df77f63a59e47f025390d2d1fdf8f425ff',
  'phpunit/phpunit' => '8.5.8@34c18baa6a44f1d1fbf0338907139e9dce95b997',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'sebastian/code-unit-reverse-lookup' => '1.0.1@4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
  'sebastian/comparator' => '3.0.2@5de4fc177adf9bce8df98d8d141a7559d7ccf6da',
  'sebastian/diff' => '3.0.2@720fcc7e9b5cf384ea68d9d930d480907a0c1a29',
  'sebastian/environment' => '4.2.3@464c90d7bdf5ad4e8a6aea15c091fec0603d4368',
  'sebastian/exporter' => '3.1.2@68609e1261d215ea5b21b7987539cbfbe156ec3e',
  'sebastian/global-state' => '3.0.0@edf8a461cf1d4005f19fb0b6b8b95a9f7fa0adc4',
  'sebastian/object-enumerator' => '3.0.3@7cfd9e65d11ffb5af41198476395774d4c8a84c5',
  'sebastian/object-reflector' => '1.1.1@773f97c67f28de00d397be301821b06708fca0be',
  'sebastian/recursion-context' => '3.0.0@5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
  'sebastian/resource-operations' => '2.0.1@4d7a795d35b889bf80a0cc04e08d77cedfa917a9',
  'sebastian/type' => '1.1.3@3aaaa15fa71d27650d62a948be022fe3b48541a3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'slevomat/coding-standard' => '6.4.0@bf3a16a630d8245c350b459832a71afa55c02fd3',
  'squizlabs/php_codesniffer' => '3.5.6@e97627871a7eab2f70e59166072a6b767d5834e0',
  'symfony/browser-kit' => 'v5.1.5@b9545e08790be2d3d7d92306e339bbcd79f461e4',
  'symfony/css-selector' => 'v5.1.5@e544e24472d4c97b2d11ade7caacd446727c6bf9',
  'symfony/deprecation-contracts' => 'v2.2.0@5fa56b4074d1ae755beb55617ddafe6f5d78f665',
  'symfony/dom-crawler' => 'v5.1.5@3ac31ffbc596e41ca081037b7d78fc7a853c0315',
  'symfony/event-dispatcher' => 'v4.4.13@3e8ea5ccddd00556b86d69d42f99f1061a704030',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/finder' => 'v5.1.5@2b765f0cf6612b3636e738c0689b29aa63088d5d',
  'symfony/polyfill-ctype' => 'v1.18.1@1c302646f6efc070cd46856e600e5e0684d6b454',
  'symfony/polyfill-php80' => 'v1.18.1@d87d5766cbf48d72388a9f6b85f280c8ad51f981',
  'symfony/yaml' => 'v5.1.5@a44bd3a91bfbf8db12367fa6ffac9c3eb1a8804a',
  'theseer/tokenizer' => '1.2.0@75a63c33a8577608444246075ea0af0d052e452a',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'devision/laminas-skeleton' => 'dev-master@1799177dab52ff8592c6a8c996093db8732ca73f',
);

    private function __construct()
    {
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}