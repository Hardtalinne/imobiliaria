<?php

declare(strict_types=1);

namespace Cadastros\Controller;

use Cadastros\Model\CorretorTable;
use Cadastros\Model\Imovel;
use Cadastros\Model\ImovelTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;

class ImovelController extends AbstractActionController
{
    private ImovelTable $imovelTable;
    private CorretorTable $corretorTable;

    public function __construct(ImovelTable $imovelTable, CorretorTable $corretorTable)
    {
        $this->imovelTable = $imovelTable;
        $this->corretorTable = $corretorTable;
    }

    public function indexAction()
    {
        $imoveis = $this->imovelTable->listar();
//        $corretores = $this->corretorTable->listar();
//        if (is_array($imoveis) || is_object($imoveis)) {
//            foreach ($imoveis as $imovel) {
//                if ($imovel->codigo_corretor == $this->corretorTable->buscar($imovel->codigo_corretor)){
//                    $nomeCorretor = $this->corretorTable->buscar($imovel->codigo_corretor)->nome;
//                }
//            }
//            $imovel->setCorretor($nomeCorretor);
//        }
        return new ViewModel([
            'imoveis' => $imoveis
        ]);
    }

    public function editarAction()
    {
        if ($this->flashMessenger()->hasMessages()) {
            $sessionContainer = new Container();
            $imovel = $sessionContainer->imovel;
        } else {
            $codigo = (int)$this->params('matricula');
            $imovel = $this->imovelTable->buscar($codigo);
        }

        $messages = $this->flashMessenger()->getMessages();
        $this->flashMessenger()->clearMessages();

        $corretores = $this->corretorTable->listar();

        return new ViewModel([
            'imovel' => $imovel,
            'corretores' => $corretores,
            'messages' => implode(',', $messages)
        ]);
    }

    public function gravarAction()
    {
        $imovel = new Imovel($_POST);
        if (!$imovel->valido()) {
            $this->flashMessenger()->addMessage('Dados inválidos');
            $sessionContainer = new Container();
            $sessionContainer->imovel = $imovel;
            return $this->redirect()->toRoute('cadastros', [
                'controller' => 'imovel',
                'action' => 'editar'
            ]);
        }

        $this->imovelTable->gravar($imovel);

        return $this->redirect()->toRoute('cadastros', [
            'controller' => 'imovel',
            'action' => 'index'
        ]);
    }

    public function apagarAction()
    {
        $codigo = (int)$this->params('matricula');
        $this->imovelTable->apagar($codigo);
        return $this->redirect()->toRoute('cadastros', [
            'controller' => 'imovel',
            'action' => 'index'
        ]);
    }


}
