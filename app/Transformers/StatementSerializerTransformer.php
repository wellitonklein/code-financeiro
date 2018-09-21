<?php

namespace CodeFin\Transformers;

use CodeFin\Models\AbstractCategory;
use CodeFin\Presenters\StatementPresenter;
use CodeFin\Serializer\StatementSerializer;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer.
 *
 * @package namespace CodeFin\Transformers;
 */
class StatementSerializerTransformer extends TransformerAbstract
{

    private $statementPresenter;

    public function __construct(StatementPresenter $statementPresenter)
    {
        $this->statementPresenter = $statementPresenter;
    }

    /**
     * Transform the CategoryRevenue entity.
     *
     * @param \CodeFin\Models\CategoryExpense $serializer
     *
     * @return array
     */
    public function transform(StatementSerializer $serializer)
    {
        return [
            'statements' => $this->statementPresenter->present($serializer->getStatements()),
            'statement_data' => $serializer->getStatementData()
        ];
    }
}
