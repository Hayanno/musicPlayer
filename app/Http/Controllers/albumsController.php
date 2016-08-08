<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatealbumsRequest;
use App\Http\Requests\UpdatealbumsRequest;
use App\Repositories\albumsRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class albumsController extends InfyOmBaseController
{
    /** @var  albumsRepository */
    private $albumsRepository;

    public function __construct(albumsRepository $albumsRepo)
    {
        $this->albumsRepository = $albumsRepo;
    }

    /**
     * Display a listing of the albums.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->albumsRepository->pushCriteria(new RequestCriteria($request));
        $albums = $this->albumsRepository->all();

        return view('albums.index')
            ->with('albums', $albums);
    }

    /**
     * Show the form for creating a new albums.
     *
     * @return Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created albums in storage.
     *
     * @param CreatealbumsRequest $request
     *
     * @return Response
     */
    public function store(CreatealbumsRequest $request)
    {
        $input = $request->all();

        $albums = $this->albumsRepository->create($input);

        Flash::success('albums saved successfully.');

        return redirect(route('albums.index'));
    }

    /**
     * Display the specified albums.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            Flash::error('albums not found');

            return redirect(route('albums.index'));
        }

        return view('albums.show')->with('albums', $albums);
    }

    /**
     * Show the form for editing the specified albums.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            Flash::error('albums not found');

            return redirect(route('albums.index'));
        }

        return view('albums.edit')->with('albums', $albums);
    }

    /**
     * Update the specified albums in storage.
     *
     * @param  int              $id
     * @param UpdatealbumsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatealbumsRequest $request)
    {
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            Flash::error('albums not found');

            return redirect(route('albums.index'));
        }

        $albums = $this->albumsRepository->update($request->all(), $id);

        Flash::success('albums updated successfully.');

        return redirect(route('albums.index'));
    }

    /**
     * Remove the specified albums from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $albums = $this->albumsRepository->findWithoutFail($id);

        if (empty($albums)) {
            Flash::error('albums not found');

            return redirect(route('albums.index'));
        }

        $this->albumsRepository->delete($id);

        Flash::success('albums deleted successfully.');

        return redirect(route('albums.index'));
    }
}
