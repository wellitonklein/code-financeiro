<?php

namespace CodeFin\Presenters;

use CodeFin\Transformers\BillSerializerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryPresenter.
 *
 * @package namespace CodeFin\Presenters;
 */
class BillSerializerPresenter extends FractalPresenter
{
    private $billPresenter;

    public function __construct(BillPresenter $billPresenter)
    {
        parent::__construct();
        $this->billPresenter = $billPresenter;
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillSerializerTransformer($this->billPresenter);
    }
}
