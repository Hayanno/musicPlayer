<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateartistsAPIRequest;
use App\Http\Requests\API\UpdateartistsAPIRequest;
use App\Models\artists;
use App\Repositories\artistsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class artistsController
 * @package App\Http\Controllers\API
 */

class artistsAPIController extends InfyOmBaseController
{
    /** @var  artistsRepository */
    private $artistsRepository;

    public function __construct(artistsRepository $artistsRepo)
    {
        $this->artistsRepository = $artistsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/artists",
     *      summary="Get a listing of the artists.",
     *      tags={"artists"},
     *      description="Get all artists",
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
     *                  @SWG\Items(ref="#/definitions/artists")
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
        $this->artistsRepository->pushCriteria(new RequestCriteria($request));
        $this->artistsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $artists = $this->artistsRepository->all();

        return $this->sendResponse($artists->toArray(), 'artists retrieved successfully');
    }

    /**
     * @param CreateartistsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/artists",
     *      summary="Store a newly created artists in storage",
     *      tags={"artists"},
     *      description="Store artists",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="artists that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/artists")
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
     *                  ref="#/definitions/artists"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateartistsAPIRequest $request)
    {
        $input = $request->all();

        $artists = $this->artistsRepository->create($input);

        return $this->sendResponse($artists->toArray(), 'artists saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/artists/{id}",
     *      summary="Display the specified artists",
     *      tags={"artists"},
     *      description="Get artists",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of artists",
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
     *                  ref="#/definitions/artists"
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
        /** @var artists $artists */
        $artists = $this->artistsRepository->find($id);

        if (empty($artists)) {
            return Response::json(ResponseUtil::makeError('artists not found'), 404);
        }

        return $this->sendResponse($artists->toArray(), 'artists retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateartistsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/artists/{id}",
     *      summary="Update the specified artists in storage",
     *      tags={"artists"},
     *      description="Update artists",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of artists",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="artists that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/artists")
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
     *                  ref="#/definitions/artists"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateartistsAPIRequest $request)
    {
        $input = $request->all();

        /** @var artists $artists */
        $artists = $this->artistsRepository->find($id);

        if (empty($artists)) {
            return Response::json(ResponseUtil::makeError('artists not found'), 404);
        }

        $artists = $this->artistsRepository->update($input, $id);

        return $this->sendResponse($artists->toArray(), 'artists updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/artists/{id}",
     *      summary="Remove the specified artists from storage",
     *      tags={"artists"},
     *      description="Delete artists",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of artists",
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
        /** @var artists $artists */
        $artists = $this->artistsRepository->find($id);

        if (empty($artists)) {
            return Response::json(ResponseUtil::makeError('artists not found'), 404);
        }

        $artists->delete();

        return $this->sendResponse($id, 'artists deleted successfully');
    }
}
