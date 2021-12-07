<?php

namespace Cadastros\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;

class ImovelTable
{
    private TableGatewayInterface $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param Imovel $imovel
     * @return int|void
     */
    public function gravar(Imovel $imovel)
    {
        $set = $imovel->toArray();
        if (isset($set['codigo']) && !empty($set['codigo'])) {
            return $this->tableGateway->update($set, ['codigo' => $set['codigo']]);
        }
        $this->tableGateway->insert($set);
    }

    public function listar()
    {
        return $this->tableGateway->select();
    }

    public function apagar(int $codigo)
    {
        $this->tableGateway->delete((['codigo' => $codigo]));
    }

    public function buscar(int $codigo): Imovel
    {
        $imoveis = $this->tableGateway->select(['codigo' => $codigo]);
        if ($imoveis->count() != 0) {
            return $imoveis->current();
        }
        return new Imovel([]);
    }
}
