<?php

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
        return $this->request['search'] ?? '';
    }

    /**
     * @return string
     */
    public function getSortField(): string
    {
        return $this->request['sort_field'] ?? 'id';
    }

    /**
     * @return string
     */
    public function getSortAsc(): string
    {
        return $this->request['sort_asc'] ?? '1';
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->request['per_page'] ?? 10;
    }
}
