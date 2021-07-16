<?php

declare(strict_types=1);

namespace App\Types;

use Illuminate\Http\Request;

/**
 * Class APIIndexRequestParams
 *
 * @package App\Types
 */
class APIIndexRequestParams
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * APIIndexRequestParams constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->request->query('search') ?? '';
    }

    /**
     * @return string
     */
    public function getSortField(): string
    {
        return $this->request->query('sort_field') ?? 'id';
    }

    /**
     * @return string
     */
    public function getSortAsc(): string
    {
        return $this->request->query('sort_asc') ?? '1';
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        $per_page = $this->request->query('per_page');
        $res = intval($per_page);

        return $res > 0 ? $res : 10;
    }
}
