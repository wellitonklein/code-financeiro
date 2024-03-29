<?php

namespace CodeFin\Presenters;

use CodeFin\Transformers\StatementSerializerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryPresenter.
 *
 * @package namespace CodeFin\Presenters;
 */
class StatementSerializerPresenter extends FractalPresenter
{
    private $statementPresenter;

    public function __construct(StatementPresenter $statementPresenter)
    {
        parent::__construct();
        $this->statementPresenter = $statementPresenter;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatementSerializerTransformer($this->statementPresenter);
    }
}
