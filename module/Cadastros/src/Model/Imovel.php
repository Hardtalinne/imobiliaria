<?php

namespace Cadastros\Model;

use Application\Model\ModelInterface;
use Laminas\Filter\FilterChain;
use Laminas\I18n\Filter\Alpha;
use Laminas\Filter\StringToUpper;
use Laminas\Validator\ValidatorChain;
use Laminas\Validator\StringLength;
use Laminas\I18n\Validator\Alpha as AlphaValidator;

class Imovel implements ModelInterface
{
    public int $codigo;
    public string $nome;
    public string $localizacao;
    public int $codigo_corretor;


    public function __construct(array $data)
    {
        $this->exchangeArray($data);
    }

    public function exchangeArray(array $data)
    {
        $this->codigo = (int)($data['codigo'] ?? 0);
        $nome = ($data['nome'] ?? '');
        $localizacao = ($data['localizacao'] ?? '');
        $filterChain = new FilterChain();
        $filterChain->attach(new Alpha(true))
            ->attach(new StringToUpper());
        $this->nome = $filterChain->filter($nome);
        $this->localizacao = $filterChain->filter($localizacao);
        $this->codigo_corretor = ($data['codigo_corretor'] ?? 0);
    }

    public function toArray()
    {
        $attributes = get_object_vars($this);
        if ($attributes['codigo'] == 0) {
            unset($attributes['codigo']);
        }
        return $attributes;
    }

    public function valido(): bool
    {
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new AlphaValidator());
        return $validatorChain->isValid($this->nome);
    }

}

