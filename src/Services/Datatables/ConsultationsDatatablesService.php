<?php

namespace App\Services\Datatables;

use App\Model\Entity\Patient;
use App\Utils\ConvertCharacters;
use App\Utils\Enum\ParameterTypesFilter;
use App\Utils\Enum\StatusEnum;
use App\Utils\Masks;
use Cake\Controller\Controller;

class ConsultationsDatatablesService extends DatatablesService
{
    /**
     * @return array[]
     */
    protected array $_customFields = [
        "patient_id" => [
            'field' => 'Consultations.patient_id',
            'type' => ParameterTypesFilter::EQUAL,
        ],
        "specialist_id" => [
            'field' => 'Consultations.specialist_id',
            'type' => ParameterTypesFilter::EQUAL,
        ],
        "dates_start_end" => [
            'field' => 'Consultations.date',
            'type' => ParameterTypesFilter::DATE_RANGE,
        ],
    ];

    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Consultations');
        parent::__construct($controller);
    }

    /**
     * @param int|null $patientId
     * @param bool $onlyOwn
     * @return array
     */
    public function getResults(?int $patientId = null, bool $onlyOwn = false) :array
    {
        try {
            $this->setDataTableFilters();
            $this->addSortCondition();
            $this->setConditions($patientId, $onlyOwn);
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

    private function setConditions(?int $patientId = null)
    {
        if ($patientId) {
            $this->conditions["{$this->getModel()}.patient_id"] = $patientId;
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
            $item->time = $item->date->i18nFormat('HH:mm');
            $item->date = $item->date->i18nFormat('dd/MM/yyyy');
            $item->value = ConvertCharacters::floatToString($item->value);
            $item->amount_paid = ConvertCharacters::floatToString($item->amount_paid);
            $item->date_paid = $item->date_paid ? $item->date_paid->i18nFormat('dd/MM/yyyy') : '';
            $response[] = [
                'id' => $item->id,
                'date' => $item->date,
                'time' => $item->time,
                'specialist' => $item->specialist->name,
                'value' => $item->value,
                'created' => $item->created->i18nFormat('dd/MM/yyyy HH:mm:ss'),
                'patient' => $this->buildPatient($item->patient),
                'entity' => $item,
                'actions' => [
                    'edit' => $this->hasPermission('edit', $this->getModel(), $item->id),
                    'consultationSave' => $this->hasPermission('consultationSave', 'Patients', $item->id),
                    'delete' => $this->hasPermission('delete', $this->getModel(), $item->id),
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
            'Specialists',
            'Patients',
        ];
    }

    /**
     * @param Patient $patient
     * @return string
     */
    private function buildPatient(Patient $patient)
    {
        return $patient->name
            . "<br>CPF: "
            . Masks::cpf($patient->cpf)
            . "<br>Email: "
            . $patient->email
            . "<br>Telefone: "
            . Masks::phone($patient->phone)
            . "<br>Celular: "
            . Masks::phone($patient->cell_phone);
    }
}
