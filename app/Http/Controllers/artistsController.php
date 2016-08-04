<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateartistsRequest;
use App\Http\Requests\UpdateartistsRequest;
use App\Repositories\artistsRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class artistsController extends InfyOmBaseController
{
    /** @var  artistsRepository */
    private $artistsRepository;

    public function __construct(artistsRepository $artistsRepo)
    {
        $this->artistsRepository = $artistsRepo;
    }

    /**
     * Display a listing of the artists.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->artistsRepository->pushCriteria(new RequestCriteria($request));
        $artists = $this->artistsRepository->all();

        return view('artists.index')
            ->with('artists', $artists);
    }

    /**
     * Show the form for creating a new artists.
     *
     * @return Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created artists in storage.
     *
     * @param CreateartistsRequest $request
     *
     * @return Response
     */
    public function store(CreateartistsRequest $request)
    {
        $input = $request->all();

        $artists = $this->artistsRepository->create($input);

        Flash::success('artists saved successfully.');

        return redirect(route('artists.index'));
    }

    /**
     * Display the specified artists.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $artists = $this->artistsRepository->findWithoutFail($id);

        if (empty($artists)) {
            Flash::error('artists not found');

            return redirect(route('artists.index'));
        }

        return view('artists.show')->with('artists', $artists);
    }

    /**
     * Show the form for editing the specified artists.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $artists = $this->artistsRepository->findWithoutFail($id);

        if (empty($artists)) {
            Flash::error('artists not found');

            return redirect(route('artists.index'));
        }

        return view('artists.edit')->with('artists', $artists);
    }

    /**
     * Update the specified artists in storage.
     *
     * @param  int              $id
     * @param UpdateartistsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateartistsRequest $request)
    {
        $artists = $this->artistsRepository->findWithoutFail($id);

        if (empty($artists)) {
            Flash::error('artists not found');

            return redirect(route('artists.index'));
        }

        $artists = $this->artistsRepository->update($request->all(), $id);

        Flash::success('artists updated successfully.');

        return redirect(route('artists.index'));
    }

    /**
     * Remove the specified artists from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $artists = $this->artistsRepository->findWithoutFail($id);

        if (empty($artists)) {
            Flash::error('artists not found');

            return redirect(route('artists.index'));
        }

        $this->artistsRepository->delete($id);

        Flash::success('artists deleted successfully.');

        return redirect(route('artists.index'));
    }
}
