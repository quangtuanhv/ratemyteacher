<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CenterInterface;
class CenterController extends ApiController
{
    private $centerRepository;

    public function __construct(
        CenterInterface $centerRepository
    ) {
        parent::__construct();
        $this->centerRepository = $centerRepository;
    }

    public function index(){
        return $this->getData(function () {
            $this->compacts['list'] = $this->centerRepository->all()->map(function ($item) {
                $teachers = ['teachers' => $item->teachers->count()];
                $item = collect($item);
                return $item->merge($teachers);
            });
        });
    }

    public function show($id) {
        $center = $this->centerRepository->findOrFail($id);
        $teachers =  $center->teachers;
        return $this->getData(function () use ($center) {
            $this->compacts['center'] = $center;
        });
    }

    public function store(Request $request){
        $data = $request->only(
            'name',
            'address',
            'description',
            'phone',
            'image',
            'email',
            'website',
        );
        $data['user_id'] = $this->user ?  $this->user->id : $request->userId ;
        return $this->doAction(function () use ($data) {
            $this->compacts['message'] = $this->centerRepository->create($data);
        });
    }
}
