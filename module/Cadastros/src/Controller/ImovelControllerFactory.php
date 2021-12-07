<?php

namespace Cadastros\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ImovelControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $imovelTable = $container->get('ImovelTable');
        $CorretorTable = $container->get('CorretorTable');

        return new ImovelController($imovelTable, $CorretorTable);
    }
}

