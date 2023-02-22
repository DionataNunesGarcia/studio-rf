<?php

namespace App\Utils;

class TranslateControllerActions
{
    /**
     *
     */
    const ACTIONS_LIST = [
        'index' => 'Pesquisar',
        'add' => 'Adicionar',
        'edit' => 'Editar',
        'deleteOwner' => 'Deletar seus registros',
        'delete' => 'Excluir',
        'view' => 'Visualizar',
        'searchOwners' => 'Pesquisar seus registros',
        'editOwner' => 'Editar seus registros',
        'enabledDisabled' => 'Habilitar/Desabilitar',
        'addEventTypeCustom' => 'Adicionar Tipo de Evento Customizado',
        'consultationSave' => 'Editar Consulta',
        'searchOnlyYourPatients' => 'Pesquisar seus Pacientes',
        'editOnlyYourPatients' => 'Editar seus Pacientes',
        'deleteOnlyYourPatients' => 'Deletar seus Pacientes',
    ];

    /**
     * @param string $action
     * @return string
     */
    public static function translateAction(string $action) :string
    {
        return key_exists($action, self::ACTIONS_LIST)
            ? self::ACTIONS_LIST[$action]
            : ucfirst($action);
    }

    /**
     *
     */
    const CONTROLLER_LIST = [
        'About' => 'Sobre',
        'BlogsCategories' => 'Categorias de Conteúdos',
        'Blogs' => 'Conteúdos',
        'Consultations' => 'Consultas',
        'Contacts' => 'Contatos',
        'ContactsNewsletters' => 'NewsLetters',
        'Events' => 'Eventos',
        'EventsTypes' => 'Tipos de Eventos',
        'Levels' => 'Níveis',
        'LogsAccess' => 'Logs de Acesso',
        'LogsChange' => 'Logs de Alterações',
        'OurServices' => 'Nossos Serviços',
        'SystemParameters' => 'Parâmetros de Sistema',
        'Patients' => 'Pacientes',
        'Specialists' => 'Psicólogos',
        'Users' => 'Usuários',
        'Testimonials' => 'Depoimentos',
        'SpecialistsCategories' => 'Tipos de Especialistas',
    ];

    /**
     * @param string $controller
     * @return string
     */
    public static function translateController(string $controller) :string
    {
        return key_exists($controller, self::CONTROLLER_LIST)
            ? self::CONTROLLER_LIST[$controller]
            : $controller;
    }
}
