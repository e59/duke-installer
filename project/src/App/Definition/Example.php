<?php

namespace %namespace%\Definition;

use \Cdc\Definition\Helper as H;
use \Cdc\ArrayHelper as AH;

class Example extends \Tanz\Definition {

    public function options($row, $rowset, $options = array()) {

        $link = \C::$router->generate('duke/inscricao/festival/visualizar', array('id' => $row['id']));
        $text = sprintf('<a class="btn btn-sm btn-default" title="Visualizar" href="%s"><i class="fa fa-eye"></i></a>', $link);

        unset($options['routes']['update']);

        return $text . parent::options($row, $rowset, $options);
    }

    protected function buildDefinition() {
        $cpfRules = array(
            array('\Cdc\Rule\Trim'),
            array('\Cdc\Rule\CPF'),
            'length' => array(),
        );

        $def = array(
            'example' => H\Relation::def(),
            'id' => H\PrimaryColumn::def(),
            'nome' => H\SetRequired::modify(H\TextColumn::def(array('tags' => array('title')))),
            'cpf' => H\SetRequired::modify(H\TextColumn::def(array(self::TYPE_RULE => $cpfRules))),
            'email' => H\SetRequired::modify(H\EmailColumn::def()),
            'senha' => H\PasswordColumn::def(),
            'confirma_senha' => H\PasswordColumn::def(array('confirmation' => 'confirma_senha')),
            'telefone' => H\SetRequired::modify(H\TextColumn::def()),
            'logradouro' => H\SetRequired::modify(H\TextColumn::def()),
            'numero' => H\SetRequired::modify(H\TextColumn::def()),
            'bairro' => H\SetRequired::modify(H\TextColumn::def()),
            'cep' => H\SetRequired::modify(H\TextColumn::def()),
            'cidade' => H\SetRequired::modify(H\TextColumn::def()),
            'estado' => H\SetRequired::modify(H\SimpleSelectColumn::def(array('values' => \C::$ufs))),
            'criado' => H\DateTimeColumn::def(array('tags' => array('metadata'))),
            'pago' => H\SetDefault::modify(H\BooleanColumn::def(array(self::OPERATION => array('create' => null))), false),
        );

        return $def;
    }

    public function prepareInput($input) {
        $input['senha'] = \C::$hasher->HashPassword($input['senha']);
        unset($input['confirma_senha']);
        return $input;
    }

}
