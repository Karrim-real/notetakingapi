<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\AuthUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{

    protected $authUserService;

    public function __construct(AuthUserService $authUserService)
    {
        $this->authUserService = $authUserService;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreUserRequest $request)
    {

        $userDatas = $request->validated();
        //Check If user Already Exists
        // return $userDatas['email'];
        if ($this->authUserService->getUserByEmail($userDatas['email'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email Already Exists',
                'statusCode' => 502,
            ], 502);
        }

        $userDatas['password'] = bcrypt($userDatas['password']);
        $user = $this->authUserService->createUser($userDatas);
        $token = $user->createToken('tokenizer')->plainTextToken;

        return  response()->json(
            [
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Register Successffull',
                'data' => $user,
                'authorization' => [
                    'type' => 'Bearer',
                    'token' => $token
                ]
            ],
            200
        );

        // return $userDatas;

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LoginRequest $request)
    {
        $userDatas = $request->validated();
        // return $userDatas;
        // return $this->authUserService->getUserByEmail($userDatas['email']);
        if (!$this->authUserService->getUserByEmail($userDatas['email'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email Not Found',
                'statusCode' => 404,
            ], 404);

        }
        $userauth =  $this->authUserService->login($userDatas);
        // return $userauth;
            if ($userauth) {
                $user = $this->authUserService->getUserByEmail($userDatas['email']);
                $token = $user->createToken('tokenizer')->plainTextToken;
                // Auth::login($user);
                return  response()->json(
                    [
                        'status' => 'success',
                        'statusCode' => 200,
                        'message' => 'Logined Successfully',
                        'data' => $user,
                        'authorization' => [
                            'type' => 'Bearer',
                            'token' => $token
                        ]
                    ],
                    200
                );
                // return Auth::user();
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Incorrect Password, Please try again',
                'statusCode' => 502,
            ], 502);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            return response()->json([
                [
                    'status' => 'success',
                    'statusCode' => 200,
                    'message' => 'Successfull',
                    'data' => Auth::user(),

                ],
                200
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $userDatas = $request->validated();

        if(Auth::user()){
            if($this->authUserService->updateUser(auth()->user()->id, $userDatas)){
                return response()->json([
                    [
                        'status' => 'success',
                        'statusCode' => 200,
                        'message' => 'Profile Detail Updated',
                        // 'data'
                        'data' => $this->authUserService->getUser(auth()->user()->id),
                    ],
                    200
                ]);
            }
             return response()->json([
                [
                    'status' => 'error',
                    'statusCode' => 500,
                    'message' => 'An error occur while updating user details',
                ],
                200
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // $user = Auth::user();
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'warning',
            'message' => 'You have logged out',
            'statusCode' => 200,
        ], 200);
    }
}
