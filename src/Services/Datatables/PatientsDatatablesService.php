<?php

namespace App\Services\Datatables;

use App\Utils\ConvertDates;
use App\Utils\Enum\ParameterTypesFilter;
use App\Utils\Enum\StatusEnum;
use App\Utils\Masks;
use Cake\Controller\Controller;
use Cake\Routing\Router;

class PatientsDatatablesService extends DatatablesService
{
    /**
     * @return array[]
     */
    protected array $_customFields = [
        "name" => [
            'field' => 'Patients.name',
            'type' => ParameterTypesFilter::LIKE,
        ],
        "cpf" => [
            'field' => 'Consultations.cpf',
            'type' => ParameterTypesFilter::LIKE_ONLY_NUMBERS,
        ],
    ];

    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Patients');
        parent::__construct($controller);
    }

    /**
     * @param int|null $onlyMyPatients
     * @return array
     */
    public function getResults(?int $onlyMyPatients = 0) :array
    {
        try {
            $this->setDataTableFilters();
            $this->addSortCondition();
            $this->setConditions($onlyMyPatients);
            $query = $this->getSearchQuery();
            $total = $query->count();
            $results = $query->toArray();

            $response = $this->handleResponse($results);

            return [
                "draw" => $this->draw ?? 1,
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $response
            ];
        } catch (\Exception $ex) {
            return [
                "draw" => $this->draw,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ];
        }
    }

    /**
     * Sort by DataTable column
     */
    private function addSortCondition()
    {
        $target = $this->getModel() . '.created';
        $method = 'DESC';

        if (!empty($this->order)) {

//            $dataTableColumnNumber = $this->order[0]["column"];
//
//            if (isset($this->sortableColumns[$dataTableColumnNumber])) {
//
//                $target = $this->sortableColumns[$dataTableColumnNumber];
//                $method = mb_strtoupper($this->order[0]["dir"]);
//            }
        }

        $this->order = [
            $target => $method
        ];
    }

    private function setConditions(int $onlyMyPatients)
    {
        if ($onlyMyPatients && $this->_userSession['specialist']) {
            $this->conditions["{$this->getModel()}.specialist_id"] = $this->_userSession['specialist']['id'];
        }
        $this->conditions["{$this->getModel()}.status !="] = StatusEnum::EXCLUDED;
        $this->setCustomFilters();
    }

    private function getSearchQuery()
    {
        $query = $this->__table
            ->find('list', [
                'keyField' => function($q) {},
                'valueField' => function($q) {
                    return $q;
                },
            ])
            ->where($this->conditions)
            ->contain($this->getContains())
            ->order($this->order);

        if ($this->limit > 0) {
            $query
                ->limit($this->limit)
                ->offset($this->offset);
        }
        return $query;
    }

    /**
     * @param array $results
     * @return array
     */
    private function handleResponse(array $results) :array
    {
        $response = [];
        foreach ($results as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'cpf' => Masks::cpf($item->cpf),
                'phone' => Masks::phone($item->phone),
                'cell_phone' => Masks::phone($item->cell_phone),
                'created' => $item->created->i18nFormat('dd/MM/yyyy HH:mm:ss'),
                'actions' => [
                    'edit' => $this->hasPermission('edit', $this->getModel(), $item->id),
                    'delete' => $this->hasPermission('delete', $this->getModel(), $item->id),
                    'editOnlyYourPatients' => $this->hasPermission('editOnlyYourPatients', $this->getModel(), $item->id),
                    'deleteOnlyYourPatients' => $this->hasPermission('deleteOnlyYourPatients', $this->getModel(), $item->id),
                ],
            ];
        }
        return $response;
    }

    /**
     * @return string[]
     */
    public function getContains() :array
    {
        return [
//            'Blogs'
        ];
    }
}
