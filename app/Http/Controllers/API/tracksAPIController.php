<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetracksAPIRequest;
use App\Http\Requests\API\UpdatetracksAPIRequest;
use App\Models\tracks;
use App\Repositories\tracksRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class tracksController
 * @package App\Http\Controllers\API
 */

class tracksAPIController extends InfyOmBaseController
{
    /** @var  tracksRepository */
    private $tracksRepository;

    public function __construct(tracksRepository $tracksRepo)
    {
        $this->tracksRepository = $tracksRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tracks",
     *      summary="Get a listing of the tracks.",
     *      tags={"tracks"},
     *      description="Get all tracks",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/tracks")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->tracksRepository->pushCriteria(new RequestCriteria($request));
        $this->tracksRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tracks = $this->tracksRepository->all();

        return $this->sendResponse($tracks->toArray(), 'tracks retrieved successfully');
    }

    /**
     * @param CreatetracksAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tracks",
     *      summary="Store a newly created tracks in storage",
     *      tags={"tracks"},
     *      description="Store tracks",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="tracks that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/tracks")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/tracks"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatetracksAPIRequest $request)
    {
        $input = $request->all();

        $tracks = $this->tracksRepository->create($input);

        return $this->sendResponse($tracks->toArray(), 'tracks saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tracks/{id}",
     *      summary="Display the specified tracks",
     *      tags={"tracks"},
     *      description="Get tracks",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of tracks",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/tracks"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var tracks $tracks */
        $tracks = $this->tracksRepository->findWithoutFail($id);

        if (empty($tracks)) {
            return Response::json(ResponseUtil::makeError('tracks not found'), 404);
        }

        return $this->sendResponse($tracks->toArray(), 'tracks retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatetracksAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tracks/{id}",
     *      summary="Update the specified tracks in storage",
     *      tags={"tracks"},
     *      description="Update tracks",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of tracks",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="tracks that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/tracks")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/tracks"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatetracksAPIRequest $request)
    {
        $input = $request->all();

        /** @var tracks $tracks */
        $tracks = $this->tracksRepository->find($id);

        if (empty($tracks)) {
            return Response::json(ResponseUtil::makeError('tracks not found'), 404);
        }

        $tracks = $this->tracksRepository->update($input, $id);

        return $this->sendResponse($tracks->toArray(), 'tracks updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tracks/{id}",
     *      summary="Remove the specified tracks from storage",
     *      tags={"tracks"},
     *      description="Delete tracks",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of tracks",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var tracks $tracks */
        $tracks = $this->tracksRepository->find($id);

        if (empty($tracks)) {
            return Response::json(ResponseUtil::makeError('tracks not found'), 404);
        }

        $tracks->delete();

        return $this->sendResponse($id, 'tracks deleted successfully');
    }
}
