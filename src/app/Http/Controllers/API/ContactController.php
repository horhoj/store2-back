<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\repositories\ContactRepository;
use App\Types\APIIndexRequestParams;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactRepository $contactRepository;

    public const CONTACT_ID = 'contact';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index(Request $request): array
    {
        $APIIndexRequestParams = new APIIndexRequestParams($request);

        return $this->contactRepository->getList($APIIndexRequestParams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function store(Request $request): array
    {
        $data = $request->all();

        return $this->contactRepository->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return array
     */
    public function show(Request $request): array
    {
        $id = $request[self::CONTACT_ID] ?? 0;

        return $this->contactRepository->get($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return array
     */
    public function update(Request $request): array
    {
        $id = $request[self::CONTACT_ID] ?? 0;
        $data = $request->all();

        return $this->contactRepository->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): array
    {
        $id = $request[self::CONTACT_ID] ?? 0;

        return $this->contactRepository->delete($id);
    }
}
