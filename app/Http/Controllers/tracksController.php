<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatetracksRequest;
use App\Http\Requests\UpdatetracksRequest;
use App\Repositories\tracksRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class tracksController extends InfyOmBaseController
{
    /** @var  tracksRepository */
    private $tracksRepository;

    public function __construct(tracksRepository $tracksRepo)
    {
        $this->tracksRepository = $tracksRepo;
    }

    /**
     * Display a listing of the tracks.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tracksRepository->pushCriteria(new RequestCriteria($request));
        $tracks = $this->tracksRepository->all();

        return view('tracks.index')
            ->with('tracks', $tracks);
    }

    /**
     * Show the form for creating a new tracks.
     *
     * @return Response
     */
    public function create()
    {
        $artists = tracks::lists('title', 'id');

        return view('tracks.create', compact('artists'));
    }

    /**
     * Store a newly created tracks in storage.
     *
     * @param CreatetracksRequest $request
     *
     * @return Response
     */
    public function store(CreatetracksRequest $request)
    {
        $input = $request->all();

        $tracks = $this->tracksRepository->create($input);

        Flash::success('tracks saved successfully.');

        return redirect(route('tracks.index'));
    }

    /**
     * Display the specified tracks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tracks = $this->tracksRepository->findWithoutFail($id);

        if (empty($tracks)) {
            Flash::error('tracks not found');

            return redirect(route('tracks.index'));
        }

        return view('tracks.show')->with('tracks', $tracks);
    }

    /**
     * Show the form for editing the specified tracks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tracks = $this->tracksRepository->findWithoutFail($id);

        if (empty($tracks)) {
            Flash::error('tracks not found');

            return redirect(route('tracks.index'));
        }

        return view('tracks.edit')->with('tracks', $tracks);
    }

    /**
     * Update the specified tracks in storage.
     *
     * @param  int              $id
     * @param UpdatetracksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetracksRequest $request)
    {
        $tracks = $this->tracksRepository->findWithoutFail($id);

        if (empty($tracks)) {
            Flash::error('tracks not found');

            return redirect(route('tracks.index'));
        }

        $tracks = $this->tracksRepository->update($request->all(), $id);

        Flash::success('tracks updated successfully.');

        return redirect(route('tracks.index'));
    }

    /**
     * Remove the specified tracks from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tracks = $this->tracksRepository->findWithoutFail($id);

        if (empty($tracks)) {
            Flash::error('tracks not found');

            return redirect(route('tracks.index'));
        }

        $this->tracksRepository->delete($id);

        Flash::success('tracks deleted successfully.');

        return redirect(route('tracks.index'));
    }
}
