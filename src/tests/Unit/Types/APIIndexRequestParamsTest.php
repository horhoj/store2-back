<?php

namespace Tests\Unit\Types;

use App\Types\APIIndexRequestParams;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class APIIndexRequestParamsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_check_return_value_of_getSearch_method_if_search_exists_in_query_parameters()
    {
        $request = Request::create('/?search=marine%20value');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSearch() === 'marine value');
    }

    public function test_it_check_return_value_of_getSearch_method_if_search_doesnt_exists_in_query_parameters()
    {
        $request = Request::create('/');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSearch() === '');
    }

    public function test_it_check_return_value_of_getSortField_method_if_sort_field_exists_in_query_parameters()
    {
        $request = Request::create('/?sort_field=kavarian');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSortField() === 'kavarian');
    }

    public function test_it_check_return_value_of_getSortField_method_if_sort_field_doesnt_exists_in_query_parameters()
    {
        $request = Request::create('/');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSortField() === 'id');
    }

    public function test_it_check_return_value_of_getSortAsc_method_if_sort_asc_exists_in_query_parameters()
    {
        $request = Request::create('/?sort_asc=0');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSortAsc() === '0');
    }

    public function test_it_check_return_value_of_getSortAsc_method_if_sort_asc_doesnt_exists_in_query_parameters()
    {
        $request = Request::create('/');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getSortAsc() === '1');
    }

    public function test_it_check_return_value_of_getPerPage_method_if_per_page_exists_in_query_parameters()
    {
        $request = Request::create('/?per_page=111');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getPerPage() === 111);
    }

    public function test_it_check_return_value_of_getPerPage_method_if_per_page_doesnt_exists_in_query_parameters()
    {
        $request = Request::create('/');

        $api = new APIIndexRequestParams($request);

        $this->assertTrue($api->getPerPage() === 10);
    }
}
