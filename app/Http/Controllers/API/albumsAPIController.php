<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatealbumsAPIRequest;
use App\Http\Requests\API\UpdatealbumsAPIRequest;
use App\Models\albums;
use App\Repositories\albumsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class albumsController
 * @package App\Http\Controllers\API
 */

class albumsAPIController extends InfyOmBaseController
{
    /** @var  albumsRepository */
    private $albumsRepository;

    public function __construct(albumsRepository $albumsRepo)
    {
        $this->albumsRepository = $albumsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/albums",
     *      summary="Get a listing of the albums.",
     *      tags={"albums"},
     *      description="Get all albums",
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
     *                  @SWG\Items(ref="#/definitions/albums")
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
        $this->albumsRepository->pushCriteria(new RequestCriteria($request));
        $this->albumsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $albums = $this->albumsRepository->all();

        return $this->sendResponse($albums->toArray(), 'albums retrieved successfully');
    }

    /**
     * @param CreatealbumsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/albums",
     *      summary="Store a newly created albums in storage",
     *      tags={"albums"},
     *      description="Store albums",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="albums that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/albums")
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
     *                  ref="#/definitions/albums"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatealbumsAPIRequest $request)
    {
        $input = $request->all();

        $albums = $this->albumsRepository->create($input);

        return $this->sendResponse($albums->toArray(), 'albums saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/albums/{id}",
     *      summary="Display the specified albums",
     *      tags={"albums"},
     *      description="Get albums",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of albums",
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
     *                  ref="#/definitions/albums"
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
        /** @var albums $albums */
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            return Response::json(ResponseUtil::makeError('albums not found'), 404);
        }

        return $this->sendResponse($albums->toArray(), 'albums retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatealbumsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/albums/{id}",
     *      summary="Update the specified albums in storage",
     *      tags={"albums"},
     *      description="Update albums",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of albums",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="albums that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/albums")
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
     *                  ref="#/definitions/albums"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatealbumsAPIRequest $request)
    {
        $input = $request->all();

        /** @var albums $albums */
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            return Response::json(ResponseUtil::makeError('albums not found'), 404);
        }

        $albums = $this->albumsRepository->update($input, $id);

        return $this->sendResponse($albums->toArray(), 'albums updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/albums/{id}",
     *      summary="Remove the specified albums from storage",
     *      tags={"albums"},
     *      description="Delete albums",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of albums",
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
        /** @var albums $albums */
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            return Response::json(ResponseUtil::makeError('albums not found'), 404);
        }

        $albums->delete();

        return $this->sendResponse($id, 'albums deleted successfully');
    }
}
