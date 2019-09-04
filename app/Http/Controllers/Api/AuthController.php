<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Validator;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * User login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['tel', 'password']);

            $validator = Validator::make($credentials, [
                'tel' => 'required',
                'password' =>'required',
            ]);


            if ($validator->fails()) {
                throw new Exception('Please check your input params', Response::HTTP_BAD_REQUEST);
            }

            if (!$token = auth('api')->attempt($credentials)) {
                throw new Exception('Unauthorized', Response::HTTP_UNAUTHORIZED);
            }


            return response()->json([
                'error' => false,
                'msg' => 'success',
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'error' => true,
                'msg' => $exception->getMessage(),
            ], $exception->getCode());
        }
    }


    /**
     * User logout
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'error' => false,
            'msg' => 'success',
        ]);
    }


    /**
     * Search login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth()
    {
        return response()->json([
            'error' => false,
            'msg' => 'success',
            'data' => auth('api')->user(),
        ]);

    }
}
