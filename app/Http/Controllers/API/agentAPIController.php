<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateagentAPIRequest;
use App\Http\Requests\API\UpdateagentAPIRequest;
use App\Models\agent;
use App\Repositories\agentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class agentController
 * @package App\Http\Controllers\API
 */

class agentAPIController extends AppBaseController
{
    /** @var  agentRepository */
    private $agentRepository;

    public function __construct(agentRepository $agentRepo)
    {
        $this->agentRepository = $agentRepo;
    }

    /**
     * Display a listing of the agent.
     * GET|HEAD /agents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->agentRepository->pushCriteria(new RequestCriteria($request));
        $this->agentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $agents = $this->agentRepository->all();

        return $this->sendResponse($agents->toArray(), 'Agents retrieved successfully');
    }

    /**
     * Store a newly created agent in storage.
     * POST /agents
     *
     * @param CreateagentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateagentAPIRequest $request)
    {
        $input = $request->all();

        $agents = $this->agentRepository->create($input);

        return $this->sendResponse($agents->toArray(), 'Agent saved successfully');
    }

    /**
     * Display the specified agent.
     * GET|HEAD /agents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var agent $agent */
        $agent = $this->agentRepository->findWithoutFail($id);

        if (empty($agent)) {
            return $this->sendError('Agent not found');
        }

        return $this->sendResponse($agent->toArray(), 'Agent retrieved successfully');
    }

    /**
     * Update the specified agent in storage.
     * PUT/PATCH /agents/{id}
     *
     * @param  int $id
     * @param UpdateagentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateagentAPIRequest $request)
    {
        $input = $request->all();

        /** @var agent $agent */
        $agent = $this->agentRepository->findWithoutFail($id);

        if (empty($agent)) {
            return $this->sendError('Agent not found');
        }

        $agent = $this->agentRepository->update($input, $id);

        return $this->sendResponse($agent->toArray(), 'agent updated successfully');
    }

    /**
     * Remove the specified agent from storage.
     * DELETE /agents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var agent $agent */
        $agent = $this->agentRepository->findWithoutFail($id);

        if (empty($agent)) {
            return $this->sendError('Agent not found');
        }

        $agent->delete();

        return $this->sendResponse($id, 'Agent deleted successfully');
    }
}
