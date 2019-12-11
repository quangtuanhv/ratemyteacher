<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\RoleInterface;
use App\Repositories\Contracts\ReviewTeacherInterface;
use Carbon\Carbon;
use Hash;
use App\Models\User;
use App\Models\Role;
use Exception;
use App\Exceptions\Api\UnknowException;
use App\Http\Requests\PasswordRequest;

class UserController extends ApiController
{

    protected $roleRepository;
    protected $reviewRepository;

    public function __construct(
        UserInterface $userRepository,
        RoleInterface $roleRepository,
        ReviewTeacherInterface $reviewRepository
    ) {
        parent::__construct($userRepository);
        $this->roleRepository = $roleRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function authUser()
    {
        return $this->user->load([
            'roles' => function ($query) {
                $query->where('type', Role::TYPE_SYSTEM);
            }
        ]);
    }

   public function show($id){
        $user = $this->repository->findOrFail($id);
        return $this->getData(function () use ($user){
            $this->compacts['user_profile'] = $this->repository->getProfile($user);
        });
   }

   public function changePassword(PasswordRequest $request, $id)
   {
        $newPassword = $request->passwordNew;
        $oldPassword = $request->passwordOld;
        $user = User::find($id);
        // dd($newPassword, $oldPassword);
        if (Hash::check($oldPassword, $user->password)) {
            return $this->doAction(function () use($id, $newPassword){
                $this->compacts['user'] = $this->repository->update($id, [
                    'password' => $newPassword
                ]);
            });
        }
        throw new UnknowException('Mật khẩu cũ không đúng');
   }

   public function update(Request $request, $id) {
            $data = ['name'    =>  $request->name,
            'birthday'=>  $request->birthday,
            'address' =>  $request->address,
            'avatar'  =>  $request->avatar,
            'phone'   =>  $request->phone,
            'gender'  =>  $request->gender,
            'about'   =>  $request->about];

        return $this->doAction(function () use($data, $id){
            $this->compacts['user'] = $this->repository->update( $id, $data);
        });
   }

   public function getReview($userId){
        return $this->getData(function () use($userId){
            $this->compacts['review'] = $this->reviewRepository->getReviewByUser($userId);
        });
   }
}
