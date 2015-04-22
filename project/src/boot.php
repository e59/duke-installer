<?php

/**
 * Menu callback example.
 */
/*

\C::$changeMenuCallback[] = '\Tanz\changeMenu';

function changeMenu($index, $controller, $menu, &$options, $breadcrumb) {

    if (!$breadcrumb) {
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->setChildrenAttribute('id', 'main-menu');
        $options['branch_class'] = 'dropdown';
    }


    $order[] = 'duke';
    $order[] = 'duke.user_management';
    $order[] = 'duke.page';

    $order[] = 'conteudo';
    $item = $menu->addChild('conteudo', array(
        'uri' => 'javascript:void(0)',
        'label' => '<span class="fa fa-files-o"></span> Conteúdo',
        'extras' => array(
            'safe_label' => true,
            'index' => 'conteudo',
        ),
    ));

    // Apoio
    $subitem = $item->addChild('duke/apoio', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Apoio',
        'extras' => array(
            'index' => 'duke/apoio',
        ),
    ));

    $subitem->addChild('duke/apoio/read', array(
        'uri' => $controller->link('duke/apoio/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/apoio/read',
        ),
    ));

    $subitem->addChild('duke/apoio/create', array(
        'uri' => $controller->link('duke/apoio/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/apoio/create',
        ),
    ));



    // Patrocinadores
    $subitem = $item->addChild('duke/patrocinador', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Patrocinadores',
        'extras' => array(
            'index' => 'duke/patrocinador',
        ),
    ));

    $subitem->addChild('duke/patrocinador/read', array(
        'uri' => $controller->link('duke/patrocinador/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/patrocinador/read',
        ),
    ));

    $subitem->addChild('duke/patrocinador/create', array(
        'uri' => $controller->link('duke/patrocinador/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/patrocinador/create',
        ),
    ));

    // Contatos
    $subitem = $item->addChild('duke/contato', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Contatos',
        'extras' => array(
            'index' => 'duke/contato',
        ),
    ));

    $subitem->addChild('duke/contato/read', array(
        'uri' => $controller->link('duke/contato/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/contato/read',
        ),
    ));

    $subitem->addChild('duke/contato/create', array(
        'uri' => $controller->link('duke/contato/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/contato/create',
        ),
    ));


    // Cursos
    $subitem = $item->addChild('duke/curso', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Cursos',
        'extras' => array(
            'index' => 'duke/curso',
        ),
    ));

    $subitem->addChild('duke/curso/read', array(
        'uri' => $controller->link('duke/curso/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/curso/read',
        ),
    ));

    $subitem->addChild('duke/curso/create', array(
        'uri' => $controller->link('duke/curso/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/curso/create',
        ),
    ));


    // Galeria
    $subitem = $item->addChild('duke/galeria', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Galerias',
        'extras' => array(
            'index' => 'duke/galeria',
        ),
    ));

    $subitem->addChild('duke/galeria/read', array(
        'uri' => $controller->link('duke/galeria/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/galeria/read',
        ),
    ));

    $subitem->addChild('duke/galeria/create', array(
        'uri' => $controller->link('duke/galeria/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/galeria/create',
        ),
    ));


    // Jurados
    $subitem = $item->addChild('duke/jurado', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Jurados',
        'extras' => array(
            'index' => 'duke/jurado',
        ),
    ));

    $subitem->addChild('duke/jurado/read', array(
        'uri' => $controller->link('duke/jurado/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/jurado/read',
        ),
    ));

    $subitem->addChild('duke/jurado/create', array(
        'uri' => $controller->link('duke/jurado/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/jurado/create',
        ),
    ));


    // Premiação
    $subitem = $item->addChild('duke/premiacao', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Premiação',
        'extras' => array(
            'index' => 'duke/premiacao',
        ),
    ));

    $subitem->addChild('duke/premiacao/read', array(
        'uri' => $controller->link('duke/premiacao/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/premiacao/read',
        ),
    ));

    $subitem->addChild('duke/premiacao/create', array(
        'uri' => $controller->link('duke/premiacao/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/premiacao/create',
        ),
    ));

    // Programação
    $subitem = $item->addChild('duke/programacao', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Programação',
        'extras' => array(
            'index' => 'duke/programacao',
        ),
    ));

    $subitem->addChild('duke/programacao/read', array(
        'uri' => $controller->link('duke/programacao/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/programacao/read',
        ),
    ));

    $subitem->addChild('duke/programacao/create', array(
        'uri' => $controller->link('duke/programacao/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/programacao/create',
        ),
    ));


    // Quem somos
    $subitem = $item->addChild('duke/quemsomos', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Quem somos',
        'extras' => array(
            'index' => 'duke/quemsomos',
        ),
    ));

    $subitem->addChild('duke/quemsomos/read', array(
        'uri' => $controller->link('duke/quemsomos/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/quemsomos/read',
        ),
    ));

    $subitem->addChild('duke/quemsomos/create', array(
        'uri' => $controller->link('duke/quemsomos/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/quemsomos/create',
        ),
    ));


    // Vitrine
    $subitem = $item->addChild('duke/vitrine', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Vitrine',
        'extras' => array(
            'index' => 'duke/vitrine',
        ),
    ));

    $subitem->addChild('duke/vitrine/read', array(
        'uri' => $controller->link('duke/vitrine/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/vitrine/read',
        ),
    ));

    $subitem->addChild('duke/vitrine/create', array(
        'uri' => $controller->link('duke/vitrine/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/vitrine/create',
        ),
    ));


    // Vitrine interna
    $subitem = $item->addChild('duke/vitrineinterna', array(
        'uri' => 'javascript:void(0)',
        'label' => 'Vitrine interna',
        'extras' => array(
            'index' => 'duke/vitrineinterna',
        ),
    ));

    $subitem->addChild('duke/vitrineinterna/read', array(
        'uri' => $controller->link('duke/vitrineinterna/read'),
        'label' => 'Listar',
        'extras' => array(
            'index' => 'duke/vitrineinterna/read',
        ),
    ));

    $subitem->addChild('duke/vitrineinterna/create', array(
        'uri' => $controller->link('duke/vitrineinterna/create'),
        'label' => 'Novo',
        'extras' => array(
            'index' => 'duke/vitrineinterna/create',
        ),
    ));

    $order[] = 'inscricoes';
    $item = $menu->addChild('inscricoes', array(
        'uri' => 'javascript:void(0)',
        'label' => '<span class="fa fa-group"></span> Inscrições',
        'extras' => array(
            'safe_label' => true,
            'index' => 'inscricoes',
        ),
    ));

    $item->addChild('duke/inscricao/festival', array(
        'uri' => $controller->link('duke/inscricao/festival/read'),
        'label' => 'Festival',
        'extras' => array(
            'index' => 'duke/inscricao/festival/read',
        ),
    ));

    $item->addChild('duke/inscricao/alojamento', array(
        'uri' => $controller->link('duke/inscricao/alojamento/read'),
        'label' => 'Alojamento',
        'extras' => array(
            'index' => 'duke/inscricao/alojamento/read',
        ),
    ));

    $item->addChild('duke/inscricao/curso', array(
        'uri' => $controller->link('duke/inscricao/curso/read'),
        'label' => 'Curso',
        'extras' => array(
            'index' => 'duke/inscricao/curso/read',
        ),
    ));


    $menu->reorderChildren($order);
}
*/
